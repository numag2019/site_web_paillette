<html style="position: relative; min-height: 100%;">
<!--Page d'acceuil du site web CRAnet-->		
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
		<link rel="stylesheet" href="bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

		<!-- Custom styles for our template -->
		<link rel="stylesheet" href="bootstrap-theme.css" media="screen" >
		<link rel="stylesheet" href="main.css">
		
		<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
	<?php $autorisation=TRUE // tout le monde?>

	<!--  Navigation -->
	 <?php 
	 include("../mise_en_page/navigation2.html"); 
	 ?>
	</head>

<body class="home" style="background: url(https://cdn.pixabay.com/photo/2017/06/23/23/50/cow-2436354_1280.jpg) no-repeat center center fixed; background-size: cover; height: 100%;">
	<div class="container">	
		<div class="h-100 row align-items-center">
			<div class="col-md-4 col-lg-4">
				<a href="https://www.synel.net/"><img class="img-fluid" src="../mise_en_page/images/synel2.png"></a>
				<a href="https://www.synel.net/" class="btn btn-light" style="background: rgba(255,255,255,0.5);">Enregistrer et visualiser les informations relatives à vos cheptels bovins.</a>
			</div>
			
			<div class="col-md-4 col-lg-4">
				<a href="http://194.199.250.44:8080/ora/main_icefaces.html?fbclid=IwAR0i_Dfnv6FnDNA9tiD1J3a6t0yc17vIprP5j0i55LLzgm0KLGKVHeK5VjU"><img class="img-fluid" src="../mise_en_page/images/mouton.jpg"></a>
				<a href="http://194.199.250.44:8080/ora/main_icefaces.html?fbclid=IwAR0i_Dfnv6FnDNA9tiD1J3a6t0yc17vIprP5j0i55LLzgm0KLGKVHeK5VjU" class="btn btn-light" style="background: rgba(255,255,255,0.5);">Modifier les informations relatives à vos cheptels ovins.</a>
			</div>
			
			<div class="col-md-4 col-lg-4">
				<a href="https://www.ifce.fr/"><img class="img-fluid" src="../mise_en_page/images/ifce.jpg"></a>
				<a href="https://www.ifce.fr/" class="btn btn-light" style="background: rgba(255,255,255,0.5);">Enregistrer et visualiser les informations concernant vos cheptels équins.</a>
			</div>
		</div>
	</div>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</body>

	<footer>
		<?php include ("../mise_en_page/pied2.html");?>
	</footer>

</html>