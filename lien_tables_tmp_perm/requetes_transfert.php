<html>
<body>
<!--pour le type d'utilisateur : le cra doit pouvoir modifier les droits sur
le site, donc, par défaut, les utilisateurs présents auront le statut d'éleveurs (id=1)
sauf pour le CRA (id=3). Pb : si le CRA fait une erreur et vire les administrateurs, 
personne ne pourra donner des droits
De meme pour initialiser mdp et identifiant (que faire par défaut ? question de sécurité)-->

<!--Penser aux modif de donnees des lignes existantes
UPDATE table
SET colonne_1 = 'valeur 1', colonne_2 = 'valeur 2', colonne_3 = 'valeur 3'
WHERE condition-->

<!--Ordre de remplissage (tables n'ayant pas de clés étrangères en premières etc)-->
<!-- type utilisateur (fait)-->
<!--utilisateurs-->
<!--races-->
<!--bovins-->
<!--coefficients-->
<!--periodes-->

<!--previsions se remplira par formulaire-->

<?php


$link=mysqli_connect('localhost','root','','crabase');
mysqli_set_charset($link,"utf8mb4");


// UTILISATEURS
// Pb : utiliser id de genis sinon risque de deux noms pareils. id_eleveurs=id_genis ?
$requeteUtI="INSERT INTO utilisateurs(id_utilisateur,nom,prenom,email)
SELECT eleveurs_intermediaire.id_eleveur, eleveurs_intermediaire.nom,
eleveurs_intermediaire.prenom,eleveurs_intermediaire.email 
FROM eleveurs_intermediaire 
WHERE not exists (SELECT utilisateurs.id_utilisateur from utilisateurs 
WHERE utilisateurs.id_utilisateur=eleveurs_intermediaire.id_eleveur )";

// Exécution requête
$obsUtI=mysqli_query($link,$requeteUtI);

$requeteUtU="UPDATE utilisateurs 
SET 
utilisateurs.nom=eleveurs_intermediaire.nom,
utilisateurs.prenom=eleveurs_intermediaire.prenom,
utilisateurs.email=eleveurs_intermediaire.email
WHERE utilisateurs.id_utilisateur=eleveurs_intermediaire.id_eleveur";

// Exécution requête
$obsUtU=mysqli_query($link,$requeteUtU);

//RACES
// Pb : seuil min seuil max ?
$requeteRaI="INSERT INTO races(id_race, nom_race)
SELECT races_intermediaire.id_race_int,races_intermediaire.nom_race
FROM races_intermediaire
WHERE not exists (SELECT races.id_race from races WHERE races.id_race=races_intermediaire.id_race_int )";

// Exécution requête
 $obsRaI=mysqli_query($link,$requeteRaI);

$requeteRaU="UPDATE races
SET 
races.nom_race=races_intermediaire.nom_race
WHERE races.id_race=races_intermediaire.id_race_int";

// Exécution requête
 $obsRaU=mysqli_query($link,$requeteRaU);

//BOVINS
// Pb : mort (date d'un cote et chiffre de l'autre)
$requeteBoI="INSERT INTO bovins(id_bovin, nom_bovin,sexe,mort,id_race,id_utilisateur)
SELECT bovins_intermediaire.id_bovin, bovins_intermediaire.nom_bovin, bovins_intermediaire.sexe,
bovins_intermediaire.date_mort, bovins_intermediaire.id_race, bovins_intermediaire.id_eleveur
FROM bovins_intermediaire
WHERE not exists (SELECT bovins.id_bovin from races WHERE bovins.id_bovin=bovins_intermediaire.id_bovin )";

// Exécution requête
$obsBoI=mysqli_query($link,$requeteBoI);

$requeteBoU="UPDATE bovins
SET 
bovins.nom_bovin=bovins_intermediaire.nom_bovin
bovins.sexe=bovins_intermediaire.sexe
bovins.id_race=bovins_intermediaire.id_race
bovins.id_utilisateur=bovins_intermediaire.id_eleveur
WHERE bovins.id_bovin=bovins_intermediaire.id_bovin";

// Exécution requête
$obsBoU=mysqli_query($link,$requeteBoU);

//COEFFICIENTS
$requeteCoI="INSERT INTO coefficients(id_coeff, valeur_coeff,id_vache,id_taureau)
SELECT coefficients_intermediaire.id_coeff_int, coefficients_intermediaire.valeur_coeff, 
coefficients_intermediaire.id_vache, coefficients_intermediaire.id_taureau
FROM coefficients_intermediaire
WHERE not exists (SELECT coefficients.id_coeff from coefficients
WHERE coefficients.id_coeff=coefficients_intermediaire.id_coeff_int )";
 
// Exécution requête
$obsCoI=mysqli_query($link,$requeteCoI);
 
 $requeteCoU="UPDATE coefficients
SET 
coefficients.valeur_coeff=coefficients_intermediaire.valeur_coeff
coefficients.id_vache=coefficients_intermediaire.id_vache
coefficients.id_taureau=coefficients_intermediaire.id_taureau
WHERE coefficients.id_coeff=coefficients_intermediaire.id_coeff_int";

// Exécution requête
$obsCoU=mysqli_query($link,$requeteCoU);

//PERIODES
//Pb : à réfléchir. Date début date du jour ? reinitialisation quand une periode pour une race prend fin
// Probablement inutile de faire une requete. Remplissage avec interaction admin.)^$


?>
	
</body>

</html>

