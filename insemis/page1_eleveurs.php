<HTML>
<?php
/*$_SESSION['id_utilisateur'];
if $_SESSION['id_type']==1;*/
$id_utilisateur = 4;

require "Mes_fonctions.php" ;

$link = mysqli_connect('localhost', 'root', '', 'crabase');
mysqli_set_charset($link, "utf8mb4");

$query_race = "SELECT DISTINCT races.id_race, races.nom_race 
				FROM races
				JOIN bovins ON races.id_race = bovins.id_race
				JOIN utilisateurs ON bovins.id_utilisateur = utilisateurs.id_utilisateur
				WHERE utilisateurs.id_utilisateur =".$id_utilisateur."";
$result_race = mysqli_query($link, $query_race);
$tab_race = mysqli_fetch_all($result_race);

echo "Choisissez la race : ";
echo '<FORM method = "GET" name = "formulaire_page1_eleveurs">';
echo '<SELECT NAME = "liste_race">';
for($i=0; $i < count($tab_race); $i++)
	{
	$value = $tab_race[$i][0];
	echo "<OPTION VALUE ='".$value. "' ";
	if (isset($_GET['liste_race']))
		{
		// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
		if ($value==$_GET['liste_race']) 
		echo "selected";
		}
	echo ">".$tab_race[$i][1]."</OPTION> ";
	}
echo '</SELECT NAME> <br/> <br/>';
echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider" value = "Valider">';
echo '<br> <br>';

