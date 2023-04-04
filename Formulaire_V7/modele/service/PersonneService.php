<?php

//NAMESPACE
namespace modele\service;
//USE ... AS
use modele\dao\PersonneDao as PersonneDao;
use modele\dao\exception\ExceptionDao as ExceptionDao;
use modele\service\exception\ExceptionService as ExceptionService;
//AUTOLOADER
require_once '../autoloader.php';

class PersonneService {

    private $hpersonneDao;

    public function __construct() {
        try {
            $hpersonneService = $this->hpersonneDao = new PersonneDao();
            return $hpersonneService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('PersonneService : CONNEXION BDD : KO') ;
        }
    }
    
    public function creer($hpersonneDao) {
        try {
            $hpersonneService = $this->hpersonneDao->creer($hpersonneDao);
            return $hpersonneService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('PersonneService : CREER : KO') ;
        }
    }

    public function afficher() {
        try {
            $hpersonneService = $this->hpersonneDao->afficher();
            return $hpersonneService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('PersonneService : AFFICHER : KO');
        }
    }
    
    // CRUD : METHODE AFFICHER UNE PERSONNE (SELECT * FROM ... WHERE ID=...) (READ)
    public function afficherun($id) {
        try {
            $hpersonneService =  $this->hpersonneDao->afficherun($id);
            return $hpersonneService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('PersonneService : AFFICHER UN : KO');
        }
    }

    // CRUD : METHODE MOFIFICATION (UPDATE)
    public function modifier($hpersonneDao) {
        try {
            $hpersonneService =  $this->hpersonneDao->modifier($hpersonneDao);
            return $hpersonneService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('PersonneService : MODIFIER : KO');
        }
    }

    // CRUD : METHODE SUPPRESSION (DELETE)
    public function supprimer($id) {
        try {
            $hpersonneService =  $this->hpersonneDao->supprimer($id);
            return $hpersonneService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('PersonneService : SUPPRIMER : KO');
        }
    }

    // LOGIN : METHODE VERIFICATION USERNAME / PASSWORD
    public function connecter() {
        try {
            $hpersonneService =  $this->hpersonneDao->connecter();
            return $hpersonneService;
        } catch (\Exception $e) {
            throw new ExceptionService('PersonneService : CONNECTER : KO');
        }
    }

}