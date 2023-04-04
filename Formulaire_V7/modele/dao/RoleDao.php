<?php

//NAMESPACE
namespace modele\dao;
//USE ... AS
use modele\entite\Role as Role;
use modele\dao\exception\ExceptionDao as ExceptionDao;
//AUTOLOADER
require_once '../autoloader.php';


class RoleDao {
    // nom de la table en constante
    private const TABLE = "T_ROLE";
    private $Connexion;

    public function __construct() {
        try {
            $hconnexion = new Connexion();
            $this->Connexion = $hconnexion->getConnexion();
        } catch (\PDOException $e) {
            throw new ExceptionDao('RoleDao : CONNEXION BDD : KO');
        }
    }

    // CRUD : METHODE AFFICHER TOUTE LA TABLE (SELECT * FROM ...) (READ)
    public function afficher() {
        try {
            $sql = "SELECT * FROM " . self::TABLE;
            $requete = $this->Connexion->prepare($sql);
            $requete->execute();
            $result = $requete->fetchAll();
            $tab_roles = array();
            foreach ($result as $value) {
                $hrole = new Role($value['libelle']);
                $hrole->setId($value['id']);
                $hrole->setLibelle($value['libelle']);
                $tab_roles[] = $hrole;
                $this->Connexion = null;
                return $tab_roles;
            }
        } catch (\PDOException $e) {
            throw new ExceptionDao('RoleDao : AFFICHER : KO');
        }
    }

    // CRUD : METHODE AFFICHER UN ROLE (SELECT * FROM ... WHERE ID=...) (READ)
    public function afficherUn($id): Role {
        try {
            $sql = "SELECT * FROM " . self::TABLE . " WHERE id = ".$id;
            $requete = $this->Connexion->prepare($sql);
            $requete->execute();
            $result = $requete->fetch();
            $hrole = new Role( $result["libelle"]);
            $hrole->setId($result["id"]);
            $hrole->setLibelle($result["libelle"]);
            $this->Connexion = null;
            return $hrole;
        } catch (\PDOException $e) {
            throw new ExceptionDao('RoleDao : AFFICHER UN : KO');
        }
    }
}