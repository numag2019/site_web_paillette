<!doctype html>
<html lang="fr">
	<head>
	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">>

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
				<FORM method="POST" name="formRaceSeuil">
					<div class="form-group">
					<label for="id_utilisateur_selection">Choisissez la race</label>
						<select class="form-control" name="liste_race" id="id_utilisateur_selection">
						
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
					

		<!-- Saisie de texte seuil min-->
		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="textinput">Seuil minimal</label> 
				<span class="help-block"></span>
				
				<?php
				if (isset($_POST['seuil_min'])) 
					{
					$valmin=$_POST['seuil_min'];			
					echo '<input id="textinput" name="seuil_min" type="text" value="'.$valmin.'" class="form-control input-md">';
							
					}
				
				else
				 {
					echo '<input id="textinput" name="seuil_min" type="text" value="" class="form-control input-md">';
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
				if (isset($_POST['seuil_max'])) 
					{
					$valmax=$_POST['seuil_max'];			
					echo '<input id="textinput" name="seuil_min" type="text" value="'.$valmax.'" class="form-control input-md">';
							
					}
				
				else
				 {
					echo '<input id="textinput" name="seuil_max" type="text" value="" class="form-control input-md">';
				}	
				?>
			<span class="help-block"></span>  
		  </div>
		</div>
	

		<!-- Bouton avec icone -->
				<input type="submit" name"submit_seuil" href="#" class="btn btn-primary btn-info"><span class="glyphicon glyphicon-ok"></span> </a>
				</FORM>


	</body>
	
	<?php 
	
	if(isset($_POST['liste_race'])||isset($_POST['seuil_min'])||isset($_POST['seuil_max']))
	{
	
	
	$race=$_POST['liste_race'];
	$seuil_min=$_POST['seuil_min'];
	$seuil_max=$_POST['seuil_max'];
	
	// if (is_float($seuil_min)) 
		// {
		// echo "$seuil_min";
		// echo "$seuil_max";
		// echo "$race";
		// }
	
	
	$requeteMajSeuils=
	"UPDATE races
	SET seuil_min=".$seuil_min.", seuil_max=".$seuil_max."
	WHERE id_race=".$race."

	";
	$seuilQuery=mysqli_query($link,$requeteMajSeuils);
	
	}
	
	?>
	


	
	
</html>