

<html>
		<!--Page accessible en cliquant sur le lien mot de passe oublié,
	l'utilisateur doit alors rentrer son adresse email, si celle ci correspond 
	à une présente dans la bdd, le mot de passe de l'utilisateur correspondant 
	est remplacé par un nouveau créer de façon aléatoire, 
	ce mot de passe est envoyé à l'utilisateur et est stocké de façon "hashé" dans la bdd-->		
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap.css">
		<?php $authentification=1;?>

		<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
		<?php $autorisation=TRUE // tout le monde?>
		
		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
		
		
	</head>
	
	<body>
<p>
    Réinitialisation du mot de passe 
	<br />
    Veuillez entrer votre adresse email :
</p>

<form action="mot_de_passe_oublie.php" method="post">
<p>
    <input type="text" name="email" />
    <input type="submit" value="Valider" />
</p>
</form>

<?php

if(isset($_POST['email']))
{
	// Déclaration de l'adresse de destination.
	// Protection faille CRLF 
	//Suppression des retours à la ligne lors du traitement
	$email=$_POST['email'];
	$email = str_replace(array("\n","\r",PHP_EOL),'',$_POST['email']); 
	//Vérification que la chaîne de caractères entrée est bien une adresse mail
if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		
	//==========Création du mot de passe
	function genererChaineAleatoire($longueur = 10)
		{return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*', rand( 1, $longueur) )),1,$longueur);}
	$mdp= genererChaineAleatoire();
	$mdp_hash=password_hash($mdp, PASSWORD_DEFAULT);//Hashage du mot de passe

	// Connexion à la BDD en PDO
	try { $bdd = new PDO('mysql:host=localhost;dbname=crabase','root',''); }
	
	catch (Exeption $e) { die('Erreur : ' . $e->getMessage())  or die(print_r($bdd->errorInfo())); }
	
	// Requête SQL sécurisée
	$req = $bdd->prepare("UPDATE utilisateurs
						SET mdp= :mdp
						WHERE email= :email ");
	$req->bindValue('mdp', $mdp_hash, PDO::PARAM_STR);
	$req->bindValue('email',$email, PDO::PARAM_STR);
	$req->execute();
	$rows = $req->rowCount();
	if ($rows>0) 
		{
			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
				{
				$passage_ligne = "\r\n";
				}
			else
				{
				$passage_ligne = "\n";
				}
			//=====Déclaration des messages au format texte et au format HTML.
			$message_txt = 'Veuillez trouvez ci dessous le mot de passe temporaire de votre comptre cranet: ( pensez a le changer rapidement)';

			//=====Définition du sujet.
			$sujet = "Reinitialisation de votre mot de passe Cranet";
			//=========
		 
			//=====Création du header de l'e-mail.
			$header = "From: \"\"<cra.conservatoire@gmail.com>".$passage_ligne;
			//=====Ajout du message au format txt
			$message= $passage_ligne.$message_txt.$passage_ligne.$mdp;
		///php.ini
		mail($email,$sujet,$message,$header);
		echo "<div class='alert alert-success'><h1>Votre nouveau mot de passe a bien été envoyé.</h1><p>Pensez à le modifier prochainement.</p>";
		}
	else 
		{
     	//=====Envoi de l'e-mail.
		echo "Veuillez entrer une adresse email valide";   
		}
	}
else{echo "Veuillez entrer une adresse email valide";  }
}

?>
	</body>
	<?php include ("../mise_en_page/pied.html");?>
</html>
