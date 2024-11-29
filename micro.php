<?php
include_once("inc/header.php"); 

$mm = new MicroManager($bdd);

$micro = $mm->getMicroById($_REQUEST['id']);


if(isset($micro)){
?>


<h2> <?= $micro->get_marque() . " " . $micro->get_modele()?> </h2>
<?php 







}
else
{
    echo "Ce micro n'existe pas...";
}
?>

<a href="listeMicro.php" class="right">Retour à la liste des micros</a>