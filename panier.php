<?php
session_start();

include_once("./inc/autoLoader.php");
require_once("./classe/PDOFactory.php");
require_once("./inc/header.php");

$conn = PDOFactory::getMySQLConnection();
$clientManager = new ClientManager($conn);
$microManager = new MicroManager($conn);

// Generate a fictional Commande if it doesn't exist in the session
if (!isset($_SESSION['commande'])) {
    // Generate fictional data
    $micros = [1, 2, 3]; // Example microphone IDs
    $quantite = 3;
    $prixTotal = 299.97; // Example total price
    $dateCommande = date('Y-m-d H:i:s');

    // Create a fictional Commande object
    $commande = new Commande(null, null, $micros, $dateCommande, $quantite, $prixTotal);

    // Store the Commande object in the session
    $_SESSION['commande'] = serialize($commande);
} else {
    $commande = unserialize($_SESSION['commande']);
}

$idClient = isset($_SESSION['client']) ? unserialize($_SESSION['client'])->getId() : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Redirect to commande.php for further processing
    header("Location: passerCommande.php");
    exit();
}

// Calculate taxes
$prixTotal = $commande->getPrixTotal();
$gst = $prixTotal * 0.05;
$qst = $prixTotal * 0.09975;
$totalWithTaxes = $prixTotal + $gst + $qst;

$conn = null;
?>

<div class="panier"s>
    <h2>Panier</h2>
    <ul>
        <?php foreach ($commande->getMicros() as $microId): ?>
            <?php
            // Fetch the Micro details using MicroManager
            $micro = $microManager->getMicroById($microId);
            ?>
            <li>
                <img src="./img/<?php echo $micro->get_image(); ?>" alt="<?php echo $micro->get_modele(); ?>" width="100">
                <p>Modèle: <?php echo $micro->get_modele(); ?></p>
                <p>Prix: <?php echo number_format($micro->get_prix(),2); ?> $</p>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="details">
        <p>Quantité: <?php echo $commande->getQuantite(); ?></p>
        <p>Prix Total: <?php echo number_format($prixTotal, 2); ?> $</p>
        <p>GST (5%): <?php echo number_format($gst, 2); ?> $</p>
        <p>QST (9.975%): <?php echo number_format($qst, 2); ?> $</p>
        <p>Total avec taxes: <?php echo number_format($totalWithTaxes, 2); ?> $</p>
    </div>

    <form action="panier.php" method="post">
        <button type="submit">Passer la commande</button>
    </form>
</div>