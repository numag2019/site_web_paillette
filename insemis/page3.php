<HTML>

<?php

$link = mysqli_connect('localhost', 'root', '', 'datacranet');
mysqli_set_charset($link, "utf8mb4");


$query_race = "SELECT id_race_int, nom_race FROM races_intermediaire";
$result_race = mysqli_query($link, $query_race);
$tab_race = mysqli_fetch_all($result_race);
$nb_race = mysqli_num_rows($result_race);

echo '<FORM method = "GET" name = "formulaire_page3bis">';

echo "Choisissez la race : ";

echo '<SELECT NAME = "liste_race">';
$i = 0;
while ($i<$nb_race)
{
	echo '<OPTION VALUE ='.$tab_race[$i][0]. '>' .$tab_race[$i][1].'</OPTION> ';
	$i++;
}
echo '</SELECT NAME> <br/> <br/>';
echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider" value = "Valider">';


$query_periode = "SELECT id_periode, date_debut, date_fin FROM periode";
$result_periode = mysqli_query($link, $query_periode);
$tab_periode = mysqli_fetch_all($result_periode);
$nb_periode = mysqli_num_rows($result_periode);


echo "Choisissez la période : ";

echo '<SELECT NAME = "liste_periode">';
$i = 0;
while ($i<$nb_eleveur)
{
	echo '<OPTION VALUE ='.$tab_periode[$i][0]. '>' .$tab_periode[$i][1]. ' - ' .$tab_periode[$i][2]. '</OPTION> ';
	$i++;
}
echo '</SELECT NAME> <br/> <br/>';

echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider" value = "Valider">';
echo '</FORM>';
?>

</HTML>