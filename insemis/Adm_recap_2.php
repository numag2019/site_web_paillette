<html>
	<head>
		<meta charset = "UTF-8">
	</head>
	
	<body>
		
		
		<?php
			$race=$_GET["id_race"];
			
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			$query_race="SELECT nom_race FROM races WHERE id_race=$race";
			$result_race=mysqli_query($link, $query_race);
			$tab_race=mysqli_fetch_all($result_race);
			
			echo "Plateforme Paillettes - Récapitulatif des prévisions de commandes de paillettes pour la race <b>". $tab_race[0][0] . " </b><br><br><br>" ;
			
			// Les lignes suivantes servent à obtenir la liste des éleveurs/utilisateurs et la liste des id_utilisateur
			$query_liste_ut="SELECT DISTINCT utilisateurs.nom, utilisateurs.prenom, utilisateurs.id_utilisateur FROM utilisateurs 
								JOIN bovins ON bovins.id_utilisateur=utilisateurs.id_utilisateur
								JOIN previsions ON previsions.id_taureau=utilisateurs.id_bovin
								WHERE bovins.id_race=$race AND previsions.nbr_paillettes IS NOT NULL";
			echo $query_liste_ut ;
			$result_liste_ut=mysqli_query($link, $query_liste_ut);
			$tab_liste_ut=mysqli_fetch_all($result_liste_ut);
			$nbligne = mysqli_num_rows($result_liste_ut);
			
			$liste_ut=[] ;
			for ($i=0;$i<$nbligne;$i++)
			{
				$liste_ut[$i]=$tab_liste_ut[$i][1] . " " . $tab_liste_ut[$i][0] ;
			}
			var_dump($liste_ut);
			
			$liste_id_ut=[] ;
			for ($i=0;$i<$nbligne;$i++)
			{
				$liste_id_ut[$i]=$tab_liste_ut[$i][2] ;
			}
			//var_dump($liste_id_ut);
			

			// Les lignes suivantes servent à obtenir la liste des taureaux de la race séléctionné dans les pages précédentes puis la liste des id_bovins
			$query_liste_t="SELECT nom_bovin, id_bovin FROM bovins WHERE (sexe=1 OR sexe=3) AND id_race=$race";
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
						echo '<td>' . $liste_t[$j]. '</td>';
						$j++;
					}
					
				$i =0;
				while ($i<$nb_ut)
				{
					echo '<tr>';
					echo "<td>" . $liste_ut[$i] . "</td>";
					$j=0;
					while ($j<$nb_t)
					{
						$query_paillettes="SELECT nbr_paillettes FROM previsions 
											JOIN bovins ON bovins.id_bovin=previsions.id_taureau
											WHERE previsions.id_taureau=$liste_id_t[$j] AND bovins.id_utilisateur=$liste_id_ut[$i]";
						$result_paillettes=mysqli_query($link, $query_paillettes);
						$tab_paillettes=mysqli_fetch_all($result_paillettes);
						//var_dump($tab_paillettes);
						if (empty($tab_paillettes))
							echo '<td> 0 </td>';
						else
							echo '<td>' . $tab_paillettes[0][0]. '</td>';
						$j++;
					}
					$i++;
					echo '</tr>';
				}
			echo '</table>';
			*/
			
		?>	
	
	</body>
</html>