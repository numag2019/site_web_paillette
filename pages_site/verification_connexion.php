<?php 
session_start();

if(empty($_POST['identifiant']) or empty($_POST['mdp'])) 
	{
	$_SESSION['error']= "Veuillez remplir les deux champs.";
	header ('location : authentification.php');
	}

else
	{
		// On récupère les variables envoyées par le formulaire
		$identifiant = $_POST['identifiant'];
		$mdp = $_POST['mdp'];

		// Connexion à la BDD en PDO
		try { $bdd = new PDO('mysql:host=localhost;dbname=crabase','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); }
		
		catch (Exeption $e) { die('Erreur : ' . $e->getMessage())  or die(print_r($bdd->errorInfo())); }
		
		// Requête SQL sécurisée
		$req = $bdd->prepare("SELECT * 
							FROM utilisateurs 
							WHERE identifiant= :identifiant ");
		$req->bindValue('identifiant', $identifiant, PDO::PARAM_STR);
		$req->execute();
		$rows = $req->rowCount();
		$resultat = $req->fetchAll(PDO::FETCH_NAMED);
		$resultat=$resultat[0];
	
	

		if ($rows<1)
		{	
			$_SESSION['error']= 'Mauvais identifiant ou mot de passe !';
			header ('location : authentification.php');
		}
		else
		{		
	// Comparaison du mot de passe envoyé via le formulaire avec celui de la base
			if (password_verify($mdp, $resultat['mdp'])) 
			{
				$_SESSION['id_utilisateur'] = $resultat['id_utilisateur']; //creation de variables de sessions
				$_SESSION['id_type']=$resultat['id_type'];
				$_SESSION['identifiant'] = $resultat['identifiant'];
				$_SESSION['mdp']=$resultat['mdp'];
				header ('Location: mon_espace.php');
			}
			else 
			{
			$_SESSION['error']='Mauvais identifiant ou mot de passe !';
			header ('Location: authentification.php'); 
			}
		}	

	}
?>
