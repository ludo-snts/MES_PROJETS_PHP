<?php

//NAMESPACE
namespace modele\service;
//USE ... AS
use modele\entite\Personne as Personne;
use modele\entite\Genre as Genre;
use modele\entite\Role as Role;

use modele\dao\PersonneDao as PersonneDao;
use modele\dao\GenreDao as GenreDao;
use modele\dao\RoleDao as RoleDao;


// require_once 'Connexion.php';
// require_once 'Genre.php';
// require_once '../entite/Role.php';
require_once '../autoloader.php';

class GenreService {

    private $hgenreDao;

    public function __construct() {
        $hgenreService = $this->hgenreDao = new GenreDao();
        return $hgenreService;
    }

    public function afficher() {
        $hgenreService = $this->hgenreDao->afficher();
        return $hgenreService;
    }

    public function afficherun($id) {
        $hgenreService = $this->hgenreDao->afficherun($id);
        return $hgenreService;
    }
}