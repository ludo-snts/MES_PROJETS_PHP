<?php

// NAMESPACE
namespace modele\dao;
//USE ... AS
use modele\entite\Genre as Genre;
use modele\dao\exception\ExceptionDao as ExceptionDao;
//AUTOLOADER
require_once '../autoloader.php';


class GenreDao {
    // nom de la table en constante
    private const TABLE = "T_GENRE";
    private $Connexion;

    public function __construct() {
        try {
            $hconnexion = new Connexion();
            $this->Connexion = $hconnexion->getConnexion();
        } catch (\PDOException $e) {
            throw new ExceptionDao('GenreDao : CONNEXION BDD : KO');
        }
    }

    // CRUD : METHODE AFFICHER TOUTE LA TABLE (SELECT * FROM ...) (READ)
    public function afficher() {
        try {
            $sql = "SELECT * FROM " . self::TABLE;
            $requete = $this->Connexion->prepare($sql);
            $requete->execute();
            $result = $requete->fetchAll();
            $tab_genres = array();
            foreach ($result as $value) {
                $hgenre = new Genre($value['libelle']);
                $hgenre->setId($value['id']);
                $hgenre->setLibelle($value['libelle']);
                $tab_genres[] = $hgenre;
            }
            $this->Connexion = null;
            return $tab_genres;
        } catch (\PDOException $e) {
            throw new ExceptionDao('GenreDao : AFFICHER : KO');
        }
    }

    // CRUD : METHODE AFFICHER UN GENRE (SELECT * FROM ... WHERE ID=...) (READ)
    public function afficherUn($id): Genre {
        try {
            $sql = "SELECT * FROM " . self::TABLE . " WHERE id = ".$id;
            $requete = $this->Connexion->prepare($sql);
            $requete->execute();
            $result = $requete->fetch();
            $hgenre = new Genre( $result["libelle"]);
            $hgenre->setId($result["id"]);
            $hgenre->setLibelle($result["libelle"]);
            $this->Connexion = null;
            return $hgenre;
        } catch (\PDOException $e) {
            throw new ExceptionDao('GenreDao : AFFICHER UN : KO');
        }
    }
}