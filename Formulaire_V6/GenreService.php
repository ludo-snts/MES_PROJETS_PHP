<?php

// require_once 'Connexion.php';
// require_once 'Genre.php';
require_once 'GenreDao.php';

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