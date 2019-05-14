
<html>
<!--Page disponible aux éleveurs bovins identifiés, 
		elle permet l'accès à la plateforme paillette et à la page des états de sorties
		Si l'utilisateur n'est pas connecté, la page affiche le formulaire de connexion-->		
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">

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
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	</body>
</html>
