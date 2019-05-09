<!-- Page disponible aux éleveurs bovins identifiés, 
		elle permet l'accès à la plateforme paillette et à la page des états de sorties
		Si l'utilisateur n'est pas connecté, la page affiche le formulaire de connexion-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		
		<!-- Entête -->
		<?php include("../mise_en_page/entete.html");?>	

		<!--  Navigation -->
		<?php include("../mise_en_page/navigation.html"); ?>
	</head>
	
	<body>

		<?php
		if (isset($_SESSION['id_utilisateur']))
		{
			// On affiche les liens disponible au type d'utilisateur connecté
			if ($_SESSION['id_type']==1)//eleveur
			{ 
				?>
				<!--lien vers la page etats_de_sorties.php-->
				<p><a href='etats_de_sorties.php'>Accès états de sorties</a></p>
				<!--lien vers la plateforme paillette entant qu'éleveurs-->
				<p><a href='plan_previsionnel_IA.php'>Plan prévisionnel d IA</a></p>
				<!--lien vers la plateforme de récupération de mot de passe-->
				<p><a href='changement_mdp.php'>Changer mon mot de passe</a></p>
				<?php
				}
			elseif ($_SESSION['id_type']==2)//administrateur de race
				{
				?>	
				<!--lien vers la page etats_de_sorties.php en--> 
				<p><a href='etats_de_sorties.php'>Accès états de sorties</a></p>
				<!--lien vers la page plateforme plan_previsionnel_IA.php en tant qu'éleveurs-->
				<p><a href='plan_previsionnel_IA.php'>Plan prévisionnel d IA</a></p>
				<!--lien vers la plateforme paillette en tant qu'administrateur de race--> 
				<p><a href='bilan_plan_previsionnel_IA.php'>Bilan plan prévisionnel d IA</a></p>
				<?php
				}
			elseif ($_SESSION['id_type']==3)
				{
				?>
				<!--lien vers l'administration du site-->
				<p><a href='administration.php'>Accès à l'administration du site</a></p> 
				<!--lien vers la plateforme paillette en tant qu'administrateur de race -->
				<p><a href='bilan_previsionnel_IA.php'>Plan prévisionnel d IA</a></p>
				<?php
				}

		else 
<<<<<<< HEAD
		{
			echo "<script type='text/javascript'>document.location.replace('authentification.php');</script>";
			//page pour administrer les types d'utilisateurs
			echo "<p><a href='type_utilisateur.php'>Administer les administrateurs de Races d IA</a></p>";
		}
=======
			{
				echo "<script type='text/javascript'>document.location.replace('authentification.php');</script>";}
			}
>>>>>>> fcd2845eaceb4e39956b25641b86ed1c8d3c81e1
	

				
		?>
		<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>
