<!doctype html>
<html lang='fr'>
<script src="https://code.jquery.com/jquery-3.3.1.min.js">
</script>

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">
		<link rel="stylesheet" href="../mise_en_page/pied.css">
		
		<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
		<?php $autorisation=3 // que le CRA?> 
		
		
		<script  type="text/javascript" >
		function gomenu(){
			location.href="page3_cra.php";
		}	
		function ConfirmMessage(periode,race) {
			if (confirm("Etes vous sûr de voulir réinitialiser le tableau ?")) { 
			   // Clic sur OK
			   $.ajax({
				    type: 'get', 
					url: 'changer_periode.php', 
					data: {
						periode: periode,
						race: race
					}
					//document.getElementById("test").innerHTML=response;
			   });
			}
		alert('La nouvelle période a été créée');
		gomenu();
		}
</script>
			
	</head>

	<body>
		<?php include("../mise_en_page/navigation.html"); ?>
		
		<?php
		
		//Connexion à la base de données
		$link = mysqli_connect('localhost', 'root', '', 'crabase');
		mysqli_set_charset($link, "utf8mb4");


		$query_race = "SELECT id_race_int, nom_race FROM races_intermediaire";
		$result_race = mysqli_query($link, $query_race);
		$tab_race = mysqli_fetch_all($result_race);
		?>
		<div class="container">	
			<div class="row d-flex justify-content-center">
			<div class="col-md-8 fond">
			<br/>
				<FORM method = "POST" name = "formulaire_page3">
					<div class="form-group row d-flex justify-content-center">
					<label  class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-form-label' > Choisissez la race : </label>
					<SELECT NAME = "liste_race" class="form-control col-xs-5 col-sm-5 col-md-5 col-lg-5">
					
		
		<?php
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
		?>
		
		</SELECT NAME> <br/> <br/>
		<div class="col-xs-3 col-sm-3 col-md-1 col-lg-1">
		<INPUT TYPE = "SUBMIT" name = "bouton_valider" class="btn btn-primary" value = "Valider">
		</div>
		</div>
		<br/>
		
		
		<?php
		if(isset($_POST['bouton_valider'])||isset($_POST['bouton_valider_periode']))
			{
			$race = $_POST['liste_race'];
			if ($race == 6)
				$nom_race = 'marine';
			if ($race == 5)
				$nom_race = 'bordelaise';
			if ($race == 19)
				$nom_race = 'béarnaise';
			
			$query_periode = "SELECT periodes.id_periode, date_format(periodes.date_debut,'%d/%m/%Y'), date_format(periodes.date_fin, '%d/%m/%Y')
							FROM periodes WHERE periodes.id_race = ".$race.""; 
			$result_periode = mysqli_query($link, $query_periode);
			$tab_periode = mysqli_fetch_all($result_periode);
		?>
			<div class="row d-flex justify-content-center">
			<label  class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-form-label'> Choisissez la période : </label>
			<SELECT NAME = "liste_periode" class="form-control col-xs-5 col-sm-5 col-md-5 col-lg-5">
			
		<?php	
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
			echo "<INPUT TYPE = 'hidden' name = 'nom_race' value = '".$nom_race."'>";
			echo "<div class='col-xs-3 col-sm-3 col-md-1 col-lg-1'>";
			echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider_periode" class="btn btn-primary" value = "Valider">';
			echo '</div>';
			echo '</div>';
			echo '<br/>';
			}
			?>
			
			<br/> <br/>
			
			<?php
			if(isset($_POST['bouton_valider_periode']))
				{
				$nom_race = $_POST['nom_race'];
				$periode = $_POST['liste_periode'];
				$query_periode_af = 'SELECT date_format(periodes.date_debut, "%d/%m/%Y"), date_format(periodes.date_fin,"%d/%m/%Y") 
									FROM periodes WHERE periodes.id_periode ='.$periode.' ';
				$result_periode_af = mysqli_query($link, $query_periode_af);
				$tab_periode_af = mysqli_fetch_all($result_periode_af);
				
				if ($tab_periode_af[0][1] == null)
					{
					echo '<p> Tableau récapitulatif des prévisions de commande de paillettes pour la race <b>'.$nom_race. '</b> depuis le ' .$tab_periode_af[0][0].'</p> ';
					}
				else 
					{
					echo '<p> Tableau récapitulatif des prévisions de commande de paillettes pour la race <b>'.$nom_race. '</b> du ' .$tab_periode_af[0][0]. ' au ' .$tab_periode_af[0][1].'</p>' ;
					}
				
				echo '<br/>';
				$race=$_POST["id_race"];
					
				// Les lignes suivantes servent à obtenir la liste des éleveurs/utilisateurs et la liste des id_utilisateur
				$query_liste_ut="SELECT DISTINCT utilisateurs.nom, utilisateurs.prenom, utilisateurs.id_utilisateur 
										FROM utilisateurs 
										JOIN bovins ON bovins.id_utilisateur=utilisateurs.id_utilisateur
										JOIN previsions ON previsions.id_vache=bovins.id_bovin
										WHERE bovins.id_race=".$race." AND previsions.nbr_paillettes IS NOT NULL";
				$result_liste_ut=mysqli_query($link, $query_liste_ut);
				$tab_liste_ut=mysqli_fetch_all($result_liste_ut);
				$nbligne = mysqli_num_rows($result_liste_ut);
					
				$liste_ut=[] ;
				for ($i=0;$i<$nbligne;$i++)
					{
						$liste_ut[$i]=$tab_liste_ut[$i][1] . " " . $tab_liste_ut[$i][0] ;
					}

					
				$liste_id_ut=[] ;
				for ($i=0;$i<$nbligne;$i++)
					{
					$liste_id_ut[$i]=$tab_liste_ut[$i][2] ;
					}

					

				// Les lignes suivantes servent à obtenir la liste des taureaux de la race séléctionné dans les pages précédentes puis la liste des id_bovins
				$query_liste_t="SELECT DISTINCT nom_bovin, id_bovin 
									FROM bovins 
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
					
				$liste_id_t=[] ;
				for ($i=0;$i<$nbligne;$i++)
					{
					$liste_id_t[$i]=$tab_liste_t[$i][1] ;
					}
					
				
				//affichage du tableau récapitulatif
				$nb_ut=count($liste_ut);
				$nb_t=count($liste_t);
				
				echo '<div class="row d-flex justify-content-center">';
				echo '<table border = 1>';
				$L=[];
				echo "<td> </td>" ;
				$j = 0;
				while ($j<$nb_t)
					{
					echo '<td>' . $liste_t[$j]. '</td>'; // affiche les noms de taureau en haut dans la première ligne du tableau
					$j++;
					}
				echo '<td>Total</td>';			
				$i =0;
				//$S_t=0;
				while ($i<$nb_ut)
					{
					echo '<tr>';
					echo "<td>" . $liste_ut[$i] . "</td>"; // afiche les noms d'éleveurs dans la première colonne du tableau
					$j=0;
					$S_ut=0;
					while ($j<$nb_t)
						{
						$query_paillettes="SELECT SUM(nbr_paillettes) FROM previsions 
											JOIN bovins ON bovins.id_bovin=previsions.id_vache
											WHERE previsions.id_taureau=".$liste_id_t[$j]." AND bovins.id_utilisateur=".$liste_id_ut[$i]." AND previsions.id_periode=".$periode."
											GROUP BY previsions.id_taureau";
						$result_paillettes=mysqli_query($link, $query_paillettes);
						$tab_paillettes=mysqli_fetch_all($result_paillettes);
						if (empty($tab_paillettes))
						{
							$tab_paillettes[0][0] = '0';
							$L[$i][$j] = $tab_paillettes[0][0];
							echo '<td> 0 </td>';
						}
						else
						{
							echo '<td>' . $tab_paillettes[0][0]. '</td>';
							$S_ut=$S_ut+$tab_paillettes[0][0];
							$L[$i][$j] = $tab_paillettes[0][0];
						}
						$j++;
						}
					$i++;
					//echo '<td>Total</td>';
					echo '<td>'. $S_ut . '</td>';
					echo '</tr>';
					}
				
				echo "<td><b>Total</b></td>";
				$S_TT=0;
				for ($j=0;$j<$nb_t;$j++)
				{
					$S_t=0;
					for ($i=0;$i<$nb_ut;$i++)
					{
						$S_t=$S_t+$L[$i][$j];
					}
					echo "<td><b>" .$S_t. "</b></td>";
					$S_TT=$S_TT+$S_t;
				}
				echo "<td><b>".$S_TT."</b></td>";
				echo '</table>';
				echo '</div>';
				echo '<br>';
				
				
				if ($tab_periode_af[0][1] == null)
				{
				echo '<div class="row d-flex justify-content-center">';	
				echo '<FORM name = "form" method = "GET" >';
				echo '<INPUT TYPE = "button" class="btn btn-light" name = "bouton_reini" onclick="ConfirmMessage('.$periode. ',' .$race. ')" value = "Réinitialiser le tableau">';
				echo '</FORM>';
				echo '<span id="test"> </span>';
				echo '</div>';
				}
				
				}
				
		?>	
		
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	
	<footer class="footer">
		<?php include ("../mise_en_page/pied.html");?>
	</footer>
	</body>
</html>