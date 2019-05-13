<!--Fonction qui compte le nombre de lignes d'une table de la base de donnée-->
<?php
function compteAjout($table,$link)
{
	$requete="SELECT count(*) FROM ".$table."";
	$obs=mysqli_query($link,$requete);
	$tab=mysqli_fetch_all($obs);
	return $tab;
}


?>