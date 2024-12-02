<?php
include_once("inc/header.php"); 

$mm = new MicroManager($bdd);

$micro = $mm->getMicroById($_REQUEST['id']);


if(isset($micro)){
?>
<div class="center micro">

<h2> <?= $micro->get_marque() . " " . $micro->get_modele()?> </h2>
<?php 

}
else
{
    echo "Ce micro n'existe pas...";
}
?>
</div>

<a href="listeMicro.php" class="boutonRetour">Retour à la liste des micros</a>
