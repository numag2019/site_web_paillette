
<html>
<body>

<!--••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••

CETTE PAGE PERMET D'ALIMENTER LES 4 TABLES INTERMÉDIAIRES DE LA BDD DATACRANET (eleveurs_intermediaire, bovins_intermediaire, 
races_intermediaire, coefficients_intermediaire),
À PARTIR DES 4 FICHIERS .CSV CRÉES DANS LE FICHIER "creationcsv.php" 

••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••-->


<?php


//••• Connexion à la base de données DataCraNet •••\\
$link=mysqli_connect('localhost','root','','crabase');

//•••Suppression données des tables intermediaires•••\\
$queryDC="DELETE FROM coefficients_intermediaire";
$queryDE="DELETE FROM eleveurs_intermediaire";
$queryDB="DELETE FROM bovins_intermediaire";
$queryDR="DELETE FROM races_intermediaire";

$obsDC=mysqli_query($link,$queryDC);
$obsDE=mysqli_query($link,$queryDE);
$obsDB=mysqli_query($link,$queryDB);
$obsDR=mysqli_query($link,$queryDR);

//•• Ajout de données à la table eleveurs_intermediaire ••\\
$queryEleveurs ="LOAD DATA LOCAL INFILE 'csv/tableauEleveurs.csv'
INTO TABLE eleveurs_intermediaire
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

$obsE=mysqli_query($link,$queryEleveurs);

//•• Ajout de données à la table bovins_intermediaire ••\\
$queryBovins ="LOAD DATA LOCAL INFILE 'csv/tableauAnimal.csv'
INTO TABLE bovins_intermediaire
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

$obsB=mysqli_query($link,$queryBovins);

//•• Ajout de données à la table races_intermediaire ••\\
$queryRaces ="LOAD DATA LOCAL INFILE 'csv/tableauRace.csv'
INTO TABLE races_intermediaire
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

$obsC=mysqli_query($link,$queryRaces);

		
//•• Ajout de données à la table coefficients_intermediaire ••\\
$queryCoeff ="LOAD DATA LOCAL INFILE 'csv/tableauCoeff.csv'
INTO TABLE coefficients_intermediaire
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

$obsD=mysqli_query($link,$queryCoeff);

	
include('requetes_transfert.php');

echo "Vos données ont bien été mises à jour";
?>
	
</body>

</html>


