<!-- Cette page est la page appelée par l'onglet "observations". Elle permet de faire tourner la page de sélection
tant que certaines conditions ne sont pas remplies. Elle permet ensuite d'afficher les onglets de choix du nom et 
du département, le tableau de résultat et un graphique.-->


<html>
<body>

<!--Autorise les accentuations-->
<meta charset='UTF-8'>

<!-- Feuille CSS-->
<link href="mise_en_page/maFeuilleDeStyle.css" rel="stylesheet" media="all" type="text/css"> 

<!--Affichage entête et menu de navigation-->
<?php 
include ("mise_en_page/DIVEntete.html"); 
include ("mise_en_page/DIVNavigation.html");
?>


<?php
// Tant que les conditions ne sont pas remplies, on fait tourner la page de selection
if (!isset($_GET['nom']) or empty($_GET['nom']) or !isset($_GET['dep']) or empty($_GET['dep']))
{
	echo "<meta charset='UTF-8'>";
	include ('observations_slct.php');
}

// Sinon on passe au traitement et à l'affichage des données
else
{

/* 	Pour les sorties on utilise un div qui englobe les sorties et deux autre div qui englobent touches et tableau dans 
	un premier temps et graphique dans un second temps (cf mise en page dans le document CSS maFeuilleDe Style */
	echo "<div id ='main'>";
		echo "<div id ='tableau'>";
			// On continue d'afficher nom et département sélectionné, on garde la possibilité de changer les valeurs directement
			include ('observations_slct.php');

		/* 	Partie 1 : recuperation nombre et oiseaux */
/* 		Rmq : urlencode dans obsevations_slct et urldecode ici permettent de transmettre les noms de départements avec caractères spéciaux d'une
		page à l autre (ici, le problème était Pyrénées Atlantiques) */
			$dep=urldecode($_GET['dep']);
			$nom=$_GET['nom'];

			//lien vers la bdd
			$link=mysqli_connect('localhost','root','','oiseaudb');

			//Change l'encodage des données de la BDD
			mysqli_set_charset($link,"utf8mb4");

			//requete
			$query="SELECT oiseaux.nom_commun,SUM(observations.nombre) FROM observations
			JOIN oiseaux ON observations.id_oiseau=oiseaux.id_oiseau
			JOIN Communes ON observations.id_commune=Communes.id_commune
			JOIN Departements ON Communes.id_dpt=Departements.id_dpt and Departements.nom_dpt='".$dep."'
			JOIN observateurs ON Observations.id_observateur=observateurs.id_observateur and nom_observateur='".$nom."'
			GROUP BY oiseaux.nom_commun";






			//recuperation donnée demandée par requete
			$obs=mysqli_query($link,$query);
			 
			 // transformation donnée eu par requete en tableau exploitable
			$tab=mysqli_fetch_all($obs);
			$nbligne=mysqli_num_rows($obs);
			$nbcol=mysqli_num_fields($obs);


			//Partie 2 : creation sorties
			// si il y a des observations, on envoie les sorties suivantes
			if ($nbligne!=0)
			{
				echo "<br>";
				echo "<strong> Nombre d'observations par oiseau en ".urldecode($_GET['dep'])." faits par Mr/Mme ".$_GET['nom']."</strong>";
				echo "<br><br>";
				
				// premiere ligne avec noms des colonnes
				echo "<table border='2' align='center'>";
				$nomscolonnes=array("Oiseaux","Quantité");

			
				echo "<tr>";
				$k=0;
				while ($k<count($nomscolonnes))
					{
					echo "<td>";
					echo $nomscolonnes[$k];
					echo "</td>";
					$k=$k+1;
					}	
				echo "</tr>";

				// lignes suivantes avec les données
				// récupération indice du nombre d'observation maximum
				$h=0;
				$indmax=0;
				$max=0;
					while($h<$nbligne)
					{
							if ($max<$tab[$h][1])
							{
								$max=$tab[$h][1];
								$indmax=$h;
							}
						$h++;
					}
				
				//création tableau avec données
				$i=0;
				while ($i<$nbligne)
				{	
					 echo "<tr>";
					$j=0;
					 
					while($j<$nbcol)
					{
						if ($j==1 and $i==$indmax)
						{
							echo "<td  style='color:red;'>";
							echo $tab[$i][$j];
							echo "</td>";
						}
						else
						{
							echo "<td>";
							echo $tab[$i][$j];	
							echo "</td>";
						}
						$j++;
					}
					echo "</tr>";
					
					$i++;
				} 
				echo "</table>";

				echo str_repeat('<br>',20);
				echo "</div>";
				
				// Appelle page de création du graphique
				echo "<div id='graph'>";
				echo "<br><br><br>";
				echo "<img src='graph_pie.php?dep=$dep&nom=$nom'>";
				echo "</div>";
			}
			
			// Si il n'y a aucune observations dans la bdd, on envoie ce message
			else
			{
				echo "</div>";
				echo "<div id='graph'>";
				echo "<br><br>";
				echo "Mr/Mme ".$_GET['nom']." n'a pas fait d'observations dans le département ".$_GET['dep'];
				echo str_repeat('<br>',8);
				echo "</div>";
			}
	echo "</div>";



	mysqli_close($link);
	echo "<br><br>";

	
}

// Affichage pied de page
include ("mise_en_page/DIVPied.html"); 
?> 	

</body>
</html>