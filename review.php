<?php 
require_once("./classe/PDOFactory.php");
include_once("inc/header.php"); 

//load les micros
$mm = new MicroManager($bdd);
$micros = $mm->get_micros();?>

<!--link pour les etoiles-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 class="center">Laisser une revue</h1>

<form action="./ajoutReview.php" method="post">
    <!-- List des micros dans la base de donne -->
    <label for="micro">Microphone</label> 
    <select name="micro" id="micro" onchange="saveInfo('micro')" required>
        <?php 
        foreach($micros as $micro){
            echo '<option value="' . $micro->get_idMicro() . '">' . $micro->get_marque() . " " . $micro->get_modele() . '</option>';
        }
        ?>
    </select>

    <!-- Titre de la revue -->
    <input type="text" name="titre" id="titre" value="Titre" onchange="saveInfo('titre')" required>

    <!-- nombre etoile sur 5 -->
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>

    <!-- Use to send the number of star class="hide"-->
    <input  type="text" name="rating" id="rating" value="0" required>

    <!-- texte de la revue -->
    <textarea name="textRevue" id="textRevue" rows="10" cols="100" oninput="saveInfo('textRevue')" required>Revue</textarea>

    <!-- Button submit -->
    <input type="hidden" name="action" value="ajoutReview">
    <button type="submit" onclick="effaceCookie()">Envoyer</button>

</form>

<?php include_once("inc/footer.php"); ?>