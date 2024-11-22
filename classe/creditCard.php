<?php 

class CreditCard
{
    private $_idCreditCard;
    private $_name;
    private $_number;
    private $_expirationDate;
    private $_cvv;
    private $_idUser;

    public function __construct($idCreditCard, $name, $number, $expirationDate, $cvv, $idUser){
        $this->_idCreditCard = $idCreditCard;
        $this->_name = $name;
        $this->_number = $number;
        $this->_expirationDate = $expirationDate;
        $this->_cvv = $cvv;
        $this->_idUser = $idUser;
    }
}
?>
?>