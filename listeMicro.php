<?php
include_once("inc/header.php"); 
$mv = new MicroManager($bdd);
$micros = $mv->get_micro();


foreach($micros as $micro){
echo $micro->get_cartridge();
}


?>