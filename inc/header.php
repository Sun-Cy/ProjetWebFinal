<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Microphone</title>
    <script src="js/script.js" defer></script>
</head>

<body>

    <header>
        <nav class="main-menu">
            <div class="menu-container">
                <div class="site-icon">
                    <img src="icon.png" alt="Site Icon" class="icon">
                </div>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="listeMicro.php">Microphone</a></li>
                    <li><a href="ajoutMicro.php">Ajout</a></li>
                    <li><a href="review.php">Revue</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>