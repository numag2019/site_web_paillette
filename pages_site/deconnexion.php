<!--Page non visible par l'utilisateur, elle est executé si l'utilisateur clique sur déconnexion
	On efface les variables de  session puis on le redirige vers l'acceuil-->
	<?php 
		session_start();
		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();
		// Redirection vers l'acceuil 
		header ('Location: accueil_site.php')
	?>
