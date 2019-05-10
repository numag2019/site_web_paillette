<?php
SESSION_START();
?>
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

//Compte des lignes des tableaux permanents avant insertion
include('compte_lignes.php');

$tabElAvantInsert=compteAjout('utilisateurs',$link);
$tabBoAvantInsert=compteAjout('bovins',$link);
$tabRaAvantInsert=compteAjout('races',$link);
$tabCoAvantInsert=compteAjout('coefficients',$link);







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
$queryEleveurs ="LOAD DATA LOCAL INFILE 'exports/tableauEleveurs.csv'
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
$queryBovins ="LOAD DATA LOCAL INFILE 'exports/tableauAnimal.csv'
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
$queryRaces ="LOAD DATA LOCAL INFILE 'exports/tableauRace.csv'
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
$queryCoeff ="LOAD DATA LOCAL INFILE 'exports/tableauCoeff.csv'
INTO TABLE coefficients_intermediaire
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

$obsD=mysqli_query($link,$queryCoeff);


// Insertion et mise à jour des données des tableaux intermédiaires dans les tables pemranentes
include('requetes_transfert.php');

//Compte des lignes des tableaux permanents après insertion
$tabUtAprèsInsert=compteAjout('utilisateurs',$link);
$tabBoAprèsInsert=compteAjout('bovins',$link);
$tabRaAprèsInsert=compteAjout('races',$link);
$tabCoAprèsInsert=compteAjout('coefficients',$link);

//Compte des lignes ajoutés
$nbUtInsert=$tabUtAprèsInsert[0][0]-$tabElAvantInsert[0][0];
$nbBoInsert=$tabBoAprèsInsert[0][0]-$tabBoAvantInsert[0][0];
$nbRaInsert=$tabRaAprèsInsert[0][0]-$tabRaAvantInsert[0][0];
$nbCoInsert=$tabCoAprèsInsert[0][0]-$tabCoAvantInsert[0][0];

echo $nbUtInsert;

//Renvoi un message d'alerte côté Genis avec le nombre de lignes ajoutés
echo "<script type='text/javascript'>";
echo 'alert("Vous avez inséré '.$nbUtInsert.' éleveur(s). \nVous avez inséré '.$nbBoInsert.' bovin(s). \nVous avez inséré '.$nbRaInsert.' race(s). \nVous avez inséré '.$nbCoInsert.' coefficient(s) de consanguinité");';
echo 'document.location.href="http://localhost/exportation/exportCRAnet.php";';
echo '</script>';


	


?>
	
</body>

</html>


