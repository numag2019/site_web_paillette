<?php include ('envoimail.php')?>
<?php
session_start(); 
if ($_SESSION['id_type']==3)
{
// recuperation des utilisateurs eleveurs
$link=mysqli_connect('localhost','root','','crabase');
//Change l'encodage des données de la BDD
mysqli_set_charset($link,"utf8mb4");
// Requête
$querya="SELECT email FROM utilisateurs WHERE id_type <3  ORDER BY email";
$result=mysqli_query($link,$querya);

//Création tableau
$tab=mysqli_fetch_all($result);
$nbligne=mysqli_num_rows($result);
$j=0;
while ($j<$nbligne)
	{
	envoimail($tab[$j]);
	$j++;
	echo $j;}
}
echo "Les nouveaux mots de passe ont bien été envoyés.";
?>		
<!-- DIV Pied de page -->	

		<?php include ("../mise_en_page/pied.html");?>
	</body>
</html>