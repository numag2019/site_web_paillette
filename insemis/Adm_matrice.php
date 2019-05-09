<html>
	<head>
		<meta charset = "UTF-8">
	</head>
	
	<body>
	
		Plateforme Paillettes - Matrice de parenté de l'éleveur <br><br><br>
	
		<?php
			require "Mes_fonctions.php" ;
		?>
	
		<?php
			$link=mysqli_connect('localhost', 'root', '', 'crabase');
			mysqli_set_charset($link, "utf8mb4"); 
		
			$query_bord="SELECT id_utilisateur FROM bovins WHERE id_race=5"; // requête pour avoir un tableau contenant les éleveurs de la race bordelaise
			$result_bord=mysqli_query($link, $query_bord);
			$liste_eleveur_bord=requete_2col_to_list ($result_bord) ;
			
			$query_mar="SELECT id_utilisateur FROM bovins WHERE id_race=6"; // requête pour avoir un tableau contenant les éleveurs de la race Marine
			$result_mar=mysqli_query($link, $query_mar);
			$liste_eleveur_mar=requete_2col_to_list ($result_mar) ;
			
			$query_bear="SELECT id_utilisateur FROM bovins WHERE id_race=19"; // requête pour avoir un tableau contenant les éleveurs de la race Béarnaise
			$result_bear=mysqli_query($link, $query_bear);
			$liste_eleveur_bear=requete_2col_to_list ($result_bear) ;
			
		?>
		
		<?php
		
		$eleveur=$_GET["id_utilisateur"];
		
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
		
		?>
		
		
	
		<FORM action="Adm_historique.php" method="GET">
			<INPUT TYPE="SUBMIT" name="bt_submit" value="Voir son historique de prévisions paillettes">
			<?php
				echo "<INPUT type='hidden' name='eleveur' value='" . $eleveur . "'>" ;
			?>
		</FORM>
		
		
	</body>
</html>