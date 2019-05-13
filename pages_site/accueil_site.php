<html>
<!--Page d'acceuil du site web CRAnet-->		
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- <link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css"> -->
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">
	<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
	<?php $autorisation=TRUE // tout le monde?>

	<!--  Navigation -->
	 <?php 
	 include("../mise_en_page/navigation.html"); 
	 ?>
	</head>
	
	<body>
		
 	<div class="container">	
		<div class="h-100 row align-items-center">
			<div class="col-md-4 col-lg-4">

				<a href="https://www.synel.net/"><img class="img-fluid" src="../mise_en_page/images/synel2.png"></a>
								<p align='center' style="color: #303030">

					Enregistrer et visualiser les
					informations relatives à vos cheptels bovins.
				</p>
			</div>
			
			<div class="col-md-4 col-lg-4">
				<a href="http://194.199.250.44:8080/ora/main_icefaces.html?fbclid=IwAR0i_Dfnv6FnDNA9tiD1J3a6t0yc17vIprP5j0i55LLzgm0KLGKVHeK5VjU"><img class="img-fluid" src="../mise_en_page/images/mouton.jpg"></a>
								<p align='center' style="color: #303030" >
					Modifier les informations relatives à vos cheptels ovins.
				</p>
			</div>
			
			<div class="col-md-4 col-lg-4">
				<a href="https://www.ifce.fr/"><img class="img-fluid" src="../mise_en_page/images/ifce.jpg"></a>
				<p align='center' style="color: #303030" >
					Enregistrer et de visualiser les
					informations concernant vos cheptels équins.
				</p>
			</div>
		</div>
	</div>
	</body>
		<!-- DIV Pied de page -->
	<?php include ("../mise_en_page/pied.html");?>
	

</html>