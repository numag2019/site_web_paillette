<?php //Cette page est liee a observations_donnes pour l'analyse des resultats. Elle permet d ajouter un graphique a secteurs.

require_once ('jpgraph-4.2.6/src/jpgraph.php');
require_once ('jpgraph-4.2.6/src/jpgraph_pie.php');



// Partie 1 : recuperation nombre et oiseaux
$dep=$_GET['dep'];
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



// Création tableaux contenant la légende (type d'oiseau) et les données (nombre d'oiseaux)
$p=0;
$data=array();
while ($p<$nbligne)
{
	$data[]+=$tab[$p][1];
	$p=$p+1;
}

$i=0;
$oiseau=array();
while ($i<$nbligne)
{
	$oiseau[]=$tab[$i][0];
	$i=$i+1;
}



// Create the Pie Graph.
$graph = new PieGraph(600,400);
$graph->clearTheme();
$graph->SetShadow();

// Set A title for the plot
$graph->title->Set("Répartition des observations d'oiseaux 
de ".$nom." dans le département ".$dep."");
$graph->title->SetFont(FF_VERDANA,FS_BOLD,14);
$graph->title->SetColor("brown");



// Create pie plot
$p1 = new PiePlot($data);
$p1->SetLegends($oiseau);
//$p1->SetSliceColors(array("red","blue","yellow","green"));
$p1->SetTheme("earth");
$p1->SetCenter(0.4);



$p1->value->SetFont(FF_ARIAL,FS_NORMAL,10);



$graph->Add($p1);
$graph->Stroke();

?>
