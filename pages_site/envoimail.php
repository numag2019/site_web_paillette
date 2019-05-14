<?php
function envoimail ($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{	
	//==========Création du mot de passe
	$longueur = 10	;
	$mdp= substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*', rand( 1, $longueur) )),1,$longueur);
	$mdp_hash=password_hash($mdp, PASSWORD_DEFAULT);//Hashage du mot de passe

	// Connexion à la BDD en PDO
	$bdd = new PDO('mysql:host=localhost;dbname=crabase','root',''); 
	
	// Requête SQL sécurisée qui modifie le mot de passe de l'utilisateur dont l'email est saisie 
	$req = $bdd->prepare("UPDATE utilisateurs
						SET mdp= :mdp
						WHERE email= :email ");
	$req->bindValue('mdp', $mdp_hash, PDO::PARAM_STR);
	$req->bindValue('email',$email, PDO::PARAM_STR);
	$req->execute();
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
	//$message_txt ='Bonjour, veuillez ne pas prendre en compte le message que vous avez precedemment reçu , toutes nos excuses pour la gene occasionee.';
	//=====Définition du sujet.
	$sujet = "Reinitialisation de votre mot de passe";
	//=========
 
	//=====Création du header de l'e-mail.
	$header = "From: \"\"<cra.conservatoire@gmail.com>".$passage_ligne;
	//=====Ajout du message au format txt
	$message= $passage_ligne.$message_txt.$passage_ligne.$mdp.$passage_ligne.$passage_ligne ;
///php.ini
	mail($email,$sujet,$message,$header);
	}
}