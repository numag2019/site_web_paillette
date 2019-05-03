<!--Page accessible en cliquant sur le lien mot de passe oublié,
	l'utilisateur doit alors rentrer son adresse email, si celle ci correspond 
	à une présente dans la bdd, le mot de passe de l'utilisateur correspondant 
	est remplacé par un nouveau créer de façon aléatoire, 
	ce mot de passe est envoyé à l'utilisateur et est stocké de façon "hashé" dans la bdd-->		

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">>
	<head>
	<link href="../mise_en_page/maFeuilleDeStyle.css" rel="stylesheet" media="all" type="text/css"> 
		<title>
		Site web Cranet
		</title>
	</head>
	
	<body>
	<div>
	<!-- DIV Entête -->
	<?php include("../mise_en_page/entete.html");?>	

	<!-- DIV Navigation (Menus) -->
	<?php include("../mise_en_page/navigation.html"); ?>
	
<p>
    Réinitialisation du mot de passe 
	<br />
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
	// Déclaration de l'adresse de destination.
	// Protection faille CRLF 
	//Suppression des retours à la ligne lors du traitement
	$mail = str_replace(array("\n","\r",PHP_EOL),'',$_POST['email']); 
	//Vérification que la chaîne de caractères entrée est bien une adresse mail
if (filter_var($mail, FILTER_VALIDATE_EMAIL))
	{
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
	{
		$passage_ligne = "\r\n";
	}
	else
	{
	$passage_ligne = "\n";
	}

	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = 'Veuillez trouvez ci dessous le mot de passe temporaire de votre comptre cranet: ( pensez a le changer rapidement)';

	//==========Création du mot de passe
	function genererChaineAleatoire($longueur = 10)
	{
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*', rand( 1, $longueur) )),1,$longueur);
	}
	$mdp = genererChaineAleatoire();
	//!!!!!! Hasher puis Enregistrer le mot de passe dans la BDD
	
 
	//=====Définition du sujet.
	$sujet = "Reinitialisation de votre mot de passe Cranet";
	//=========
 
	//=====Création du header de l'e-mail.
	$header = "From: \"\"<cra.conservatoire@gmail.com>".$passage_ligne;


	//=====Ajout du message au format txt
	$message= $passage_ligne.$message_txt.$passage_ligne.$mdp;

	//=====Envoi de l'e-mail.
	mail($mail,$sujet,$message,$header);
	//htmlspecialchars() permet de prévenir les failles XSS
	echo "Votre nouveau mot de passe a bien été envoyé à l'adresse ".htmlspecialchars($mail);
	//==========
	}
}
else 
{
	echo "Veuillez entrer une adresse email valide";
}
?>
	</body>
	<?php include ("../mise_en_page/pied.html");?>
</html>
