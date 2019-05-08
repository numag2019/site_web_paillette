<!-- Page disponible aux éleveurs bovins identifiés, 
		elle permet l'accès à la plateforme paillette et à la page des états de sorties
		Si l'utilisateur n'est pas connecté, la page affiche le formulaire de connexion-->
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
if ($_SESSION['id_type']==3)
	{

// Sélectionner l'utilisateur dont vous voulez changer le droit 
	echo "<br>";
	echo "*Choix de l'utilisateur que vous voulez rendre administateur de races";
	echo "<br>";

	// recuperation noms des departement
	$link=mysqli_connect('localhost','root','','oiseaudb');

	//Change l'encodage des données de la BDD
	mysqli_set_charset($link,"utf8mb4");

	// Requête
	$querya="SELECT  nom prenom id_utilisateur FROM ulisateurs WHERE id_type=1";
	$result=mysqli_query($link,$querya);


	//Création tableau
	$tab=mysqli_fetch_all($result);
	$nbligne=mysqli_num_rows($result);
	$nbcol=mysqli_num_fields($result);
	echo '<FORM action="type_utilisateur.php" method="POST" name="form">';
	
		while ($j<$nbligne)
			{
			echo "<option value=".urlencode($tab[$j][1]).">".$tab[$j][1]."</option>";
			$j++;
			}
	echo '<input onclick="do;" type="submit" value="utilisateur" />';
	}
	echo '</FORM>';
	if isset ($_POST['utilisateur'])
	{
			// Connexion à la BDD en PDO
	try { $bdd = new PDO('mysql:host=localhost;dbname=crabase','root',''); }
	
	catch (Exeption $e) { die('Erreur : ' . $e->getMessage())  or die(print_r($bdd->errorInfo())); }
	
	// Requête SQL sécurisée
	$req = $bdd->prepare("UPDATE utilisateurs
						SET type_utilisateur= :type_utilisateur
						WHERE email= :email ");
	$req->bindValue('type_utilisateur', 2 , PDO::PARAM_STR);
	$req->bindValue('utilisateur',$email, PDO::PARAM_STR);
	$req->execute();
	$rows = $req->rowCount();
	}
	
			?>
		<!-- DIV Pied de page -->	
		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>
