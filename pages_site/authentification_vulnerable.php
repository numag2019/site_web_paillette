<!-- Formulaire d'authentification-->
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
    Veuillez rentrer vos identifiants :
</p>

<form action="verification_connexion_vulnerable.php" method="post">
<p>
	Pseudo:
    <input type="text" name="identifiant" />
	<br />
	<br />
	Mot de passe:
	<input type="text" name="mdp" />
	<br />
	<br />
    <input type="submit" value="Valider" />
</p>
</form>
<!-- lien vers la page permettant de changer de mot de passe-->
<a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a></li>
<br />
<?php if (isset($_SESSION['error']))
	{echo $_SESSION['error'];}
	

?>
		<!-- DIV Pied de page -->	
		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>