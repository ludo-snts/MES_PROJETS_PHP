<?php

require_once 'Connexion.php';
require_once 'Personne.php';

class PersonneDao {
    // nom de la table en constante
    private const TABLE = "T_PERSONNE";
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

    // CRUD : METHODE CREATION (CREATE)
    public function creer($personne) {
        $sql = "INSERT INTO " . self::TABLE . " (nom,prenom,mail,age,genre) VALUES (:nom,:prenom,:mail,:age,:genre)";
        $requete = $this->Connexion->prepare($sql);

        $result = $requete->execute(array("prenom" => $personne->getPrenom(), "nom" => $personne->getNom(), "mail" => $personne->getMail(), "age" => $personne->getAge(), "genre" => $personne->getGenre()
        ));

        $this->Connexion = null;
        
        return $result;
    }

    // CRUD : METHODE AFFICHER UNE PERSONNE (SELECT * FROM ... WHERE ID=...) (READ)
    public function afficherUn($id) {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE id = ?";
        $requete = $this->Connexion->prepare($sql);
        $requete->execute([$id]);
        $result = $requete->fetch(PDO::FETCH_OBJ);
        $personne = new Personne($result->prenom, $result->nom, $result->mail, $result->age, $result->genre);
        $personne->setId($result->id);
        return $personne;
    }

    // CRUD : METHODE AFFICHER TOUTE LA TABLE (SELECT * FROM ...) (READ)
    public function afficher() {
        $sql = "SELECT * FROM " . self::TABLE;
        $requete = $this->Connexion->prepare($sql);

        $requete->execute();
        $result = $requete->fetchAll();

        $tab_personnes = array();
        
        foreach ($result as $value) {

            $personne = new Personne($value['prenom'], $value['nom'],$value['mail'], $value['age'], $value['genre']);

            $personne->setId($value['id']);

            $tab_personnes[] = $personne;
        }

        $this->Connexion = null;
        return $tab_personnes;
    }

    // CRUD : METHODE MOFIFICATION (UPDATE)
    public function modifier($personne){
        $sql = "UPDATE " . self::TABLE . " SET prenom = :prenom, nom = :nom, mail = :mail, age = :age, genre = :genre WHERE id = :id";
        $requete = $this->Connexion->prepare($sql);

        $requete->bindParam(':prenom', $personne->getPrenom(), PDO::PARAM_STR);
        $requete->bindParam(':nom', $personne->getNom(), PDO::PARAM_STR);
        $requete->bindParam(':mail', $personne->getMail(), PDO::PARAM_STR);
        $requete->bindParam(':age', $personne->getAge(), PDO::PARAM_INT);
        $requete->bindParam(':genre', $personne->getGenre(), PDO::PARAM_STR);
        $requete->bindParam(':id', $personne->getId(), PDO::PARAM_INT);

        $requete->execute();
        $this->Connexion = null;
    }

    // CRUD : METHODE SUPPRESSION (DELETE)
    public function supprimer($id) {
        try {
            $sql = "DELETE FROM " . self::TABLE . " WHERE id = :id";
            $requete = $this->Connexion->prepare($sql);
            $requete->bindParam(':id', $id);
            $requete->execute();
            // La ligne a été supprimée avec succès
            // return "Personne supprimée avec succès";
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
}
