
<?php



require_once("./inc/header.php");

$conn = PDOFactory::getMySQLConnection();

$clientManager = new ClientManager($bdd);

$messageClass = '';

?> 
<div class="container">
    


<?php
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'register') {
        $prenom = $_POST['prenom'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $adresse = $_POST['adresse'] ?? '';
        $telephone = $_POST['telephone'] ?? '';

        $newClient = new Client($prenom, $nom, $email, $password, $adresse, $telephone, null);
        $clientManager->addClient($newClient);
        $messageClass = 'success';
        ?>
        <div class="message success">
            <p>Inscription réussie ! Vous pouvez maintenant vous connecter.</p>
        </div>
        <?php
    } elseif ($_POST['action'] === 'connexion') {
        $email = $_POST['username'] ?? '';
        $password = $_POST['mdp'] ?? '';

        $client = $clientManager->getClientByEmailAndPassword($email, $password);

        if ($client) {
            $_SESSION['client'] = serialize($client);
            $messageClass = 'success';
            ?>
            <div class="message success">
                <p>Authentification réussie ! Bon magasinage, <?php echo $client->getNomComplet(); ?>.</p>
                <a href="listeMicro.php">Commencer le magasinage</a>
            </div>
            <?php
        } else {
            $messageClass = 'error';
            ?>
            <div class="message error">
                Authentification ratée. Veuillez entrer des informations valides.
            </div>
            <?php
        }
    }
}

$conn = null;
?>

</div>
</main>