<?php
include_once("./inc/autoLoader.php");
require_once("./classe/PDOFactory.php");
require_once("./inc/header.php");

$conn = PDOFactory::getMySQLConnection();
$clientManager = new ClientManager($conn);

$idClient = isset($_SESSION['client']) ? unserialize($_SESSION['client'])->getId() : null;
$client = isset($_SESSION['client']) ? unserialize($_SESSION['client']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['prenom'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $adresse = $_POST['adresse'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $creditCardName = $_POST['creditCardName'] ?? '';
    $creditCardNumber = $_POST['creditCardNumber'] ?? '';
    $creditCardExpiration = $_POST['creditCardExpiration'] ?? '';
    $creditCardCVV = $_POST['creditCardCVV'] ?? '';
    $micros = explode(',', $_POST['micros'] ?? '');
    $quantite = $_POST['quantite'] ?? 1;
    $prixTotal = $_POST['prixTotal'] ?? 0.0;
    $dateCommande = date('Y-m-d H:i:s');

    if ($idClient === null) {
        // Create a new guest client
        $newClient = new Client($prenom, $nom, $email, '', $adresse, $telephone, null);
        $clientManager->addClient($newClient);
        $idClient = $conn->lastInsertId();
    }

    // Create a new credit card object
    $creditCard = new CreditCard(null, $creditCardName, $creditCardNumber, $creditCardExpiration, $creditCardCVV, $idClient);

    // Create a new order
    $newCommande = new Commande(null, $idClient, $micros, $dateCommande, $quantite, $prixTotal);
    $clientManager->addCommande($newCommande);

    echo "Order placed successfully!";
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande</title>
</head>
<body>
    <h2>Commande</h2>
    <form action="commande.php" method="post">
        <fieldset>
            <legend>Informations personnelles</legend>
            <label for="prenom">Prénom: </label>
            <input type="text" name="prenom" id="prenom" value="<?php echo $client ? $client->getPrenom() : ''; ?>" required><br><br>

            <label for="nom">Nom: </label>
            <input type="text" name="nom" id="nom" value="<?php echo $client ? $client->getNom() : ''; ?>" required><br><br>

            <label for="email">Email: </label>
            <input type="email" name="email" id="email" value="<?php echo $client ? $client->getEmail() : ''; ?>" required><br><br>

            <label for="adresse">Adresse: </label>
            <input type="text" name="adresse" id="adresse" value="<?php echo $client ? $client->getAdresse() : ''; ?>" required><br><br>

            <label for="telephone">Téléphone: </label>
            <input type="text" name="telephone" id="telephone" value="<?php echo $client ? $client->getTéléphone() : ''; ?>" required><br><br>
        </fieldset>

        <fieldset>
            <legend>Informations de la carte de crédit</legend>
            <label for="creditCardName">Nom sur la carte: </label>
            <input type="text" name="creditCardName" id="creditCardName" required><br><br>

            <label for="creditCardNumber">Numéro de carte: </label>
            <input type="text" name="creditCardNumber" id="creditCardNumber" required><br><br>

            <label for="creditCardExpiration">Date d'expiration: </label>
            <input type="text" name="creditCardExpiration" id="creditCardExpiration" required><br><br>

            <label for="creditCardCVV">CVV: </label>
            <input type="text" name="creditCardCVV" id="creditCardCVV" required><br><br>
        </fieldset>

        <input type="hidden" name="micros" value="<?php echo $_POST['micros'] ?? ''; ?>">
        <input type="hidden" name="quantite" value="<?php echo $_POST['quantite'] ?? ''; ?>">
        <input type="hidden" name="prixTotal" value="<?php echo $_POST['prixTotal'] ?? ''; ?>">

        <button type="submit">Passer la commande</button>
    </form>
</body>
</html>