<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta charset="UTF-8">
	<title>
			Importation pdf
	</title>
</head>

<body>
<form method="post" action="" enctype ="multipart/form-data">
    <label for="mon_fichier">Fichier (formats pdf) :</label><br><br>
    <input type="file" name="mon_fichier" id="mon_fichier" /><br><br>
    <input type="submit" name="fichier" value="Envoyer" />
</form>

<?php

if(isset($_FILES['mon_fichier']))
{
$file = $_FILES["mon_fichier"] ;// on récupère le fichier

$ftpServer = 'localhost';
$ftpUser = 'admin';
$ftpPwd = 'admin';
$ftpTarget = '/eleveur/';
$log= '<h3>Tentative de connexion FTP...</h3>';
  $connection = ftp_connect($ftpServer);
  $login = ftp_login($connection, $ftpUser, $ftpPwd);
  if ($connection && $login) 
  {
    $log= 'La tentative de connexion FTP a réussi !<br>';
    $upload = ftp_put($connection, $ftpTarget.$file, $path . $savedFile, FTP_BINARY);
    if ($upload) 
	{
      $log= '<span style="color:#090">Le téléversement par FTP a réussi !</span><br>';
    } 
	else 
	{
      $log= '<span style="color:#900">Le téléversement par FTP a échoué !</span><br>';
    }
  } 
  else 
  {
    $log= 'La tentative de connexion FTP a échoué !<br>';
  }
  ftp_close($connection);
 // exit();
}
?>
</div><!-- #global -->

</body>
</html>