<?php
	
function csv_to_array2($filename='', $delimiter=';')
{
    $row=0;
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
 		while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
			$num = count($data);
			for($c=0;$c<$num;$c++)
			{
				$csv[$row][$c]=$data[$c];
			}
			$row = $row+1;
	    }
        fclose($handle);
    }
    return $csv;
}
	
	
	$csv = csv_to_array2('C:\Users\NUMAG3\Desktop\sortie_genis\ResultatsPedig\parente\parente_bear.csv'); 
	
	// 1. Requête sur la base de données GenIS pour stocker le numéro SIRE en face du sexe
	
	$link=mysqli_connect('genis.cra', 'root', '', 'genis_test');
	$query_male="SELECT no_identification FROM animal WHERE sexe=1 OR sexe=3";
	$result_male=mysqli_query($link,$query_male);
	$tab_male=mysqli_fetch_all($result_male);
	$nbligne_male=mysqli_num_rows($result_male);
	
	$liste_male=[];
	for($i=0; $i<=$nbligne_male-1; $i++)
	{
		$liste_male[$i]=$tab_male[$i][0];
	}
	//var_dump($liste_male);
	
	$query_femelle="SELECT no_identification FROM animal WHERE sexe=2";
	$result_femelle=mysqli_query($link,$query_femelle);
	$tab_femelle=mysqli_fetch_all($result_femelle);
	$nbligne_femelle=mysqli_num_rows($result_femelle);
	
	$liste_femelle=[];
	for($i=0; $i<=$nbligne_femelle-1; $i++)
	{
		$liste_femelle[$i]=$tab_femelle[$i][0];
	}
	//var_dump($liste_femelle);
	
	//if ((in_array("722530",$liste_femelle) AND in_array("4330342",$liste_male)) OR (in_array("7722530",$liste_femelle) AND in_array("14330342",$liste_male)))
	//	echo "on le prend";
	
	//if (in_array("3214330342",$liste_male))
	//	echo "OK";

	// 2. On parcours le tableau à partir de $csv[2][2]. 
	//	  Si la colonne 1 (parent) et la ligne 1 (parent) correspondant sont un male et une femelle ou un male castré et une femelle, alors on fait l'étape 3.

	
	$nb_tab = count($csv);
	$i = 2;
	while ($i<$nb_tab-1)
	{
		$j = 2;
		while ($j<$nb_tab-1)
		{
			echo $csv[1][$j];
			echo"<br>";
			echo $csv[$i][1];
			if ((in_array($csv[1][$j],$liste_femelle) AND in_array($csv[$i][1],$liste_male)) OR (in_array($csv[1][$j],$liste_femelle) AND in_array($csv[$i][1],$liste_male)))
			// if ((in_array($csv[1][$j],$liste_femelle) AND (in_array($csv[$i][1],$liste_male)) OR (in_array($csv[1][$j],$liste_male) AND (in_array($csv[$i][1],$liste_femelle)))
			{
			echo $csv[$i][$j];
			echo "<br>";
			}
			$j = $j + 1;
			echo"<br>";
		}
		$i = $i +1;
	}
	
	// 3. pour le coefficiant, on le copie dans la base de données GenIS avec le n° SIRE du père et de la mère asssociés.



			//$query="SELECT id_observateur, nom_observateur FROM observateurs"; // requête pour la liste déroulante choix observateur
			//$result=mysqli_query($link, $query);
			
			//$tab_nom=mysqli_fetch_all($result,MYSQLI_NUM); // identifiant et nom des observateurs regroupés dans un tableau
?>

