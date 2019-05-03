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

$nom_fichier="tableau_eleveurs_csv";
// Création du .csv 
$csvElev=creationcsv($lignes,$nom_fichier);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE ANIMAL : 
//on sélectionne seulement les animaux dont la race est Bearnaise, Bordelaise, Marine et dont l'éleveur consent à partager ses données.
//
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

 $requeteAnimal= "
select a.no_identification, a.nom_animal, a.sexe, a.code_race, c.id_contact, if (p.id_type=1,true,false)
from periode p join elevage e on p.id_elevage=e.id_elevage join contact c on e.id_elevage=c.id_elevage join animal a on a.id_animal=p.id_animal 
join (select id_animal, max(id_periode) as idmax from periode p join elevage e on p.id_elevage=e.id_elevage join contact c on e.id_elevage=c.id_elevage group by id_animal order by id_animal) v on p.id_animal=v.id_animal and p.id_periode=v.idmax 
where a.code_race=19 OR a.code_race=5 OR a.code_race=6
 	
";
//Récupération de la requete Animal
$obsAnimal=mysqli_query($link,$requeteAnimal);
// Transformation données en tableau 
$tabAnimal=mysqli_fetch_all($obsAnimal);

// Récupération lignes et colonnes du tableau
$nbligneAnimal=mysqli_num_rows($obsAnimal);
$nbcolAnimal=mysqli_num_fields($obsAnimal);

// Les lignes du tableau
$i=0;
	while ($i<$nbligneAnimal)
	{	
			$lignesAnimal[] = array('/'.$tabAnimal[$i][0], $tabAnimal[$i][1], $tabAnimal[$i][2], $tabAnimal[$i][3], $tabAnimal[$i][4], $tabAnimal[$i][5].'/');
			$i++;
		
	}
// Création du .csv 
$csvAnimal=creationcsv($lignesAnimal,"tableau_animal_csv"); 

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
$obsRace=mysqli_query($link,$requeteRace);

// Transformation données en tableau 
$tabRace=mysqli_fetch_all($obsRace);

// Récupération lignes et colonnes du tableau
$nbligneRace=mysqli_num_rows($obsRace);
$nbcolRace=mysqli_num_fields($obsRace);

// Les lignes du tableau
$i=0;
	while ($i<$nbligneRace)
	{	
		$lignesRace[] = array('/'.$tabRace[$i][0], $tabRace[$i][1].'/');
		$i++;
	}
// Création du .csv 
$csvRace=creationcsv($lignesRace,"tableau_race_csv");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REQUETE COEFFICIENTS : 
//on sélectionne seulement les races Bearnaise, Bordelaise, Marine.
//
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)

$requeteCoeff= "
SELECT id_coeff, valeur_coeff, id_vache, id_taureau  FROM coefficient
JOIN animal ON coefficient.id_vache=animal.id_animal
WHERE animal.code_race=19 OR animal.code_race=5 OR animal.code_race=6
";
// Récupération de la requete Coeff	
$obsCoeff=mysqli_query($link,$requeteCoeff);

// Transformation données en tableau 
$tabCoeff=mysqli_fetch_all($obsCoeff);

// Récupération lignes et colonnes du tableau
$nbligneCoeff=mysqli_num_rows($obsCoeff);
$nbcolCoeff=mysqli_num_fields($obsCoeff);

// Les lignes du tableau
$i=0;
	while ($i<$nbligneCoeff)
	{	
		$lignesCoeff[] = array('/'.$tabCoeff[$i][0], $tabCoeff[$i][1], $tabCoeff[$i][2], $tabCoeff[$i][3].'/');
		$i++;
	}
// Création du .csv 
$csvCoeff=creationcsv($lignesCoeff,"tableau_coeff_csv");
?>


</body>
</html>