<!-- Page disponible pour les administrateurs du CRA, -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> 

		<!-- Entête -->
		<?php include("../mise_en_page/entete.html");?>	

		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
	</head>
	
	<body>
	
<?php	if ($_SESSION['id_type']==3) //si administrateur
	{ 
?>
	
	<!--lien vers l'administration du site-->
	<p><a href='type_utilisateur.php'>Rendre un éleveur animateur de race</a></p>
	<!--lien vers l'administration du site-->
	<p><a href='type_utilisateur_supp_anim.php'>Rendre un animateur de race éleveur</a></p> 
	
<?php 
} 
else  // sinon
	{
	echo "<script type='text/javascript'>document.location.replace('authentification.php');</script>";
	}
?>
		<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>