<html>
	<!-- Page executé par 'changement_mdp.php', si l'ancien mot de passe de l'utilisateur correspond à celui hashé  dans la bdd, 
	à le nouveau mot de passe est hashé puis remplace l'ancien -->		
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
	<!-- DIV Navigation (Menus) -->
	<?php include("../mise_en_page/navigation.html"); ?>
<?php

if(isset($_POST['mdp_changement']))
	{	
	$mdp=$_POST['mdp_changement'];

	if (password_verify($mdp,$_SESSION['mdp']))
	{	?>
	<div class="container">	
		<div class="row d-flex justify-content-center">
			<div class="col-md-3 fond"> <br>
				<form action='changement_mdp_verification_form.php' method='post'>
					<label for="mdp">Veuillez entrer votre nouveau mot de passe deux fois de manière identique:</label><br>
					<input type='text' class="form-control" placeholder="Mot de passe" name='nouveaumdp1'><br>
					<input type='text' class="form-control" placeholder="Mot de passe" name='nouveaumdp2'><br>
					<input type='submit' class='btn btn-primary' value='Valider' />
				</form>
			</div>
		</div>
	</div>
	<?php }
	else 
	{
		$_SESSION['error']='Votre mot de passe est incorrect.';
		echo "<script type='text/javascript'>document.location.replace('changement_mdp.php');</script>";
	}
}
///////////////mettre un else 
if(isset($_POST['nouveaumdp1']) and isset($_POST['nouveaumdp2']))
	{
		if ($_POST['nouveaumdp1']=$_POST['nouveaumdp2'])
		{
		// Connexion à la BDD en PDO
		$mdp_hash=password_hash($_POST['nouveaumdp1'], PASSWORD_DEFAULT);//Hashage du mot de passe
		try { $bdd = new PDO('mysql:host=localhost;dbname=crabase','root',''); }
		catch (Exeption $e) { die('Erreur : ' . $e->getMessage())  or die(print_r($bdd->errorInfo())); }
		// Requête SQL sécurisée
		$req = $bdd->prepare("UPDATE utilisateurs
							SET mdp= :mdp
							WHERE id_utilisateur= :id_utilisateur ");
		$req->bindValue('mdp', $mdp_hash, PDO::PARAM_STR);
		$req->bindValue('id_utilisateur', $_SESSION['id_utilisateur'], PDO::PARAM_STR);
		$req->execute();
		echo "<script type='text/javascript'>document.location.replace('deconnexion.php');</script>";
		
		}
else 
	{
	echo "Veuillez entrer deux mots de passe identiques !";   
	}

}

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
