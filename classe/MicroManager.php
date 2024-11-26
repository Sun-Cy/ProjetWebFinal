<?php 

class MicroManager{
    private $_db;

CONST ADD_MICRO="";

    public function __construct($db) { assert(is_a($db, 'PDO'), 'La classe "VoitureManager" doit recevoir une instance (un objet) de la classe "PDO" lors de l\'appel à son constructeur.');
      $this->_db = $db;}













      
};