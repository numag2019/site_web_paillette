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
<?php include ('envoimail.php')?>
	<body>
<form name="x" action="page.php" method="post">
<input type="submit" value="Page suivante">
<a class="btn btn-default" name="validation" value ="999" method=post><span class="glyphicon glyphicon-refresh"></span> Cliquer pour réinitialiser tous les mots de passe</a>
</form>		
<?php 
if (isset ($_POST['validation']))
{

// recuperation des utilisateurs eleveurs
$link=mysqli_connect('localhost','root','','crabase');
//Change l'encodage des données de la BDD
mysqli_set_charset($link,"utf8mb4");
// Requête
$querya="SELECT email FROM utilisateurs WHERE id_type <3  ORDER BY email";
$result=mysqli_query($link,$querya);

//Création tableau
$tab=mysqli_fetch_all($result);
$nbligne=mysqli_num_rows($result);
$j=0;
while ($j<$nbligne)
	{
	envoimail($tab[$j]);
	$j++;
	echo $j;}
echo "Les nouveaux mots de passe ont bien été envoyés.";
}		

?>		
<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>