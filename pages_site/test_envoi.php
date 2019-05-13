
<?php 
include ('envoimail.php');
session_start();
envoimail('theo.nobella@agro-bordeaux.fr');
echo 'ok';?>