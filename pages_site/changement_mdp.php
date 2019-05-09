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


<div class="container">	
	<div class="row">
		<div id="block1" class="col-md-3 offset-md-4" align='center' >
			<form action="changement_mdp_verification_form.php" method="post">
			  <div class="form-group">
				<label for="mdp">Veuillez entrer votre mot de passe actuel :</label>
				<input type="mdp_changement" name="mdp_changement" class="form-control" id="mdp_changement" placeholder="Mot de passe">
			  <button type="submit" class="btn btn-primary">Valider</button>
			</form>
		</div>
	</div>
</div>

<?php if (isset ($_SESSION['error']))
	{echo $_SESSION['error'];}?>

		<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>
