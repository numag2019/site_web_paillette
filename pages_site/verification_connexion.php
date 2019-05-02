<?php 
if(empty($_SESSION['id']) or empty($_SESSION['pseudo'])) 
{
//  Récupération de l'utilisateur et de son pass hashé
	$req = $bdd->prepare('SELECT id_utilisateur, mdp FROM utilisateurs WHERE identifiant' = 'pseudo');
	$req->execute(array(
    'pseudo' => $pseudo));
	$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
	$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

	if (!$resultat)
	{
		echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
		if ($isPasswordCorrect) {
			session_start();
			$_SESSION['id'] = $resultat['id']; //creation de variables de sessions
			$_SESSION['pseudo'] = $pseudo;
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
