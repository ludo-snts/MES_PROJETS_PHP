<?php

//NAMESPACE
namespace modele\service;
//USE ... AS
use modele\dao\RoleDao as RoleDao;
use modele\dao\exception\ExceptionDao as ExceptionDao;
use modele\service\exception\ExceptionService as ExceptionService;
//AUTOLOADER
require_once '../autoloader.php';

class RoleService {

    private $hroleDao;

    public function __construct() {
        try {
            $hroleService = $this->hroleDao = new RoleDao();
            return $hroleService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('RoleService : CONNEXION BDD : KO');
        }
    
    }

    public function afficher() {
        try {
            $hroleService = $this->hroleDao->afficher();
            return $hroleService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('RoleService : AFFICHER : KO');
        }
    }

    public function afficherun($id) {
        try {
            $hroleService = $this->hroleDao->afficherun($id);
            return $hroleService;
        } catch (ExceptionDao $e) {
            throw new ExceptionService('RoleService : AFFICHER UN : KO');
        }
    }
}