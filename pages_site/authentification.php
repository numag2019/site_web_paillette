<!-- Formulaire d'authentification-->
<p>
    Veuillez rentrer vos identifiants :
</p>

<form action="verification_connexion.php" method="post">
<p>
	Pseudo:
    <input type="text" name="identifiant" />
	<br />
	<br />
	Mot de passe:
	<input type="text" name="mdp" />
	<br />
	<br />
    <input type="submit" value="Valider" />
</p>
</form>
<br />
<!-- lien vers la page permettant de changer de mot de passe-->
<a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a></li>


<?php 
if (isset($_POST['Valider']) )
	{
	if(empty($_POST['identifiant']) or empty($_POST['mdp'])) 
		{
		echo "Veuillez remplir les deux champs.";
		}

	else
		{
		// On récupère les variables envoyées par le formulaire
		$login = $_POST['identifiant'];
		$password = $_POST['mdp'];

		// Connexion à la BDD en PDO
		try { $bdd = new PDO('mysql:host=localhost;dbname=bdd','root',''); }
		catch (Exeption $e) { die('Erreur : ' .$e->getMessage())  or die(print_r($bdd->errorInfo())); }

		// Requête SQL sécurisée
		$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE login= ? AND password= ?");
		$req->execute(array($login, $password));
		$resultat=$req->fetch();
		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($password, $resultat['password']);

		if (!$resultat)
			{	
			echo 'Mauvais identifiant ou mot de passe !';
			}
		else
			{
			if ($isPasswordCorrect) 
				{
				session_start();
				$_SESSION['id'] = $resultat['id']; //creation de variables de sessions
				$_SESSION['id_type']=$id_type;
				$_SESSION['identifiant'] = $identifiant;
				header ('location : mon_espace.php');
				exit;
				}
			else 
				{
				echo 'Mauvais identifiant ou mot de passe !';
				}
		
			}
		}
	}
?>
