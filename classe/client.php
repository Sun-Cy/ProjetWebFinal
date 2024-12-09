<?php 
class Client {

    private $id;
    private $prenom;
    private $nom;
    private $email;
    private $password;
    private $adresse;
    private $téléphone;
    private $creditCard;

    public function __construct($prenom,$nom, $email, $password, $adresse, $téléphone, $creditCard){
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->adresse = $adresse;
        $this->téléphone = $téléphone;
        $this->creditCard = $creditCard;
    }

    // Getters
    
    public function getId() {
        return $this->id;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getNomComplet() {
        return $this->prenom . " " . $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getTéléphone() {
        return $this->téléphone;
    }

    public function getCreditCard() {
        return $this->creditCard;
    }

    // Setters

    public function setId($id) {
        $this->id = $id;
    }
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function setTéléphone($téléphone) {
        $this->téléphone = $téléphone;
    }

    public function setCreditCard( creditCard $creditCard) {
        $this->creditCard = $creditCard;
    }
}

?>