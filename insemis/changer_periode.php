<?php

$periode = $_GET['periode'];
$race = $_GET['race'];
echo $periode;
echo $race;

//Procédure pour terminer la période 

$query_fin_periode = "UPDATE periodes
					SET date_fin = CURRENT_DATE()
					WHERE  id_periode =".$periode."AND date_fin=null";

//Procédure pour commencer une nouvelle période

?>