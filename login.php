<?php
require_once("./inc/header.php");
?>

<form action="./traitement.php" method="post" class="login">


    <label for="username">Nom d'utilisateur: </label>
    <input type="text" name="username" id="username">



    <label for="mdp">Mot de passe: </label>
    <input type="password" name="mdp" id="mdp">


    <input type="hidden" name="action" value="connexion">


    <button type="submit">Se connecter</button>
    <p>Pas encore inscrit? <a href="inscription.php">Inscrivez-vous</a></p>

</form>