	<?php
	function genererChaineAleatoire($longueur = 10)
	{
	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*', rand( 1, $longueur) )),1,$longueur);
	}
	 
	echo( genererChaineAleatoire());
	?>