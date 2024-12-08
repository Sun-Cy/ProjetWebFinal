<?php
require_once("./inc/header.php");
?>

<h2>Inscription</h2>
<form action="./traitement.php" method="post" class="inscription">
    <fieldset class="active">
        <legend>Informations personnelles</legend>
        <label for="prenom">Prénom: </label>
        <input type="text" name="prenom" id="prenom" required><br><br>

        <label for="nom">Nom: </label>
        <input type="text" name="nom" id="nom" required><br><br>

        <label for="adresse">Adresse: </label>
        <input type="text" name="adresse" id="adresse" required><br><br>

        <label for="telephone">Téléphone: </label>
        <input type="text" name="telephone" id="telephone" required><br><br>
    </fieldset>

    <fieldset>
        <legend>Informations de connexion</legend>
        <label for="username">Nom d'utilisateur: </label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="email">Email: </label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Mot de passe: </label>
        <input type="password" name="password" id="password" required><br><br>
    </fieldset>

    <input type="hidden" name="action" value="register">

    <div class="nav-arrows">
        <button type="button" id="prev-arrow" class="hide">&larr;</button>
        <button type="button" id="next-arrow">&rarr;</button>
    </div>

    <button type="submit" class="hide">S'inscrire</button>
</form>
<p>Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const fieldsets = document.querySelectorAll("form.inscription fieldset");
    const prevArrow = document.getElementById("prev-arrow");
    const nextArrow = document.getElementById("next-arrow");
    const submitButton = document.querySelector("form.inscription button[type='submit']");
    let currentFieldset = 0;

    function updateFieldsets() {
        fieldsets.forEach((fieldset, index) => {
            fieldset.classList.toggle("active", index === currentFieldset);
        });
        prevArrow.classList.toggle("hide", currentFieldset === 0);
        nextArrow.classList.toggle("hide", currentFieldset === fieldsets.length - 1);
        submitButton.classList.toggle("hide", currentFieldset !== fieldsets.length - 1);
    }

    prevArrow.addEventListener("click", function() {
        if (currentFieldset > 0) {
            currentFieldset--;
            updateFieldsets();
        }
    });

    nextArrow.addEventListener("click", function() {
        if (currentFieldset < fieldsets.length - 1) {
            currentFieldset++;
            updateFieldsets();
        }
    });

    updateFieldsets();
});
</script>