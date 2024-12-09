<?php


require_once("./inc/header.php");

$clientManager = new ClientManager($bdd);
$microManager = new MicroManager($bdd);

if (!isset($_SESSION['commande'])) {
    $micros = [1, 2, 3];
    $quantite = 3;
    $sousTotal = 299.97;
    $dateCommande = date('Y-m-d H:i:s');

    $commande = new Commande(null, null, $micros, $dateCommande, $quantite, $sousTotal);

    $_SESSION['commande'] = serialize($commande);
} else {
    $commande = unserialize($_SESSION['commande']);
}

$idClient = isset($_SESSION['client']) ? unserialize($_SESSION['client'])->getId() : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: passerCommande.php");
    exit();
}

$sousTotal = $commande->getPrixTotal();
$tps = $sousTotal * 0.05;
$tvq = $sousTotal * 0.09975;
$total = $sousTotal + $tps + $tvq;

$conn = null;
?>

<div class="panier">
    <h2>Panier</h2>
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
</div>
</main>