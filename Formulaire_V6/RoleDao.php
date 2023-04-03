<?php

require_once 'Connexion.php';
require_once 'Role.php';

class RoleDao {
    // nom de la table en constante
    private const TABLE = "T_ROLE";
    private $Connexion;

    public function __construct()
    {
        try {
            $hconnexion = new Connexion();
            $this->Connexion = $hconnexion->getConnexion();
        } catch (Exception $e) {
            throw new Exception('Peut pas se connecter à la BDD on te dit');
        }
    }

    // CRUD : METHODE AFFICHER TOUTE LA TABLE (SELECT * FROM ...) (READ)
    public function afficher() {
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
        }

        $this->Connexion = null;
        return $tab_roles;
    }

    // CRUD : METHODE AFFICHER UN ROLE (SELECT * FROM ... WHERE ID=...) (READ)
    public function afficherUn($id): Role {
        $requete = $this->Connexion->prepare("SELECT * FROM " . self::TABLE . " WHERE id = ".$id);
        $requete->execute();
        $result = $requete->fetch();
        $hrole = new Role( $result["libelle"]);
        $hrole->setId($result["id"]);
        $hrole->setLibelle($result["libelle"]);
        $this->Connexion = null;
        return $hrole;
    }
}