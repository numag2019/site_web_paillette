<html>
<!--Page d'acceuil du site web CRAnet-->		
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
	
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	</body>
	
	<footer>
		<!-- DIV Pied de page -->
	<?php include ("../mise_en_page/pied.html");?>
	</footer

</html>