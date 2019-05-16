<html>
	<!-- Page executé par 'changement_mdp.php', si l'ancien mot de passe de l'utilisateur correspond à celui hashé  dans la bdd, 
	à le nouveau mot de passe est hashé puis remplace l'ancien -->		
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
	</body>
	<?php include ("../mise_en_page/pied.html");?>
</html>
