<html>
	<head>
		<meta charset = "UTF-8">
	</head>
	
	<body>
		Historique des prévisions de commande de paillettes de l'éleveur pour la race administrateur de race <br><br>
		
		<?php
			$link=mysqli_connect('localhost', 'root', '', 'DataCRANET'); // connexion à la base de données
			mysqli_set_charset($link, "utf8mb4"); // prise en compte des caractères de la base de données
			
			/*
			$query="SELECT id_periode, id_prevision, id_vache
					FROM previsions"; // 
			$result=mysqli_query($link, $query);
			$tab=mysqli_fetch_all($result); //
			*/
			
			// Les lignes suivantes servent à obtenir la liste des périodes
			$query_liste_per="SELECT date_debut, date_fin FROM periodes";
			$result_liste_per=mysqli_query($link, $query_liste_per);
			$tab_liste_per=mysqli_fetch_all($result_liste_per);
			$nbligne = mysqli_num_rows($result_liste_per);
			
			$liste_per=[] ;
			for ($i=0;$i<$nbligne;$i++)
			{
				$liste_per[$i]=$tab_liste_per[$i][0] . " - " . $tab_liste_per[$i][1] ;
			}
			var_dump($liste_per);
			
			// Les lignes suivantes servent à obtenir la liste des vache de l'éleveur séléctionné dans les pages précédentes
			$utilisateur=$_GET["eleveur"]; // recupère l'id de l'utilisateur rentré sur 2 pages avant
			$query_liste_vache="SELECT nom_bovin FROM bovins WHERE sexe=2 AND id_utilisateur=$utilisateur";
			$result_liste_vache=mysqli_query($link, $query_liste_vache);
			$tab_liste_vache=mysqli_fetch_all($result_liste_vache);
			$nbligne = mysqli_num_rows($result_liste_vache);
			
			$liste_vache=[] ;
			for ($i=0;$i<$nbligne;$i++)
			{
				$liste_vache[$i]=$tab_liste_vache[$i][0] ;
			}
			var_dump($liste_vache);


			//affichage du tableau récap
			$nb_periodes=count($liste_per);
			echo $nb_periodes;
			$i=0 ;
			//while ($i<$nb_periodes)
			//{
				$nb_vaches=count($liste_vache);
				echo $nb_vaches;
				$j=0;
				//while ($j<$nb_vaches)
				//{
					
					
			
			
		?>

	</body>
</html>