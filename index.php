<?php include_once("inc/header.php"); ?>

<h1 class="center">Bienvenue sur notre site de comparaison de micros !</h1>
 <br>
 <div class="wrapperImages">
<?php 
$bdd = PDOFactory::getMySQLConnection();
$mm = new MicroManager($bdd);
$micros = $mm->get_micros();

foreach($micros as $micro){
    echo '<img src="img/' . $micro->get_image() . '" alt="" class="imgCarouselle">';  
}
?>
</div>






<?php include_once("inc/footer.php"); ?>