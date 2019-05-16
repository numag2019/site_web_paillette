<!doctype html>
<HTML lang='fr'>

	<head>
	<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/site/docs/4.3/assets/js/vendor/jquery-slim.min.js"></script>
		<script  type="text/javascript" src="../mise_en_page/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="../mise_en_page/bootstrap2.css">
		
	<!-- Déclaration des types d'utilisateurs autorisés à accéder à cette page -->
	<?php $autorisation=TRUE // tout le monde?>

	<!--  Navigation -->
	 <?php 
	 include("../mise_en_page/navigation.html"); 
	 ?>
	</head>
	
	<body>
		<?php	
		$id_utilisateur=$_SESSION['id_utilisateur'];
	
		require "Mes_fonctions.php" ;

		//Connection à la base de données crabase
		$link = mysqli_connect('localhost', 'root', '', 'crabase');
		mysqli_set_charset($link, "utf8mb4");

		
		//Requête sélectionnant les races qu'élèvent l'éleveur qui vient de se connecter
		$query_race = "SELECT DISTINCT races.id_race, races.nom_race 
						FROM races
						JOIN bovins ON races.id_race = bovins.id_race
						JOIN utilisateurs ON bovins.id_utilisateur = utilisateurs.id_utilisateur
						WHERE utilisateurs.id_utilisateur =".$id_utilisateur."";
		$result_race = mysqli_query($link, $query_race);
		$tab_race = mysqli_fetch_all($result_race);

		?>
		<div class="container">	
			<div class="row d-flex justify-content-center">
				<div class="col-md-8" style="background: rgba(0,0,0,0.4); border-radius: 10px; text-align:center;"> 
				</br>
				<FORM method = "POST" name = "formulaire_page1_eleveurs">
					<div class="row d-flex justify-content-center">
					<label class='col-3 col-form-label'> Choisissez la race : </label>
		
		<!--Liste déroulante permettant la sélection d'une race élevée par l'éleveur connecté-->
		<SELECT NAME = "liste_race" class="form-control col-3">
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
		
		</SELECT NAME> <br/> 
		
		<!--Bouton de validation de la race -->
		<INPUT TYPE = "SUBMIT" name = "bouton_valider" class="btn btn-primary" value = "Valider">
					</div>
		<br> <br>
					
		<?php
		if(isset($_POST['bouton_valider'])||isset($_POST['bouton_historique'])||isset($_POST['bouton_valider_prev']))
			{
				
			$query_bord="SELECT id_utilisateur FROM bovins WHERE id_race=5"; // requête pour avoir un tableau contenant les éleveurs de la race bordelaise
			$result_bord=mysqli_query($link, $query_bord);
			$liste_eleveur_bord=requete_2col_to_list ($result_bord) ;
						
			$query_mar="SELECT id_utilisateur FROM bovins WHERE id_race=6"; // requête pour avoir un tableau contenant les éleveurs de la race Marine
			$result_mar=mysqli_query($link, $query_mar);
			$liste_eleveur_mar=requete_2col_to_list ($result_mar) ;
						
			$query_bear="SELECT id_utilisateur FROM bovins WHERE id_race=19"; // requête pour avoir un tableau contenant les éleveurs de la race Béarnaise
			$result_bear=mysqli_query($link, $query_bear);
			$liste_eleveur_bear=requete_2col_to_list ($result_bear) ;
						
			//Boucle qui permet d'obtenir le catalogue de la race en fonction des races élevées
					
			if (in_array($id_utilisateur,$liste_eleveur_bord))
				{
				echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Bordelaise </a> <br><br>" ;
				}
			if (in_array($id_utilisateur,$liste_eleveur_mar))
				{
				echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Marine </a> <br><br>" ;
				}
			if (in_array($id_utilisateur,$liste_eleveur_bear))
				{
				echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Béarnaise </a> <br><br>" ;
				}	
					
			//Assignation du nom de la race en fonction de son identifiant
			$race = $_POST['liste_race'];
			if ($race == 6)
				$nom_race = 'marine';
			if ($race == 5)
				$nom_race = 'bordelaise';
			if ($race == 19)
				$nom_race = 'béarnaise';
			echo 'Matrice de parenté pour la race '.$nom_race;	
			
			//Sélection des identifiants des vaches et des tauraux pour lesquels un coefficient de consanguinité a été calculé
			$query_matrice = "SELECT coefficients.id_vache, coefficients.id_taureau
							FROM coefficients
							JOIN bovins ON bovins.id_bovin = coefficients.id_vache 
							WHERE bovins.id_race =".$race." and bovins.id_utilisateur = ".$id_utilisateur." ";
			$result_matrice = mysqli_query($link, $query_matrice);
			$tab_matrice = mysqli_fetch_all($result_matrice);
			$nb_accouplement = mysqli_num_rows($result_matrice);
			
			//Création d'une liste vide pour stocker les identifiants des mâles
			$liste_males = [];
			//Création d'une liste vide pour stocker les noms des mâles
			$liste_nom_males = [];
			//Pour tous les accouplements..
			for ($k=0; $k < $nb_accouplement; $k++)
				{
				//on récupère l'identifiant du mâle
				$individu = $tab_matrice[$k][1];
				//si il est déjà dans la liste alors on ne l'ajoute pas
				if (in_array($individu,$liste_males))
					{}
				//si il n'est pas dans la liste
				else
					{
					//requête sélectionnant le nom du mâle correspondant à l'identifiant sélectionné
					$query_nom_male = 'SELECT bovins.nom_bovin FROM bovins WHERE bovins.id_bovin='.$tab_matrice[$k][1].'';
					$result_nom_male = mysqli_query($link, $query_nom_male);
					$tab_nom_male = mysqli_fetch_all($result_nom_male);
					//on ajoute le nom du mâle à la liste
					array_push($liste_nom_males,$tab_nom_male[0][0]);
					//on ajoute l'identifiant du mâle à la liste
					array_push($liste_males,$tab_matrice[$k][1]);
					}
				}

				//Création d'une liste vide pour stocker les identifiants des femelles
				$liste_femelles = [];
				//Création d'une liste vide pour stocker les noms des femelles
				$liste_nom_femelle = [];
				//Pour tous les accouplements..
				for ($k=0; $k < $nb_accouplement; $k++)
				{
					//on récupère l'identifiant de la femelle
					$individu_femelle = $tab_matrice[$k][0];
					//si elle est déjà dans la liste alors on ne l'ajoute pas
					if (in_array($individu_femelle,$liste_femelles))
					{}
					//sinon
					else 
					{
						//requête sélectionnant le nom de la femelle correspondant à l'identifiant sélectionné
						$query_nom_femelle = 'SELECT bovins.nom_bovin FROM bovins WHERE bovins.id_bovin='.$tab_matrice[$k][0].'';
						$result_nom_femelle = mysqli_query($link, $query_nom_femelle);
						$tab_nom_femelle = mysqli_fetch_all($result_nom_femelle);
						//on ajoute le nom de la femelle à la liste
						array_push($liste_nom_femelle,$tab_nom_femelle[0][0]);
						//on ajoute l'identifiant de la femelle à la liste
						array_push($liste_femelles,$tab_matrice[$k][0]);
					}
				}
							
				//on compte le nombre de mâles et de femelles
				$nb_males=count($liste_males);
				$nb_femelle=count($liste_femelles);
				
				?>
				
				<div class="row">
					
						<div class="col-6">
				
				<!--création de la matrice de parenté-->
				<table class="table table-bordered">
				<tr>
				<td>&nbsp;</td>
				
				<?php
				//pour le nombre de mâles impliqués dans un accouplement
				for ($j=0; $j < $nb_males; $j++)
				{
					//on ajoute le nom du mâle à chaque début de colonne
					echo '<td>' . $liste_nom_males[$j]. '</td>';
				}
					echo '</tr>';
						
						//pour le nombre de femelles impliquées dans un accouplement
						for ($i=0; $i < $nb_femelle; $i++)
						{
							echo '<tr><center>';
							//on ajoute le nom de la femelle en début de ligne
							echo '<td>'.$liste_nom_femelle[$i];
							for ($j=0; $j < $nb_males; $j++)
							{
								//requête sélectionnant les seuils de la race pour définir le code couleur
								$query_color = "SELECT races.seuil_min, races.seuil_max FROM races WHERE id_race=".$race."";
								$result_color = mysqli_query($link, $query_color);
								$tab_color = mysqli_fetch_all($result_color);
								
								//requête sélectionnant les coefficients pour un mâle et une femelle donnés
								$query_coeff="SELECT coefficients.valeur_coeff 
														FROM coefficients 
														WHERE id_vache=" .$liste_femelles[$i]." AND id_taureau=".$liste_males[$j]."";
								$result_coeff = mysqli_query($link, $query_coeff);
								$tab_coeff = mysqli_fetch_all($result_coeff);
								
								//requête sélectionnant l'identifiant de la période actuelle pour la race élevée
								$query_periode = "SELECT periodes.id_periode 
												FROM periodes 
												WHERE ISNULL(date_fin) =1 AND id_race =".$race."";
								$result_periode = mysqli_query($link, $query_periode);
								$tab_periode = mysqli_fetch_all($result_periode);
								//récupération de l'identifiant de la période actuelle
								$periode = $tab_periode[0][0];
								
								//requête sélectionnant les prévisions de paillettes pour un accouplement durant la période actuelle
								$query_prev = "SELECT previsions.nbr_paillettes 
											FROM previsions 
											WHERE id_vache=" .$liste_femelles[$i]." AND id_taureau=".$liste_males[$j]." AND id_periode=".$periode. "";
								$result_prev = mysqli_query($link, $query_prev);
								$tab_prev = mysqli_fetch_all($result_prev);
								
								//détermination du code couleurs en fonction des seuils
								if(isset($tab_coeff[0][0]))
								{
									//si le coefficient est inférieur au seuil minimum, alors la case sera colorée en vert
									if ($tab_coeff[0][0]<$tab_color[0][0])
										$color = 'green';
									//si le coefficient est supérieur au seuil minimum mais inférieur au seuil maximum, alors la case sera colorée en orange
									if ($tab_coeff[0][0]>$tab_color[0][0] AND $tab_coeff[0][0]<$tab_color[0][1])
										$color = 'orange';
									//si le coefficient est supérieur au seuil maximum, alors la case sera colorée en rouge
									if ($tab_coeff[0][0]>$tab_color[0][1])
										$color = 'red';
									echo '<td bgcolor ='.$color.'><center>';
									if(isset($tab_prev[0][0]))
									{
										//on écrit la prévision dans la case
										echo ' <br> '.$tab_prev[0][0];
									}
								}
								echo '</center></td>';
								}
							echo '</td>';
							echo '</center></tr>';
						}
						echo '</table>';
						echo '</div>';
						echo '</div>';
						echo '<br>';
						echo '<div class="row">';
						echo '<div class="col-3">';
						
						//création du tableau de légende des couleurs
						echo '<table class="table table-bordered" align="center">';
						echo '<tr>';
						echo '<td bgcolor=green> Accouplement très favorable </td> ';
						echo '</tr>';
						echo '<tr>';
						echo '<td bgcolor=orange> Accouplement favorable </td> ';
						echo '</tr>';
						echo '<tr>';
						echo '<td bgcolor=red> Accouplement peu favorable </td> ';
						echo '</tr>';
						echo '</table>';
						echo '</div>';
						echo '</div>';
						echo '<br> <br>';
			
			//choix de prévision d'un accouplement grâce à 3 listes déroulantes
			echo "Prévoir un accouplement <br><br>";
			echo '<div class="form-group row">';
			echo "<label class='col-2 col-form-label'> Choisissez le mâle : </label>";
			//on choisit le mâle
			echo '<SELECT NAME = "liste_male" class="form-control col-2">';
			for($i=0; $i < count($liste_nom_males); $i++)
			{
				$value = $liste_males[$i];
				echo "<OPTION VALUE ='".$value. "' ";
				if (isset($_POST['liste_male']))
				{
					// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
					if ($value==$_POST['liste_male']) 
					echo "selected";
				}
			echo ">".$liste_nom_males[$i]."</OPTION> ";
			}
			//on choisit la femelle
			echo '</SELECT NAME> <br/>';
			echo '</div>';
			echo '<div class="form-group row">';
			echo "<label class='col-2 col-form-label'> Choisissez la femelle : </label>";
			echo '<SELECT NAME = "liste_femelle" class="form-control col-2">';
			for($i=0; $i < count($liste_nom_femelle); $i++)
			{
				$value = $liste_femelles[$i];
				echo "<OPTION VALUE ='".$value. "' ";
				if (isset($_POST['liste_femelle']))
				{
					// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
					if ($value==$_POST['liste_male']) 
					echo "selected";
				}
			echo ">".$liste_nom_femelle[$i]."</OPTION> ";
			}
			echo '</SELECT NAME> <br/>';
			echo '</div>';
			//on choisit le nombre de paillettes souhaitées pour cet accouplement
			$liste_nombre = array('-1','-2','-3','1','2','3');
			echo '<div class="form-group row">';
			echo "<label class='col-2 col-form-label'> Choisissez le nombre de paillettes à commander : </label>";
			echo '<SELECT NAME = "liste_nombre" class="form-control col-2">';
			for($i=0; $i < count($liste_nombre); $i++)
			{
				$value = $liste_nombre[$i];
				echo "<OPTION VALUE ='".$value. "' ";
				if (isset($_POST['liste_nombre']))
				{
					// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
					if ($value==$_POST['liste_nombre']) 
					echo "selected";
				}
			echo ">".$liste_nombre[$i]."</OPTION> ";
			}
			echo '</SELECT NAME> <br/>';
			echo '</div>';
			echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider_prev" class="btn btn-primary" value = "Valider la prévision">';
			echo '<br> <br>';
			
			
			echo "<input type='hidden' name='id_race' value='".$race."'>";
			echo "<input type='hidden' name='nom_race' value='".$nom_race."'>";
			echo '<INPUT TYPE="submit" name="bouton_historique" class="btn btn-dark" value="Afficher mon historique de commandes">';
			echo '<br> <br>';
			
			//si le bouton historique a été cliquée, on affiche la matrice de parenté
			if(isset($_POST['bouton_historique']))
				{
					$id_race = $_POST['id_race'];
					$nom_race = $_POST['nom_race'];
					echo "Historique des prévisions de commande de paillettes pour la race ".$nom_race." <br><br>";
					// Les lignes suivantes servent à obtenir la liste des périodes et la liste des id_periode
					$query_liste_per="SELECT date_format(date_debut,'%d/%m/%Y'), date_format(date_fin,'%d/%m/%Y'), id_periode 
									FROM periodes 
									WHERE periodes.id_race =".$id_race."
									ORDER BY date_debut";
					$result_liste_per=mysqli_query($link, $query_liste_per);
					$tab_liste_per=mysqli_fetch_all($result_liste_per);
					$nbligne = mysqli_num_rows($result_liste_per);
					
						$liste_per=[] ;
						for ($i=0;$i<$nbligne;$i++)
							{
								$liste_per[$i]=$tab_liste_per[$i][0] . " - " . $tab_liste_per[$i][1] ;
							}
					
						$liste_id_per=[] ;
						for ($i=0;$i<$nbligne;$i++)
							{
								$liste_id_per[$i]=$tab_liste_per[$i][2] ;
							}
					
						// Les lignes suivantes servent à obtenir la liste des vache de l'éleveur séléctionné dans les pages précédentes puis la liste des id_bovins
						$query_liste_taureau="SELECT DISTINCT nom_bovin, id_bovin 
											FROM bovins
											JOIN previsions ON previsions.id_taureau=bovins.id_bovin
											WHERE (sexe=1 OR sexe=3) AND bovins.id_race=$id_race AND previsions.nbr_paillettes IS NOT NULL";
						$result_liste_taureau=mysqli_query($link, $query_liste_taureau);
						$tab_liste_taureau=mysqli_fetch_all($result_liste_taureau);
						$nbligne = mysqli_num_rows($result_liste_taureau);
					
						$liste_taureau=[] ;
						for ($i=0;$i<$nbligne;$i++)
							{
								$liste_taureau[$i]=$tab_liste_taureau[$i][0] ;
							}
					
						$liste_id_taureau=[] ;
						for ($i=0;$i<$nbligne;$i++)
							{
								$liste_id_taureau[$i]=$tab_liste_taureau[$i][1] ;
							}

						$nb_periodes=count($liste_per);
						$nb_taureau=count($liste_taureau);
					
						echo '<table border = 1>';
						echo "<td> </td>" ;
						$j = 0;
						while ($j<$nb_taureau)
							{
								echo '<td>' . $liste_taureau[$j]. '</td>';
								$j++;
							}
						echo '<td>Total</td>';	
						$i =0;
						while ($i<$nb_periodes)
						{
							echo '<tr>';
							echo "<td>" . $liste_per[$i] . "</td>";
							$j=0;
							$s_periode = 0;
							while ($j<$nb_taureau)
							{
								$query_paillettes="SELECT SUM(nbr_paillettes) 
												   FROM previsions 
												   WHERE id_taureau=".$liste_id_taureau[$j]." AND id_periode=".$liste_id_per[$i]."
												   GROUP BY previsions.id_taureau";			   
								$result_paillettes=mysqli_query($link, $query_paillettes);
								$tab_paillettes=mysqli_fetch_all($result_paillettes);;
								if (empty($tab_paillettes))
									echo '<td> 0 </td>';
								else
									if(isset($tab_paillettes[0][0]))
									{
										echo '<td>' . $tab_paillettes[0][0]. '</td>';
										$s_periode=$s_periode+$tab_paillettes[0][0];
									}
								$j++;
							}
							$i++;
							echo '<td>'. $s_periode . '</td>';
							echo '</tr>';
						}
						echo '</table>';	
					
				}
						
			
			//si le bouton de validation de la prévision est cliqué
			if (isset($_POST['bouton_valider_prev']))
			{
				$id_race = $_POST['id_race'];
					
						$link = mysqli_connect('localhost', 'root', '', 'crabase');
						mysqli_set_charset($link, "utf8mb4");
						//requête sélectionnant la période actuelle afin de rajouter les nouvelles prévisions de paillettes
						$query_periode_act = "SELECT id_periode
											  FROM periodes
											  WHERE periodes.date_fin IS NULL and periodes.id_race=".$id_race." ";
						
					
						$result_periode_act=mysqli_query($link, $query_periode_act);
						$tab_periode_act = mysqli_fetch_all($result_periode_act);
						
						$id_periode = $tab_periode_act[0][0];
				
						//requête sélectionnant les prévisions pour tous les accouplements possibles
						$req_test="SELECT *
									FROM previsions
									WHERE id_vache=".$_POST['liste_femelle']." and id_taureau=".$_POST['liste_male']."";
						$result_test=mysqli_query($link, $req_test);
						$tab_result = mysqli_fetch_all($result_test);
						// si une prévision existe déjà 
						if (count($tab_result)>0) 
						{
						//on actualise le nombre de paillettes commandées pour cet accouplement
						$query_race = "UPDATE previsions
										SET nbr_paillettes=nbr_paillettes+".$_POST['liste_nombre']."
										WHERE  id_vache=".$_POST['liste_femelle']." and id_taureau=".$_POST['liste_male']."";
						$result_race = mysqli_query($link, $query_race);
						}
						//si aucune prévision n'a été réalisée pour cet accouplement
						else 
						{
						//on crée la prévision avec le nombre de paillettes prévues
						$reqadd="INSERT INTO previsions ( nbr_paillettes, id_periode	 , id_vache , id_taureau) 
								VALUES ( ".$_POST['liste_nombre'].",".$id_periode." , ".$_POST['liste_femelle']." , ".$_POST['liste_male'].")";
						
						$result_race = mysqli_query($link, $reqadd);
						}
						
						//echo "<script type='text/javascript'>document.location.replace('page1_eleveurs.php');</script>";
			
			}				
				
			}			
		
		?>
			</div>
		</div>
	</div>	
	
	</body>
	
</HTML>