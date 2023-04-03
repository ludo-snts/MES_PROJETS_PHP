<?php

namespace modele\entite;


class Role {
    private int $id = -1;
    private string $libelle;

    // GETTER ID
    public function getId() {
        return $this->id;
    }

    // SETTER ID
    public function setId($id) {
        $this->id = $id;
    }

    // GETTER LIBELLÉ
    public function getLibelle() {
        return $this->libelle;
    }
    // SETTER LIBELLÉ
    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    // CONSTRUCTEUR
    public function __construct() {
    }

    // TOSTRING
    public function __toString() {
        $str =
        "ID : " . $this->id .
        " - libelle : " . $this->libelle;
        return $str;
    }
}
