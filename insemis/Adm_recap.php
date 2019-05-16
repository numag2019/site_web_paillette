<!doctype html>
<HTML lang='fr'>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">
		<link rel="stylesheet" href="../mise_en_page/pied.css">
	<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
	<?php $autorisation=TRUE // tout le monde?>

	</head>
	
	<body>
		<?php include("../mise_en_page/navigation.html"); ?>
		<?php
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			$query="SELECT id_race, nom_race FROM races"; // requête pour la liste déroulante choix eleveur
			$result=mysqli_query($link, $query);
		
			$tab_race=mysqli_fetch_all($result); // identifiant et nom des observateurs regroupés dans un tableau
		
				$race="5";
			
				$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
				mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
				
				$query_race="SELECT nom_race FROM races WHERE id_race=$race";
				$result_race=mysqli_query($link, $query_race);
				$tab_race=mysqli_fetch_all($result_race);
				
				echo'<div class="container">	
				 <div class="row d-flex justify-content-center">
				 <div class="col-md-8 fond"><br>';
				echo "Récapitulatif des prévisions de commandes de paillettes pour la race <b>". $tab_race[0][0] . " </b><br>" ;
				
				// Les lignes suivantes servent à obtenir la liste des éleveurs/utilisateurs et la liste des id_utilisateur
				$query_liste_ut="SELECT DISTINCT utilisateurs.nom, utilisateurs.prenom, utilisateurs.id_utilisateur FROM utilisateurs 
									JOIN bovins ON bovins.id_utilisateur=utilisateurs.id_utilisateur
									JOIN previsions ON previsions.id_vache=bovins.id_bovin
									WHERE bovins.id_race=$race AND previsions.nbr_paillettes IS NOT NULL";
				// La requête devrait prendre que les utilisateurs pour lesquels y a une rpevision pour leurs vache
				$result_liste_ut=mysqli_query($link, $query_liste_ut);
				$tab_liste_ut=mysqli_fetch_all($result_liste_ut);
				$nbligne = mysqli_num_rows($result_liste_ut);
				
				$liste_ut=[] ;
				for ($i=0;$i<$nbligne;$i++)
				{
					$liste_ut[$i]=$tab_liste_ut[$i][1] . " " . $tab_liste_ut[$i][0] ;
				}
				
				$liste_id_ut=[] ;
				for ($i=0;$i<$nbligne;$i++)
				{
					$liste_id_ut[$i]=$tab_liste_ut[$i][2] ;
				}
				
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
				
				$liste_id_t=[] ;
				for ($i=0;$i<$nbligne;$i++)
				{
					$liste_id_t[$i]=$tab_liste_t[$i][1] ;
				}
				
				
				//affichage du tableau récapitulatif
				$nb_ut=count($liste_ut);
				$nb_t=count($liste_t);
				
					
					echo '<div class="row d-flex justify-content-center">';
					echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
					echo '<table class="table table-striped table-bordered">';
					$L=[];
					echo "<td> </td>" ;
					$j = 0;
					
					while ($j<$nb_t)
						{
							echo '<td>' . $liste_t[$j]. '</td>'; // affiche les noms de taureau en haut dans la première ligne du tableau
							$j++;
						}
					echo "<td><b> Total </b></td>";	
					$i =0;
					while ($i<$nb_ut)
					{
						echo '<tr>';
						echo "<td>" . $liste_ut[$i] . "</td>"; // afiche les noms d'éleveurs dans la première colonne du tableau
						$j=0;
						$S_ut=0;
						while ($j<$nb_t)
						{
							$query_paillettes="SELECT SUM(nbr_paillettes) FROM previsions 
												JOIN bovins ON bovins.id_bovin=previsions.id_vache 
												WHERE previsions.id_taureau=$liste_id_t[$j] AND bovins.id_utilisateur=$liste_id_ut[$i]
												GROUP BY previsions.id_taureau";
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
					echo "</div>";
					echo "</div>";

		echo "</FORM>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<footer class="footer">
		<?php include ("../mise_en_page/pied.html");?>
	</footer>
	
	</body>
</html>