<!doctype html>
<HTML lang='fr'>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- <link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">
	<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
	<?php $autorisation=TRUE // tout le monde?>

	<!--  Navigation -->
	 <?php 
	 include("../mise_en_page/navigation.html"); 
	 ?>
	</head>
	
	<body>
		<?php
			require "Mes_fonctions.php" ;
	
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			$query="SELECT id_utilisateur, nom, prenom FROM utilisateurs"; // requête pour la liste déroulante choix eleveur
			$result=mysqli_query($link, $query);
			
			$tab_nom=mysqli_fetch_all($result,MYSQLI_BOTH); // identifiant et nom des observateurs regroupés dans un tableau
		
		if(isset($_POST["bouton_valider_eleveur"])||isset($_POST['bt_submit_hist']))
		{
			$eleveur_select=$_POST["id_utilisateur"];
		}
		echo'<div class="container">	
				 <div class="row d-flex justify-content-center">
				 <div class="col-md-8" style="background: rgba(163,163,163,0.4); border-radius: 10px;">';
		echo '<FORM method = "POST" name = "formulaire">';
		echo '<div class="form-group row">';
		echo "<label class='col-3 col-form-label'> Choisissez l'éleveur : </label>";
		//liste déroulante éleveur
		echo "<SELECT name='id_utilisateur' class='form-control col-2'>";
					// boucle permettant d'afficher la liste déroulante des noms d'eleveurs
					$i=0;
					for ($i=0;$i<count($tab_nom);$i++)
					{
						$sel="";
						if ($eleveur_select==$tab_nom[$i][0])
						{
							$sel=" selected";
						}	
						echo "<OPTION value = '" . $tab_nom[$i][0] ."'" . $sel .  ">". $tab_nom[$i][1]," " ,$tab_nom[$i][2] . "</OPTION>"; // le nom est affiché (colonne 1), l'identifiant est stocké (colonne 0)
					}
				echo "</SELECT>";
			echo "<INPUT TYPE='SUBMIT' class='btn btn-primary' name='bouton_valider_eleveur' value='Valider'>";
			echo "</div>";
			echo "<br><br>";
	
			
			if(isset($_POST['bouton_valider_eleveur'])||isset($_POST['bt_submit_hist']))
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
				
	
				if (in_array($eleveur_select,$liste_eleveur_bord))
				{
					echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Bordelaise </a> <br><br>" ;
				}
				if (in_array($eleveur_select,$liste_eleveur_mar))
				{
					echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Marine </a> <br><br>" ;
				}
				if (in_array($eleveur_select,$liste_eleveur_bear))
				{
					echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Béarnaise </a> <br><br>" ;
				}
				
					
				//Affichage de la matrice				
				
				//$id_eleveur = $_POST["liste_eleveurs"];
						/*$race = $_POST["liste_race"];
						if ($race == 6)
							$nom_race = 'marine';
						if ($race == 5)
							$nom_race = 'bordelaise';
						if ($race == 19)
							$nom_race = 'béarnaise';*/
						
						$race=5;
						$nom_race="Bordelaise";
						// La il faudra récupérer avec une variable session la race de l'animateur de race
						
						// Récupération du nom de l'éleveur, on se sert aussi de cette requête dans l'affichage de l'hsitorique plus bas
						$query_eleveur="SELECT nom, prenom FROM utilisateurs WHERE id_utilisateur=$eleveur_select";
						$result_eleveur=mysqli_query($link, $query_eleveur);
						$tab_eleveur=mysqli_fetch_all($result_eleveur);
						
						echo "Matrice de parenté de l'éleveur <b>" .$tab_eleveur[0][1] . " " . $tab_eleveur[0][0]. " </b>pour la race <b>" .$nom_race . "</b>";
						echo '<br><br>';
						
						$query_matrice = "SELECT coefficients.id_vache, coefficients.id_taureau
										 FROM coefficients
										 JOIN bovins ON bovins.id_bovin = coefficients.id_vache 
										 WHERE bovins.id_race =".$race." and bovins.id_utilisateur = ".$eleveur_select." ";
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
						
						echo '<div class="row">';
						echo '<div class="col-6">';
						echo '<table class="table table-bordered">';
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
								if(isset($tab_coeff[0][0]))
								{
									if ($tab_coeff[0][0]<$tab_color[0][0])
										$color = 'green';
									if ($tab_coeff[0][0]>$tab_color[0][0] AND $tab_coeff[0][0]<$tab_color[0][1])
										$color = 'orange';
									if ($tab_coeff[0][0]>$tab_color[0][1])
										$color = 'red';
									echo '<td bgcolor ='.$color.'><center>';
									echo $tab_coeff[0][0];
									if(isset($tab_prev[0][0]))
									{
										echo ' <br> '.$tab_prev[0][0];
									}
								}
								echo '</center></td>';
								// echo '</tr>';
								}
							echo '</td>';
							echo '</center></tr>';
						}
						echo '</table>';
						echo '</div>';
						echo '</div>';
						echo '<br>';
						echo '<div class="row">';
						echo '<div class="col-3">';
						echo '<table class="table table-bordered">';
						echo '<tr>';
						echo '<td bgcolor=green> Accouplement très favorable </td> ';
						echo '</tr>';
						echo '<tr>';
						echo '<td bgcolor=orange> Accouplement favorable </td> ';
						echo '</tr>';
						echo '<tr>';
						echo '<td bgcolor=red> Accouplement peu favorable </td> ';
						echo '</tr>';
						echo '</table>';
						echo '</div>';
						echo '</div>';
						echo '<br> <br>';	
					echo "<INPUT TYPE='SUBMIT' name='bt_submit_hist' class='btn btn-dark' value='Voir son historique de prévisions paillettes'>";
					echo "<br><br>";

				//Affichage de l'historique
				
				if(isset($_POST['bt_submit_hist']))
				{
					echo "Historique des prévisions de commande de paillettes de <b>" . $tab_eleveur[0][1] . " " . $tab_eleveur[0][0] . "</b> pour la race <b>" . $nom_race . "</b><br><br>";
					//Sauf que la ca prend toutes les races, pas forcément que celles de la race de l'administrateur...

					// Les lignes suivantes servent à obtenir la liste des périodes et la liste des id_periode
					//$query_liste_per="SELECT date_debut, date_fin, id_periode FROM periodes WHERE id_race=$race";
					$query_liste_per="SELECT DATE_FORMAT(date_debut,'%d/%m/%Y'), DATE_FORMAT(date_fin,'%d/%m/%Y'), id_periode FROM periodes 
										WHERE id_race=$race
										ORDER BY date_debut";
					$result_liste_per=mysqli_query($link, $query_liste_per);
					$tab_liste_per=mysqli_fetch_all($result_liste_per);
					$nbligne = mysqli_num_rows($result_liste_per);
					
					$liste_per=[] ;
					for ($i=0;$i<$nbligne;$i++)
					{
						$liste_per[$i]=$tab_liste_per[$i][0] . " - " . $tab_liste_per[$i][1] ;
					}
					
					$liste_id_per=[] ;
					for ($i=0;$i<$nbligne;$i++)
					{
						$liste_id_per[$i]=$tab_liste_per[$i][2] ;
					}
					
					// Les lignes suivantes servent à obtenir la liste des vache de l'éleveur séléctionné dans les pages précédentes puis la liste des id_bovins
					$query_liste_taureau="SELECT DISTINCT bovins.nom_bovin, bovins.id_bovin 
										FROM bovins 
										JOIN previsions ON previsions.id_taureau=bovins.id_bovin
										WHERE (bovins.sexe=1 OR bovins.sexe=3) AND previsions.nbr_paillettes IS NOT NULL";
					//Faudra pouvoir prendre les taureaux que de la race de l'adlinistrateur de race
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


					//affichage du tableau historique commandes
					$nb_periodes=count($liste_per);
					$nb_taureau=count($liste_taureau);
					
					// echo '<div class="row">';
					echo '<div class="col-3">';
					echo '<table class="table table-bordered">';
						echo "<td> </td>" ;
						$j = 0;
						while ($j<$nb_taureau)
							{
								echo '<td>' . $liste_taureau[$j]. '</td>';
								$j++;
							}
						echo "<td><b> Total </b></td>";
						$i =0;
						while ($i<$nb_periodes)
						{
							echo '<tr>';
							echo "<td>" . $liste_per[$i] . "</td>";
							$j=0;
							$S=0;
							while ($j<$nb_taureau)
							{
								$query_paillettes="SELECT SUM(nbr_paillettes) 
													FROM previsions 
													WHERE id_taureau=$liste_id_taureau[$j] AND id_periode=$liste_id_per[$i]
													GROUP BY previsions.id_taureau";
								$result_paillettes=mysqli_query($link, $query_paillettes);
								$tab_paillettes=mysqli_fetch_all($result_paillettes);
								if (empty($tab_paillettes))
									echo '<td> 0 </td>';
								else
								{
									echo '<td>' . $tab_paillettes[0][0]. '</td>';
									$S=$S+$tab_paillettes[0][0];
								}
								$j++;
							}
							$i++;
							echo '<td><b>'. $S . '</b></td>';
							echo '</tr>';
						}
					echo '</table>';
					echo '</div>';
					echo '</div>';
				}		
			}
			echo "</FORM>";
			echo '</div>';
			echo '</div>';
		?>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	</body>
</html>