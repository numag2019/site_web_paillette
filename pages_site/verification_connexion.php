<?php 

if(empty($_POST['identifiant']) or empty($_POST['mdp'])) 
	{
	echo "Veuillez remplir les deux champs.";
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
	$isPasswordCorrect = password_verify($passord, $resultat['password']);

	if (!$resultat)
	{	
		echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
		if ($isPasswordCorrect) 
		{
			session_start();
			$_SESSION['id'] = $resultat['id']; //creation de variables de sessions
			$_SESSION['id_type']=$id_type;
			$_SESSION['identifiant'] = $identifiant;
			header ('location : mon_espace.php');
		}
		else 
		{
			echo 'Mauvais identifiant ou mot de passe !';
		}
	
	}
}
?>
