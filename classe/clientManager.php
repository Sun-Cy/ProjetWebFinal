<?php
require_once './classe/client.php';

class ClientManager {
    private $_db;

    const ADD_CLIENT = "INSERT INTO Utilisateur (username, password, email, prenom, nom, adresse, telephone) VALUES (:username, :password, :email, :prenom, :nom, :adresse, :telephone)";
    const GET_CLIENT_BY_EMAIL_AND_PASSWORD = "SELECT * FROM Utilisateur WHERE email = :email AND password = :password";
    const ADD_COMMANDE = "INSERT INTO Commandes (idClient, dateCommande, quantite, prixTotal) VALUES (:idClient, :dateCommande, :quantite, :prixTotal)";
    const ADD_COMMANDE_MICRO = "INSERT INTO CommandeMicro (idCommande, idMicro) VALUES (:idCommande, :idMicro)";

    public function __construct($db) {
        assert(is_a($db, 'PDO'), 'La classe "ClientManager" doit recevoir une instance (un objet) de la classe "PDO" lors de l\'appel à son constructeur.');
        $this->_db = $db;
    }

    public function addClient(Client $client) {
        $query = $this->_db->prepare(self::ADD_CLIENT);
        $query->execute(array(
            'username' => $client->getEmail(),
            'password' => $client->getPassword(),
            'email' => $client->getEmail(),
            'prenom' => $client->getPrenom(),
            'nom' => $client->getNom(),
            'adresse' => $client->getAdresse(),
            'telephone' => $client->getTéléphone()
        ));
    }

    public function getClientByEmailAndPassword($email, $password) {
        $query = $this->_db->prepare(self::GET_CLIENT_BY_EMAIL_AND_PASSWORD);
        $query->execute(array(
            'email' => $email,
            'password' => $password
        ));
        $dbResult = $query->fetch();

        if ($dbResult) {
            return new Client($dbResult['prenom'],$dbResult['nom'], $dbResult['email'], $dbResult['password'], $dbResult['adresse'], $dbResult['telephone'], null);
        } else {
            return null;
        }
    }

    public function addCommande(Commande $commande) {
        $query = $this->_db->prepare(self::ADD_COMMANDE);
        $query->execute(array(
            'idClient' => $commande->getIdClient(),
            'dateCommande' => $commande->getDateCommande(),
            'quantite' => $commande->getQuantite(),
            'prixTotal' => $commande->getPrixTotal()
        ));
        $idCommande = $this->_db->lastInsertId();

        foreach ($commande->getMicros() as $idMicro) {
            $query = $this->_db->prepare(self::ADD_COMMANDE_MICRO);
            $query->execute(array(
                'idCommande' => $idCommande,
                'idMicro' => $idMicro
            ));
        }
    }
}
?>