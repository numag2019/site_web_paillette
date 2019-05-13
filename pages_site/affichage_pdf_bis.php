<!--Page permettant l'afichage des pdf selon les utilisateurs-->

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">
	
	<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
	<?php $autorisation=TRUE // tout le monde?>
		<!--  Navigation -->
	<?php include("../mise_en_page/navigation.html"); ?>

	</head>
	<body>

		<div class="container">	
			<div class="row">
				<div id="block2" class="col-md-3 offset-md-4" align='center' style="background: white ;border-radius: 30px;">
					<h5 style="color: black">PDF à disposition</h5>
					<BR>
					<?php
					// On prend tous les noms et les chemins des fichiers présents dans le dossier pdf
					$nb_fichier = 0;   //variable nombre de fichier
					$chemin=array();
					$nomfichier=array();
					if($dossier = opendir('./../importexportCSV/exports/pdf'))
					{
						
						while(false !== ($fichier = readdir($dossier)))
						{
							if($fichier != '.' && $fichier != '..')
							{
								$nomfichier[]=$fichier;
								$chemin[]="./../importexportCSV/exports/pdf/".$fichier;
								$nb_fichier++; // On incrémente le compteur de 1
								

							} // On ferme le if (qui permet de ne pas afficher index.php, etc.)
						
						} // On termine la boucle

					 
						closedir($dossier);

						 // si l'utilisateur est un éleveur ou un animateur de race
							if ($_SESSION['id_type']!=3 )
							{
								$link=mysqli_connect('localhost','root','','crabase');
								mysqli_set_charset($link,"utf8mb4");
								
								// Requête SQL 
								$requeteElev="SELECT r.nom_race, u.nom FROM races r 
								JOIN bovins b ON r.id_race = b.id_race 
								JOIN utilisateurs u ON b.id_utilisateur = u.id_utilisateur 
								WHERE u.id_utilisateur=".$_SESSION['id_utilisateur']." GROUP BY r.id_race";

								// Récupération de la requete Eleveurs		
								$obs=mysqli_query($link,$requeteElev);

								// Transformation données en tableau 
								$tab=mysqli_fetch_all($obs);

								// Récupération lignes et colonnes du tableau
								$nbligne=mysqli_num_rows($obs);
								$nbcol=mysqli_num_fields($obs);
								
								
								
								// mise à disposition des pdf de la race élevée par l'éleveur
								echo "<BR>";
								echo '<h6 style="color: black">Les pdf de la race</h6>';
								
								$i=0;
								while($i<$nb_fichier)
								{
									$j=0;
									while ($j<$nbligne)
									{
										// Si le nom de la race est présent dans le nom du pdf, on l'affiche
										if (stripos($chemin[$i],$tab[$j][0]))
										{
											echo '<a href='.$chemin[$i].'>'.$nomfichier[$i].'</a>';
											echo "<BR>";	
										}
										$j++;
									}
									$i++;
								}
								
								
								
								// mise à disposition des pdf de l'éleveur
								echo "<BR>";
								echo '<h6 style="color: black">Les pdf de l\'éleveur</h6>';
								
								$i=0;
								while($i<$nb_fichier)
								{
								
									// Si le nom de la race est présent dans le nom du pdf, on l'affiche
									if (stripos($chemin[$i],$tab[0][1]))
									{
										echo '<a href='.$chemin[$i].'>'.$nomfichier[$i].'</a>';
										echo "<BR>";	
									}
									$i++;
								}
								
								// mise à disposition du pdf global
								echo "<BR>";
								echo '<h6 style="color: black">pdf global</h6>';
								
								echo '<a href="../importexportCSV/exports/pdf/fiche_race_globale.pdf">fiche_race_globale.pdf</a>';
								echo "<BR>";
							}
							
							
							
							
							//ADMINISTRATEUR
							// Si c'est l'administrateur, tous les documents sont affichés
							
							else
							{
								$pdf=array('race','eleveur','elevage','globale');
								$j=0;
								
								while ($j<count($pdf))
								{
									echo "<BR>";
									echo '<h6 style="color: black">pdf '.$pdf[$j].'</h6>';
									
									$k=0;
									while ($k<$nb_fichier)
									{
										if (stripos($chemin[$k],$pdf[$j]))
										{
											echo '<a href='.$chemin[$k].'>'.$nomfichier[$k].'</a>';
											echo "<BR>";
										}
										$k++;
									}
									$j++;
								}
							}

					}
					else
						 echo 'Le dossier n\' a pas pu être ouvert';

					?>
					
				</div>
			</div>
		</div>
	</body>
	

 <!-- DIV Pied de page -->
<?php include ("../mise_en_page/pied.html");?>
</html>