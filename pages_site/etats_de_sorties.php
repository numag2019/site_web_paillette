<!-- Pages d'accès aux téléchargements des états de sorties disponibles pour l'éleveur-->

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
	
<?php
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
	//écrire une requête qui cherche les fichiers que l'utilisateur à accès
}
//Si l'utilisateur n'est pas connecté on affiche le formulaire de connexion 
else
{	
	//
}
?> 
	</body>
	
	<?php include (../mise_en_page/pied.html) ?>
</html>