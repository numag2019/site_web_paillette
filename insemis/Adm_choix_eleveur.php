<html>
	<head>
		<meta charset = "UTF-8">
	</head>
	
	<body>
		Plateforme Paillettes <br><br><br>
	
		<?php
			require "Mes_fonctions.php" ;
	
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			$query="SELECT id_utilisateur, nom, prenom FROM utilisateurs"; // requête pour la liste déroulante choix eleveur
			$result=mysqli_query($link, $query);
			//var_dump($result);
			
			$tab_nom=mysqli_fetch_all($result,MYSQLI_BOTH); // identifiant et nom des observateurs regroupés dans un tableau
			//var_dump($tab_nom);
			//echo $tab_nom[0][1];
		
		if(isset($_GET["bouton_valider_eleveur"])||isset($_GET['bt_submit_hist']))
		{
			$eleveur_select=$_GET["id_utilisateur"];
		}
		
		echo "<FORM method='GET' name='formulaire'>" ; 
		
			echo "<br>";
			echo "<b> Séléctionnez un éleveur </b>"  ;      //liste déroulante éleveur
				echo "<SELECT name='id_utilisateur' size='1'>";
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
			echo "<br><br>";
		
			echo "<INPUT TYPE='SUBMIT' name='bouton_valider_eleveur' value='OK'>";
			echo "<br><br>";
	
			
			if(isset($_GET['bouton_valider_eleveur'])||isset($_GET['bt_submit_hist']))
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
				
					echo "<INPUT TYPE='SUBMIT' name='bt_submit_hist' value='Voir son historique de prévisions paillettes'>";
					echo "<br><br>";
				
				if(isset($_GET['bt_submit_hist']))
				{
					$query_eleveur="SELECT nom, prenom FROM utilisateurs WHERE id_utilisateur=$eleveur_select";
					$result_eleveur=mysqli_query($link, $query_eleveur);
					$tab_eleveur=mysqli_fetch_all($result_eleveur);
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
					
					$liste_id_per=[] ;
					for ($i=0;$i<$nbligne;$i++)
					{
						$liste_id_per[$i]=$tab_liste_per[$i][2] ;
					}
					
					// Les lignes suivantes servent à obtenir la liste des vache de l'éleveur séléctionné dans les pages précédentes puis la liste des id_bovins
					$query_liste_taureau="SELECT DISTINCT bovins.nom_bovin, bovins.id_bovin 
										FROM bovins 
										JOIN previsions ON previsions.id_taureau=bovins.id_bovin
										JOIN utilisateurs ON utilisateurs.id_utilisateur=bovins.id_utilisateur
										WHERE (bovins.sexe=1 OR bovins.sexe=3) AND previsions.nbr_paillettes IS NOT NULL AND utilisateurs.id_utilisateur=$eleveur_select";
					//Faudra poiuvoir prendre les taureaux que de la race de l'adlinistrateur de race
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
					
					echo '<table border = 1>';
						echo "<td> </td>" ;
						$j = 0;
						while ($j<$nb_taureau)
							{
								echo '<td>' . $liste_taureau[$j]. '</td>';
								$j++;
							}
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
								//var_dump($tab_paillettes);
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
							echo '<td>'. $S . '</td>';
							echo '</tr>';
						}
					echo '</table>';		
				}		
			}
			echo "</FORM>";
		?>
	</body>
</html>