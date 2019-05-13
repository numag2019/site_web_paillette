<!doctype html>
<HTML lang='fr'>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- <link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<!-- <link rel="stylesheet" href="../mise_en_page/bootstrap2.css"> -->
	<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
	<?php $autorisation=TRUE // tout le monde?>

	<!--  Navigation -->
	 <?php 
	 // include("../mise_en_page/navigation.html"); 
	 ?>
	</head>
	
	<body>
		<FORM action = "page2_cra.php">
		<INPUT TYPE = "SUBMIT" name = "bouton1" class="btn btn-light" value = "Consulter la matrice de parenté des éleveurs">
		</FORM>

		<FORM action = "page3_cra.php">
		<INPUT TYPE = "SUBMIT" name = "bouton1" class="btn btn-light" value = "Consulter le tableau récapitulatif des commandes prévisionnelles de paillettes">
		</FORM>
	</body>

</HTML>