<!-- Formulaire d'authentification-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">>
	<head>
	<link href="../mise_en_page/maFeuilleDeStyle.css" rel="stylesheet" media="all" type="text/css"> 
		<title>
		Site web Cranet
		</title>

	</head>
	
	<body>
	<div>
	<!-- DIV Entête -->
	<?php include("../mise_en_page/entete.html");?>	

<!-- DIV Navigation (Menus) -->
	<?php include("../mise_en_page/navigation.html"); ?>
	
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
<?php if (isset($Post['error']))
	{echo $Post['error']}
<!-- lien vers la page permettant de changer de mot de passe-->
<a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a></li>




if (isset($_POST['Valider']) )
	{
	if(empty($_POST['identifiant']) or empty($_POST['mdp'])) 
		{
		$_POST['error']='Veuillez remplir les deux champs.';
		echo "<script type='text/javascript'>document.location.replace('authentification.php');</script>";
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
		

		if (!$resultat)
			{	
			$_POST['error']='Mauvais identifiant ou mot de passe !';
			echo "<script type='text/javascript'>document.location.replace('authentification.php');</script>";
			
			}
		else
		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($password, $resultat['password']);
			{
			if ($isPasswordCorrect) 
				{
				session_start();
				$_SESSION['id'] = $resultat['id']; //creation de variables de sessions
				$_SESSION['id_type']=$id_type;
				$_SESSION['identifiant'] = $identifiant;
				echo "<script type='text/javascript'>document.location.replace('mon_espace.php');</script>";
				exit;
				}
			else 
				{
				echo "<script type='text/javascript'>document.location.replace('authentification.php');</script>";
				}
		
			}
		}
	}
?>
		<!-- DIV Pied de page -->	
		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>