<?php
function envoimail ($email)
{
	$email = str_replace(array("\n","\r",PHP_EOL),'',$_POST['email']); 
	//Vérification que la chaîne de caractères entrée est bien une adresse mail
if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		
	//==========Création du mot de passe
	function genererChaineAleatoire($longueur = 10)
		{return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*', rand( 1, $longueur) )),1,$longueur);}
	$mdp= genererChaineAleatoire();
	$mdp_hash=password_hash($mdp, PASSWORD_DEFAULT);//Hashage du mot de passe

	// Connexion à la BDD en PDO
	try { $bdd = new PDO('mysql:host=localhost;dbname=crabase','root',''); }
	
	catch (Exeption $e) { die('Erreur : ' . $e->getMessage())  or die(print_r($bdd->errorInfo())); }
	
	// Requête SQL sécurisée
	$req = $bdd->prepare("UPDATE utilisateurs
						SET mdp= :mdp
						WHERE email= :email ");
	$req->bindValue('mdp', $mdp_hash, PDO::PARAM_STR);
	$req->bindValue('email',$email, PDO::PARAM_STR);
	$req->execute();
	$rows = $req->rowCount();
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
		{
		$passage_ligne = "\r\n";
		}
	else
		{
		$passage_ligne = "\n";
		}
	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = 'Veuillez trouvez ci dessous le mot de passe temporaire de votre comptre cranet: ( pensez a le changer rapidement)';

	//=====Définition du sujet.
	$sujet = "Reinitialisation de votre mot de passe Cranet";
	//=========
 
	//=====Création du header de l'e-mail.
	$header = "From: \"\"<cra.conservatoire@gmail.com>".$passage_ligne;
	//=====Ajout du message au format txt
	$message= $passage_ligne.$message_txt.$passage_ligne.$mdp;
///php.ini
mail($email,$sujet,$message,$header);
echo "<div class='alert alert-success'><h1>Votre nouveau mot de passe a bien été envoyé.</h1><p>Pensez à le modifier prochainement.</p>";
		}
} 