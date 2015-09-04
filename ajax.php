<?php
include 'morpion.php';
if(empty($_POST)){
	$etatActuel = array(array(null, null, null), array(null, null, null), array(null, null, null));
}else{
	$etatActuel = array(array($_POST['0-0'], $_POST['0-1'], $_POST['0-2']), array($_POST['1-0'], $_POST['1-1'], $_POST['1-2']), array($_POST['2-0'], $_POST['2-1'], $_POST['2-2']));
}


$grille = new Morpion($etatActuel);
echo $grille->game();
?>
