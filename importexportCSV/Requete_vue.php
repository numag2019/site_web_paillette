<html>
<body>
<?php
$link=mysqli_connect('localhost','root','','genis_test');
mysqli_set_charset($link,"utf8mb4");


$requete="create or replace view v_ani_mort as 
select * from animal a left join 
(SELECT id_animal as id_ani, id_periode, date_entree, date_sortie, id_elevage, id_type FROM `periode` WHERE id_type=1, 
Consentement FROM `contact`)
 vmort on a.id_animal=vmort.id_ani";

// Exécution requête	
$obs=mysqli_query($link,$requete);


?>


</body>
</html>