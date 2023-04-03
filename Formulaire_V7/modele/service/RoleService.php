<?php

//NAMESPACE
namespace modele\service;
//USE ... AS
use modele\dao\RoleDao as RoleDao;

// require_once 'Connexion.php';
// require_once 'Role.php';
// require_once '../dao/RoleDao.php';
require_once '../autoloader.php';

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