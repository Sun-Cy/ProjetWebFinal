<?php 
 require_once './classe/microClasse.php';

class MicroManager{
    private $_db;
CONST GET_MICRO="USE Microphone; SELECT mi.idMicro, m.marque,mi.modele,g.garantie,i.interface,mi.image,mi.prix,mi.lienAchat,c.cartouche,mi.frequenceMin,mi.frequenceMax,mi.maxSPL,mi.ratedImpedance,mi.RGB FROM microphone mi JOIN marque m ON mi.idMarque = m.idMarque JOIN garantie g ON mi.idGarantie = g.idGarantie JOIN interface i ON mi.idInterface = i.idInterface JOIN cartouche c ON mi.idCartouche = c.idCartouche";
CONST ADD_MICRO="";

CONST GET_MICRO_BY_ID="USE Microphone; SELECT mi.idMicro, m.marque,mi.modele,g.garantie,i.interface,mi.image,mi.prix,mi.lienAchat,c.cartouche,mi.frequenceMin,mi.frequenceMax,mi.maxSPL,mi.ratedImpedance,mi.RGB FROM microphone mi JOIN marque m ON mi.idMarque = m.idMarque JOIN garantie g ON mi.idGarantie = g.idGarantie JOIN interface i ON mi.idInterface = i.idInterface JOIN cartouche c ON mi.idCartouche = c.idCartouche WHERE idMicro = :idMicro;";

    public function __construct($db) 
    {
        assert(is_a($db, 'PDO'), 'La classe "MicroManager" doit recevoir une instance (un objet) de la classe "PDO" lors de l\'appel à son constructeur.');
        $this->_db = $db;
    }

    public function get_micro(){
        $microArray = array();

        $dbResult = $this->_db->query(self::GET_MICRO)->fetchAll();

        foreach($dbResult as $row){
            array_push($microArray, new Micro($row));
        }
        return $microArray;
    }

    public function getMicroById(int $idMicro) {
        
        $query = $this->_db->prepare(self::GET_MICRO_BY_ID);
        $query->execute(array("idMicro" => $idMicro));
        $dbResult = $query->fetch();
        
        assert(!empty($dbResult), 'didnt work man');
  
        return new Micro($dbResult);
      }











      
};