if(isset($_GET['bouton_valider'])||isset($_GET['bouton_historique']))
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
				
	// Requête SQL sécurisée
		
	$eleveur = 4;	
	if (in_array($eleveur,$liste_eleveur_bord))
		{
		echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Bordelaise </a> <br><br>" ;
		}
	if (in_array($eleveur,$liste_eleveur_mar))
		{
		echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Marine </a> <br><br>" ;
		}
	if (in_array($eleveur,$liste_eleveur_bear))
		{
		echo "<a href='file:///C:/Users/NUMAG3/Desktop/projet%20web%20entreprise/documents%20fournis/AQUITAINE2017diffusion.pdf'> Catalogue Taureaux Race Béarnaise </a> <br><br>" ;
		}	
			
	$race = $_GET['liste_race'];
	if ($race == 6)
		$nom_race = 'marine';
	if ($race == 5)
		$nom_race = 'bordelaise';
	if ($race == 19)
		$nom_race = 'béarnaise';
	echo 'Matrice de parenté pour la race '.$nom_race;	
	

	$query_matrice = "SELECT coefficients.id_vache, coefficients.id_taureau
								 FROM coefficients
								 JOIN bovins ON bovins.id_bovin = coefficients.id_vache 
								 WHERE bovins.id_race =".$race." and bovins.id_utilisateur = ".$id_utilisateur." ";
				$result_matrice = mysqli_query($link, $query_matrice);
				$tab_matrice = mysqli_fetch_all($result_matrice);
				$nb_accouplement = mysqli_num_rows($result_matrice);
				$liste_males = [];
				$liste_nom_males = [];
				for ($k=0; $k < $nb_accouplement; $k++)
					{
					$individu = $tab_matrice[$k][1];
					if (in_array($individu,$liste_males))
						{}
					else
						{
						$query_nom_male = 'SELECT bovins.nom_bovin FROM bovins WHERE bovins.id_bovin='.$tab_matrice[$k][1].'';
						$result_nom_male = mysqli_query($link, $query_nom_male);
						$tab_nom_male = mysqli_fetch_all($result_nom_male);
						array_push($liste_nom_males,$tab_nom_male[0][0]);
						array_push($liste_males,$tab_matrice[$k][1]);
						}
					}

				$liste_femelles = [];
				$liste_nom_femelle = [];
				for ($k=0; $k < $nb_accouplement; $k++)
					{
					$individu_femelle = $tab_matrice[$k][0];
					if (in_array($individu_femelle,$liste_femelles))
						{}
					else 
						{
						$query_nom_femelle = 'SELECT bovins.nom_bovin FROM bovins WHERE bovins.id_bovin='.$tab_matrice[$k][0].'';
						$result_nom_femelle = mysqli_query($link, $query_nom_femelle);
						$tab_nom_femelle = mysqli_fetch_all($result_nom_femelle);
						array_push($liste_nom_femelle,$tab_nom_femelle[0][0]);
						array_push($liste_femelles,$tab_matrice[$k][0]);
						}
					}
					
				$nb_males=count($liste_males);
				$nb_femelle=count($liste_femelles);
				
				echo '<table border = 1>';
				echo '<tr>';
				echo '<td>&nbsp;</td>';
				for ($j=0; $j < $nb_males; $j++)
						{
							echo '<td>' . $liste_nom_males[$j]. '</td>';
						}
				echo '</tr>';
				
				for ($i=0; $i < $nb_femelle; $i++)
				{
					echo '<tr><center>';
					echo '<td>'.$liste_nom_femelle[$i];
					for ($j=0; $j < $nb_males; $j++)
						{
						$query_color = "SELECT races.seuil_min, races.seuil_max FROM races WHERE id_race=".$race."";
						$result_color = mysqli_query($link, $query_color);
						$tab_color = mysqli_fetch_all($result_color);
						$query_coeff="SELECT coefficients.valeur_coeff 
												FROM coefficients 
												WHERE id_vache=" .$liste_femelles[$i]." AND id_taureau=".$liste_males[$j]."";
						$result_coeff = mysqli_query($link, $query_coeff);
						$tab_coeff = mysqli_fetch_all($result_coeff);
						$query_periode = "SELECT periodes.id_periode FROM periodes WHERE ISNULL(date_fin) =1 AND id_race =".$race."";
						$result_periode = mysqli_query($link, $query_periode);
						$tab_periode = mysqli_fetch_all($result_periode);
						$periode = $tab_periode[0][0];
						$query_prev = "SELECT previsions.nbr_paillettes FROM previsions 
									WHERE id_vache=" .$liste_femelles[$i]." AND id_taureau=".$liste_males[$j]." AND id_periode=".$periode. "";
						$result_prev = mysqli_query($link, $query_prev);
						$tab_prev = mysqli_fetch_all($result_prev);
						if ($tab_coeff[0][0]<$tab_color[0][0])
							$color = 'green';
						if ($tab_coeff[0][0]>$tab_color[0][0] AND $tab_coeff[0][0]<$tab_color[0][1] )
							$color = 'orange';
						if ($tab_coeff[0][0]>$tab_color[0][1])
							$color = 'red';
						echo '<td bgcolor ='.$color.'><center>';
						//echo $tab_coeff[0][0];
						echo $tab_prev[0][0];
						echo '</center></td>';
						}
					echo '</td>';
					echo '</center></tr>';
				}
				echo '<br>';
				echo '<table border = 1>';
				echo '<tr>';
				echo '<td bgcolor=green> Accouplement très favorable </td> ';
				echo '</tr>';
				echo '<tr>';
				echo '<td bgcolor=orange> Accouplement favorable </td> ';
				echo '</tr>';
				echo '<tr>';
				echo '<td bgcolor=red> Accouplement peu favorable </td> ';
				echo '</tr>';
				echo '<br> <br>';
	echo "Prévoir un accouplement <br>";
	echo "Choisissez le mâle : ";
	echo '<SELECT NAME = "liste_male">';
	for($i=0; $i < count($liste_nom_males); $i++)
	{
		$value = $liste_males[$i];
		echo "<OPTION VALUE ='".$value. "' ";
		if (isset($_GET['liste_male']))
		{
			// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
			if ($value==$_GET['liste_male']) 
			echo "selected";
		}
	echo ">".$liste_nom_males[$i]."</OPTION> ";
	}
	echo '</SELECT NAME> <br/>';
	
	echo "Choisissez la femelle : ";
	echo '<SELECT NAME = "liste_femelle">';
	for($i=0; $i < count($liste_nom_femelle); $i++)
	{
		$value = $liste_femelles[$i];
		echo "<OPTION VALUE ='".$value. "' ";
		if (isset($_GET['liste_male']))
		{
			// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
			if ($value==$_GET['liste_male']) 
			echo "selected";
		}
	echo ">".$liste_nom_femelle[$i]."</OPTION> ";
	}
	echo '</SELECT NAME> <br/>';
	echo "Choisissez le nombre de paillettes à commander : ";
	$liste_nombre = array('1','2','3','4','5');
	echo '<SELECT NAME = "liste_nombre">';
	for($i=0; $i < count($liste_nombre); $i++)
	{
		$value = $liste_nombre[$i];
		echo "<OPTION VALUE ='".$value. "' ";
		if (isset($_GET['liste_nombre']))
		{
			// Dans le cas où une sélection a déjà été faite, on conserve cette sélection par défaut
			if ($value==$_GET['liste_nombre']) 
			echo "selected";
		}
	echo ">".$liste_nombre[$i]."</OPTION> ";
	}
	echo '</SELECT NAME> <br/>';
	echo '<INPUT TYPE = "SUBMIT" name = "bouton_valider_prev" value = "Valider la prévision">';
	echo '<br> <br>';
	
	
	echo "<input type='hidden' name='id_race' value='".$race."'>";
	echo "<input type='hidden' name='nom_race' value='".$nom_race."'>";
	echo '<INPUT TYPE="submit" name="bouton_historique"  value="Afficher mon historique de commandes pour la race">';
	if(isset($_GET['bouton_historique']))
		{
			$id_race = $_GET['id_race'];
			$nom_race = $_GET['nom_race'];
			echo "Historique des prévisions de commande de paillettes pour la race ".$nom_race." <br><br>";
			// Les lignes suivantes servent à obtenir la liste des périodes et la liste des id_periode
			$query_liste_per="SELECT date_debut, date_fin, id_periode FROM periodes WHERE periodes.id_race =".$id_race."";
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
				$query_liste_taureau="SELECT nom_bovin, id_bovin 
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
						$query_paillettes="SELECT nbr_paillettes FROM previsions WHERE id_taureau=".$liste_id_taureau[$j]." AND id_periode=".$liste_id_per[$i]."";
						$result_paillettes=mysqli_query($link, $query_paillettes);
						$tab_paillettes=mysqli_fetch_all($result_paillettes);;
						if (empty($tab_paillettes))
							echo '<td> 0 </td>';
						else
							echo '<td>' . $tab_paillettes[0][0]. '</td>';
							$s_periode=$s_periode+$tab_paillettes[0][0];
						$j++;
					}
					$i++;
					echo '<td>'. $s_periode . '</td>';
					echo '</tr>';
				}
				echo '</table>';	
			
		}
	
	
	}				
					
