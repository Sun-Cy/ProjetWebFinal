<?php
include_once("inc/header.php"); 
$mv = new MicroManager($bdd);
$micros = array();
$micros = $mv->get_micro();
$unMicro = $mv->getMicroById(1);

echo $unMicro->get_cartouche();

foreach($micros as $micro){
echo $micro->get_cartouche() . '<br>';
}
echo "YO WTF";

?>