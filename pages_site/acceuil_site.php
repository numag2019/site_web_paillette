<!--Page d'acceuil du site web CRAnet-->		

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
	
	<a href="https://www.synel.net/"><img src="../mise_en_page/images/synel.png" alt="synel"/></a> 
	<BR/>
	Accéder à SYNEL, la base de données de l’ARSOE conçue pour enregistrer et visualiser les
informations relatives à vos cheptels bovins.
	<BR/>
	<a href="https://www.ifce.fr/"><img src="../mise_en_page/images/ifce.png" alt="ifce"/></a>
	<BR/>
	Accéder au SIRE, la base de données de l’IFCE vous permettant d’enregistrer et de visualiser les
informations concernant vos cheptels équins.

	<p><a href="deconnexion.html">Déconnexion</a></p>
	
	</body>
<!-- DIV Pied de page -->	
	<?php include ("../mise_en_page/pied.html");?>
</html>