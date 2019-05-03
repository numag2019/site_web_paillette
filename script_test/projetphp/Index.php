<!--L'index est la page d'accueil contenant une brève description du site, avec une brève description du comportement
du corbeau et du renard-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

	<!-- Index.php -->
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<link href="mise_en_page/maFeuilleDeStyle.css" rel="stylesheet" media="all" type="text/css"> 
	<title>
		Oiseaux - Projet Techno. Web
	</title>
	<!-- Déclaration de la feuille de style -->

</head>

<body>
<!-- On définit ici une section 'global' -->
<div>
	
	<!-- DIV Entête -->
	<?php include("mise_en_page/DIVEntete.html"); ?>
	<!-- DIV Navigation (Menus) -->
	<?php include("mise_en_page/DIVNavigation.html"); ?>

	<!-- Section Contenu : on définit ici le contenu central de la page -->
	<div>
		<h2>Bienvenue sur <I>Oiseau</I> !</h2>
		<p>
		Ce portail permet de recenser les oiseaux observés dans la région Aquitaine
		</p>	
		<p>
		Vous trouverez sur ce site des informations et des statistiques sur les oiseaux observés. 
		</p>
	Maître Corbeau, sur un arbre perché,<br>
	Tenait en son bec un fromage.<br>
	Maître Renard, par l'odeur alléché,<br>
	Lui tint à peu près ce langage :<br>
	"Hé ! bonjour, Monsieur du Corbeau.<br>
	Que vous êtes joli ! que vous me semblez beau !<br>
	Sans mentir, si votre ramage<br>
	Se rapporte à votre plumage,<br>
	Vous êtes le Phénix des hôtes de ces bois. "<br>
	A ces mots le Corbeau ne se sent pas de joie ;<br>
	Et pour montrer sa belle voix,<br>
	Il ouvre un large bec, laisse tomber sa proie.<br>
	Le Renard s'en saisit, et dit : "Mon bon Monsieur,<br>
	Apprenez que tout flatteur<br>
	Vit aux dépens de celui qui l'écoute :<br>
	Cette leçon vaut bien un fromage, sans doute. "<br>
	Le Corbeau, honteux et confus,<br>
	Jura, mais un peu tard, qu'on ne l'y prendrait plus.<br>		
	</div><!-- #contenu -->

	<!-- DIV Pied de page -->		
	<?php include("mise_en_page/DIVPied.html"); ?>	


</div><!-- #global -->

</body>
</html>
