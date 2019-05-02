<p>
    Réinitialisation du mot de passe <br />
    Veuillez entrer votre adresse email :
</p>

<form action="mot_de_passe_oublie.php" method="post">
<p>
    <input type="text" name="email" />
    <input type="submit" value="Valider" />
</p>
</form>

<?php

if(isset($_POST['email']))
{
$mail = $_POST['email']; // Déclaration de l'adresse de destination.

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = 'Veuillez trouvez ci dessous le mot de passe temporaire de votre comptre cranet, pensez a le changer rapidement';
$mdp='motdepasseturfu45';
//==========
 
//=====Définition du sujet.
$sujet = "Reinitialisation de votre mot de passe Cranet";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"WeaponsB\"<cra.conservatoire@gmail.com>".$passage_ligne;


//=====Ajout du message au format txt
$message= $passage_ligne.$message_txt.$passage_ligne.$mdp;

//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
echo "Votre nouveau mot de passe a bien été envoyé à l'adresse ".$mail;
//==========
}
?>
