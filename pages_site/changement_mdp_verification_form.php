<!--Page accessible en cliquant sur le lien gérer mon compte,
	l'utilisateur doit alors rentrer son ancien mot de passe , si celle ci correspond 
	à une présente dans la bdd, le mot de passe de l'utilisateur peut être remplacé-->		

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
	<link href="../mise_en_page/maFeuilleDeStyle.css" rel="stylesheet" media="all" type="text/css"> 
		<title>
		Site web Cranet
		</title>
	</head>
	
	<body>
	<div>
	<!-- DIV Entête -->
	<?php include("../mise_en_page/entete.html");?>	

	<!-- DIV Navigation (Menus) -->
	<?php include("../mise_en_page/navigation.html"); ?>
	
<?php

if(isset($_POST['mdp_changement']))
	{	
	$mdp=$_POST['mdp_changement'];

	if (password_verify($mdp,$_SESSION['mdp']))
	{		
	echo "<br /> Veuillez entrer votre nouveau mot de passe deux fois de façon identiques:";
	echo "<form action='changement_mdp_verification_form.php' method='post'>
			<p>
			<input type='text' name='nouveaumdp1' />
			<input type='text' name='nouveaumdp2' />
			<input type='submit' value='Valider' />
			</p>
		</form>";
	}
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
