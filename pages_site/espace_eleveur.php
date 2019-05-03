<!-- Page disponible aux éleveurs bovins identifiés, 
		elle permet l'accès à la plateforme paillette et à la page des états de sorties
		Si l'utilisateur n'est pas connecté, la page affiche le formulaire de connexion-->		
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">>
	<head>
	<link href="../mise_en_page/maFeuilleDeStyle.css" rel="stylesheet" media="all" type="text/css"> 
		<title>
		Site web Cranet
		</title>

	</head>
	
	<body>
	<div>
	<?php
		include(../mise_en_page/entete.php)	;
		if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
		{
			
			echo "<p><a href='etats_de_sorties.php'>Accès états de sorties</a> ?</p>"; //lien vers la page etats_de_sorties.php
			echo "<p><a href='plan_previsionnel_IA.php'>Plan prévisionnel d IA</a> ?</p>";//lien vers la plateforme paillette
			
		}
		else
		{
			include (authentification.php); //formulaire de connexion
		}
		?>
		<!-- DIV Pied de page -->	
		<?php include (../mise_en_page/pied.php)?>
	</body>
</html>
