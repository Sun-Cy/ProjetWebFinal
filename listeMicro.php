<?php
include_once("inc/header.php"); 

$mm = new MicroManager($bdd);

$micros = $mm->get_micros();


?>
<div class="center listeMicro">
<?php
foreach($micros as $micro){
    echo '<a href="micro.php?id=' . $micro->get_idMicro() . '">' . $micro->get_marque() . " " . $micro->get_modele() . '</a>' . '<br>';
}
?>
</div>