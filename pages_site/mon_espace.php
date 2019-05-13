
<html>
<!--Page disponible aux éleveurs bovins identifiés, 
		elle permet l'accès à la plateforme paillette et à la page des états de sorties
		Si l'utilisateur n'est pas connecté, la page affiche le formulaire de connexion-->		
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap.css">

		<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
		<?php $autorisation=TRUE // tout le monde?>
		
		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
	</head>
	
	<body>

		<?php
		if (isset($_SESSION['id_utilisateur']))
		{
			// On affiche les liens disponible au type d'utilisateur connecté
			if ($_SESSION['id_type']==1)//eleveur
			{ 
				echo "<p  align='center' style='color: #303030'>Bienvenue, éleveur</p>";
			}
			elseif ($_SESSION['id_type']==21 or $_SESSION['id_type']==22 or $_SESSION['id_type']==23)//administrateur de race
			{
				echo "<p  align='center' style='color: #303030'>Bienvenue, animateur</p>";
			}
			elseif ($_SESSION['id_type']==3)
			{
				echo "<p  align='center' style='color: #303030'>Bienvenue, administrateur</p>";
			}
		}
		else 
		{
			echo "<script type='text/javascript'>document.location.replace('authentification.php');</script>";
		}
		
		?>
		<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>
