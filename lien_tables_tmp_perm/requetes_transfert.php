<html>
<body>
<!--••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••

CETTE PAGE PERMET D'INSERER DE NOUVELLES DONNEES OU DE METTRE A JOUR DES DONNEES DE
 4 TABLES PERMANENTES (utilisateurs, bovins, races, coefficients)
A PARTIR DES 4 TABLES INTERMÉDIAIRES DE LA BDD DATACRANET (eleveurs_intermediaire, bovins_intermediaire,
 races_intermediaire, coefficients_intermediaire)

••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••-->

<?php

//Lien à la base de donnée
$link=mysqli_connect('localhost','root','','crabase');
mysqli_set_charset($link,"utf8mb4");



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// UTILISATEURS

//INSERTION
$requeteUtI="INSERT INTO utilisateurs(id_utilisateur,nom,prenom,email)
SELECT eleveurs_intermediaire.id_eleveur, eleveurs_intermediaire.nom,
eleveurs_intermediaire.prenom,eleveurs_intermediaire.email 
FROM eleveurs_intermediaire 
WHERE not exists (SELECT utilisateurs.id_utilisateur from utilisateurs 
WHERE utilisateurs.id_utilisateur=eleveurs_intermediaire.id_eleveur )";

// Exécution requête
$obsUtI=mysqli_query($link,$requeteUtI);

// MISE A JOUR
$requeteUtU="UPDATE utilisateurs 
	INNER JOIN eleveurs_intermediaire
	ON utilisateurs.id_utilisateur=eleveurs_intermediaire.id_eleveur
	SET utilisateurs.nom=eleveurs_intermediaire.nom,
	utilisateurs.prenom=eleveurs_intermediaire.prenom,
	utilisateurs.email=eleveurs_intermediaire.email";

// Exécution requête
$obsUtU=mysqli_query($link,$requeteUtU);




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//RACES

//INSERTION
$requeteRaI="INSERT INTO races(id_race, nom_race)
SELECT races_intermediaire.id_race_int,races_intermediaire.nom_race
FROM races_intermediaire
WHERE not exists (SELECT races.id_race from races WHERE races.id_race=races_intermediaire.id_race_int )";

// Exécution requête
 $obsRaI=mysqli_query($link,$requeteRaI);

// MISE A JOUR
$requeteRaU="UPDATE races 
INNER JOIN races_intermediaire 
ON races.id_race=races_intermediaire.id_race_int 
SET races.nom_race=races_intermediaire.nom_race";

// Exécution requête
 $obsRaU=mysqli_query($link,$requeteRaU);




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//BOVINS

//INSERTION
$requeteBoI="INSERT INTO bovins(id_bovin, nom_bovin,sexe,mort,id_race,id_utilisateur) 
SELECT bovins_intermediaire.id_bovin, bovins_intermediaire.nom_bovin, 
bovins_intermediaire.sexe, bovins_intermediaire.mort, bovins_intermediaire.id_race,
 bovins_intermediaire.id_eleveur FROM bovins_intermediaire
 WHERE not exists (SELECT bovins.id_bovin from bovins WHERE bovins.id_bovin=bovins_intermediaire.id_bovin )";

// Exécution requête

$obsBoI=mysqli_query($link,$requeteBoI);
 
 // MISE A JOUR
$requeteBoU="UPDATE bovins
INNER JOIN bovins_intermediaire
ON bovins.id_bovin=bovins_intermediaire.id_bovin
SET bovins.nom_bovin=bovins_intermediaire.nom_bovin,
bovins.sexe=bovins_intermediaire.sexe,
bovins.id_race=bovins_intermediaire.id_race";

// Exécution requête
$obsBoU=mysqli_query($link,$requeteBoU);



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//COEFFICIENTS

//INSERTION
$requeteCoI="INSERT INTO coefficients(id_coeff, valeur_coeff,id_vache,id_taureau)
SELECT coefficients_intermediaire.id_coeff_int, coefficients_intermediaire.valeur_coeff, 
coefficients_intermediaire.id_vache, coefficients_intermediaire.id_taureau
FROM coefficients_intermediaire
WHERE not exists (SELECT coefficients.id_coeff 
FROM coefficients
WHERE coefficients.id_coeff=coefficients_intermediaire.id_coeff_int )";
 
// Exécution requête
$obsCoI=mysqli_query($link,$requeteCoI);
 
// MISE A JOUR
 $requeteCoU="UPDATE coefficients
 INNER JOIN coefficients_intermediaire
 ON coefficients.id_coeff=coefficients_intermediaire.id_coeff_int
SET coefficients.valeur_coeff=coefficients_intermediaire.valeur_coeff,
coefficients.id_vache=coefficients_intermediaire.id_vache,
coefficients.id_taureau=coefficients_intermediaire.id_taureau";

// Exécution requête
$obsCoU=mysqli_query($link,$requeteCoU);



?>
	
</body>

</html>

