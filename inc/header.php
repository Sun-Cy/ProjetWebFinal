<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
include_once("inc/autoloader.php");
include_once("classe/PDOFactory.php");

$bdd = PDOFactory::getMySQLConnection();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "connexion"){
    $_SESSION['username'] = $_REQUEST['username']; 
    
} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == "logout"){ 

    $_SESSION = array();
    session_destroy(); 
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!DOCTYPE html>
<html lang="fr">     

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Microphone</title>
    <script src="js/script.js" defer></script>
</head>

<body onload="loadInfo()">

    <header>
        <nav class="main-menu">
            <div class="menu-container">
                <a href="index.php" class="site-icon">
                    <img src="img/micIcon.png" alt="Site Icon" class="icon">
                </a>
                <ul class="menu-items">
                    <li><a href="listeMicro.php">Microphones</a></li>
                    <li><a href="ajoutMicro.php">Ajout</a></li>
                    <li><a href="review.php">Revue</a></li>
                </ul>
                <a href="panier.php" class="site-icon">
                    <img src="img/shoppingCart.png" alt="Panier Icon" class="icon">
                </a>

                <?php if (isset($_SESSION['client'])): ?>
                    <a href="index.php?action=logout" class="site-icon">Se déconnecter</a>
                <?php else: ?>
                    <a href="login.php" class="site-icon">Ouvrir une session</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>