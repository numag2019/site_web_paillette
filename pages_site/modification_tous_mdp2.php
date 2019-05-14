<html>
<!--Page Reinitialisant tous les mots de passes des éleveurs ainsi que ceux des animateurs,
Par ailleurs, les identifiants deviennent de la forme première lettre du prénom suivit du nom de famille en majuscule-->		
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap.css">

		<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
		<?php $autorisation=3// que le CRA?>
		
		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
<?php include ('envoimail.php')?>

<?php


////////////////////////////////////////////// CREATION nouveaux mdp
// recuperation des utilisateurs eleveurs
$link=mysqli_connect('localhost','root','','crabase');
//Change l'encodage des données de la BDD
mysqli_set_charset($link,"utf8mb4");
// Requête
$querya="SELECT email FROM utilisateurs WHERE id_type != 3 and email != 'NULL' ";
$result=mysqli_query($link,$querya);

//Création tableau
$tab=mysqli_fetch_all($result);
$nbligne=mysqli_num_rows($result);
$j=0;
while ($j<$nbligne)
	{
//	envoimail($tab[$j][0]);    Enlever les commentaires pour que la fonctionnalité soit effective ///////////////::
	$j++;
	}
/////////////////////////////////////////////CREATION identifiant : exemple Prénom: Théo Nom: NOBELLA --> identifiant= tNOBELLA

$queryb="UPDATE utilisateurs SET identifiant= CONCAT(SUBSTR(prenom, 1, 1),nom) WHERE id_type != 3 ";
$result=mysqli_query($link,$queryb);

echo "Les nouveaux mots de passe ont bien été envoyés aux éleveurs ayant une adresse email renseignée 
<BR> Les identifiants sont maintenant de la forme: Première lettre du prénom/nom 
<BR> Exemple :
<BR> Théo Nom: NOBELLA --> identifiant= tNOBELLA";
?>		
<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>