<!-- Cette page affiche un tableau des observations-->
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
// Varibale d'erreur par soucis de lisibilité
// Evite d'imbriquer trop de if/else, on pourrait aisément s'en passer
$error = false;

// On définis nos constantes
$newName = bin2hex(random_bytes(32));
$path = "pdf";
$legalExtensions = array("pdf");
$legalSize = "100000000" ;// 100000000 Octets = 100 MO

// On récupères les infos
$file = $_FILES["mon_fichier"];
$actualName = $file['tmp_name'];
$actualSize = $file['size'];
// echo $actualName;
echo $actualSize;

$extension1 = pathinfo($_FILES['mon_fichier']['name']);
$extension = $extension1['extension'];


// On s'assure que le fichier n'est pas vide
if ($actualName == "" || $actualSize == 0) {
	echo 'fichier vide';
    $error = true;
}

// On vérifie qu'un fichier portant le même nom n'est pas présent sur le serveur
if (file_exists($path.'/'.$newName.'.'.$extension)) {
	echo 'meme nom';
    $error = true;
}

// On effectue nos vérifications réglementaires
if (!$error) {
    if ($actualSize < $legalSize) {
        if (in_array($extension, $legalExtensions)) {
            move_uploaded_file($actualName, $path.'/'.$newName.'.'.$extension);
        }
    }
}

else {
    
    // On supprime le fichier du serveur
    @unlink($path.'/'.$newName.'.'.$extension);
    
    echo "Une erreur s'est produite";
	// test
}
}
?>
</div><!-- #global -->

</body>
</html>