<!-- Page disponible aux éleveurs bovins identifiés, 
		Elle permet de personnaliser son mot de passe
		Si l'utilisateur n'est pas connecté, la page affiche le formulaire de connexion-->

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">

	<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
	<?php $autorisation=TRUE // tout le monde?>

		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
	</head>
	
	<body>


<div class="container">	
	<div class="row d-flex justify-content-center">
		<div class="col-md-3" style="background: rgba(163,163,163,0.4); border-radius: 10px;" >
			<form action="changement_mdp_verification_form.php" method="post">
			  <div class="form-group">
				<label for="mdp" style="color: black; padding-top: 15px;">Veuillez entrer votre mot de passe actuel :</label>
				<input type="mdp_changement" name="mdp_changement" class="form-control" id="mdp_changement" placeholder="Mot de passe">
				<br>
			  <button type="submit" class="btn btn-primary" style="color: black" >Valider</button>
			</form>
		</div>
		<?php if (isset ($_SESSION['error']))
			{echo $_SESSION['error'];
			unset($_SESSION['error']);}?>
	</div>
</div>


		<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>
