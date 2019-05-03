<html>
<body>
<?php

//*****************************************************************************************************************************************************************************************************************************************\\

// CETTE PAGE PERMET DE GÉNÉRER 4 FICHIERS .CSV À PARTIR DE LA BDD GENIS (ELEVEURS, ANIMAL, RACE, COEFFICIENTS).
//CEUX-CI VONT ALIMENTER LES 4 TABLES INTERMÉDIAIRES DE LA BDD DATACRANET (eleveurs_intermediaire, bovins_intermediaire, races_intermediaire, coefficients_intermediaire).  //

//******************************************************************************************************************************************************************************************************************************************\\



//Importation des fonctions utiles
include('fonctioncreationcsv.php');

//Connexion à la base de données\\

$link=mysqli_connect('localhost','root','','genis_test');
mysqli_set_charset($link,"utf8mb4");




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE ELEVEURS : 
//on sélectionne seulement les éleveurs dont l'elevage possède la/les race(s) Bearnaise, Bordelaise, Marine et dont le consentement est positif.
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

$requeteElev="
SELECT id_contact,nom,prenom FROM contact
JOIN link_race_elevage ON contact.id_elevage = link_race_elevage.id_elevage

WHERE link_race_elevage.code_race=19 OR link_race_elevage.code_race=6  OR link_race_elevage.code_race=5

";


// Récupération de la requete Eleveurs		
$obs=mysqli_query($link,$requeteElev);

// Transformation données en tableau 
$tab=mysqli_fetch_all($obs);

// Récupération lignes et colonnes du tableau
$nbligne=mysqli_num_rows($obs);
$nbcol=mysqli_num_fields($obs);

// Les lignes du tableau
$i=0;
	while ($i<$nbligne)
	{	
		$lignes[] = array('/'.$tab[$i][0], $tab[$i][1], $tab[$i][2].'/');
		$i++;
	}
// Création du .csv 
$csvElev=creationcsv($lignes,"tableau_eleveurs_csv");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE ANIMAL : 
//on sélectionne seulement les animaux dont la race est Bearnaise, Bordelaise, Marine et dont l'éleveur consent à partager ses données.
//
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

$requeteAnimal= "
SELECT animal.no_identification, animal.nom_animal, animal.sexe, animal.code_race, contact.id_contact, periode.id_type FROM animal
JOIN periode ON animal.id_animal=periode.id_animals
JOIN contact ON periode.id_elevage=contact.id_elevage
WHERE animal.code_race=19 OR animal.code_race=5 OR animal.code_race=6 AND contact.consentement=Oui 

";

// Récupération de la requete Animal	
$obs=mysqli_query($link,$requeteAnimal);

// Transformation données en tableau 
$tab=mysqli_fetch_all($obs);

// Récupération lignes et colonnes du tableau
$nbligne=mysqli_num_rows($obs);
$nbcol=mysqli_num_fields($obs);

// Les lignes du tableau
$i=0;
	while ($i<$nbligne)
	{	
		$lignes[] = array('/'.$tab[$i][0], $tab[$i][1], $tab[$i][2], $tab[$i][3], $tab[$i][4], $tab[$i][5].'/');
		$i++;
	}
// Création du .csv 
$csvAnimal=creationcsv($lignes,"tableau_animal_csv");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE RACES : 
//on sélectionne seulement les races Bearnaise, Bordelaise, Marine.
//
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

$requeteRace= "
SELECT code_race, lib_race FROM race
WHERE code_race=19 OR code_race=5 OR code_race=6
";
// Récupération de la requete Race	
$obs=mysqli_query($link,$requeteRace);

// Transformation données en tableau 
$tab=mysqli_fetch_all($obs);

// Récupération lignes et colonnes du tableau
$nbligne=mysqli_num_rows($obs);
$nbcol=mysqli_num_fields($obs);

// Les lignes du tableau
$i=0;
	while ($i<$nbligne)
	{	
		$lignes[] = array('/'.$tab[$i][0], $tab[$i][1].'/');
		$i++;
	}
// Création du .csv 
$csvRace=creationcsv($lignes,"tableau_race_csv");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE COEFFICIENTS : 
//on sélectionne seulement les races Bearnaise, Bordelaise, Marine.
//
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

$requeteCoeff= "
SELECT id_coeff, valeur_coeff, id_vache, id_taureau  FROM coefficients
JOIN animal ON id_vache
WHERE animalcode_race=19 OR code_race=5 OR code_race=6
";
// Récupération de la requete Coeff	
$obs=mysqli_query($link,$requeteCoeff);

// Transformation données en tableau 
$tab=mysqli_fetch_all($obs);

// Récupération lignes et colonnes du tableau
$nbligne=mysqli_num_rows($obs);
$nbcol=mysqli_num_fields($obs);

// Les lignes du tableau
$i=0;
	while ($i<$nbligne)
	{	
		$lignes[] = array('/'.$tab[$i][0], $tab[$i][1], $tab[$i][2], $tab[$i][3].'/');
		$i++;
	}
// Création du .csv 
$csvCoeff=creationcsv($lignes,"tableau_coeff_csv");
?>



</body>
</html>
</body>
>>>>>>> db1697991c2eafae97a0a09179d397998e000023
</html>