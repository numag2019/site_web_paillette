<html>
	<head>
		<meta charset = "UTF-8">
	</head>
	
	<body>
		
		
		<?php
			require "Mes_fonctions.php" ;
		?>
		
		<?php
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
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
			
			// Les lignes suivantes servent à obtenir la liste des vache de l'éleveur séléctionné dans les pages précédentes puis la liste des id_bovins
			$query_liste_taureau="SELECT DISTINCT bovins.nom_bovin, bovins.id_bovin 
								FROM bovins 
								JOIN previsions ON previsions.id_taureau=bovins.id_bovin
								WHERE (bovins.sexe=1 OR bovins.sexe=3) AND previsions.nbr_paillettes IS NOT NULL";
			//Faudra poiuvoir prendre les taureaux que de la race de l'adlinistrateur de race
			$result_liste_taureau=mysqli_query($link, $query_liste_taureau);
			$tab_liste_taureau=mysqli_fetch_all($result_liste_taureau);
			$nbligne = mysqli_num_rows($result_liste_taureau);
			
			$liste_taureau=[] ;
			for ($i=0;$i<$nbligne;$i++)
			{
				$liste_taureau[$i]=$tab_liste_taureau[$i][0] ;
			}
			//var_dump($liste_taureau);
			
			$liste_id_taureau=[] ;
			for ($i=0;$i<$nbligne;$i++)
			{
				$liste_id_taureau[$i]=$tab_liste_taureau[$i][1] ;
			}
			//var_dump($liste_id_taureau);


			//affichage du tableau historique commandes
			//$tab_historique=[];
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
				/*
				echo "<tr>";
				echo "<td> Total </td>";
				echo "</tr>";
				*/
			echo '</table>';
			

			/*
			$query_paillettes="SELECT nbr_paillettes FROM previsions WHERE id_vache=$liste_id_vache[0] AND id_periode=$liste_id_per[1]";
			$result_paillettes=mysqli_query($link, $query_paillettes);
			$tab_paillettes=mysqli_fetch_all($result_paillettes);
			var_dump($tab_paillettes);
			*/
			
			/*
			$i=0 ;
			while ($i<$nb_periodes-1)
			{
				
				$j=0;
				while ($j<$nb_vaches-1)
				{
					//$query="SELECT nbr_paillettes FROM previsions WHERE id_vache=$tab_historique[0][$j]";
					$tab_historique[$i][$j]=3;
					echo $tab_historique[$i][$j];
					$j++;
				}
				$i++;
			}
			*/
		?>







	</body>
</html>