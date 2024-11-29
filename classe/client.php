<?php 
class Client {

    private $prenom;
    private $email;
    private $password;
    private $adresse;
    private $téléphone;
    private $creditCard;

    public function __construct($prenom, $email, $password, $adresse, $téléphone, $creditCard){
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->adresse = $adresse;
        $this->téléphone = $téléphone;
        $this->creditCard = $creditCard;
    }

    // Getters
    public function getPrenom() {
        return $this->prenom;
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
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
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