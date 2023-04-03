<?php

class Voiture {
    // public  string $marque;
    // public  string $modele;
    private int $idvoiture;
    private string $marque;
    private string $modele;

    // GETTER MARQUE
    public function getMarque() {
        return strtoupper($this->marque);
    }
    // SETTER MARQUE
    public function setMarque($p_marque) {
        $this->marque = $p_marque;
    }

    // GETTER MODELE
    public function getModele() {
        return strtoupper($this->modele);
    }
    // SETTER MODELE
    // public function setModele($p_modele) {
    //     $this->modele = $p_modele;
    // }
    private function setModele($p_modele) {
        $this->modele = $p_modele;
    }

    public function __construct($p_marque, $p_modele) {
        // echo "Vehicule : constructeur".PHP_EOL;
        $this->marque = $p_marque;
        $this->modele = $p_modele;
    }

    public function __toString() {
        $str =  "Véhicule de marque ".$this->marque." et de modèle ".$this->modele.".".PHP_EOL;
        return $str;
    }
}