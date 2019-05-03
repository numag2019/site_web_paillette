<?php 
if(empty($_SESSION['id']) or empty($_SESSION['pseudo'])) 
{
	$identifiant=htmlspecialchars($_POST['identifiant'])
	$mdp=htmlspecialchars($_POST['mdp'])
//  Récupération de l'utilisateur et de son pass hashé
	$req = $bdd->prepare('SELECT id_utilisateur, mdp FROM utilisateurs WHERE identifiant' = $identifiant);
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
			$_SESSION['identifiant'] = $identifiant);
			echo 'Vous êtes connecté !';
		}
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