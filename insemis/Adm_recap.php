<html>
	<head>
		<meta charset = "UTF-8">
	</head>
	
	<body>
		Plateforme Paillettes - Récapitulatif des prévisions de commandes de paillettes <br><br><br>
		
		<?php
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			$query="SELECT id_race, nom_race FROM races"; // requête pour la liste déroulante choix eleveur
			$result=mysqli_query($link, $query);
		
			$tab_race=mysqli_fetch_all($result); // identifiant et nom des observateurs regroupés dans un tableau
		
		echo "<FORM method='GET' name='form_recap'>";
		
			echo "<br>";
			echo "<b> Séléctionnez une race </b>";        //liste déroulante race
				echo "<SELECT name='id_race' size='1'>";
					// boucle permettant d'afficher la liste déroulante des races
					$i=0;
					for ($i=0;$i<count($tab_race);$i++)
						{
						echo "<OPTION value = '" . $tab_race[$i][0] . "'> ". $tab_race[$i][1] . "</OPTION>"; // le nom est affiché (colonne 1), l'identifiant est stocké (colonne 0)
						}
				echo "</SELECT>";
			echo "<br><br>";
			echo "<INPUT TYPE='SUBMIT' name='bt_submit' value='OK'>";
			echo "<br><br>";
			
			if(isset($_GET['id_race']))
			{
				$race=$_GET["id_race"];
			
				$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
				mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
				
				$query_race="SELECT nom_race FROM races WHERE id_race=$race";
				$result_race=mysqli_query($link, $query_race);
				$tab_race=mysqli_fetch_all($result_race);
				
				
				/*include ("Mes_fonctions.php");
				$query_vache="SELECT id_bovin FROM bovins WHERE sexe=2";
				$result_vache=mysqli_query($link, $query_vache);
				//$tab_vache=mysqli_fetch_all($result_vache);
				$tab_vache=requete_2col_to_list ($result_vache);*/
				
				echo "Plateforme Paillettes - Récapitulatif des prévisions de commandes de paillettes pour la race <b>". $tab_race[0][0] . " </b><br><br><br>" ;
				
				// Les lignes suivantes servent à obtenir la liste des éleveurs/utilisateurs et la liste des id_utilisateur
				$query_liste_ut="SELECT DISTINCT utilisateurs.nom, utilisateurs.prenom, utilisateurs.id_utilisateur FROM utilisateurs 
									JOIN bovins ON bovins.id_utilisateur=utilisateurs.id_utilisateur
									JOIN previsions ON previsions.id_taureau=bovins.id_bovin
									WHERE bovins.id_race=$race AND previsions.nbr_paillettes IS NOT NULL";
				/*$query_liste_ut="SELECT DISTINCT utilisateurs.nom, utilisateurs.prenom, utilisateurs.id_utilisateur FROM utilisateurs 
									JOIN bovins ON bovins.id_utilisateur=utilisateurs.id_utilisateur
									JOIN previsions ON previsions.id_taureau=bovins.id_bovin
									WHERE bovins.id_race=$race AND previsions.id_vache IS NOT NULL";*/
				// La requête devrait prendre que les utilisateurs pour lesquels y a une rpevision pour leurs vache
				$result_liste_ut=mysqli_query($link, $query_liste_ut);
				$tab_liste_ut=mysqli_fetch_all($result_liste_ut);
				$nbligne = mysqli_num_rows($result_liste_ut);
				
				$liste_ut=[] ;
				for ($i=0;$i<$nbligne;$i++)
				{
					$liste_ut[$i]=$tab_liste_ut[$i][1] . " " . $tab_liste_ut[$i][0] ;
				}
				//var_dump($liste_ut);
				
				$liste_id_ut=[] ;
				for ($i=0;$i<$nbligne;$i++)
				{
					$liste_id_ut[$i]=$tab_liste_ut[$i][2] ;
				}
				//var_dump($liste_id_ut);
				

				// Les lignes suivantes servent à obtenir la liste des taureaux de la race séléctionné dans les pages précédentes puis la liste des id_bovins
				$query_liste_t="SELECT DISTINCT nom_bovin, id_bovin FROM bovins 
								JOIN previsions ON previsions.id_taureau=bovins.id_bovin
								WHERE (bovins.sexe=1 OR bovins.sexe=3) AND bovins.id_race=$race AND previsions.nbr_paillettes IS NOT NULL";
				$result_liste_t=mysqli_query($link, $query_liste_t);
				$tab_liste_t=mysqli_fetch_all($result_liste_t);
				$nbligne = mysqli_num_rows($result_liste_t);
				
				$liste_t=[] ;
				for ($i=0;$i<$nbligne;$i++)
				{
					$liste_t[$i]=$tab_liste_t[$i][0] ;
				}
				//var_dump($liste_t);
				
				$liste_id_t=[] ;
				for ($i=0;$i<$nbligne;$i++)
				{
					$liste_id_t[$i]=$tab_liste_t[$i][1] ;
				}
				//var_dump($liste_id_t);
				
				
				//affichage du tableau récapitulatif
				$nb_ut=count($liste_ut);
				$nb_t=count($liste_t);
				
				/*
				echo '<table border = 1>';
					echo "<td> </td>" ;
					$j = 0;
					
					while ($j<$nb_t)
						{
							echo '<td>' . $liste_t[$j]. '</td>'; // affiche les noms de taureau en haut dans la première ligne du tableau
							$j++;
						}
					echo "<td><b> Total </b></td>";	
					$i =0;
					$S_t=0;
					while ($i<$nb_ut)
					{
						echo '<tr>';
						echo "<td>" . $liste_ut[$i] . "</td>"; // afiche les noms d'éleveurs dans la première colonne du tableau
						$j=0;
						$S_ut=0;
						while ($j<$nb_t)
						{
							$query_paillettes="SELECT nbr_paillettes FROM previsions 
												JOIN bovins ON bovins.id_bovin=previsions.id_taureau
												WHERE previsions.id_taureau=$liste_id_t[$j] AND bovins.id_utilisateur=$liste_id_ut[$i]";
							$result_paillettes=mysqli_query($link, $query_paillettes);
							$tab_paillettes=mysqli_fetch_all($result_paillettes);
							if (empty($tab_paillettes))
								echo '<td> 0 </td>';
							else
							{
								echo '<td>' . $tab_paillettes[0][0]. '</td>';
								$S_ut=$S_ut+$tab_paillettes[0][0];
							}
							//echo '<td>'. $S_ut . '</td>';
							//$S_t=$S_t+$tab_paillettes[0][0];
							
							--------
							if($j!=0)
							{
								echo '</tr>';
								echo '<tr>';
								echo '<td>'.$S_t.'</td>';
								echo '</tr>';
							}
							-------
							
							//$S_t=$S_t+$tab_paillettes[0][0];
							$j++;
						}
						$i++;
						echo '<td><b>'. $S_ut . '</b></td>';
						echo '</tr>';
					}
					*/
					
					echo '<table border = 1>';
					$L=[];
					/*
					$L[0][0]=4;
					$L[0][1]=2;
					echo $L[0][0];
					echo $L[0][1];
					*/
					echo "<td> </td>" ;
					$j = 0;
					
					while ($j<$nb_t)
						{
							echo '<td>' . $liste_t[$j]. '</td>'; // affiche les noms de taureau en haut dans la première ligne du tableau
							$j++;
						}
					echo "<td><b> Total </b></td>";	
					$i =0;
					//$S_t=0;
					while ($i<$nb_ut)
					{
						echo '<tr>';
						echo "<td>" . $liste_ut[$i] . "</td>"; // afiche les noms d'éleveurs dans la première colonne du tableau
						$j=0;
						$S_ut=0;
						while ($j<$nb_t)
						{
							$query_paillettes="SELECT SUM(nbr_paillettes) FROM previsions 
												JOIN bovins ON bovins.id_bovin=previsions.id_taureau
												WHERE previsions.id_taureau=$liste_id_t[$j] AND bovins.id_utilisateur=$liste_id_ut[$i]
												GROUP BY bovins.id_bovin";
							$result_paillettes=mysqli_query($link, $query_paillettes);
							$tab_paillettes=mysqli_fetch_all($result_paillettes);
							if (empty($tab_paillettes))
							{
								$tab_paillettes[0][0]="0";
								$L[$i][$j]=$tab_paillettes[0][0];
								echo '<td> 0 </td>';
							}
							else
							{
								echo '<td>' . $tab_paillettes[0][0]. '</td>';
								$S_ut=$S_ut+$tab_paillettes[0][0];
								$L[$i][$j]=$tab_paillettes[0][0];
								echo "<br>";
							}
							$j++;
						}
						$i++;
						echo '<td><b>'. $S_ut . '</b></td>';
						echo '</tr>';
					}
					echo "<td><b> Total </b></td>";
					//Affiche le total par taureaux ($S_t) et le total du total ($S_TT)
					$S_TT=0;
					for ($j=0;$j<$nb_t;$j++)
					{
						$S_t=0;
						for ($i=0;$i<$nb_ut;$i++)
						{
							$S_t=$S_t+$L[$i][$j];
						}
						echo "<td><b>" . $S_t . "</b></td>";
						$S_TT=$S_TT+$S_t;
					}
					echo "<td><b>" . $S_TT . "</b></td>";
					// ----------------------
					echo "</table>";
			}
		echo "</FORM>";
		
		
		?>
	</body>
</html>