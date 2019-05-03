<!-- Cette page est appelée par l'onglet "groupes".Elle permet de faire tourner la page de sélection
tant que certaines conditions ne sont pas remplies. Elle permet ensuite d'afficher les onglets de choix 
du département, du trimestre et de la taille, et enfin les résultats.-->

<html>
<body>


<!--Autorise les accentuations-->
<meta charset='UTF-8'>

<!-- Feuille CSS, entête et menu de navigation-->
<link href="mise_en_page/maFeuilleDeStyle.css" rel="stylesheet" media="all" type="text/css"> 
<?php 
include ("mise_en_page/DIVEntete.html"); 
include ("mise_en_page/DIVNavigation.html");
?>

<?php

// Si la page tourne pour la première fois ou si le champ taille n'est pas en numérique, ou négatif, on refait tourner la page de selection
if (!isset($_GET['dep']) or !is_numeric($_GET['taille']) or $_GET['taille']<0)
{
		include ('groupes_slct.php');
	
}

// Sinon tout va bien, on traite les données
else
{
	echo '<div id = "main">';
	echo "<div id='selection'>";
	// on affiche les selections pour pouvoir changer les donnees
		include ('groupes_slct.php');
	echo "</div>";
	
	echo "<div id='donnees'>";
		$link=mysqli_connect('localhost','root','','oiseaudb');


		//Partie 1 : Creation intervalle date selon le trimestre
		$tri=$_GET['trimestre'];
		$date1="0";
		$date2="0";

		if ($tri==1)
		{
			$date1='01';
			$date2='03';
		}
		elseif ($tri==2)
		{
			$date1='04';
			$date2='06';
		}
		elseif ($tri==3)
		{
			$date1='07';
			$date2='09';
		}
		elseif ($tri==4)
		{
			$date1='10';
			$date2='12';
		}





		//Partie 2 : Recuperation dates d'observation et nom oiseau et nombre d'oiseaux observés 
		//(conditions : intervalle de date, départment, et nombre minimale)

		// récupération des sélections
		$dep=urldecode($_GET['dep']);
		$nbremin=$_GET['taille'];



		//Change l'encodage des données de la BDD
		mysqli_set_charset($link,"utf8mb4");


		//Requête
		$queryd="SELECT DATE_FORMAT(Observations.date,'%d/%m/%Y'),Observations.nombre,oiseaux.nom_commun,Communes.nom_commune,Departements.id_dpt FROM observations
		JOIN oiseaux ON observations.id_oiseau=oiseaux.id_oiseau
		JOIN Communes ON observations.id_commune=Communes.id_commune
		JOIN Departements ON Communes.id_dpt=Departements.id_dpt and Departements.nom_dpt='".$dep."'
		WHERE MONTH(Observations.date) BETWEEN '".$date1."' and '".$date2."' and Observations.nombre >".$nbremin."
		GROUP BY Observations.date";

			
		$obsd=mysqli_query($link,$queryd);

		// Transformation données en tableau 
		$tab=mysqli_fetch_all($obsd);

		// Récupération lignes et colonnes du tableau
		$nbligned=mysqli_num_rows($obsd);
		$nbcold=mysqli_num_fields($obsd);





		//Partie 3 : creation des sorties 
		echo "<br>";
		// Si il y a des observations, on affiche les résultats suivants
		if (count($tab)>0)
		{
			// Orthographe pour le trimestre (ème ou er) pris en compte
			if ($tri==1)
			{
				echo "<strong>Bilan de(s) ".$nbligned." observation(s) fait(es) dans le département ".$dep." (".$tab[0][4].") 
				 durant le ".$tri."er trimestre par groupe d'au moins ".$nbremin." individu(s).</strong>";
			}
			else
			{
				echo "<strong>Bilan de(s) ".$nbligned." observation(s) fait(es) dans le département ".$dep." (".$tab[0][4].") 
				 durant le ".$tri."ème trimestre par groupe d'au moins ".$nbremin." individu(s).</strong>";
			}


			echo str_repeat('<br>',2);
			echo "<ol>";
			$i=0;

			while ($i+1<=$nbligned)
			{
				echo "<li> Le ".$tab[$i][0].", ".$tab[$i][1]." individu(s) de ".$tab[$i][2]." ont/a été observé(s) à ".$tab[$i][3]."</li>";
				$i=$i+1;

			}
			echo "</ol>";
			echo str_repeat('<br>',6);
		}
		
		//Si pas de résultats, alors affichage résultats suivants
		else
		{
			if ($tri==1)
			{
				echo "Aucune observation n'a été faite le ".$tri."er trimestre dans le département ".$dep."
				 par groupe d'au moins ".$nbremin." individu(s)";				
			}
			else
			{
				echo "Aucune observation n'a été faite le ".$tri."ème trimestre dans le département ".$dep."
				 par groupe d'au moins ".$nbremin." individu(s)";
			}
			echo str_repeat('<br>',10);
		}
		echo "</div>";
	echo "</div>";
}

echo "<br>";

?>

<!--Affichage pied de page--> 
<?php
include ("mise_en_page/DIVPied.html"); 
?> 	

</body>
</html>