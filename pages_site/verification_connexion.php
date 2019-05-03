<?php 
if(empty($_SESSION['id']) or empty($_SESSION['pseudo'])) 
{
	$identifiant=htmlspecialchars($_POST['identifiant'])
	$mdp=htmlspecialchars($_POST['mdp'])
//  Récupération de l'utilisateur et de son pass hashé
	$req = $bdd->prepare('SELECT id_utilisateur, id_type, mdp FROM utilisateurs WHERE identifiant' = $identifiant);
	$req->execute();
	$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
	$isPasswordCorrect = password_verify(htmlspecialchars($_POST['pass']), $resultat['pass']);

	if (!$resultat)
	{
		echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
		if ($isPasswordCorrect) {
			session_start();
			$_SESSION['id'] = $resultat['id']; //creation de variables de sessions
			$_SESSION['id_type']=$id_type
			$_SESSION['identifiant'] = $identifiant);
			if ($_SESSION=3)
			{header ('location : espace_cra.php');}
			else 
			{
				if($_SESSION=2) {header ('location : espace_admi_race.php');}
					else {header ('location : espace_eleveur.php');};
		else 
		{
			echo 'Mauvais identifiant ou mot de passe !';
		}
	}
}
<?php 
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}
}
?>
