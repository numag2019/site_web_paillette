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