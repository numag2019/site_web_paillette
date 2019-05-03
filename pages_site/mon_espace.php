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
	<!-- DIV Entête -->
	<?php include("../mise_en_page/entete.html");?>	

<!-- DIV Navigation (Menus) -->
	<?php include("../mise_en_page/navigation.html"); ?>
	
	<?php
//Vérification de connexion
		if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
		{
			// On affiche les liens disponible au type d'utilisateur connecté
			if ($_SESSION['id_type']=1)
			{ 
			//lien vers la page etats_de_sorties.php
			echo "<p><a href='etats_de_sorties.php'>Accès états de sorties</a> ?</p>";
			//lien vers la plateforme paillette entant qu'éleveurs
			echo "<p><a href='plan_previsionnel_IA.php'>Plan prévisionnel d IA</a> ?</p>";
			}
			elseif ($_SESSION['id_type']=2)
				{
				//lien vers la page etats_de_sorties.php en 
				echo "<p><a href='etats_de_sorties.php'>Accès états de sorties</a> ?</p>"; 
				//lien vers la page plateforme plan_previsionnel_IA.php en tant qu'éleveurs
				echo "<p><a href='plan_previsionnel_IA.php'>Plan prévisionnel d IA</a> ?</p>";
				//lien vers la plateforme paillette en tant qu'administrateur de race 
				echo "<p><a href='bilan_plan_previsionnel_IA.php'>Bilan plan prévisionnel d IA</a> ?</p>";
				}
			elseif ($_SESSION['id_type']=3)
				{
				//lien vers l'administration du site
				echo "<p><a href='administration.php'>Accès à l'administration du site</a> ?</p>"; 
				//lien vers la plateforme paillette en tant qu'administrateur de race 
				echo "<p><a href='bilan_previsionnel_IA.php'>Plan prévisionnel d IA</a> ?</p>";
				}
			else
			{
			include ("authentification.php"); //formulaire de connexion
			}
				
		}
		// S'il n'est pas connecté on affiche le formulaire de connexion
		else
		{
			include ("authentification.php"); //formulaire de connexion
		}
		?>
		<!-- DIV Pied de page -->	
		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>
