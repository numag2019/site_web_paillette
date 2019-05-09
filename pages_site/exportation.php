<?php
function export_vers_cranet($chemin , $ftpTarget='/')
/*
$chemin : chemin d'accès au fichier GeniS à envoyer sur Cranet
$ftpTarget : emplacement où le fichier va être envoyé */
$chemin= "C:\Users\Nobella Théo\AppData\Local\Temp\Memento Stage 2A_2018-2019"; 
$ftpServer = 'localhost';
$ftpUser = 'admin';
$ftpPwd = 'admin';
$connection = ftp_connect($ftpServer);
$login = ftp_login($connection, $ftpUser, $ftpPwd);
if ($connection && $login) 
	{
	$upload = ftp_put($connection, $ftpTarget , $chemin, FTP_BINARY);
	if (!$upload) 
		{
		$error="échec de l'envoie "
		}
	} 
else 
{
$error= 'La tentative de connexion FTP a échoué !<br>';
}
ftp_close($connection);
?>