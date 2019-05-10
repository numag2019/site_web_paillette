<?php
		
		$bdd = new PDO('mysql:host=localhost;dbname=crabase','root','')
	
		// Requête SQL sécurisée
		$req = $bdd->prepare("UPDATE previsions
							SET nbr_paillettes = :nbr_paillettes
							WHERE id_vache= :id_vache
							AND 
");
		$req->bindValue('mdp', $mdp_hash, PDO::PARAM_STR);
		$req->bindValue('id_utilisateur', $_SESSION['id_utilisateur'], PDO::PARAM_STR);
		$req->execute();
		echo "<script type='text/javascript'>document.location.replace('deconnexion.php');</script>";
?>