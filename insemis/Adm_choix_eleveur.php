<html>
	<head>
		<meta charset = "UTF-8">
	</head>
	
	<body>
		Plateforme Paillettes <br><br><br>
	
		<?php
			$link=mysqli_connect('localhost', 'root', '', 'DataCRANET'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			$query="SELECT id_utilisateur, nom, prenom FROM utilisateurs"; // requête pour la liste déroulante choix eleveur
			$result=mysqli_query($link, $query);
			//var_dump($result);
			
			$tab_nom=mysqli_fetch_all($result,MYSQLI_BOTH); // identifiant et nom des observateurs regroupés dans un tableau
			//var_dump($tab_nom);
			//echo $tab_nom[0][1];
		?>
	
		<FORM action="Adm_matrice.php" method="GET">
		
			<br>
			<b> Séléctionnez un éleveur </b>        <!--liste déroulante éleveur-->
				<SELECT name="id_utilisateur" size="1">
					<?php
					// boucle permettant d'afficher la liste déroulante des nom d'eleveurs
					$i=0;
					for ($i=0;$i<count($tab_nom);$i++)
						{
						echo "<OPTION value = '" . $tab_nom[$i][0] . "'> ". $tab_nom[$i][1]," " ,$tab_nom[$i][2] . "</OPTION>"; // le nom est affiché (colonne 1), l'identifiant est stocké (colonne 0)
						}
					?>
			
				</SELECT>
			<br><br>
		
			<INPUT TYPE="SUBMIT" name="bt_submit" value="OK">
		</FORM>
		
	</body>
</html>