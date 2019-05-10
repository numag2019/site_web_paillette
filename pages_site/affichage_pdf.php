<html>
<!--Page d'acceuil du site web CRAnet-->		
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
	<?php
		try { $bdd = new PDO('mysql:host=localhost;dbname=crabase','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); }
	
		catch (Exeption $e) { die('Erreur : ' . $e->getMessage())  or die(print_r($bdd->errorInfo())); }
		$_SESSION['id_utilisateur']=35;
		// Requête SQL sécurisée
		$req = $bdd->prepare("SELECT r.nom_race 
							FROM races r JOIN bovins b 
								ON r.id_race = b.id_race 
							JOIN utilisateurs u 
								ON b.id_utilisateur = u.id_utilisateur 
							WHERE u.id_utilisateur= :id_utilisateur 
							GROUP BY r.id_race  ");
		$req->bindValue('id_utilisateur', $_SESSION['id_utilisateur'], PDO::PARAM_STR);
		$req->execute();
		$rows = $req->rowCount();
		$resultat = $req->fetchAll(PDO::FETCH_NAMED);
		$resultat=$resultat[0];
		$race=$resultat['nom_race'];
		$chemin1= '../upload/fiche_race_'.$race.'.pdf';
		$chemin2= 'fiche_eleveur_'.$race.'.pdf';
		$chemin3= 'fiche_race_globale.pdf';
	
echo '<a href='.$chemin1.'>fiche_race</a>'
echo '<a href='.$chemin2.'>fiche_eleveur</a>'
echo '<a href='.$chemin3.'>fiche_race_globale</a>'
 ?>


	
	<!-- DIV Pied de page -->
	<?php include ("../mise_en_page/pied.html");?>
	</body>
	

</html>