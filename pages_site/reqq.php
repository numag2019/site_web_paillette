<?php



$reqadd="INSERT INTO previsions (id_prevision , nbr_paillettes, id_periode	 , id_vache , id_taureau) 
							VALUES ($id_prevision , $nbr_paillettes,id_periode	 , $id_vache , $id_taureau)";
if(!empty($_POST['envoyer'])) {
    echo "Bonjour !";
    // ou echo afficher();
}
?>
 
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <input type="submit" id="envoyer" name="envoyer" value="envoyer">
<form>