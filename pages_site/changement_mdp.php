<!--Page accessible en cliquant sur le lien gérer mon compte,
	l'utilisateur doit alors rentrer son ancien mot de passe , si celle ci correspond 
	à une présente dans la bdd, le mot de passe de l'utilisateur peut être remplacé-->		

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
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
    Modification du mot de passe 
	<br />
    Veuillez entrer votre mot de passe actuel :
</p>

<form action="changement_mdp_verification_form.php" method="post">
<p>
    <input type="text" name="mdp" />
    <input type="submit" value="Valider" />
</p>
</form>
<?php if (isset $_SESSION['error'])
	{echo $_SESSION['error'];}?>
	</body>
	<?php include ("../mise_en_page/pied.html");?>
</html>
