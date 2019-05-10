<html>
<!--Page d'acceuil du site web CRAnet-->		
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
	$id_elevage='bazadaise';
	$fin_chemin = $id_elevage.'php';
	echo $fin_chemin;
	//header("Location: ../uploade/$id_elevage.php ");
	
	?>

	
	<!-- DIV Pied de page -->
	<?php include ("../mise_en_page/pied.html");?>
	</body>
	

</html>