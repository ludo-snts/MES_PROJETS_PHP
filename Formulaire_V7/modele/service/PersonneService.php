<?php

//NAMESPACE
namespace modele\service;
//USE ... AS
use modele\dao\PersonneDao as PersonneDao;



// require_once 'Connexion.php';
// require_once 'Personne.php';
// require_once '../dao/PersonneDao.php';
require_once '../autoloader.php';

class PersonneService {

    private $hpersonneDao;

    public function __construct() {
        $this->hpersonneDao = new PersonneDao();
    }
    
    // CRUD : METHODE CREATION (CREATE)
    public function creer($hpersonneDao) {
        $hpersonneService = $this->hpersonneDao->creer($hpersonneDao);
        return $hpersonneService;
    }

    // CRUD : METHODE AFFICHER TOUTE LA TABLE (SELECT * FROM ...) (READ)
    public function afficher() {
        $hpersonneService = $this->hpersonneDao->afficher();
        return $hpersonneService;
    }
    
    // CRUD : METHODE AFFICHER UNE PERSONNE (SELECT * FROM ... WHERE ID=...) (READ)
    public function afficherun($id) {
        $hpersonneService =  $this->hpersonneDao->afficherun($id);
        return $hpersonneService;
    }

    // CRUD : METHODE MOFIFICATION (UPDATE)
    public function modifier($hpersonneDao) {
        $hpersonneService =  $this->hpersonneDao->modifier($hpersonneDao);
        return $hpersonneService;
    }

    // CRUD : METHODE SUPPRESSION (DELETE)
    public function supprimer($id) {
        $hpersonneService =  $this->hpersonneDao->supprimer($id);
        return $hpersonneService;
    }

    // LOGIN : METHODE VERIFICATION USERNAME / PASSWORD
    public function connecter() {
        $hpersonneService =  $this->hpersonneDao->connecter();
        return $hpersonneService;
    }

}