<?php

require_once 'Connexion.php';
require_once 'Personne.php';
require_once 'Genre.php';

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

    // CRUD : METHODE CREATION (CREATE) = OK
    public function creer($personne) {
        $sql = "INSERT INTO " . self::TABLE . " (prenom,nom,mail,age,idgenre) VALUES (:prenom,:nom,:mail,:age,:idgenre)";
        $requete = $this->Connexion->prepare($sql);

        $result = $requete->execute(array(
            "prenom" => $personne->getPrenom(), 
            "nom" => $personne->getNom(), 
            "mail" => $personne->getMail(), 
            "age" => $personne->getAge(), 
            "idgenre" => $personne->getGenre()->getId()
        ));

        $this->Connexion = null;
        
        return $result;
    }

    // CRUD : METHODE AFFICHER UNE PERSONNE (SELECT * FROM ... WHERE ID=...) (READ) = OK

    // public function afficherUn($id) {
    //     $sql = "SELECT * FROM " . self::TABLE . " WHERE id = ?";
    //     $requete = $this->Connexion->prepare($sql);
    //     $requete->execute([$id]);
    //     $result = $requete->fetch(PDO::FETCH_OBJ);
    //     $hpersonne = new Personne();
    //     $hpersonne->setId($result->id);
    //     $hpersonne->setPrenom($result->prenom);
    //     $hpersonne->setNom($result->nom);
    //     $hpersonne->setMail($result->mail);
    //     $hpersonne->setAge($result->age);
        
    //     $hgenreDao = new GenreDao();
    //     $genre = $hgenreDao->afficherUn($result->idgenre);
    //     $hpersonne->setGenre($genre);


    //     $this->Connexion = null;
    //     return $hpersonne;
    // }

    public function afficherUn($id) {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE id = " . $id;
        $requete = $this->Connexion->prepare($sql);
        $requete->execute();
        $result = $requete->fetch();
        $hpersonne = new Personne();
        $hpersonne->setId($result['id']);
        $hpersonne->setPrenom($result['prenom']);
        $hpersonne->setNom($result['nom']);
        $hpersonne->setMail($result['mail']);
        $hpersonne->setAge($result['age']);

        $hgenreDao = new GenreDao();
        $genre = $hgenreDao->afficherUn($result['idgenre']);
        $hpersonne->setGenre($genre);

        $this->Connexion = null;
        return $hpersonne;
    }

    // CRUD : METHODE AFFICHER TOUTE LA TABLE (SELECT * FROM ...) (READ) = OK
    public function afficher() {
        $sql = "SELECT * FROM " . self::TABLE;
        $requete = $this->Connexion->prepare($sql);

        $requete->execute();
        $result = $requete->fetchAll();

        $tab_personnes = array();
        
        foreach ($result as $value) {

            $hpersonne = new Personne();

            $hpersonne->setId($value['id']);
            $hpersonne->setPrenom($value['prenom']);
            $hpersonne->setNom($value['nom']);
            $hpersonne->setMail($value['mail']);
            $hpersonne->setAge($value['age']);

            $genreDao = new GenreDao();
            $hgenre = $genreDao->afficherUn($value['idgenre']);
            $hpersonne->setGenre($hgenre);


            $tab_personnes[] = $hpersonne;
        }

        $this->Connexion = null;
        return $tab_personnes;
    }

    // CRUD : METHODE MOFIFICATION (UPDATE)

    // public function modifier($personne){
    //     $sql = "UPDATE " . self::TABLE . " SET prenom = :prenom, nom = :nom, mail = :mail, age = :age, genre = :genre WHERE id = :id";
    //     $requete = $this->Connexion->prepare($sql);

    //     $requete->bindParam(':prenom', $personne->getPrenom(), PDO::PARAM_STR);
    //     $requete->bindParam(':nom', $personne->getNom(), PDO::PARAM_STR);
    //     $requete->bindParam(':mail', $personne->getMail(), PDO::PARAM_STR);
    //     $requete->bindParam(':age', $personne->getAge(), PDO::PARAM_INT);
    //     $requete->bindParam(':genre', $personne->getGenre(), PDO::PARAM_STR);
    //     $requete->bindParam(':id', $personne->getId(), PDO::PARAM_INT);

    //     $requete->execute();
    //     $this->Connexion = null;
    // }
    public function modifier($personne){
        $sql = "UPDATE " . self::TABLE . " SET prenom = :prenom, nom = :nom, mail = :mail, age = :age, idgenre = :idgenre WHERE id = :id";
        $requete = $this->Connexion->prepare($sql);

        



        $requete-> execute(); 
        $this->Connexion = null;
    }

    // CRUD : METHODE SUPPRESSION (DELETE) = OK
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
