<?php 
require_once("./classe/PDOFactory.php");
include_once("inc/header.php"); 

$conn = PDOFactory::getMySQLConnection();?>

<!--link pour les etoiles-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 class="center">Laisser une revue</h1>

<form action="./ajoutReview.php" method="post">
    <!-- List des micros dans la base de donne -->
    <label for="micro">Microphone</label> 
    <select name="micro" id="micro" onchange="saveInfo('micro')" onload="loadInfo('micro')">
        <option value="test">test</option>
        <option value="test">test</option>
        <?php 
        $bddResults = $conn->query(
            'SELECT m.idMicro, concat(m.modele, " ", ma.marque) FROM microphone AS m 
            JOIN marque AS ma ON m.idMicro=ma.marque;');
            while($fetchData = $bddResults->fetch()){
                echo '<option value='.$fetchData[0].'>'.$fetchData[1].'<option>';
            };
        ?>
    </select>

    <!-- Titre de la revue -->
    <input type="text" name="titre" id="titre" value="Titre" onchange="saveInfo('titre')" onload="loadInfo('titre')">

    <!-- nombre etoile sur 5 -->
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>

    <!-- Use to send the number of star -->
    <input class="hide" type="text" name="rating" id="rating" value="0">

    <!-- texte de la revue -->
    <textarea name="textRevue" id="textRevue" rows="10" cols="100" oninput="saveInfo('textRevue')" onload="loadInfo('textRevue')">Revue</textarea>

    <!-- Button submit -->
    <input type="hidden" name="action" value="ajoutReview">
    <button type="submit" onclick="effaceCookie()">Envoyer</button>

</form>

<?php include_once("inc/footer.php"); ?>