<?php 
require_once("./classe/PDOFactory.php");
include_once("inc/header.php"); 

$conn = PDOFactory::getMySQLConnection();?>

<!--link pour les etoiles-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 class="center">Laisser une revue</h1>
<form>
    <!-- List des micros dans la base de donne -->
    <label for="micro">Microphone</label> 
    <select name="micro" id="micro">
        <?php 

        $bddResults = $conn->query(
            'SELECT m.idMicro, concat(m.modele, " ",ma.marque) FROM microphone AS m 
            JOIN marque AS ma ON m.idMicro=ma.marque;');
            while($fetchData = $bddResults->fetch()){
                echo '<option value='.$fetchData[0].'>'.$fetchData[0].'<option>';
            };
        ?>
    </select>

    <!-- Titre de la revue -->
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre">

    <!-- nombre etoile sur 5 -->
    <span id="star" class="fa fa-star checked"></span>
    <span id="star" class="fa fa-star checked"></span>
    <span id="star" class="fa fa-star checked"></span>
    <span id="star" class="fa fa-star"></span>
    <span id="star" class="fa fa-star"></span>

    <!-- texte de la revue -->

    <!-- Button submit -->
</form>

<?php include_once("inc/footer.php"); ?>