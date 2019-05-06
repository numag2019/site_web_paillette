
﻿<html>
<body>
<?php

//*****************************************************************************************************************************************************************************************************************************************\\

// CETTE PAGE PERMET DE GÉNÉRER 4 FICHIERS .CSV À PARTIR DE LA BDD GENIS (ELEVEURS, ANIMAL, RACE, COEFFICIENTS).
//CEUX-CI VONT ALIMENTER LES 4 TABLES INTERMÉDIAIRES DE LA BDD DATACRANET (eleveurs_intermediaire, bovins_intermediaire, races_intermediaire, coefficients_intermediaire).  //

//******************************************************************************************************************************************************************************************************************************************\\

// Page necessaire
include('fonctioncreationcsv.php');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE ELEVEURS : 
//on sélectionne seulement les éleveurs dont l'elevage possède la/les race(s) Bearnaise, Bordelaise, Marine et dont le consentement est positif.
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

$requeteEleveurs="
SELECT id_contact,nom,prenom,mail FROM contact
JOIN link_race_elevage ON contact.id_elevage = link_race_elevage.id_elevage
WHERE link_race_elevage.code_race=19 OR link_race_elevage.code_race=6  OR link_race_elevage.code_race=5";

//Fonction creant le csv
$csv=creationcsv($requeteEleveurs,"tableau_eleveurs_csv");


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE ANIMAL : 
//on sélectionne seulement les animaux dont la race est Bearnaise, Bordelaise, Marine et dont l'éleveur consent à partager ses données.
//
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

 $requeteAnimal= "
select a.no_identification, a.nom_animal, a.sexe, if (p.id_type=1,true,false), a.code_race, c.id_contact
from periode p join elevage e on p.id_elevage=e.id_elevage join contact c on e.id_elevage=c.id_elevage join animal a on a.id_animal=p.id_animal 
join (select id_animal, max(id_periode) as idmax from periode p join elevage e on p.id_elevage=e.id_elevage join contact c on e.id_elevage=c.id_elevage group by id_animal order by id_animal) v on p.id_animal=v.id_animal and p.id_periode=v.idmax 
where a.code_race=19 OR a.code_race=5 OR a.code_race=6";

//Fonction creant le csv
$csv=creationcsv($requeteAnimal,"tableau_animal_csv");


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE RACES : 
//on sélectionne seulement les races Bearnaise, Bordelaise, Marine.
//
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

$requeteRace= "SELECT code_race, lib_race FROM race
WHERE code_race=19 OR code_race=5 OR code_race=6";

//Fonction creant le csv
$csv=creationcsv($requeteRace,"tableau_race_csv");


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE COEFFICIENTS : 
//on sélectionne seulement les races Bearnaise, Bordelaise, Marine.
//
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

$requeteCoeff= "SELECT id_coeff, valeur_coeff, id_vache, id_taureau  
FROM coefficient
JOIN animal ON coefficient.id_vache=animal.id_animal
WHERE animal.code_race=19 OR animal.code_race=5 OR animal.code_race=6";

//Fonction creant le csv
$csv=creationcsv($requeteCoeff,"tableau_coeff_csv");


?>


</body>

</html>