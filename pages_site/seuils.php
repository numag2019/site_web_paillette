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
				<FORM action="type_utilisateur.php" method="POST" name="form">
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
					
	<!-- Saisie de texte seuil max-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="textinput">Seuil maximal</label> 
		  <div class="col-md-4">
			<input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
			<span class="help-block"></span>  
		  </div>
		</div>
		
		<!-- Saisie de texte seuil min-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="textinput">Seuil minimal</label> 
		  <div class="col-md-4">
			<input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
			<span class="help-block"></span>  
		  </div>
		</div>


zizi



	</body>
	
	
</html>