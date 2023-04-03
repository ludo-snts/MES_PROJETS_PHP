<?php

class Garage {

    private $tab_voiture = array();


    public function __construct() {
    }

    public function ajouterVoiture($voiture){
        array_push($this->tab_voiture, $voiture);
    }

    // __toString de Garage appelle le __toString de Voiture (avec $voiture)
    public function __toString() {
        $infos = "Voitures dans le garage : ".PHP_EOL;
        foreach ($this->tab_voiture as $voiture){
            $infos = $infos.$voiture;
        }
        return $infos;
    }

}