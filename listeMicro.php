<?php
include_once("inc/header.php"); 

$mm = new MicroManager($bdd);

$micros = $mm->get_micros();


?>
<div id="micro-liste-container" class="center">
<?php
foreach($micros as $micro){
    echo '<a id="liste-micro" href="micro.php?id=' . $micro->get_idMicro() . '">' . $micro->get_marque() . " " . $micro->get_modele() . '</a>' . '<br>';
}
?>
</div>