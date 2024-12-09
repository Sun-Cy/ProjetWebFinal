<?php
include_once("inc/header.php"); 

$bdd = PDOFactory::getMySQLConnection();
$mm = new MicroManager($bdd);


if(isset($_REQUEST['id'])){
    $micro = $mm->getMicroById($_REQUEST['id']);
?>
<h2 class="center"> <?= $micro->get_marque() . " " . $micro->get_modele()?> </h2>
<div class="center micro">

<div class="microImg"><img src="img/<?= $micro->get_image() ?>" alt=""></div><br>
<div class="text">
   
<div><label for="">Garantie : </label><?= $micro->get_garantie() ?><br></div>
<div><label for="">Interface : </label><?= $micro->get_interface() ?><br></div>
<div><label for="">Prix : </label><?= $micro->get_prix() ?><br></div>
<div><label for="">Lien :</label><a href="<?= $micro->get_lienAchat() ?>"><?= $micro->get_marque() ?> <?= $micro->get_modele() ?></a><br></div>
<div><label for="">Garantie : </label><?= $micro->get_garantie() ?><br></div>
<div><label for="">Cartouche : </label><?= $micro->get_cartouche() ?><br></div>
<div><label for="">Fréquence Min (dB) : </label><?= $micro->get_frequenceMin() ?><br></div>
<div><label for="">Fréquence Max (dB) : </label><?= $micro->get_frequenceMax() ?><br></div>
<div><label for="">Max SPL (Sound Pressure Level en dB): </label><?php $maxSPL = $micro->get_maxSPL(); if(isset($maxSPL)){ echo $micro->get_maxSPL();} else{ echo 'Nul';} ?><br></div>
<div><label for="">Rated Impedance : </label><?php $ratedImp =  $micro->get_ratedImpedance(); if(isset($ratedImp)){ echo $micro->get_ratedImpedance();} else{ echo 'Nul';} ?><br></div>
<div><label for="">RGB : </label><?php if($micro->get_RGB() == true){echo 'Oui';}else{echo 'Non';} ?><br><br></div>
<a href="listeMicro.php" class="boutonRetour">Retour à la liste des micros</a>
</div>
<?php 
}
else
{
    echo '<p class"center">Aucun micro trouvé...</p>';
    echo '<a href="listeMicro.php" class="boutonRetour">Retour à la liste des micros</a>';
}
?>
<br>
<div>

</div>
</div>


