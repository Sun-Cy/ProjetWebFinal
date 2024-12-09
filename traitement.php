<?php
session_start();

include_once("./inc/autoLoader.php");
require_once("./classe/PDOFactory.php");
require_once("./inc/header.php");

$conn = PDOFactory::getMySQLConnection();

$clientManager = new ClientManager($conn);

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'register') {
        // Register a new client
        $prenom = $_POST['prenom'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $adresse = $_POST['adresse'] ?? '';
        $telephone = $_POST['telephone'] ?? '';

        $newClient = new Client($prenom, $nom, $email, $password, $adresse, $telephone, null);
        $clientManager->addClient($newClient);
        echo "Registration successful! You can now log in.";
    } elseif ($_POST['action'] === 'connexion') {
        // Attempt to login
        $email = $_POST['username'] ?? '';
        $password = $_POST['mdp'] ?? '';

        $client = $clientManager->getClientByEmailAndPassword($email, $password);

        if ($client) {
            $_SESSION['client'] = serialize($client);
            echo "Authentification réussie ! Bon magasinage, " . $client->getNomComplet() . ".";
        } else {
            echo "Authentification ratée. Veuillez entrez des informations valides..";
        }
    }
}

$conn = null;
?>