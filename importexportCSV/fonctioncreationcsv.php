
<?php
// Fonction créant un csv ayant comme variable une requete et le nom du fichier (appelé par la page creationcsv.php)
function creationcsv($requete,$nom_fichier)
{
	$link=mysqli_connect('localhost','root','','genis_test');
	mysqli_set_charset($link,"utf8mb4");

	// Recuperation de la requete 		
	$obs=mysqli_query($link,$requete);

	// Transformation donnees en tableau 
	$tab=mysqli_fetch_all($obs);

	// Recuperation lignes et colonnes du tableau
	$nbligne=mysqli_num_rows($obs);
	$nbcol=mysqli_num_fields($obs);

	//chemin du fichier texte
	$chemin = 'csv/'.$nom_fichier.'.csv';

	// Creation du fichier csv (le fichier est vide pour le moment)
	$fichier_csv = fopen($chemin, 'w+');

	//Pour éviter les problemes avec des caracteres speciaux sur le fichier texte
	fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));
	
	// Creation de l'ecrit destine au csv
	$i=0;
	$ecrit='';
	while ($i<$nbligne)
	{	
		$ecrit.='/"'.$tab[$i][0];
		$j=1;
		while ($j<$nbcol-1)
		{
			$ecrit.='";"'. $tab[$i][$j];
			$j++;
		}
		$ecrit.='";"'.$tab[$i][$nbcol-1].'"/'."\r\n";
		$i++;
	}
	
	//ecriture dans le csv
	fwrite($fichier_csv,$ecrit);
	
	// fermeture du fichier csv
	fclose($fichier_csv);

}

?>

