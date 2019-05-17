<!doctype html>
<html lang="fr">
	<head>
		<!--•••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••
				CETTE PAGE PERMET AUX MEMBRES DU CRA DE DETERMINER LES SEUILS MAX ET MIN  DES COEFFICIENTS DE CONSANGUINITE POUR CHAQUE RACE.
				DANS LA MATRICE DE PARENTE : - SI COEFF<SEUILMIN : CASE VERTE
											 - SI SEUILMAX>COEFF>SEUILMIN : CASE ORANGE
											 - SI COEFF>SEUILMAX : CASE ROUGE
		•••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••-->
		
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">
		
		
		
		<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
		<?php $autorisation=3 // que le CRA?> 
		
		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
		
	</head>
	<?php
;
			//Connexion à la base de données
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			// Requete donnant la race et la stockant dans un tableau
			$query_race="SELECT id_race, nom_race FROM races";
			$result_race=mysqli_query($link, $query_race);
			$tab_race=mysqli_fetch_all($result_race);

	?>
	
	
	
	<!-- Liste déroulante choix de la race-->
		<div class="container">	
		<div class="row d-flex justify-content-center">
			<div class="col-md-3" style="background: rgba(0,0,0,0.4); border-radius: 10px;">
				<FORM method="POST" name="formRaceSeuil">
					<div class="form-group d-flex justify-content-center">
					<div class="col-md-8">
					<label for="id_utilisateur_selection">Choisissez la race</label>
						<select class="form-control" name="liste_race" id="id_utilisateur_selection" style="text-align:center">
						
						<?php
						for($i=0; $i < count($tab_race); $i++)
						{
							$value = $tab_race[$i][0];
							$valeur_affichee = $tab_race[$i][1];
							echo "<OPTION value='".$value."' ";
							
							if (isset($_POST['liste_race'])) 
							{
								// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
								if ($value==$_POST['liste_race']) 
									echo "selected";
							}
							echo ">".$tab_race[$i][1]."</OPTION>";  
						}
						?>
						
							</select>
					</div>
					</div>
					

		<!-- Saisie de texte seuil min-->
		<div class="form-group d-flex justify-content-center">
			<div class="col-md-6">
				<label class="control-label" for="textinput">Seuil minimal</label> 
				<span class="help-block"></span>
				
				<?php
				if (isset($_POST['seuil_min'])) 
					{
					$valmin=$_POST['seuil_min'];			
					echo '<input style="text-align:center" id="textinput" name="seuil_min" type="number" step="any" value="'.$valmin.'" class="form-control input-md" >';
							
					}
				
				else
				 {
					echo '<input style="text-align:center" id="textinput" name="seuil_min" type="number" step="any" value="" class="form-control input-md">';
				}	
				?>
				
				<span class="help-block"></span>  
			</div>
		  
		</div>
		
			<!-- Saisie de texte seuil max-->
		<div class="form-group d-flex justify-content-center">
		<div class="col-md-6">
		  <label class="control-label" for="textinput">Seuil maximal</label> 
		  
			
			<?php
				if (isset($_POST['seuil_max'])) 
					{
					$valmax=$_POST['seuil_max'];			
					echo '<input style="text-align:center" id="textinput" name="seuil_min" type="number" step="any" value="'.$valmax.'" class="form-control input-md">';
							
					}
				
				else
				 {
					echo '<input style="text-align:center" id="textinput" name="seuil_max" type="number" step="any" value="" class="form-control input-md">';
				}	
				?>
			<span class="help-block"></span>  
		  </div>
		</div>
	

		<!-- Bouton d'envoi -->
				<input type="submit" name="submit_seuil" href="#" class="btn btn-primary btn-info"><span class="glyphicon glyphicon-ok"></span> </a>
				</FORM>



	
	<?php 
	
	//Si l'on a cliqué sur le bouton d'envoi du formulaire 
	if(isset($_POST['liste_race'])&&isset($_POST['seuil_min'])&&isset($_POST['seuil_max']))
	{
		//On récupère sous forme de variable php les valeurs des objets du formulaire.
		$race=$_POST['liste_race'];
		$seuil_min=strval($_POST['seuil_min']);
		$seuil_max=strval($_POST['seuil_max']);

	
	

		// Si les seuils ne sont pas remplis on affiche une fenetre d'alerte
		if(empty($seuil_min)&&empty($seuil_min))
			{
				echo "<script type='text/javascript'>";
				echo 'alert("Veuillez entrer des valeurs de seuils");';
				echo 'document.location.href="http://cranet/site_web_paillette/insemis/seuils.php";';
				echo '</script>';
				
				
			}
			
		// Si les seuils ne sont pas compris entre 0 et 0.5, on affiche une fenetre d'alerte
		elseif($seuil_min<=0||$seuil_min>=0.5||$seuil_max<=0||$seuil_max>=0.5)
			{
				echo "<script type='text/javascript'>";
				echo 'alert("Veuillez entrer des valeurs de seuils entre 0 et 0,5");';
				echo 'document.location.href="http://cranet/site_web_paillette/insemis/seuils.php";';
				echo '</script>';
				
			}
		else 
			{
				
				
				// s'il n'ya aucune erreur de saisie, on effectue une requete qui modifie les seuils pour la race.
				$requeteMajSeuils=
				"UPDATE races
				SET seuil_min=".$seuil_min.", seuil_max=".$seuil_max."
				WHERE id_race=".$race."

				";
				$seuilQuery=mysqli_query($link,$requeteMajSeuils);
				
				echo "<script type='text/javascript'>";
				echo 'alert("Vos seuils ont bien été enregistrés");';
				//echo 'document.location.href="http://cranet/site_web_paillette/pages_site/seuils.php";';
				echo '</script>';
			}
	
	
	}
	
	?>
	
	<br>
	</body>
	
	
</html>