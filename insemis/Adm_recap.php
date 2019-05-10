<html>
	<head>
		<meta charset = "UTF-8">
	</head>
	
	<body>
		Plateforme Paillettes - Récapitulatif des prévisions de commandes de paillettes <br><br><br>
		
		<?php
			$link=mysqli_connect('localhost', 'root', '', 'crabase'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			$query="SELECT id_race, nom_race FROM races"; // requête pour la liste déroulante choix eleveur
			$result=mysqli_query($link, $query);
		
			$tab_race=mysqli_fetch_all($result); // identifiant et nom des observateurs regroupés dans un tableau
		?>
		
		<FORM action="Adm_recap_2.php" method="GET">
		
			<br>
			<b> Séléctionnez une race </b>        <!--liste déroulante race-->
				<SELECT name="id_race" size="1">
					<?php
					// boucle permettant d'afficher la liste déroulante des races
					$i=0;
					for ($i=0;$i<count($tab_race);$i++)
						{
						echo "<OPTION value = '" . $tab_race[$i][0] . "'> ". $tab_race[$i][1] . "</OPTION>"; // le nom est affiché (colonne 1), l'identifiant est stocké (colonne 0)
						}
					?>
			
				</SELECT>
			<br><br>
		
			<INPUT TYPE="SUBMIT" name="bt_submit" value="OK">
		</FORM>
	
	</body>
</html>