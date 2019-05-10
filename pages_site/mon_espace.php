<!-- Page disponible aux éleveurs bovins identifiés, 
		elle permet l'accès à la plateforme paillette et à la page des états de sorties
		Si l'utilisateur n'est pas connecté, la page affiche le formulaire de connexion-->
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

		<?php
		if (isset($_SESSION['id_utilisateur']))
		{
			// On affiche les liens disponible au type d'utilisateur connecté
			if ($_SESSION['id_type']==1)//eleveur
			{ 
				echo '<p>Bienvenu, éleveur</p>';
			}
			elseif ($_SESSION['id_type']==21 or $_SESSION['id_type']==22 or $_SESSION['id_type']==23)//administrateur de race
			{
				echo '<p>Bienvenu, animateur</p>';
			}
			elseif ($_SESSION['id_type']==3)
			{
				echo '<p>Bienvenu, administrateur</p>';
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
