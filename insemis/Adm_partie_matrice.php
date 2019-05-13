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
	<?php $autorisation=TRUE // tout le monde?>
<head>
	<body>
		Plateforme Paillettes <br><br><br>
	
		<?php
			require "Mes_fonctions.php" ;
	
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			// requête pour la liste déroulante choix eleveur
			$query="SELECT id_utilisateur, nom, prenom FROM utilisateurs"; 
			$result=mysqli_query($link, $query);
			$tab_nom=mysqli_fetch_all($result,MYSQLI_BOTH); 
			
			if(isset($_GET['bouton_valider_eleveur']))
			{
				//requête pour la liste déroulante race (ne contient sue les races que l'éleveur élève)
				$id_eleveur=$_GET["liste_eleveurs"];
				$query_race = "SELECT DISTINCT races.id_race, races.nom_race 
							  FROM races
							  JOIN bovins ON races.id_race = bovins.id_race
							  JOIN utilisateurs ON bovins.id_utilisateur = utilisateurs.id_utilisateur
							  WHERE utilisateurs.id_utilisateur =".$id_eleveur."";
				$result_race=mysqli_query($link, $query_race);
				$tab_race=mysqli_fetch_all($result_race);
			}
			//Formulaire avec la liste déroulante de l'éleveur Puis la liste déroulante de la race ou des races qu'il élève
			echo '<FORM method = "GET" name = "formulaire">';

			//liste déroulante éleveurs
			echo "Choisissez l'éleveur : ";
			echo "<SELECT name='liste_eleveurs'>";
					for($i=0; $i < count($tab_nom); $i++)
					{
						$value = $tab_nom[$i][0];
						$valeur_affichee = $tab_eleveur[$i][1];
						
						echo "<OPTION value='".$value."' ";
						if (isset($_GET['liste_eleveurs'])) 
						{
							// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
							if ($value==$_GET['liste_eleveurs']) 
								echo "selected";
						}
						echo ">".$tab_nom[$i][1]. ' ' .$tab_nom[$i][2]."</OPTION>";  
					}
			echo '</SELECT>';
			echo '<INPUT type = "submit" name = "bouton_valider_eleveur" value = "OK">';
			echo '<br> <br>';
			
			// liste déroulante races
			if(isset($_GET['bouton_valider_eleveur'])||isset($_GET['bouton_valider_race'])||isset($_GET['bt_submit_hist']))
			{
				echo "Choisissez la race dont vous voulez voir la matrice de parenté : ";
				echo "<SELECT name='liste_race'>";
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
				echo '</SELECT>';
				echo '<INPUT type = "submit" name = "bouton_valider_race" value = "OK">';
				echo '<br> <br>';
		
		
				//Affichage catalogue + matrice
				//Affichage catalogue
				if(isset($_GET['bouton_valider_race'])||isset($_GET['bt_submit_hist']))
				{	
					$link=mysqli_connect('localhost', 'root', '', 'crabase');
					mysqli_set_charset($link, "utf8mb4"); 
				
					$query_bord="SELECT id_utilisateur FROM bovins WHERE id_race=5"; // requête pour avoir un tableau contenant les éleveurs de la race bordelaise
					$result_bord=mysqli_query($link, $query_bord);
					$liste_eleveur_bord=requete_2col_to_list ($result_bord) ;
					
					$query_mar="SELECT id_utilisateur FROM bovins WHERE id_race=6"; // requête pour avoir un tableau contenant les éleveurs de la race Marine
					$result_mar=mysqli_query($link, $query_mar);
					$liste_eleveur_mar=requete_2col_to_list ($result_mar) ;
					
					$query_bear="SELECT id_utilisateur FROM bovins WHERE id_race=19"; // requête pour avoir un tableau contenant les éleveurs de la race Béarnaise
					$result_bear=mysqli_query($link, $query_bear);
					$liste_eleveur_bear=requete_2col_to_list ($result_bear) ;
					
							// Requête SQL sécurisée
			
		
					$eleveur=$_GET["liste_eleveurs"];
					
					if (in_array($eleveur,$liste_eleveur_bord))
					{
						echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Bordelaise </a> <br><br>" ;
					}
					if (in_array($eleveur,$liste_eleveur_mar))
					{
						echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Marine </a> <br><br>" ;
					}
					if (in_array($eleveur,$liste_eleveur_bear))
					{
						echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Béarnaise </a> <br><br>" ;
					}
						
					//Affichage de la matrice de parenté de l'éleveur
					$id_eleveur = $_GET["liste_eleveurs"];
					$race = $_GET["liste_race"];
					if ($race == 6)
						$nom_race = 'marine';
					if ($race == 5)
						$nom_race = 'bordelaise';
					if ($race == 19)
						$nom_race = 'béarnaise';
					echo "Matrice de parenté de l'éleveur " .$tab_nom[0][1] . " pour la race " .$nom_race;
					echo "<input type='hidden' name='nom_eleveur' value='".$nom_eleveur."'>";
					echo "<input type='hidden' name='id_eleveur' value='".$id_eleveur."'>";
					echo "<input type='hidden' name='id_race' value='".$race."'>";
					echo "<input type='hidden' name='nom_race' value='".$nom_race."'>";
					echo '<INPUT TYPE="submit" name="bouton_historique"  value="Afficher l historique de commande de l éleveur">';
					echo '<br>';
					
					
					$query_matrice = "SELECT coefficients.id_vache, coefficients.id_taureau
									 FROM coefficients
									 JOIN bovins ON bovins.id_bovin = coefficients.id_vache 
									 WHERE bovins.id_race =".$race." and bovins.id_utilisateur = ".$id_eleveur." ";
					$result_matrice = mysqli_query($link, $query_matrice);
					$tab_matrice = mysqli_fetch_all($result_matrice);
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
						echo '<td>'.$liste_nom_femelle[$i];;
						for ($j=0; $j < $nb_males; $j++)
						{
							$query_color = "SELECT races.seuil_min, races.seuil_max FROM races WHERE id_race=".$race."";
							$result_color = mysqli_query($link, $query_color);
							$tab_color = mysqli_fetch_all($result_color);

							$query_coeff="SELECT coefficients.valeur_coeff 
													FROM coefficients 
													WHERE id_vache=" .$liste_femelles[$i]." AND id_taureau=".$liste_males[$j]."";
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
							//echo $query_coeff;
							//var_dump($tab_coeff);
							//echo $tab_coeff[0][0];
							//echo $tab_color[0][0];
							//var_dump($tab_prev);
							if ($tab_coeff[0][0]<$tab_color[0][0])
								$color = 'green';
							if ($tab_coeff[0][0]>$tab_color[0][0] AND $tab_coeff[0][0]<$tab_color[0][1] )
								$color = 'orange';
							if ($tab_coeff[0][0]>$tab_color[0][1])
								$color = 'red';
							echo '<td bgcolor ='.$color.'><center>';
							echo $tab_coeff[0][0];
							if(isset($tab_prev[0][0]))
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
					
						echo "<INPUT TYPE='SUBMIT' name='bt_submit_hist' value='Voir son historique de prévisions paillettes'>";
						echo "<INPUT type='hidden' name='eleveur' value='" . $eleveur . "'>" ;
						echo "<br><br>";
					
					
					//Affichage historique de previsions de commandes
					if(isset($_GET['bt_submit_hist']))
					{
						$utilisateur=$_GET["eleveur"]; // recupère l'id de l'utilisateur rentré sur 2 pages avant
						$query_eleveur="SELECT nom, prenom FROM utilisateurs WHERE id_utilisateur=$utilisateur";
						$result_eleveur=mysqli_query($link, $query_eleveur);
						$tab_eleveur=mysqli_fetch_all($result_eleveur);
						//var_dump($tab_eleveur);
						echo "Historique des prévisions de commande de paillettes de <b>" . $tab_eleveur[0][1] . " " . $tab_eleveur[0][0] . "</b> pour la race 'administrateur de race' <br><br>";
						//Sauf que la ca prend toutes les races, pas forcément que celles de la race de l'administrateur...

						// Les lignes suivantes servent à obtenir la liste des périodes et la liste des id_periode
						$query_liste_per="SELECT date_debut, date_fin, id_periode FROM periodes";
						$result_liste_per=mysqli_query($link, $query_liste_per);
						$tab_liste_per=mysqli_fetch_all($result_liste_per);
						$nbligne = mysqli_num_rows($result_liste_per);
						
						$liste_per=[] ;
						for ($i=0;$i<$nbligne;$i++)
						{
							$liste_per[$i]=$tab_liste_per[$i][0] . " - " . $tab_liste_per[$i][1] ;
						}
						//var_dump($liste_per);
						
						$liste_id_per=[] ;
						for ($i=0;$i<$nbligne;$i++)
						{
							$liste_id_per[$i]=$tab_liste_per[$i][2] ;
						}
						//var_dump($liste_id_per);
						
						// Les lignes suivantes servent à obtenir la liste des taureaux puis la liste des id_bovins
						/*$query_liste_taureau="SELECT DISTINCT bovins.nom_bovin, bovins.id_bovin 
											FROM bovins 
											JOIN previsions ON previsions.id_taureau=bovins.id_bovin
											JOIN utilisateurs ON utilisateurs.id_utilisateur=bovins.id_utilisateur
											WHERE (bovins.sexe=1 OR bovins.sexe=3) AND previsions.nbr_paillettes IS NOT NULL AND utilisateurs.id_utilisateur=$utilisateur";
											*/
						$query_liste_taureau="SELECT DISTINCT bovins.nom_bovin, bovins.id_bovin 
											FROM bovins 
											JOIN previsions ON previsions.id_taureau=bovins.id_bovin
											WHERE (bovins.sexe=1 OR bovins.sexe=3) AND previsions.nbr_paillettes IS NOT NULL";
						//Faudra poiuvoir prendre les taureaux que de la race de l'administrateur de race
						$result_liste_taureau=mysqli_query($link, $query_liste_taureau);
						$tab_liste_taureau=mysqli_fetch_all($result_liste_taureau);
						$nbligne = mysqli_num_rows($result_liste_taureau);
						
						$liste_taureau=[] ;
						for ($i=0;$i<$nbligne;$i++)
						{
							$liste_taureau[$i]=$tab_liste_taureau[$i][0] ;
						}
						
						$liste_id_taureau=[] ;
						for ($i=0;$i<$nbligne;$i++)
						{
							$liste_id_taureau[$i]=$tab_liste_taureau[$i][1] ;
						}


						//affichage du TABLEAU historique commandes
						$nb_periodes=count($liste_per);
						$nb_taureau=count($liste_taureau);
						
						echo '<table border = 1>';
							echo "<td> </td>" ;
							$j = 0;
							while ($j<$nb_taureau)
								{
									echo '<td>' . $liste_taureau[$j]. '</td>';
									$j++;
								}
								echo '<td> Total </td>';
							$i =0;
							while ($i<$nb_periodes)
							{
								echo '<tr>';
								echo "<td>" . $liste_per[$i] . "</td>";
								$j=0;
								$S=0;
								while ($j<$nb_taureau)
								{
									$query_paillettes="SELECT nbr_paillettes FROM previsions WHERE id_taureau=$liste_id_taureau[$j] AND id_periode=$liste_id_per[$i]";
									$result_paillettes=mysqli_query($link, $query_paillettes);
									$tab_paillettes=mysqli_fetch_all($result_paillettes);
									if (empty($tab_paillettes))
										echo '<td> 0 </td>';
									else
									{
										echo '<td>' . $tab_paillettes[0][0]. '</td>';
										$S=$S+$tab_paillettes[0][0];
									}
									//$prev=$tab_paillettes[0][0];
									//echo $tab_paillettes[0][0];
									//echo '<td> OK </td>';
									//echo '<td>' . $tab_paillettes[0][0]. '</td>';
									$j++;
									
								}
								$i++;
								echo '<td>'. $S . '</td>';
								echo '</tr>';
								
							}
						echo '</table>';
								
					}
							
				}
			}
			echo "</FORM>";
		?>
	</body>
</html>