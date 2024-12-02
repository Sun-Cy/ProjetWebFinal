<?php 
 require_once './classe/microClasse.php';

class MicroManager{
    private $_db;
CONST GET_MICROS="SELECT mi.idMicro, m.marque,mi.modele,g.garantie,i.interface,mi.image,mi.prix,mi.lienAchat,c.cartouche,mi.frequenceMin,mi.frequenceMax,mi.maxSPL,mi.ratedImpedance,mi.RGB FROM microphone mi JOIN marque m ON mi.idMarque = m.idMarque JOIN garantie g ON mi.idGarantie = g.idGarantie JOIN interface i ON mi.idInterface = i.idInterface JOIN cartouche c ON mi.idCartouche = c.idCartouche ORDER BY idMicro ASC";
CONST ADD_MICRO="INSERT INTO microphone (idMarque,Modele,idGarantie,idInterface,image,prix,lienAchat,idCartouche,FrequenceMin,FrequenceMax,maxSPL,ratedImpedance,RGB)
VALUES ((SELECT idMarque FROM marque WHERE marque = 'Elgato'),'Wave:2',(SELECT idGarantie FROM garantie WHERE garantie = '1 an'), (SELECT idInterface FROM interface WHERE interface = 'USB-C'),
 'lol.123',69,'ok',(SELECT idCartouche FROM cartouche WHERE cartouche = 'Condenser'),1,10069,169,69,TRUE);";
 CONST GET_MARQUE="SELECT marque FROM marque WHERE marque = :marque";
 CONST ADD_MARQUE_IF_NOT_EXIST="INSERT INTO marque (marque) VALUES (':marque')";

CONST GET_MICRO_BY_ID="SELECT mi.idMicro, m.marque,mi.modele,g.garantie,i.interface,mi.image,mi.prix,mi.lienAchat,c.cartouche,mi.frequenceMin,mi.frequenceMax,mi.maxSPL,mi.ratedImpedance,mi.RGB FROM microphone mi JOIN marque m ON mi.idMarque = m.idMarque JOIN garantie g ON mi.idGarantie = g.idGarantie JOIN interface i ON mi.idInterface = i.idInterface JOIN cartouche c ON mi.idCartouche = c.idCartouche WHERE idMicro = :idMicro;";

    public function __construct($db) 
    {
        assert(is_a($db, 'PDO'), 'La classe "MicroManager" doit recevoir une instance (un objet) de la classe "PDO" lors de l\'appel à son constructeur.');
        $this->_db = $db;
    }

    public function get_micros(){
        $microArray = array();

        $query = $this->_db->prepare(self::GET_MICROS);
        $query->execute();
        $dbResult = $query->fetchAll();


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
      public function insertMicro($marque){

        $query = $this->_db->prepare(self::GET_MARQUE);
        $query->bindParam(':marque',$marque,PDO::PARAM_STR);
        $query->execute();
        $marqueResult = $query->fetch();

        if(empty($marqueResult)){
            $query = $this->_db->prepare(self::ADD_MARQUE_IF_NOT_EXIST);
            $query->bindParam(':marque',$marque);
        }
        else{

        }




      }   
};