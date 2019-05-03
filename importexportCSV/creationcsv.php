<html>
<body>
<?php
$link=mysqli_connect('localhost','root','','genis_test');
mysqli_set_charset($link,"utf8mb4");
$requete="SELECT id_animal,nom_animal,sexe FROM animal";

// $queryd="SELECT DATE_FORMAT(Observations.date,'%d/%m/%Y'),Observations.nombre,oiseaux.nom_commun,Communes.nom_commune,Departements.id_dpt FROM observations
		// JOIN oiseaux ON observations.id_oiseau=oiseaux.id_oiseau
		// JOIN Communes ON observations.id_commune=Communes.id_commune
		// JOIN Departements ON Communes.id_dpt=Departements.id_dpt and Departements.nom_dpt='".$dep."'
		// WHERE MONTH(Observations.date) BETWEEN '".$date1."' and '".$date2."' and Observations.nombre >".$nbremin."
		// GROUP BY Observations.date";

//
// Requete Eleveurs  : on sélectionne seulement les éleveurs dont l'elevage possède la/les race(s) Bearnaise, Bordelaise, Marine.
//(Bearnaise : 19, Bordelaise : 6, Marine : 6)
//
// $requete="
// SELECT id_contact,nom,prenom FROM contact
// JOIN link_race_elevage ON contact.id_elevage = link_race_elevage.id_elevage

// WHERE link_race_elevage.code_race=19 OR link_race_elevage.code_race=6  OR link_race_elevage.code_race=5

// ";

$requete="create or replace view v_ani_mort as select * from animal a left join (SELECT id_animal as id_ani, id_periode, date_entree, date_sortie, id_elevage, id_type FROM `periode` WHERE id_type=1) vmort on a.id_animal=vmort.id_ani";

// Tableau Eleveurs		
$obs=mysqli_query($link,$requete);

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


include('fonctioncreationcsv.php');
$csv=creationcsv($lignes);
?>


</body>
</html>