<?php
session_start();

include_once("./inc/autoLoader.php");
require_once("./classe/PDOFactory.php");
require_once("./inc/header.php");

$clientManager = new ClientManager($bdd);
$microManager = new MicroManager($bdd);

if (isset($_POST['action']) && $_POST['action'] === 'vider') {
    unset($_SESSION['commande']);
    setcookie('commande', '', time() - 3600, "/"); // Delete the cookie
    header("Location: panier.php");
    exit();
}

if (!isset($_SESSION['commande'])) {
    if (isset($_COOKIE['commande'])) {
        $commande = unserialize($_COOKIE['commande']);
    } else {
        $commande = null;
    }
} else {
    $commande = unserialize($_SESSION['commande']);
}

$idClient = isset($_SESSION['client']) ? unserialize($_SESSION['client'])->getId() : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    header("Location: passerCommande.php");
    exit();
}

$sousTotal = $commande ? $commande->getPrixTotal() : 0;
$tps = $sousTotal * 0.05;
$tvq = $sousTotal * 0.09975;
$total = $sousTotal + $tps + $tvq;

$conn = null;
?>

<div class="panier">
    <h2>Panier</h2>
    <?php if ($commande && count($commande->getMicros()) > 0): ?>
        <ul>
            <?php foreach ($commande->getMicros() as $microId): ?>
                <?php
                $micro = $microManager->getMicroById($microId);
                ?>
                <li>
                    <img src="./img/<?php echo $micro->get_image(); ?>" alt="<?php echo $micro->get_modele(); ?>" width="100">
                    <p>Modèle: <?php echo $micro->get_modele(); ?></p>
                    <p>Prix: <?php echo number_format($micro->get_prix(), 2); ?> $</p>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="details">
            <p>Quantité d'items: <?php echo $commande->getQuantite(); ?></p>
            <p>Sous-total: <?php echo number_format($sousTotal, 2); ?> $</p>
            <p>TPS (5%): <?php echo number_format($tps, 2); ?> $</p>
            <p>TVQ (9.975%): <?php echo number_format($tvq, 2); ?> $</p>
            <p><strong>Total : <?php echo number_format($total, 2); ?> $ </strong></p>
        </div>
        <form action="panier.php" method="post">
            <button type="submit">Passer la commande</button>
        </form>
        <form action="panier.php" method="post">
            <input type="hidden" name="action" value="vider">
            <button type="submit">Vider Panier</button>
        </form>
    <?php else: ?>
        <div class="empty-cart">
            <img src="./img/emptyCart.png" alt="Panier Vide" class="empty-cart-img">
            <p>Aucun item dans le panier</p>
        </div>
    <?php endif; ?>
</div>
</main>