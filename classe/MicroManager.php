<?php 
 require_once './classe/microClasse.php';

class MicroManager{
    private $_db;
CONST GET_MICROS="SELECT mi.idMicro, m.marque,mi.modele,g.garantie,i.interface,mi.image,mi.prix,mi.lienAchat,c.cartouche,mi.frequenceMin,mi.frequenceMax,mi.maxSPL,mi.ratedImpedance,mi.RGB FROM microphone mi JOIN marque m ON mi.idMarque = m.idMarque JOIN garantie g ON mi.idGarantie = g.idGarantie JOIN interface i ON mi.idInterface = i.idInterface JOIN cartouche c ON mi.idCartouche = c.idCartouche ORDER BY idMicro ASC";
CONST ADD_MICRO="INSERT INTO microphone (idMarque,modele,idGarantie,idInterface,image,prix,lienAchat,idCartouche,frequenceMin,frequenceMax,maxSPL,ratedImpedance,RGB)VALUES ((SELECT idMarque FROM marque WHERE marque = :marque),:modele,(SELECT idGarantie FROM garantie WHERE garantie = :garantie),(SELECT idInterface FROM interface WHERE interface = :interface),:img,:prix,:lien,(SELECT idCartouche FROM cartouche WHERE cartouche = :cartouche),:frequMin,:frequMax,:maxSPL,:ratedImp,:rgb)";
 CONST GET_MARQUE="SELECT marque FROM marque WHERE marque = :marque";
 CONST ADD_MARQUE_IF_NOT_EXIST="INSERT INTO marque (marque) VALUES (:marque)";
 CONST GET_GARANTIE="SELECT idGarantie AS id, garantie FROM garantie";
 CONST GET_INTERFACE="SELECT idInterface AS id, interface FROM interface";
 CONST GET_CARTOUCHE="SELECT idCartouche AS id, cartouche FROM cartouche";

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

    public function getMicroById(int $idMicro): Micro {
        
        $query = $this->_db->prepare(self::GET_MICRO_BY_ID);
        $query->execute(array("idMicro" => $idMicro));
        $dbResult = $query->fetch();
        
        assert(!empty($dbResult), 'didnt work man');
        
        return new Micro($dbResult);
      }   
      public function insertMicro($marque,$modele,$garantie,$interface,$img,$prix,$lien,$cartouche,$frequMin,$frequMax,$maxSPL,$ratedImp,$rgb){

        $query = $this->_db->prepare(self::GET_MARQUE);
        $query->execute(array("marque" => $marque));
        $dbResult = $query->fetchAll();

        if(empty($dbResult)){
            $query2 = $this->_db->prepare(self::ADD_MARQUE_IF_NOT_EXIST);
            $query2->bindParam(':marque',$marque);
            $query2->execute();
        }

        $query1 = $this->_db->prepare(self::ADD_MICRO);
        $query1->bindParam(':marque',$marque);
        $query1->bindParam(':modele',$modele);
        $query1->bindParam(':garantie',$garantie);
        $query1->bindParam(':interface',$interface);
        $query1->bindParam(':img',$img);
        $query1->bindParam(':prix',$prix);
        $query1->bindParam(':lien',$lien);
        $query1->bindParam(':cartouche',$cartouche);
        $query1->bindParam(':frequMin',$frequMin);
        $query1->bindParam(':frequMax',$frequMax);
        $query1->bindParam(':maxSPL',$maxSPL);
        $query1->bindParam(':ratedImp',$ratedImp);
        $query1->bindParam(':rgb',$rgb);
        $query1->execute();

      }
    public function get_garantie(){

        $garantieArr = Array();

        $dbResult = $this->_db->query(self::GET_GARANTIE)->fetchAll();

        foreach($dbResult as $row){
            array_push($garantieArr,$row);
        }
        return $garantieArr;
    }   
    public function get_interface(){

        $interfaceArr = Array();

        $dbResult = $this->_db->query(self::GET_INTERFACE)->fetchAll();

        foreach($dbResult as $row){
            array_push($interfaceArr,$row);
        }
        return $interfaceArr;
    }  
    public function get_cartouche(){

        $cartoucheArr = Array();

        $dbResult = $this->_db->query(self::GET_CARTOUCHE)->fetchAll();

        foreach($dbResult as $row){
            array_push($cartoucheArr,$row);
        }
        return $cartoucheArr;
    }  
};