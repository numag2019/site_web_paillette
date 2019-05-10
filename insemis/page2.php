<HTML>

<?php
require "tableau.php";
$link = mysqli_connect('localhost', 'root', '', 'crabase');
mysqli_set_charset($link, "utf8mb4");

$query_eleveur = "SELECT id_eleveur, nom, prenom FROM eleveurs_intermediaire";
$result_eleveur = mysqli_query($link, $query_eleveur);
$tab_eleveur = mysqli_fetch_all($result_eleveur);
$nb_eleveur = mysqli_num_rows($result_eleveur);

echo '<FORM method = "GET" name = "formulaire">';

echo "Choisissez l'éleveur : ";
echo "<SELECT name='liste_eleveurs'>";
		for($i=0; $i < count($tab_eleveur); $i++)
		{
			$value = $tab_eleveur[$i][0];
			$valeur_affichee = $tab_eleveur[$i][1];
			
			echo "<OPTION value='".$value."' ";
			if (isset($_GET['liste_eleveurs'])) 
			{
				// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
				if ($value==$_GET['liste_eleveurs']) 
					echo "selected";
			}
			echo ">".$tab_eleveur[$i][1]. ' ' .$tab_eleveur[$i][2]."</OPTION>";  
		}
echo '</SELECT>';
echo '<INPUT type = "submit" name = "bouton_valider_eleveur" value = "Valider">';
echo '<br> <br>';
//echo '</FORM>';


		if(isset($_GET['bouton_valider_eleveur'])||isset($_GET['bouton_valider_race']))
		{
			//echo '<FORM method="GET" name="formulaire_race" >';
			$id_eleveur = $_GET["liste_eleveurs"];
			$nom_eleveur = $tab_eleveur[$id_eleveur-1][1].$tab_eleveur[$id_eleveur-1][2];
			$query_race = "SELECT DISTINCT races.id_race, races.nom_race 
						  FROM races
						  JOIN bovins ON races.id_race = bovins.id_race
						  JOIN utilisateurs ON bovins.id_utilisateur = utilisateurs.id_utilisateur
						  WHERE utilisateurs.id_utilisateur =".$id_eleveur."";
			//echo $query_race;
			$result_race = mysqli_query($link, $query_race);
			$tab_race = mysqli_fetch_all($result_race);

			echo "Choisissez la race : ";

			echo '<SELECT NAME = "liste_race">';
			for($i=0; $i < count($tab_race); $i++)
				{
					$value_race = $tab_race[$i][0];
					echo $value_race;
					$valeur_affichee_race = $tab_race[$i][1];
					echo "<OPTION value='".$value_race."' ";
					if (isset($_GET['liste_race'])) 
				{
					// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
					if ($value_race==$_GET['liste_race']) 
						echo "selected";
				}	
					echo ">".$tab_race[$i][1].'</OPTION> ';	
				} 
			
			echo '</SELECT>';
			echo "<input type='hidden' name='nom_eleveur' value='".$nom_eleveur."'>";
			echo "<input type='hidden' name='nom_eleveur' value='".$nom_race."'>";
			echo '<INPUT type="submit" name="bouton_valider_race"  value="Valider">';
			echo '<br> <br>';
			//echo '</FORM>';
			
			//$race = $_GET["liste_race"];
			
			
			if(isset($_GET['bouton_valider_race']))
			{
				$id_eleveur = $_GET["liste_eleveurs"];
				$race = $_GET["liste_race"];
				if ($race == 6)
					$nom_race = 'marine';
				if ($race == 5)
					$nom_race = 'bordelaise';
				if ($race == 19)
					$nom_race = 'béarnaise';
				echo "Matrice de parenté de l'éleveur " .$nom_eleveur. " pour la race " .$nom_race;
				echo '<INPUT TYPE="submit" name="bouton_historique"  value="Afficher l historique de commande de l éleveur">';
				echo '<br>';
				$query_matrice = "SELECT coefficients.id_vache, coefficients.id_taureau
								 FROM coefficients
								 JOIN bovins ON bovins.id_bovin = coefficients.id_vache 
								 WHERE bovins.id_race =".$race." and bovins.id_utilisateur = ".$id_eleveur." ";
				//echo $query_matrice;
				$result_matrice = mysqli_query($link, $query_matrice);
				$tab_matrice = mysqli_fetch_all($result_matrice);
				//var_dump($tab_matrice);
				//tableau($result_matrice);
				$nb_accouplement = mysqli_num_rows($result_matrice);
				$liste_males = [];
				$liste_nom_males = [];
				for ($k=0; $k < $nb_accouplement; $k++)
				{
					$individu = $tab_matrice[$k][1];
					if (in_array($individu,$liste_males))
					{}
					else
					{
						$query_nom_male = 'SELECT bovins.nom_bovin FROM bovins WHERE bovins.id_bovin='.$tab_matrice[$k][1].'';
						$result_nom_male = mysqli_query($link, $query_nom_male);
						$tab_nom_male = mysqli_fetch_all($result_nom_male);
						array_push($liste_nom_males,$tab_nom_male[0][0]);
						array_push($liste_males,$tab_matrice[$k][1]);
						
					}
				}
				
				$liste_femelles = [];
				$liste_nom_femelle = [];
				for ($k=0; $k < $nb_accouplement; $k++)
				{
					$individu_femelle = $tab_matrice[$k][0];
					if (in_array($individu_femelle,$liste_femelles))
					{}
					else 
					{
						$query_nom_femelle = 'SELECT bovins.nom_bovin FROM bovins WHERE bovins.id_bovin='.$tab_matrice[$k][0].'';
						$result_nom_femelle = mysqli_query($link, $query_nom_femelle);
						$tab_nom_femelle = mysqli_fetch_all($result_nom_femelle);
						array_push($liste_nom_femelle,$tab_nom_femelle[0][0]);
						array_push($liste_femelles,$tab_matrice[$k][0]);
					}
				}

				
				$nb_males=count($liste_males);
				$nb_femelle=count($liste_femelles);
				
				echo '<table border = 1>';
				echo '<tr>';
				echo '<td>&nbsp;</td>';
				for ($j=0; $j < $nb_males; $j++)
						{
							echo '<td>' . $liste_nom_males[$j]. '</td>';
						}
				echo '</tr>';
				
				for ($i=0; $i < $nb_femelle; $i++)
				{
					echo '<tr><center>';
					echo '<td>'.$liste_nom_femelle[$i];
					//echo '<td>';
					for ($j=0; $j < $nb_males; $j++)
						{
						//echo '<tr>';
						$query_color = "SELECT races.seuil_min, races.seuil_max FROM races WHERE id_race=".$race."";
						$result_color = mysqli_query($link, $query_color);
						$tab_color = mysqli_fetch_all($result_color);
						
						//echo '<td bgcolor ='.$color.'><center>';
						$query_coeff="SELECT coefficients.valeur_coeff 
												FROM coefficients 
												WHERE id_vache=" .$liste_femelles[$i]." AND id_taureau=".$liste_males[$j]."";
						//echo $query_coeff;
						$result_coeff = mysqli_query($link, $query_coeff);
						$tab_coeff = mysqli_fetch_all($result_coeff);
						$query_periode = "SELECT periodes.id_periode FROM periodes WHERE ISNULL(date_fin) =1 AND id_race =".$race."";
						$result_periode = mysqli_query($link, $query_periode);
						$tab_periode = mysqli_fetch_all($result_periode);
						$periode = $tab_periode[0][0];
						$query_prev = "SELECT previsions.nbr_paillettes FROM previsions 
									WHERE id_vache=" .$liste_femelles[$i]." AND id_taureau=".$liste_males[$j]." AND id_periode=".$periode. "";
						$result_prev = mysqli_query($link, $query_prev);
						$tab_prev = mysqli_fetch_all($result_prev);
						if ($tab_coeff[0][0]<$tab_color[0][0])
							$color = 'green';
						if ($tab_coeff[0][0]>$tab_color[0][0] AND $tab_coeff[0][0]<$tab_color[0][1] )
							$color = 'orange';
						if ($tab_coeff[0][0]>$tab_color[0][1])
							$color = 'red';
						echo '<td bgcolor ='.$color.'><center>';
						echo $tab_coeff[0][0];
						echo ' <br> '.$tab_prev[0][0];
						echo '</center></td>';
						//echo '</tr>';
						}
					echo '</td>';
					echo '</center></tr>';
				}
				echo '<br>';
				echo '<table border = 1>';
				echo '<tr>';
				echo '<td bgcolor=green> Accouplement très favorable </td> ';
				echo '</tr>';
				echo '<tr>';
				echo '<td bgcolor=orange> Accouplement favorable </td> ';
				echo '</tr>';
				echo '<tr>';
				echo '<td bgcolor=red> Accouplement peu favorable </td> ';
				echo '</tr>';
				echo '<br> <br>';
					

				
			}
			
		}	
echo '</FORM>';	
?>
</HTML>