if (isset($_GET['bouton_valider_prev']))
	{
	echo $_GET['liste_male'] ;
	echo $_GET['liste_femelle'] ;
	echo $_GET['liste_nombre'];
	$link = mysqli_connect('localhost', 'root', '', 'crabase');
	mysqli_set_charset($link, "utf8mb4");
	$req_test="SELECT *
				FROM previsions
				WHERE id_vache=".$_GET['liste_femelle']." and id_taureau=".$_GET['liste_male']."";
	$result_test=mysqli_query($link, $req_test);
	$tab_result = mysqli_fetch_all($result_test);
	if (count($tab_result)>0) // la prevision existe
	{
	$query_race = "UPDATE previsions
					ON nbr_paillettes=nbr_paillettes+".$_GET['liste_nombre']."
					WHERE  id_vache=".$_GET['liste_femelle']." and id_taureau=".$_GET['liste_male']."";

	$result_race = mysqli_query($link, $query_race);
	}
	else // sinon on la crée
	{
	$reqadd="INSERT INTO previsions ( nbr_paillettes, id_periode	 , id_vache , id_taureau) 
			VALUES ( ".$_GET['liste_nombre'].",1 , ".$GET['liste_femelle']." , ".$GET['liste_male'].")";
	$result_race = mysqli_query($link, $reqadd);

	}
	
}
?>
</HTML>