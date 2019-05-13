		<?php
	
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			$query="SELECT id_vache, id_taureau FROM `coefficients` WHERE id_utilisateur=$_SESSION['id_utilisateur']"; // requête pour la liste déroulante choix eleveur
			$result=mysqli_query($link, $query);
			//var_dump($result);
			
			$tab_nom=mysqli_fetch_all($result,MYSQLI_BOTH); // identifiant et nom des observateurs regroupés dans un tableau
			//var_dump($tab_nom);
			//echo $tab_nom[0][1];
		
	
		echo "<FORM method='POST' name='formulaire'>" ; 
		
			echo "<br>";
			echo "<b> Sélectionner la vache </b>"  ;      //liste déroulante éleveur
				echo "<SELECT name='id_vache' size='1'>";
					// boucle permettant d'afficher la liste déroulante des nom d'eleveurs
					$i=0;
					for ($i=0;$i<count($tab_nom);$i++)
						{
						echo "<OPTION value = '" . $tab_nom[$i][0] . "'> ". $tab_nom[$i][1]," " ,$tab_nom[$i][2] . "</OPTION>"; // le nom est affiché (colonne 1), l'identifiant est stocké (colonne 0)
						}
				echo "</SELECT>";
			echo "<br><br>";
		
			echo "<INPUT TYPE='SUBMIT' name='bouton_valider_eleveur' value='OK'>";
			echo "<br><br>";
	
			
			if(isset($_POST['bouton_valider_eleveur'])||isset($_POST['bt_submit_hist']))