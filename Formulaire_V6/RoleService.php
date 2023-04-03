<?php

// require_once 'Connexion.php';
// require_once 'Role.php';
require_once 'RoleDao.php';

class RoleService {

    private $hroleDao;

    public function __construct() {
        $hroleService = $this->hroleDao = new RoleDao();
        return $hroleService;
    }

    public function afficher() {
        $hroleService = $this->hroleDao->afficher();
        return $hroleService;
    }

    public function afficherun($id) {
        $hroleService = $this->hroleDao->afficherun($id);
        return $hroleService;

    }
}