<?php
session_start();

include_once("./inc/autoLoader.php");
require_once("./classe/PDOFactory.php");
require_once("./inc/header.php");


$clientManager = new ClientManager($bdd);
$microManager = new MicroManager($bdd);

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
    $logMessage = "Commande created and stored in session.";
} else {
    $commande = unserialize($_SESSION['commande']);
    $logMessage = "Commande retrieved from session.";
}

// Log the Commande object details
$logMessage .= "\nCommande details: " . var_export($commande, true);

// Log all objects in the session
$logMessage .= "\nSession contents: " . var_export($_SESSION, true);

$idClient = isset($_SESSION['client']) ? unserialize($_SESSION['client'])->getId() : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Redirect to passerCommande.php for further processing
    header("Location: passerCommande.php");
    exit();
}

// Calculate taxes
$sousTotal = $commande->getPrixTotal();
$logMessage .= "\nSous-total: " . var_export($sousTotal, true);
$tps = $sousTotal * 0.05;
$tvq = $sousTotal * 0.09975;
$total = $sousTotal + $tps + $tvq;
$logMessage .= "\nTPS: " . var_export($tps, true);
$logMessage .= "\nTVQ: " . var_export($tvq, true);
$logMessage .= "\nTotal: " . var_export($total, true);


?>

<script>
    console.log(<?php echo json_encode($logMessage); ?>);
</script>

<div class="panier">
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