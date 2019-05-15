					<?php


$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
//Récupération  des données entrées précédemment dans le formulaire
$periode = $_GET['periode'];
//echo $periode;
$race = $_GET['race'];
//echo $race;


//Procédure pour terminer la période 


$query_fin_periode = "UPDATE periodes
					SET date_fin = CURRENT_DATE()
					WHERE  id_periode =".$periode;
					
$reqfin=mysqli_query($link,$query_fin_periode );

//Procédure pour commencer une nouvelle période					
$query_new_periode = "INSERT INTO periodes(date_debut,id_race) VALUES(CURRENT_DATE(),".$race.")";

$reqnew=mysqli_query($link,$query_new_periode );




?>
