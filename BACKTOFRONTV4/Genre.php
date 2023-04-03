<?php
class Genre {
    private int $id;
    private string $libelle;

    //-----------CONSTRUCTION DE GENRE-------------/////////
    public function __construct()
    {
    
    }

    //-------------SETTER -----------------------//////////

    public function  setId($id){
        $this->id = $id;
        
    }
    public function setLibelle($genre){
        $this->libelle = $genre;
    }


    //------------GETTER-----------------------/////////////

    public function getId(){
        return $this->id;
    }
    public function getLibelle(){
        return $this->libelle;
    }

    //------RETRENSCIPTION EN CHAINE DE CARACTERE ----------- ////////////

    public function __toString()
    {
        //  $this->id .
        $retour = $this->libelle ;
        return $retour;
    }

}