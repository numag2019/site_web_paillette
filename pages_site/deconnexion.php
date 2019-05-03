<html>
	<head>
		<!-- informations sur le type et la version du fichier HTML et informations diverses à destination notamment 				des robots-->
		<meta charset="UTF-8">
	</head>
	<body>
	<?php 
		session_start();
		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();
		// Suppression des cookies de connexion automatique
		setcookie('login', '');
		setcookie('pass_hache', '');
	?>
	</body>
</html>
	