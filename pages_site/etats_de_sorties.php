
<?php
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
	
}
//Si l'utilisateur n'est pas connecté on affiche le formulaire de connexion 
else
{	
	include (authentification.php)
}