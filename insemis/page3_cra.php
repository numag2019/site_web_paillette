<!doctype html>
<html lang='fr'>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- <link href="../mise_en_page/bootstrap-4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css">
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<!-- <link rel="stylesheet" href="../mise_en_page/bootstrap2.css"> -->
		<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
		<?php $autorisation=TRUE // tout le monde?>

		<!--  Navigation -->
		 <?php 
		 // include("../mise_en_page/navigation.html"); 
		 ?>

		<TITLE>fenetre pop up</TITLE>
		<script language="javascript" src="confirmation.js" type = "text/javascript"> 
		</script>
			
	</head>

	<body>
		<?php

		$link = mysqli_connect('localhost', 'root', '', 'crabase');
		mysqli_set_charset($link, "utf8mb4");


		$query_race = "SELECT id_race_int, nom_race FROM races_intermediaire";
		$result_race = mysqli_query($link, $query_race);
		$tab_race = mysqli_fetch_all($result_race);

		echo '<FORM method = "POST" name = "formulaire_page3">';
		echo '<div class="form-group row">';
		echo "<label class='col-2 col-form-label'> Choisissez la race : </label>";
		echo '<SELECT NAME = "liste_race" class="form-control col-2">';
		for($i=0; $i < count($tab_race); $i++)
			{
			$value = $tab_race[$i][0];
			echo "<OPTION VALUE ='".$value. "' ";
			if (isset($_POST['liste_race']))
				{
				// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
				if ($value==$_POST['liste_race']) 
				echo "selected";
				}
			echo ">".$tab_race[$i][1]."</OPTION> ";
			}
		echo '</SELECT NAME> <br/> <br/>';
		echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider" class="btn btn-primary" value = "Valider">';
		echo '</div>';
		echo '<br> <br>';

		if(isset($_POST['bouton_valider']))
			{
			$race = $_POST['liste_race'];
			if ($race == 6)
				$nom_race = 'marine';
			if ($race == 5)
				$nom_race = 'bordelaise';
			if ($race == 19)
				$nom_race = 'béarnaise';
			$query_periode = "SELECT periodes.id_periode, periodes.date_debut, periodes.date_fin FROM periodes WHERE periodes.id_race = ".$race.""; 
			$result_periode = mysqli_query($link, $query_periode);
			$tab_periode = mysqli_fetch_all($result_periode);

			echo '<div class="form-group row">';
			echo "<label class='col-2 col-form-label'> Choisissez la période : </label>";
			echo '<SELECT NAME = "liste_periode" class="form-control col-2">';
			for($i=0; $i < count($tab_periode); $i++)
				{
					$value = $tab_periode[$i][0];
					echo "<OPTION VALUE ='".$value. "'"; 
					if (isset($_POST['liste_periode']))
						{
						// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
						if ($value==$_POST['liste_periode']) 
						echo "selected";	
						}
					echo ">" .$tab_periode[$i][1]. '-' .$tab_periode[$i][2]. "</OPTION>";
				}
			echo '</SELECT NAME> <br/> <br/>';
			echo "<INPUT TYPE = 'hidden' name = 'id_race' value = '".$race."'>";
			echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider_periode" class="btn btn-primary" value = "Valider">';
			echo '</div>';
			echo '<br/> <br/>';
			}
			
			if(isset($_POST['bouton_valider_periode']))
				{
				$periode = $_POST['liste_periode'];
				$query_periode_af = 'SELECT periodes.date_debut, periodes.date_fin FROM periodes WHERE periodes.id_periode ='.$periode.' ';
				$result_periode_af = mysqli_query($link, $query_periode_af);
				$tab_periode_af = mysqli_fetch_all($result_periode_af);
				echo 'Tableau récapitulatif des prévisions de commande de paillettes pour la race '.$nom_race. ' du ' .$tab_periode_af[0][0]. ' au ' .$tab_periode_af[0][1];
				
				$race=$_POST["id_race"];
					
				// Les lignes suivantes servent à obtenir la liste des éleveurs/utilisateurs et la liste des id_utilisateur
				$query_liste_ut="SELECT DISTINCT utilisateurs.nom, utilisateurs.prenom, utilisateurs.id_utilisateur FROM utilisateurs 
										JOIN bovins ON bovins.id_utilisateur=utilisateurs.id_utilisateur
										JOIN previsions ON previsions.id_taureau=bovins.id_bovin
										WHERE bovins.id_race=".$race." AND previsions.nbr_paillettes IS NOT NULL";
				$result_liste_ut=mysqli_query($link, $query_liste_ut);
				$tab_liste_ut=mysqli_fetch_all($result_liste_ut);
				$nbligne = mysqli_num_rows($result_liste_ut);
					
				$liste_ut=[] ;
				for ($i=0;$i<$nbligne;$i++)
					{
						$liste_ut[$i]=$tab_liste_ut[$i][1] . " " . $tab_liste_ut[$i][0] ;
					}
				//var_dump($liste_ut);
					
				$liste_id_ut=[] ;
				for ($i=0;$i<$nbligne;$i++)
					{
					$liste_id_ut[$i]=$tab_liste_ut[$i][2] ;
					}
					//var_dump($liste_id_ut);
					

				// Les lignes suivantes servent à obtenir la liste des taureaux de la race séléctionné dans les pages précédentes puis la liste des id_bovins
				$query_liste_t="SELECT DISTINCT nom_bovin, id_bovin FROM bovins 
									JOIN previsions ON previsions.id_taureau=bovins.id_bovin
									WHERE (bovins.sexe=1 OR bovins.sexe=3) AND bovins.id_race=$race AND previsions.nbr_paillettes IS NOT NULL AND previsions.id_periode =$periode";
				$result_liste_t=mysqli_query($link, $query_liste_t);
				$tab_liste_t=mysqli_fetch_all($result_liste_t);
				$nbligne = mysqli_num_rows($result_liste_t);
					
				$liste_t=[] ;
				for ($i=0;$i<$nbligne;$i++)
					{
					$liste_t[$i]=$tab_liste_t[$i][0] ;
					}
					//var_dump($liste_t);
					
				$liste_id_t=[] ;
				for ($i=0;$i<$nbligne;$i++)
					{
					$liste_id_t[$i]=$tab_liste_t[$i][1] ;
					}
				//var_dump($liste_id_t);
					
					
				//affichage du tableau récapitulatif
				$nb_ut=count($liste_ut);
				$nb_t=count($liste_t);
				echo $nb_t;
					
				echo '<table border = 1>';
				echo "<td> </td>" ;
				$j = 0;
				while ($j<$nb_t)
					{
					echo '<td>' . $liste_t[$j]. '</td>'; // affiche les noms de taureau en haut dans la première ligne du tableau
					$j++;
					}
				echo '<td>Total</td>';			
				$i =0;
				$S_t=0;
				while ($i<$nb_ut)
					{
					echo '<tr>';
					echo "<td>" . $liste_ut[$i] . "</td>"; // afiche les noms d'éleveurs dans la première colonne du tableau
					$j=0;
					$S_ut=0;
					while ($j<$nb_t)
						{
						$query_paillettes="SELECT nbr_paillettes FROM previsions 
											JOIN bovins ON bovins.id_bovin=previsions.id_taureau
											WHERE previsions.id_taureau=".$liste_id_t[$j]." AND bovins.id_utilisateur=".$liste_id_ut[$i]."";
						$result_paillettes=mysqli_query($link, $query_paillettes);
						$tab_paillettes=mysqli_fetch_all($result_paillettes);
						//var_dump($tab_paillettes);
						/*$query_sum_paillettes="SELECT SUM(nbr_paillettes) FROM previsions 
											JOIN bovins ON bovins.id_bovin=previsions.id_taureau
											WHERE previsions.id_taureau=".$liste_id_t[$j]."";
						echo $query_sum_paillettes;
						$result_sum_paillettes=mysqli_query($link, $query_sum_paillettes);
						$tab_sum_paillettes=mysqli_fetch_all($result_sum_paillettes);
						var_dump($tab_sum_paillettes);*/
						if (empty($tab_paillettes))
							echo '<td> 0 </td>';
						else
							{
							echo '<td>' . $tab_paillettes[0][0]. '</td>';
							$S_ut=$S_ut+$tab_paillettes[0][0];
							}
								//echo '<td>'. $S_ut . '</td>';
								//$S_t=$S_t+$tab_paillettes[0][0];
								/*
								if($j!=0)
								{
									echo '</tr>';
									echo '<tr>';
									echo '<td>'.$S_t.'</td>';
									echo '</tr>';
								}
								*/
								//$S_t=$S_t+$tab_paillettes[0][0];
						$j++;
						}
					$i++;
					//echo '<td>Total</td>';
					echo '<td>'. $S_ut . '</td>';
					echo '</tr>';
					}
				echo '</table>';
				echo '<br> <br>';
				echo '</FORM>';
				echo '<FORM onclick="ConfirmMessage()">';
				echo '<INPUT TYPE = "button" name = "bouton_reini" onclick="ConfirmMessage()" value = "Réinitialiser le tableau"> <br/> <br/>';
				echo '</FORM>';
				
				}	
		
		
		
		
		
		
		?>
	</body>
</html>