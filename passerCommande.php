<?php

require_once("./inc/header.php");

$clientManager = new ClientManager($bdd);

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
        //ajoute un  client guest
        $newClient = new Client($prenom, $nom, $email, '', $adresse, $telephone, null);
        $clientManager->addClient($newClient);
        $idClient = $bdd->lastInsertId();
    }

    // créer une carte de crédit
    $creditCard = new CreditCard(null, $creditCardName, $creditCardNumber, $creditCardExpiration, $creditCardCVV, $idClient);

    // place la commande avec l'id client
    $commande->setIdClient($idClient);
    $clientManager->addCommande($commande);

    echo "<h2>Commande passée avec succès!</h2>";
    unset($_SESSION['commande']);
}


?>

<div class="containerForm">
    <h2>Commande</h2>
    <form action="passerCommande.php" method="post" class="inscription">
        <?php if (!$client): ?>
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

                <label for="email">Email: </label>
                <input type="email" name="email" id="email" required><br><br>
            </fieldset>
        <?php endif; ?>

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

        <div class="nav-arrows">
            <button type="button" id="prev-arrow" class="hide">&larr;</button>
            <button type="button" id="next-arrow">&rarr;</button>
        </div>

        <input type="hidden" name="micros" value="<?php echo implode(',', $commande->getMicros()); ?>">
        <input type="hidden" name="quantite" value="<?php echo $commande->getQuantite(); ?>">
        <input type="hidden" name="prixTotal" value="<?php echo $commande->getPrixTotal(); ?>">

        <button type="submit" class="hide">Passer la commande</button>
    </form>
    <p>Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
</div>
</main>