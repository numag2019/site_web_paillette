<?php
$mail = 'theo6197@gmail.com'; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
$message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Hey mon ami test!";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"WeaponsB\"<cra.conservatoire@gmail.com>".$passage_ligne;


//=====Ajout du message au format HTML
$message= $passage_ligne.$message_txt.$passage_ligne;

//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
echo "message envoyé à ".$mail;
//==========
?>
