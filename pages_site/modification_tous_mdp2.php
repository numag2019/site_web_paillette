<!--Page disponible uniquement au CRA, appuyer sur le bouton reinitialisera tous les mots de passes -->
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
	envoimail($tab[$j][0]);
	$j++;
	}
/////////////////////////////////////////////CREATION identifiant : exemple Prénom: Théo Nom: NOBELLA --> identifiant= tNOBELLA

$queryb="UPDATE utilisateurs SET identifiant= CONCAT(SUBSTR(prenom, 1, 1),nom) WHERE id_type != 3 ";
$result=mysqli_query($link,$queryb);
}
echo "Les nouveaux mots de passe ont bien été envoyés aux éleveurs ayant une adresse email renseignée 
<BR> Les identifiants sont maintenant de la forme: Première lettre du prénom/nom 
<BR> Exemple :
<BR> Théo Nom: NOBELLA --> identifiant= tNOBELLA";
?>		
<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>