<!-- Formulaire d'authentification-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
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
	
		<?php $authentification=1;?>

		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
	</head>
	
	<body>	



		<div class="container">	
			<div class="row">
				<br></br><br></br><br></br>
				<div id="block2" class="col-md-3 offset-md-4" align='center'  border-radius=30px;>
					<form action="verification_connexion.php" method="post">
					  <div class="form-group">
						<label for="identifiant" style="color: black">Identifiez-vous :</label>
						<input type="text" class="form-control" id="identifiant" name="identifiant" placeholder="Identifiant">
						<small id="remarque" class="form-text text-muted">Vous devez détenir un compte</small>
					  </div>
					  <div class="form-group" style="color: black">
						<label for="mdp">Mot de passe</label>
						<input type="password" name="mdp" class="form-control" id="mdp" placeholder="Mot de passe">
						<small id="mdpoublie" class="form-text text-muted"><a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a></small>
					  </div>
					  <button type="submit" class="btn btn-primary">Valider</button>
					</form>
				</div>
			</div>
		</div>
		
		<?php if (isset($_SESSION['error']))
			{echo $_SESSION['error'];}
		?>
	</body>
	
	<!-- pied de page -->	
	<?php include ("../mise_en_page/pied.html");?>
</html>