
<?php
$mdpa=password_hash('secu', PASSWORD_BCRYPT);
echo $mdpa;
echo "<BR/>";
$mdpb=password_hash('secu', PASSWORD_BCRYPT);
echo "<BR/>";
echo $mdpb;
echo "<BR/>";
echo "<BR/>";

if (password_verify('secu', $mdpb))
{echo 'connexion';}
else 
	{echo 'problème...';}
?>

