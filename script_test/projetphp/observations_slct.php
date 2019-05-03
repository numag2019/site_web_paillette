<!-- Observations.slct est la page de sélection d'un nom d'utilisateur et du département.
On a voulu ici afficher au fur et à mesure les champs de sélection (nom puis département).
La valeur par défaut étant vide, si l'utilisateur ne sélectionne pas un nom ou un département, 
un message d'erreur s'affichera (la page tourne de nouveau. cf observations_donnees).
Si l'utilisateur a déjà saisi une valeur, elle restera dans les champs de sélection.

Rmq : la page appelée par l'onglet observation est observations.donnees. Cette page ci n'est 
jamais appelée directement-->

<html>
<body>
<meta charset='UTF-8'>

<?php
//  observations _donnees permet le traitement des résultats si les champs ne sont pas vides, sinon il fait tourner cette page
echo '<FORM action="observations_donnees.php" method="GET" name="form">';

/* Partie 1 : recuperation noms des observateurs */
echo "<br>";
echo "*Choisir un observateur";
echo "<br>";

// Lien à la base de donnée
$link=mysqli_connect('localhost','root','','oiseaudb');

//Change l'encodage des données de la BDD
mysqli_set_charset($link,"utf8mb4");

// Requête pour récupérer nom		
$query="SELECT * FROM observateurs";
$result=mysqli_query($link,$query);


// Transformation donnée récupérée en tableau
$tab=mysqli_fetch_all($result);

// Récupération nombre de lignes
$nbligne=mysqli_num_rows($result);


//Creation liste deroulante avec les noms recuperes

echo "<select name = 'nom' size=1>";
$i=0;

if (empty($_GET['nom']))									// si le nom n'est pas rempli, affiche par défaut une selection vide
{
	
	echo "<option value='' selected='selected'></option>";
	while ($i<$nbligne)
	{
		echo "<option value=".$tab[$i][1].">".$tab[$i][1]."</option>";
		$i++;
	}
	echo "</select>";
}
$i=0;




if (!empty($_GET['nom']))														//si le nom est rempli, selection par défaut sur le nom saisi precedemment
{	

	while ($i<$nbligne)
	{
		if ($tab[$i][1]==$_GET['nom'])
		{
		echo "<option value=".$tab[$i][1]." selected='selected'>".$tab[$i][1]."</option>";
		$i++;
		}
		
		else
		{
			echo "<option value=".$tab[$i][1].">".$tab[$i][1]."</option>";
			$i++;
		}
	}
	echo "</select>";
}




// si le champ nom existe (si la page a déjà tournée) et est non vide, alors on cherche le departement
if (isset($_GET['nom']))
{
	if (!empty($_GET['nom']))
	{
		/* Partie 2 : récuperation noms des départements */
		//lien à la bdd
		$link=mysqli_connect('localhost','root','','oiseaudb');
		echo "<br>";
		echo "<br>";
		echo "*Choisir un département";
		echo "<br>";

		//Change l'encodage des données de la BDD
		mysqli_set_charset($link,"utf8mb4");

		//requete pour nom département
		$querya="SELECT * FROM Departements";
		$resulta=mysqli_query($link,$querya);


		// création tableau et récupération nombre de lignes
		$taba=mysqli_fetch_all($resulta);
		$nblignea=mysqli_num_rows($resulta);


		//Creation liste deroulante avec les départements récupérés

		if (empty($_GET['dep']))					// Si le champ département n'est pas rempli, alors on affiche par défaut une selection vide
		{
			echo "<select name = 'dep' size=1>";
			$j=0;
			echo "<option value='' selected='selected'></option>";
			while ($j<$nblignea)
				{
				echo "<option value=".urlencode($taba[$j][1]).">".$taba[$j][1]."</option>";
				$j++;
				}
			echo "</select>";
		}

		if (!empty($_GET['dep']))						// Si le champ département est rempli, alors on affiche par défaut le nom selectionné precedemment
		{
			echo "<select name = 'dep' size=1>";
			$j=0;

			while ($j<$nblignea)
			{
				if ($taba[$j][1]==urldecode($_GET['dep']))
					{
						echo "<option value=".urlencode($taba[$j][1])." selected='selected'>".$taba[$j][1]."</option>";
					}
				else
					{
						echo "<option value=".urlencode($taba[$j][1]).">".$taba[$j][1]."</option>";
					}
				$j++;
			}
			echo "</select>";
		}




	}
	
	/* Partie 3 : ajout de messages d'erreurs 
	(Rmq : on est toujours dans une boucle if qui tourne si la page a déjà tourné pour le nom,
	ce test de création dans un premier temps du nom puis du département empêche le message d'erreur de s'afficher dès le début) */
	
	if (empty($_GET['nom']))					//si nom non rempli, indication
	{
		echo str_repeat('&nbsp;',25);
		echo "<strong> Veuillez selectionner  un nom </strong> ";

	}
}

if (isset($_GET['dep']))						//si departement existe
{
	if (empty($_GET['dep']))					//si departement non rempli
	{
		echo str_repeat('&nbsp;',25);
		echo " <strong> Veuillez sélectionner  un département </strong> ";
			
	}
}



/* Partie 4 : création des deux touches d appelle des pages suivantes */
if (empty($_GET['dep']))							// But : indiquer "confirmer" tant que le département n'a pas été sélectionné
{
	echo "<br><br>";
	echo '<input onclick="do;" type="submit" value="Confirmer" />';
	echo '</FORM>';
}

else												// But : indiquer "Changer" pour changer de données
{
	echo "<br><br>";
	echo '<input onclick="do;" type="submit" value="Changer" />';
	echo '</FORM>';
}

?>



</body>
</html>