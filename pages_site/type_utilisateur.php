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
<?php 
if (($_SESSION['id_type']==3) and !isset($_POST['id_utilisateur_selection']))
	{

	// Sélection de l'utilisateur dont vous voulez changer le droit 
	echo "<br>";
	echo "Choix de l'utilisateur que vous voulez rendre animateur de races";
	echo "<br>";

	// recuperation des utilisateurs eleveurs
	$link=mysqli_connect('localhost','root','','crabase');

	//Change l'encodage des données de la BDD
	mysqli_set_charset($link,"utf8mb4");

	// Requête
	$querya="SELECT  nom, prenom, id_utilisateur FROM utilisateurs WHERE id_type=1";
	$result=mysqli_query($link,$querya);


	//Création tableau
	$tab=mysqli_fetch_all($result);
	$nbligne=mysqli_num_rows($result);
	$nbcol=mysqli_num_fields($result);
	echo '<FORM action="type_utilisateur.php" method="POST" name="form">';
	$j=0;
		while ($j<$nbligne)
			{
			echo "<option value=".urlencode($tab[$j][1]).">".$tab[$j][1]."</option>";
			$j++;
			}
	echo '<input onclick="do;" type="submit" value="id_utilisateur_selection" />';
	echo '</FORM>';
	}
	
///////////Si l'utilisateur a déjà choisi l'éleveur	
	if (isset ($_POST['utilisateur']))
	{
		// Sélection de l'utilisateur dont vous voulez changer le droit 
	echo "<br>";
	echo "Choix de la race à animer";
	echo "<br>";

	// recuperation des utilisateurs eleveurs
	$link=mysqli_connect('localhost','root','','crabase');

	//Change l'encodage des données de la BDD
	mysqli_set_charset($link,"utf8mb4");

	// Requête
	$querya="SELECT id_type libelle_type FROM `type_utilisateur` WHERE id_type > 20 ";
	$result=mysqli_query($link,$querya);


	//Création tableau
	$tab=mysqli_fetch_all($result);
	$nbligne=mysqli_num_rows($result);
	$nbcol=mysqli_num_fields($result);
	echo '<FORM action="type_utilisateur.php" method="POST" name="form">';
	$j=0;
		while ($j<$nbligne)
			{
			echo "<option value=".urlencode($tab[$j][1]).">".$tab[$j][1]."</option>";
			$j++;
			}
	echo '<input onclick="do;" type="submit" value="id_type_selection" />';
	echo '</FORM>';
	}
////////////
if (isset ($_POST['id_type_selection']))
	{
	// Connexion à la BDD en PDO
	try { $bdd = new PDO('mysql:host=localhost;dbname=crabase','root',''); }
	
	catch (Exeption $e) { die('Erreur : ' . $e->getMessage())  or die(print_r($bdd->errorInfo())); }
	
	// Requête SQL sécurisée
	$req = $bdd->prepare("UPDATE utilisateurs
						SET id_type = :race_admin
						WHERE id_utilisateur= :id_utilisateur ");
						
	$req->bindValue('id_utilisateur',$_POST['id_utilisateur_selection'], PDO::PARAM_STR);
	$req->bindValue('race_admin',$_POST['id_type_selection'], PDO::PARAM_STR);
	$req->execute();
	$_SESSION['message_type_utilisateur']= 'Changement effectué';
	unset ($_SESSION['id_utilisateur_selection']);
	unset ($_SESSION['id_type_selection']);
	//echo "<script type='text/javascript'>document.location.replace('type_utilisateur.php');</script>";
	header('Refresh: 0');
	}
if (isset($_SESSION['message_type_utilisateur']))
	{echo $_SESSION['message_type_utilisateur']; }
			?>
		<!-- DIV Pied de page -->	
		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>
