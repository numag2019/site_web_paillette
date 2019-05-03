
<?php

function creationcsv($lignes)
{
	// Paramétrage de l'écriture du futur fichier CSV
	$chemin = 'csv/table_eleveurs.csv';

	// Création du fichier csv (le fichier est vide pour le moment)
	// w+ : consulter http://php.net/manual/fr/function.fopen.php
	$table_eleveurs_csv = fopen($chemin, 'w+');

	// Si votre fichier a vocation a être importé dans Excel,
	// vous devez impérativement utiliser la ligne ci-dessous pour corriger
	// les problèmes d'affichage des caractères internationaux (les accents par exemple)
	fprintf($table_eleveurs_csv, chr(0xEF).chr(0xBB).chr(0xBF));

	// Boucle foreach sur chaque ligne du tableau
	foreach($lignes as $ligne){
		// chaque ligne en cours de lecture est insérée dans le fichier
		// les valeurs présentes dans chaque ligne seront séparées par $delimiteur
		fputcsv($table_eleveurs_csv,$ligne,";","\"");
	}

	// fermeture du fichier csv
	fclose($table_eleveurs_csv);

}
?>


