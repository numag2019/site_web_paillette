<!doctype html>
<html lang="fr">
	<head>
	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">
	</head>
	<?php
	//require "Mes_fonctions.php" ;
	
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			// Requete donnant la race et la stockant dans un tableau
			$query_race="SELECT id_race, nom_race FROM races";
			$result_race=mysqli_query($link, $query_race);
			$tab_race=mysqli_fetch_all($result_race);

	?>
	
	
	
	<!-- Liste déroulante choix de la race-->
			<div class="container">	
		<div class="row">
			<div id="block1" class="col-md-3 offset-md-4" align='center' >
				<FORM method="GET" name="formRaceSeuil">
					<div class="form-group">
					<label for="id_utilisateur_selection">Choisissez la race</label>
						<select class="form-control" name="liste_race" id="id_utilisateur_selection">
						
						<?php
						for($i=0; $i < count($tab_race); $i++)
						{
							$value = $tab_race[$i][0];
							$valeur_affichee = $tab_race[$i][1];
							echo "<OPTION value='".$value."' ";
							
							if (isset($_GET['liste_race'])) 
							{
								// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
								if ($value==$_GET['liste_race']) 
									echo "selected";
							}
							echo ">".$tab_race[$i][1]."</OPTION>";  
						}
						?>
						
							</select>
					</div>
					

		<!-- Saisie de texte seuil min-->
		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="textinput">Seuil minimal</label> 
				<span class="help-block"></span>
				
				<?php
				if (isset($_GET['seuil_min'])) 
					{
					$valmin=$_GET['seuil_min'];			
					echo '<input id="textinput" name="seuil_min" type="number" step="any" value="'.$valmin.'" class="form-control input-md">';
							
					}
				
				else
				 {
					echo '<input id="textinput" name="seuil_min" type="number" step="any" value="" class="form-control input-md">';
				}	
				?>
				
				<span class="help-block"></span>  
			</div>
		  
		</div>
		
			<!-- Saisie de texte seuil max-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="textinput">Seuil maximal</label> 
		  <div class="col-md-4">
			
			<?php
				if (isset($_GET['seuil_max'])) 
					{
					$valmax=$_GET['seuil_max'];			
					echo '<input id="textinput" name="seuil_min" type="number" step="any" value="'.$valmax.'" class="form-control input-md">';
							
					}
				
				else
				 {
					echo '<input id="textinput" name="seuil_max" type="number" step="any" value="" class="form-control input-md">';
				}	
				?>
			<span class="help-block"></span>  
		  </div>
		</div>
	

		<!-- Bouton d'envoi -->
				<input type="submit" name"submit_seuil" href="#" class="btn btn-primary btn-info"><span class="glyphicon glyphicon-ok"></span> </a>
				</FORM>



	
	<?php 
	
	if(isset($_GET['liste_race'])&&isset($_GET['seuil_min'])&&isset($_GET['seuil_max']))
	{
	
	
	
	
	$race=$_GET['liste_race'];
	$seuil_min=strval($_GET['seuil_min']);
	$seuil_max=strval($_GET['seuil_max']);
	
	

	
		if(empty($seuil_min)&&empty($seuil_min))
			{
				// echo "$seuil_min";
				// echo "$seuil_max";
				// echo "$race";
				
				
				echo "OK";
				
				$requeteMajSeuils=
				"UPDATE races
				SET seuil_min=".$seuil_min.", seuil_max=".$seuil_max."
				WHERE id_race=".$race."

				";
				$seuilQuery=mysqli_query($link,$requeteMajSeuils);
			}
		
		// elseif(empty($seuil_min)
			// {
				
			// }
		else 
			{
				// echo "<script type='text/javascript'>";
				// echo 'alert("Veuillez entrer des nombres décimaux pour les valeurs des seuils");';
				// echo 'document.location.href="http://cranet/site_web_paillette/pages_site/seuils.php";';
				// echo '</script>';
			}
	
	
	}
	
	?>
	

	</body>
	
	
</html>