<!-- Formulaire d'authentification-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">
		<link rel="stylesheet" href="../mise_en_page/pied.css">

	<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
	<?php $autorisation=TRUE // tout le monde?>
	
		<?php $authentification=1;?>

	</head>
	
	<body>	

		<?php include("../mise_en_page/navigation.html"); ?>

		<div class="container">	
			<div class="row d-flex justify-content-center">
				<div class="col-md-3 fond">
					<form action="verification_connexion.php" method="post">
					  <div class="form-group">
						<label for="identifiant" style="padding-top: 15px;">Identifiez-vous :</label>
						<input type="text" class="form-control" id="identifiant" name="identifiant" placeholder="Identifiant">
						<small id="remarque" class="form-text text-muted">Vous devez détenir un compte</small>
					  </div>
					  <div class="form-group">
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
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	
	<footer class="footer">
		<?php include ("../mise_en_page/pied.html");?>
	</footer>
	</body>
</html>