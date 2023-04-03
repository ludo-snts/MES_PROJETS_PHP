<?php

require_once 'Connexion.php';
require_once 'Genre.php';

class GenreDao {
    // nom de la table en constante
    private const TABLE = "T_GENRE";
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

        $tab_genres = array();
        
        foreach ($result as $value) {

            $hgenre = new Genre($value['libelle']);
            $hgenre->setId($value['id']);
            $hgenre->setLibelle($value['libelle']);
            $tab_genres[] = $hgenre;
        }

        $this->Connexion = null;
        return $tab_genres;
    }

    // CRUD : METHODE AFFICHER UN GENRE (SELECT * FROM ... WHERE ID=...) (READ)
    public function afficherUn($id): Genre {
        $requete = $this->Connexion->prepare("SELECT * FROM " . self::TABLE . " WHERE id = ".$id);
        $requete->execute();
        $result = $requete->fetch();
        $hgenre = new Genre( $result["libelle"]);
        $hgenre->setId($result["id"]);
        $hgenre->setLibelle($result["libelle"]);
        $this->Connexion = null;
        return $hgenre;
    }
}