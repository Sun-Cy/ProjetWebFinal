<?php


include_once("./inc/autoLoader.php");
require_once("./classe/PDOFactory.php");
require_once("./inc/header.php");

$conn = PDOFactory::getMySQLConnection();
$clientManager = new ClientManager($conn);

$idClient = isset($_SESSION['client']) ? unserialize($_SESSION['client'])->getId() : null;
$client = isset($_SESSION['client']) ? unserialize($_SESSION['client']) : null;
$commande = isset($_SESSION['commande']) ? unserialize($_SESSION['commande']) : null;

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

    if ($idClient === null) {
        // Create a new guest client
        $newClient = new Client($prenom, $nom, $email, '', $adresse, $telephone, null);
        $clientManager->addClient($newClient);
        $idClient = $conn->lastInsertId();
    }

    // Create a new credit card object
    $creditCard = new CreditCard(null, $creditCardName, $creditCardNumber, $creditCardExpiration, $creditCardCVV, $idClient);

    // Update the order with the client ID
    $commande->setIdClient($idClient);
    $clientManager->addCommande($commande);

    echo "Order placed successfully!";
    unset($_SESSION['commande']);
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
    <form action="passerCommande.php" method="post">
        <fieldset>
            <legend>Informations personnelles</legend>
            <label for="prenom">Prénom: </label>
            <input type="text" name="prenom" id="prenom" value="<?php echo $client ? $client->getPrenom() : ''; ?>" <?php echo $client ? 'readonly' : 'required'; ?>><br><br>

            <label for="nom">Nom: </label>
            <input type="text" name="nom" id="nom" value="<?php echo $client ? $client->getNom() : ''; ?>" <?php echo $client ? 'readonly' : 'required'; ?>><br><br>

            <label for="email">Email: </label>
            <input type="email" name="email" id="email" value="<?php echo $client ? $client->getEmail() : ''; ?>" <?php echo $client ? 'readonly' : 'required'; ?>><br><br>

            <label for="adresse">Adresse: </label>
            <input type="text" name="adresse" id="adresse" value="<?php echo $client ? $client->getAdresse() : ''; ?>" <?php echo $client ? 'readonly' : 'required'; ?>><br><br>

            <label for="telephone">Téléphone: </label>
            <input type="text" name="telephone" id="telephone" value="<?php echo $client ? $client->getTéléphone() : ''; ?>" <?php echo $client ? 'readonly' : 'required'; ?>><br><br>
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

        <input type="hidden" name="micros" value="<?php echo implode(',', $commande->getMicros()); ?>">
        <input type="hidden" name="quantite" value="<?php echo $commande->getQuantite(); ?>">
        <input type="hidden" name="prixTotal" value="<?php echo $commande->getPrixTotal(); ?>">

        <button type="submit">Passer la commande</button>
    </form>
</body>
</html>