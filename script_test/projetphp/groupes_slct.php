<!-- Cette page est appelée par la page groupes_donnees. Elle permet de sélectionner un nom de département, un trimestre et une taille minimale de 
groupe d'oiseau. Affiche des messages d'erreurs si la taille du groupe est négative et si elle est non numérique.-->

<html>
<body>

<!--Autorise les accentuations-->
<meta charset='UTF-8'>



<?php
// appelle de la page suivante
echo '<FORM action="groupes_donnees.php" method="GET" name="form">';

// Choix département
echo "<br>";
echo "*Choisir un département";
echo "<br>";

// recuperation noms des departement
$link=mysqli_connect('localhost','root','','oiseaudb');

//Change l'encodage des données de la BDD
mysqli_set_charset($link,"utf8mb4");

// Requête
$querya="SELECT * FROM Departements";
$result=mysqli_query($link,$querya);


//Création tableau
$tab=mysqli_fetch_all($result);
$nbligne=mysqli_num_rows($result);
$nbcol=mysqli_num_fields($result);

//Creation liste deroulante avec les departements recuperes

echo "<select name = 'dep' size=1>";
$j=0;

// si c'est la première fois qu'on fait tourner la page
if (!isset($_GET['dep']))
{
	while ($j<$nbligne)
		{
		echo "<option value=".urlencode($tab[$j][1]).">".$tab[$j][1]."</option>";
		$j++;
		}
}

// si c'est la seconde fois, on affiche la valeur selectionnée précedemment 
else
{
		while ($j<$nbligne)
		{
			if ($tab[$j][1]==urldecode($_GET['dep']))
			{
				echo "<option value=".urlencode($tab[$j][1])." selected='selected'>".$tab[$j][1]."</option>";
				$j++;
			}
			else
			{
				echo "<option value=".urlencode($tab[$j][1]).">".$tab[$j][1]."</option>";
				$j++;
			}
		}
}
echo "</select>";



//recuperation trimestre

echo "<br><br>";
echo "*Choisir le trimestre";
echo "<br>";

echo "<select name = 'trimestre' size=1>";
$i=0;
$trimestre=array(1,2,3,4);

// si première fois que la page tourne
if (!isset($_GET['trimestre']))
{
	while ($i<$nbligne)
	{
		echo "<option value=".$trimestre[$i].">".$trimestre[$i]."</option>";
		$i++;
	}
}

//si seconde fois, on affiche les valeurs sélectionnées précedemment
else
{
		while ($i<$nbligne)
	{
		if ($trimestre[$i]==$_GET['trimestre'])
		{
			echo "<option value=".$trimestre[$i]." selected='selected'>".$trimestre[$i]."</option>";
			$i++;
		}
		else
		{
			echo "<option value=".$trimestre[$i].">".$trimestre[$i]."</option>";
			$i++;
		}
	}
}
echo "</select>";

//recuperation taille minimale du groupe d'oiseau
echo "<br>";
echo "<br>";
echo "*Choisir la taille minimale du groupe d'oiseau";
echo "<br>";


// Si la page tourne pour la seconde fois
if (isset($_GET['taille']))
{
	// Si la taille est négative ou n'est pas numérique
	if (!is_numeric($_GET['taille']) or ($_GET['taille']<0))
	{  
		if (!is_numeric($_GET['taille']))
		{
			echo "<INPUT TYPE ='TEXT' value='0' name='taille' id='taille'>";
			echo str_repeat('&nbsp;',25);
			echo " <strong>Les chiffres sont à droite de votre clavier!!!</strong>";
		}
		else
		{
			echo "<INPUT TYPE ='TEXT' value='0' name='taille' id='taille'>";
			echo str_repeat('&nbsp;',25);
			echo " <strong>On n'aime point les chiffres négatifs</strong>";
		}
	}
	else
	{
			echo "<INPUT TYPE ='TEXT' value=".$_GET['taille']." name='taille' id='taille'>";
	}
}
// Si la page tourne pour la première fois
else
{
	echo "<INPUT TYPE ='TEXT' value='0' name='taille' id='taille'>";
}

//Avancer a la page suivante
echo "<br><br>";
echo '<input onclick="do;" type="submit" value="Voir résultats" />';


echo '</FORM>';



?>


</body>
</html>