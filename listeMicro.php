<?php
include_once("inc/header.php"); 
$mv = new MicroManager($bdd);

$micros = $mv->get_micro();

foreach($micros as $micro){
    echo $micro->get_idMicro() . " " . $micro->get_modele() . " ";
    if($micro->get_RGB()){
        echo "avec RGB";
    }
    else{
        echo "Sans RGB";
    }
    echo "<br>";
}

?>

