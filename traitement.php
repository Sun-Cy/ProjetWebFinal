<?php

include_once("./inc/autoLoader.php");


// Simulate a stored client object (in a real application, this would come from a database)
$storedClient = new Client("John", "john@example.com", "password123", "123 Main St", "555-555-5555", new CreditCard(1, "John Doe", "1234567890123456", "12/23", "123", 1));

// Function to handle login
function login($username, $password) {
    global $storedClient;

    if ($storedClient->getEmail() === $username && $storedClient->getPassword() === $password) {
        return $storedClient;
    } else {
        return null;
    }
}

// Check if action is set to 'connexion'
if (isset($_POST['action']) && $_POST['action'] === 'connexion') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['mdp'] ?? '';

    // Attempt to login
    $client = login($username, $password);

    if ($client) {
        $_SESSION['client'] = $client;
        echo "Login successful! Welcome, " . $client->getPrenom() . ".";
    } else {
        echo "Login failed. Invalid username or password.";
    }
}
?>