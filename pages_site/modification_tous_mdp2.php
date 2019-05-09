<!-- Page disponible aux éleveurs bovins identifiés, 
		elle permet l'accès à la plateforme paillette et à la page des états de sorties
		Si l'utilisateur n'est pas connecté, la page affiche le formulaire de connexion-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		
		<!-- Entête -->
		<?php include("../mise_en_page/entete.html");?>	

		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
	</head>

	<body>
<?php include ('envoimail.php')?>
<?php

if ($_SESSION['id_type']==3)
{
// recuperation des utilisateurs eleveurs
$link=mysqli_connect('localhost','root','','crabase');
//Change l'encodage des données de la BDD
mysqli_set_charset($link,"utf8mb4");
// Requête
$querya="SELECT email FROM utilisateurs WHERE id_type < 3 and email <> 'NULL' ";
$result=mysqli_query($link,$querya);

//Création tableau
$tab=mysqli_fetch_all($result);
//$tab=$tab[1];
$nbligne=mysqli_num_rows($result);
$j=0;
while ($j<$nbligne)
	{
	$error=envoimail($tab[0][$j]);
	echo '<BR>'.$tab[0][$j].'<BR>'.$error;
	$j++;
	}
}
echo "Les nouveaux mots de passe ont bien été envoyés.";
?>		
<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>