<?php 

if(empty($_POST['identifiant']) or empty($_POST['mdp'])) 
	{
	$_SESSION['error']= "Veuillez remplir les deux champs.";
	header ('location : authentification.php')
	;
	}

else
	{
	// On récupère les variables envoyées par le formulaire
	$login = $_POST['identifiant'];
	$password = $_POST['mdp'];

	// Connexion à la BDD en PDO
	try { $bdd = new PDO('mysql:host=localhost;dbname=bdd','root',''); }
	catch (Exeption $e) { die('Erreur : ' .$e->getMessage())  or die(print_r($bdd->errorInfo())); }

	// Requête SQL sécurisée
	$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE login= ? AND password= ?");
	$req->execute(array($login, $password));
	$resultat=$req->fetch();
// Comparaison du pass envoyé via le formulaire avec la base
	$isPasswordCorrect = password_verify($password, $resultat['password']);

	if (!$resultat)
	{	
		$_SESSION['error']= 'Mauvais identifiant ou mot de passe !';
		header ('location : authentification.php');
	}
	else
	{
		if ($isPasswordCorrect) 
		{
			session_start();
			$_SESSION= array()
			session_destroy()
			$_SESSION['id_utilisateur'] = $resultat['id_utilisateur']; //creation de variables de sessions
			$_SESSION['id_type']=$id_type;
			$_SESSION['identifiant'] = $identifiant;
			header ('location : mon_espace.php');
		}
		else 
		{
		$_SESSION['error']= 'Mauvais identifiant ou mot de passe !';
		header ('location : authentification.php');
		}
	
	}
}
?>
