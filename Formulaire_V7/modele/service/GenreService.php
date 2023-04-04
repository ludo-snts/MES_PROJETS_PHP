<?php

//NAMESPACE
namespace modele\service;
//USE ... AS
use modele\dao\GenreDao as GenreDao;
use modele\dao\exception\ExceptionDao as ExceptionDao;
use modele\service\exception\ExceptionService as ExceptionService;



//AUTOLOADER
require_once '../autoloader.php';

class GenreService {

    private $hgenreDao;

    public function __construct() {
        try {
            $hgenreService = $this->hgenreDao = new GenreDao();
            return $hgenreService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('GenreService : CONNEXION BDD : KO');
        }
    }

    public function afficher() {
        try {
            $hgenreService = $this->hgenreDao->afficher();
            return $hgenreService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('GenreService : AFFICHER : KO');
        }
    }

    public function afficherun($id) {
        try {
            $hgenreService = $this->hgenreDao->afficherun($id);
            return $hgenreService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('GenreService : AFFICHER UN : KO');
        }
    }
}