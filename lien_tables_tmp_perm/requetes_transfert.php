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

// $queryd="SELECT DATE_FORMAT(Observations.date,'%d/%m/%Y'),Observations.nombre,oiseaux.nom_commun,Communes.nom_commune,Departements.id_dpt FROM observations
		// JOIN oiseaux ON observations.id_oiseau=oiseaux.id_oiseau
		// JOIN Communes ON observations.id_commune=Communes.id_commune
		// JOIN Departements ON Communes.id_dpt=Departements.id_dpt and Departements.nom_dpt='".$dep."'
		// WHERE MONTH(Observations.date) BETWEEN '".$date1."' and '".$date2."' and Observations.nombre >".$nbremin."
		// GROUP BY Observations.date";

// UTILISATEURS
// Pb : utiliser id de genis sinon risque de deux noms pareils. id_eleveurs=id_genis ?
$requete="INSERT INTO utilisateurs(id_utilisateur,nom,prenom,email)
SELECT eleveurs_intermediaires.id_eleveur, eleveurs_intermediaires.nom,
eleveurs_intermediaires.prenom,eleveurs_intermediaires.email 
FROM eleveurs_intermediaires 
WHERE not exists (SELECT utilisateurs.id_utilisateur from utilisateurs 
WHERE utilisateurs.id_utilisateur=eleveurs_intermediaires.id_eleveur )";

// Exécution requête
$obs=mysqli_query($link,$requete);


//RACES
// Pb : seuil min seuil max ?
$requete="INSERT INTO races(id_race, nom_race)
SELECT races_intermediaires.id_race_int,races_intermediaires.nom_race
FROM races_intermediaires
WHERE not exists (SELECT races.id_race from races WHERE races.id_race=races_intermediaires.id_race_int )";

// Exécution requête
$obs=mysqli_query($link,$requete);

//BOVINS
// Pb : mort (date d'un cote et chiffre de l'autre)
$requete="INSERT INTO bovins(id_bovin, nom_bovin,sexe,mort,id_race,id_utilisateur)
SELECT bovins_intermediaires.id_bovin, bovins_intermediaires.nom_bovin, bovins_intermediaires.sexe,
bovins_intermediaires.date_mort, bovins_intermediaires.id_race, bovins_intermediaires.id_eleveur
FROM bovins_intermediaires
WHERE not exists (SELECT bovins.id_bovin from races WHERE bovins.id_bovin=bovins_intermediaires.id_bovin )";

// Exécution requête
$obs=mysqli_query($link,$requete);

//COEFFICIENTS
$requete="INSERT INTO coefficients(id_coeff, valeur_coeff,id_vache,id_taureau)
SELECT coefficients_intermediaires.id_coeff_int, coefficients_intermediaires.valeur_coeff, 
coefficients_intermediaires.id_vache, coefficients_intermediaires.id_taureau
FROM coefficients_intermediaires
WHERE not exists (SELECT coefficients.id_coeff from coefficients
 WHERE coefficients.id_coeff=coefficients_intermediaires.id_coeff_int )";
 
 // Exécution requête
$obs=mysqli_query($link,$requete);

//PERIODES
//Pb : à réfléchir. Date début date du jour ? reinitialisation quand une periode pour une race prend fin
// Probablement inutile de faire une requete. Remplissage avec interaction admin.)^$


?>

</body>

</html>

