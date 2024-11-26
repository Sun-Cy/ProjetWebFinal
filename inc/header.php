<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
include_once("classe/autoloader.php");
include_once("classe/PDOFactory.php");

$bdd = PDOFactory::getMySQLConnection();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Réservation de voiture</title>
    <script src="js/script.js" defer></script>
</head>

<body>

    <main>

        <nav class="main-menu">
            <ul>
                <li><a href="index.php">Accueil</a></li>
            </ul>
        </nav>