<html>
<body>

<!--••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••

CETTE PAGE PERMET D'ALIMENTER LES 4 TABLES INTERMÉDIAIRES DE LA BDD DATACRANET (eleveurs_intermediaire, bovins_intermediaire, races_intermediaire, coefficients_intermediaire),
À PARTIR DES 4 FICHIERS .CSV CRÉES DANS LE FICHIER "creationcsv.php" (tableau_eleveurs_csv

••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••-->


<?php


//••• Connexion à la base de données DataCraNet •••\\
$link=mysqli_connect('localhost','root','','crabase');

//•• Ajout de données à la table eleveurs_intermediaire ••\\
$queryEleveurs ="LOAD DATA LOCAL INFILE 'csv/tableau_eleveurs_csv.csv'
INTO TABLE eleveurs_intermediaire
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

    if ($obs=mysqli_query($link,$queryEleveurs)) {
        echo "executed";


//•• Ajout de données à la table bovins_intermediaire ••\\
$queryBovins ="LOAD DATA LOCAL INFILE 'csv/tableau_animal_csv.csv'
INTO TABLE bovins_intermediaire
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

    if ($obs=mysqli_query($link,$queryBovins)) {
        echo "executed";
        
//•• Ajout de données à la table races_intermediaire ••\\
$queryRaces ="LOAD DATA LOCAL INFILE 'csv/tableau_race_csv.csv'
INTO TABLE races_intermediaire
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

    if ($obs=mysqli_query($link,$queryRaces)) {
        echo "executed";
        
//•• Ajout de données à la table coefficients_intermediaire ••\\
$queryCoeff ="LOAD DATA LOCAL INFILE 'csv/tableau_coeff_csv.csv'
INTO TABLE coefficients_intermediaire
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

    if ($obs=mysqli_query($link,$queryCoeff)) {
        echo "executed";
            
    
?>
	
</body>

</html>

