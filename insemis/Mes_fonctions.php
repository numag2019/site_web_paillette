<?php
//Page des fonctions utiles pour INSEMIS
	
	//fonction pour transformer le tableau de resultat d'une requête à un élément en liste exploitable.
	function requete_2col_to_list ($result)
	{
		$nbligne=mysqli_num_rows($result);
		$tab=mysqli_fetch_all($result);
			$liste=[];
			for($i=0; $i<=$nbligne-1; $i++)
			{
				$liste[$i]=$tab[$i][0];
			}
		return $liste;
	}
?>

<?php
function tableau($result)
{
$tab = mysqli_fetch_all($result);
$nbligne = mysqli_num_rows($result);
$nbcolonne = mysqli_num_fields($result);	
echo '<table border = 1>';
	$j = 0;
	while ($j<$nbcolonne)
		{
			echo '<td>' .mysqli_fetch_field_direct($result,$j)->name. '</td>';
			$j++;
		}
	$i =0;
	while ($i<$nbligne)
	{
		echo '<tr>';
		$j=0;
		while ($j<$nbcolonne)
		{
			echo '<td>' .$tab[$i][$j]. '</td>';
			$j++;
		}
		$i++;
		echo '</tr>';
	}
echo '</table>';
}
?>