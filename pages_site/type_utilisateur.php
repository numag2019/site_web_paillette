<html>
<!--Page d'acceuil du site web CRAnet-->		
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap.css">
		
		<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
		<?php $autorisation=3 // que le CRA?> 
		
		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
	</head>
	
	<body>
<?php 
if (!isset($_POST['id_utilisateur_selection']) )
	{

	// Sélection de l'utilisateur dont vous voulez changer le droit 
	// recuperation des utilisateurs eleveurs
	$link=mysqli_connect('localhost','root','','crabase');

	//Change l'encodage des données de la BDD
	mysqli_set_charset($link,"utf8mb4");

	// Requête
	$querya="SELECT  nom, prenom, id_utilisateur FROM utilisateurs WHERE id_type=1";
	$result=mysqli_query($link,$querya);

	?>

	<div class="container">	
		<div class="row">
			<div id="block1" class="col-md-3 offset-md-4" align='center' >
				<FORM action="type_utilisateur.php" method="POST" name="form">
					<div class="form-group">
					  
						<?php
						//Création tableau
						$tab=mysqli_fetch_all($result);
						$nbligne=mysqli_num_rows($result);
						$nbcol=mysqli_num_fields($result);
						$j=0;
						?>
						<label for="id_utilisateur_selection">Choix de l'utilisateur</label>
						<select class="form-control" name="id_utilisateur_selection" id="id_utilisateur_selection">
							<?php
							while ($j<$nbligne)
								{
								echo "<option value=".$tab[$j][2].">".$tab[$j][0]." ".$tab[$j][1]."</option>";
								$j++;
								}
							?>
						</select>
					</div>
					<?php
						
						



					// Sélection de l'utilisateur dont vous voulez changer le droit 
					// Requête
					$queryb="SELECT id_type, libelle_type FROM `type_utilisateur` WHERE id_type!=3 ";
					$resultb=mysqli_query($link,$queryb);


					//Création tableau
					$tabb=mysqli_fetch_all($resultb);
					$nbligneb=mysqli_num_rows($resultb);
					$nbcolb=mysqli_num_fields($resultb);
						
					$j=0;
					?>
					<div class="form-group">
						<label for="id_type_selection">Choisir les droits à donner à l'utilisateur</label>
						<select class="form-control" name="id_type_selection" id="id_type_selection">
							<?php
							while ($j<$nbligneb)
							{
								echo "<option value=".$tabb[$j][0].">".$tabb[$j][1]."</option>";
								$j++;
							}
							?>
						</select>
						<small align='left' id="remarque" class="form-text text-muted">Eleveur : accès à ses animaux et à la modification de son plan prévisionnel paillette <br>
						Animateur : accès à tout les comptes éleveurs liés à une des trois races</small>
					</div>
					<input onclick="do;" type="submit" value="Valider" />
				</FORM>
						
			</div>
		</div>
	</div>
	
	<?php
	}
// Si le CRA a rempli le formulaire est appuyé sur le bouton on exécute une requête modifiant le type d'utilisateur 	
else 
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
	header('Refresh: 0');
	}
	
if (isset($_SESSION['message_type_utilisateur']))
	{echo $_SESSION['message_type_utilisateur']; 
	unset ($_SESSION['message_type_utilisateur']);}
			?>
		<!-- DIV Pied de page -->	
		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>
