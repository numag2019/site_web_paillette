<!-- Page disponible aux éleveurs bovins identifiés, 
		Elle permet de personnaliser son mot de passe
		Si l'utilisateur n'est pas connecté, la page affiche le formulaire de connexion-->

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

	</head>
	
	<body>

<?php include("../mise_en_page/navigation.html"); ?>

<div class="container">	
	<div class="row d-flex justify-content-center">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 fond"> <br>
			<form action="changement_mdp_verification_form.php" method="post">
			<div class="row d-flex justify-content-center">
				<label for="mdp" class="col-xs-3 col-sm-3 col-md-6 col-lg-6">Veuillez entrer votre mot de passe actuel :</label>
				<div class="row d-flex justify-content-center">
					<input type="mdp_changement" name="mdp_changement" class="form-control col-xs-3 col-sm-3 col-md-10 col-lg-10" id="mdp_changement" placeholder="Mot de passe">
				</div>
				<button type="submit" style="text-align: center" class="btn btn-primary">Valider</button>
			</div>
			</form>
		</div>
		<?php if (isset ($_SESSION['error']))
			{echo $_SESSION['error'];
			unset($_SESSION['error']);}?>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	
	<footer class="footer">
		<?php include ("../mise_en_page/pied.html");?>
	</footer>
	</body>
</html>
