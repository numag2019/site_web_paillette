<HTML>

<?php

$link = mysqli_connect('localhost', 'root', '', 'crabase');
mysqli_set_charset($link, "utf8mb4");


$query_race = "SELECT id_race_int, nom_race FROM races_intermediaire";
$result_race = mysqli_query($link, $query_race);
$tab_race = mysqli_fetch_all($result_race);

echo '<FORM method = "GET" name = "formulaire_page3">';
echo "Choisissez la race : ";
echo '<SELECT NAME = "liste_race">';
for($i=0; $i < count($tab_race); $i++)
	{
	$value = $tab_race[$i][0];
	echo "<OPTION VALUE ='".$value. "' ";
	if (isset($_GET['liste_race']))
		{
		// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
		if ($value==$_GET['liste_race']) 
		echo "selected";
		}
	echo ">".$tab_race[$i][1]."</OPTION> ";
	}
echo '</SELECT NAME> <br/> <br/>';
echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider" value = "Valider">';
echo '<br> <br>';

if(isset($_GET['bouton_valider']))
	{
	$race = $_GET['liste_race'];
	if ($race == 6)
		$nom_race = 'marine';
	if ($race == 5)
		$nom_race = 'bordelaise';
	if ($race == 19)
		$nom_race = 'béarnaise';
	$query_periode = "SELECT periodes.id_periode, periodes.date_debut, periodes.date_fin FROM periodes WHERE periodes.id_race = ".$race.""; 
	$result_periode = mysqli_query($link, $query_periode);
	$tab_periode = mysqli_fetch_all($result_periode);

	echo "Choisissez la période : ";

	echo '<SELECT NAME = "liste_periode">';
	for($i=0; $i < count($tab_periode); $i++)
		{
			$value = $tab_periode[$i][0];
			echo "<OPTION VALUE ='".$value. "'"; 
			if (isset($_GET['liste_periode']))
				{
				// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
				if ($value==$_GET['liste_periode']) 
				echo "selected";	
				}
			echo ">" .$tab_periode[$i][1]. '-' .$tab_periode[$i][2]. "</OPTION>";
		}
	echo '</SELECT NAME> <br/> <br/>';
	echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider" value = "Valider"> <br/> <br/>';
	}
	
	if(isset($_GET['bouton_valider']))
		{
		$periode = $_GET['liste_periode'];
		$query_periode_af = 'SELECT periodes.date_debut, periodes.date_fin FROM periodes WHERE periodes.id_periode ='.$periode.' ';
		$result_periode_af = mysqli_query($link, $query_periode_af);
		$tab_periode_af = mysqli_fetch_all($result_periode_af);
		echo 'Tableau récapitulatif des prévisions de commande de paillettes pour la race '.$nom_race. ' du ' .$tab_periode_af[0][0]. ' au ' .$tab_periode_af[0][1];
		echo '<br> <br>';
		echo '<INPUT TYPE = "SUBMIT" name = "bouton_reini" value = "Réinitialiser le tableau"> <br/> <br/>';
		}
	
echo '</FORM>';
?>

</HTML>