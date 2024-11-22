<?php

class Micro
{
    private $_idMicro;
    private $_marque;
    private $_modele;
    private $_garantie;
    private $_interface;
    private $_certification;
    private $_img;
    private $_prix;
    private $_lienAchat;
    private $_cartridge;
    private $_frequenceMin;
    private $_frequenceMax;
    private $_maxSPL;
    private $_ratedImpedance;
    private $_rgb;

    public function __construct($params = array()){
  
        foreach($params as $k => $v){

            $methodName = "set_" . $k;            
            if(method_exists($this, $methodName)) {
                $this->$methodName($v);
            }   
        }
    }
    /**
     * Get the value of _idMicro
     */ 
    public function get_idMicro()
    {
        return $this->_idMicro;
    }

    /**
     * Set the value of _idMicro
     *
     * @return  self
     */ 
    public function set_idMicro($_idMicro)
    {
        $this->_idMicro = $_idMicro;

        return $this;
    }

    /**
     * Get the value of _marque
     */ 
    public function get_marque()
    {
        return $this->_marque;
    }

    /**
     * Set the value of _marque
     *
     * @return  self
     */ 
    public function set_marque($_marque)
    {
        $this->_marque = $_marque;

        return $this;
    }

    /**
     * Get the value of _modele
     */ 
    public function get_modele()
    {
        return $this->_modele;
    }

    /**
     * Set the value of _modele
     *
     * @return  self
     */ 
    public function set_modele($_modele)
    {
        $this->_modele = $_modele;

        return $this;
    }

    /**
     * Get the value of _garantie
     */ 
    public function get_garantie()
    {
        return $this->_garantie;
    }

    /**
     * Set the value of _garantie
     *
     * @return  self
     */ 
    public function set_garantie($_garantie)
    {
        $this->_garantie = $_garantie;

        return $this;
    }

    /**
     * Get the value of _interface
     */ 
    public function get_interface()
    {
        return $this->_interface;
    }

    /**
     * Set the value of _interface
     *
     * @return  self
     */ 
    public function set_interface($_interface)
    {
        $this->_interface = $_interface;

        return $this;
    }

    /**
     * Get the value of _certification
     */ 
    public function get_certification()
    {
        return $this->_certification;
    }

    /**
     * Set the value of _certification
     *
     * @return  self
     */ 
    public function set_certification($_certification)
    {
        $this->_certification = $_certification;

        return $this;
    }

    /**
     * Get the value of _img
     */ 
    public function get_img()
    {
        return $this->_img;
    }

    /**
     * Set the value of _img
     *
     * @return  self
     */ 
    public function set_img($_img)
    {
        $this->_img = $_img;

        return $this;
    }

    /**
     * Get the value of _prix
     */ 
    public function get_prix()
    {
        return $this->_prix;
    }

    /**
     * Set the value of _prix
     *
     * @return  self
     */ 
    public function set_prix($_prix)
    {
        $this->_prix = $_prix;

        return $this;
    }

    /**
     * Get the value of _lienAchat
     */ 
    public function get_lienAchat()
    {
        return $this->_lienAchat;
    }

    /**
     * Set the value of _lienAchat
     *
     * @return  self
     */ 
    public function set_lienAchat($_lienAchat)
    {
        $this->_lienAchat = $_lienAchat;

        return $this;
    }

    /**
     * Get the value of _cartridge
     */ 
    public function get_cartridge()
    {
        return $this->_cartridge;
    }

    /**
     * Set the value of _cartridge
     *
     * @return  self
     */ 
    public function set_cartridge($_cartridge)
    {
        $this->_cartridge = $_cartridge;

        return $this;
    }

    /**
     * Get the value of _frequenceMin
     */ 
    public function get_frequenceMin()
    {
        return $this->_frequenceMin;
    }

    /**
     * Set the value of _frequenceMin
     *
     * @return  self
     */ 
    public function set_frequenceMin($_frequenceMin)
    {
        $this->_frequenceMin = $_frequenceMin;

        return $this;
    }

    /**
     * Get the value of _frequenceMax
     */ 
    public function get_frequenceMax()
    {
        return $this->_frequenceMax;
    }

    /**
     * Set the value of _frequenceMax
     *
     * @return  self
     */ 
    public function set_frequenceMax($_frequenceMax)
    {
        $this->_frequenceMax = $_frequenceMax;

        return $this;
    }

    /**
     * Get the value of _maxSPL
     */ 
    public function get_maxSPL()
    {
        return $this->_maxSPL;
    }

    /**
     * Set the value of _maxSPL
     *
     * @return  self
     */ 
    public function set_maxSPL($_maxSPL)
    {
        $this->_maxSPL = $_maxSPL;

        return $this;
    }

    /**
     * Get the value of _ratedImpedance
     */ 
    public function get_ratedImpedance()
    {
        return $this->_ratedImpedance;
    }

    /**
     * Set the value of _ratedImpedance
     *
     * @return  self
     */ 
    public function set_ratedImpedance($_ratedImpedance)
    {
        $this->_ratedImpedance = $_ratedImpedance;

        return $this;
    }

    /**
     * Get the value of _rgb
     */ 
    public function get_rgb()
    {
        return $this->_rgb;
    }

    /**
     * Set the value of _rgb
     *
     * @return  self
     */ 
    public function set_rgb($_rgb)
    {
        $this->_rgb = $_rgb;

        return $this;
    }
}