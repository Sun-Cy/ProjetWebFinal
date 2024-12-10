<?php 

class Commande {
    private $idCommande;
    private $idClient; // peut être nul si le client n'est pas connecté
    private $micros; 
    private $dateCommande;
    private $quantite;
    private $prixTotal;

    public function __construct($idCommande, $idClient, $micros, $dateCommande, $quantite, $prixTotal){
        $this->idCommande = $idCommande;
        $this->idClient = $idClient;
        $this->micros = $micros; // Array of microphone IDs
        $this->dateCommande = $dateCommande;
        $this->quantite = $quantite;
        $this->prixTotal = $prixTotal;
    }

    // Getters
    public function getIdCommande() {
        return $this->idCommande;
    }

    public function getIdClient() {
        return $this->idClient;
    }

    public function getMicros() {
        return $this->micros;
    }

    public function getDateCommande() {
        return $this->dateCommande;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function getPrixTotal() {
        return $this->prixTotal;
    }

    // Setters
    public function setIdCommande($idCommande) {
        $this->idCommande = $idCommande;
    }

    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    public function setMicros($micros) {
        $this->micros = $micros;
    }

    public function setDateCommande($dateCommande) {
        $this->dateCommande = $dateCommande;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    public function setPrixTotal($prixTotal) {
        $this->prixTotal = $prixTotal;
    }

    public function addMicro($microId) {
        $this->micros[] = $microId;
    }

   

   
}
?>