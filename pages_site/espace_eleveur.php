
<?php
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
	echo "<p><a href='etats_de_sorties.php'>Accès états de sorties</a> ?</p>";
	echo "<p><a href='plan_previsionnel_IA.php'>Plan prévisionnel d IA</a> ?</p>";
	
}
else
{
	include authentification.php
}	
?>
