<?php

//NAMESPACE
namespace modele\dao;
//USE ... AS
use modele\entite\Personne as Personne;
use modele\dao\exception\ExceptionDao as ExceptionDao;
//AUTOLOADER
require_once '../autoloader.php';


class PersonneDao {
    // nom de la table en constante
    private const TABLE = "T_PERSONNE";
    private const VUE = "V_PERSONNE";
    private $Connexion;

    public function __construct()
    {
        try {
            $hconnexion = new Connexion();
            $this->Connexion = $hconnexion->getConnexion();
        } catch (\Exception $e) {
            throw new ExceptionDao('PersonneDao : CONNEXION BDD : KO');
        }
    }

    // CRUD : METHODE CREATION (CREATE) = OK
    public function creer($personne) {
        try {
            $sql = "INSERT INTO " . self::TABLE . " (prenom,nom,mail,age,idgenre, idrole, username, password) VALUES (:prenom,:nom,:mail,:age,:idgenre, :idrole, :username, :password)";
            $requete = $this->Connexion->prepare($sql);
            $result = $requete->execute(array(
                "prenom" => $personne->getPrenom(), 
                "nom" => $personne->getNom(), 
                "mail" => $personne->getMail(), 
                "age" => $personne->getAge(), 
                "idgenre" => $personne->getGenre()->getId(),
                "idrole" => $personne->getRole()->getId(),
                "username" => $personne->getUsername(), 
                "password" => $personne->getPassword()
            ));
            $this->Connexion = null;
            return $result;
        } catch (\PDOException $e) {
            throw new ExceptionDao('PersonneDao : CREER : KO');
        }
    }

    // CRUD : METHODE AFFICHER UNE PERSONNE (SELECT * FROM ... WHERE ID=...) (READ) = OK
    public function afficherUn($id) {
        try {
            $sql = "SELECT * FROM " . self::VUE . " WHERE id = " . $id;
            $requete = $this->Connexion->prepare($sql);
            $requete->execute();
            $result = $requete->fetch();
            $hpersonne = new Personne();
            $hpersonne->setId($result['id']);
            $hpersonne->setPrenom($result['prenom']);
            $hpersonne->setNom($result['nom']);
            $hpersonne->setMail($result['mail']);
            $hpersonne->setAge($result['age']);
            $hgenre = $hpersonne->getGenre();
            $hgenre->setId($result['idgenre']);
            $hgenre->setLibelle($result['Genre_libelle']);
            $hrole = $hpersonne->getRole();
            $hrole->setId($result['idrole']);
            $hrole->setLibelle($result['Role_libelle']);
            $hpersonne->setUsername($result['username']);
            $hpersonne->setPassword($result['password']);
            $this->Connexion = null;
            return $hpersonne;
        } catch (\PDOException $e) {
            throw new ExceptionDao('PersonneDao : AFFICHER UN : KO');
        }
    }

    // CRUD : METHODE AFFICHER TOUTE LA TABLE (SELECT * FROM ...) (READ) = OK
    public function afficher() {
        try {
            $sql = "SELECT * FROM " . self::VUE;
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
                $hgenre = $hpersonne->getGenre();
                $hgenre->setId($value['idgenre']);
                $hgenre->setLibelle($value['Genre_libelle']);
                $hrole = $hpersonne->getRole();
                $hrole->setId($value['idrole']);
                $hrole->setLibelle($value['Role_libelle']);
                $hpersonne->setUsername($value['username']);
                $hpersonne->setPassword($value['password']);
                $tab_personnes[] = $hpersonne;
                $this->Connexion = null;
                return $tab_personnes;
            }
        } catch (\PDOException $e) {
            throw new ExceptionDao('PersonneDao : AFFICHER : KO');
        }
    }

    // CRUD : METHODE MOFIFICATION (UPDATE)
    public function modifier($personne){
        $sql = "UPDATE " . self::TABLE . " SET prenom = :prenom, nom = :nom, mail = :mail, age = :age, idgenre = :idgenre, idrole = :idrole, username = :username, password = :password WHERE id = :id";
        $requete = $this->Connexion->prepare($sql);
        // try {
        //     $requete-> execute(); 
        //     $this->Connexion = null;
        //     }
        // } catch (\ExceptionDao $e) {
        //     throw new \ExceptionDao('PersonneDao : MODIFIER : KO');
        // }
    }
        // $requete->bindValue(':prenom', $personne->getPrenom(), \PDO::PARAM_STR);
        // $requete->bindValue(':nom', $personne->getNom(), \PDO::PARAM_STR);
        // $requete->bindValue(':mail', $personne->getMail(), \PDO::PARAM_STR);
        // $requete->bindValue(':age', $personne->getAge(), \PDO::PARAM_INT);
        // $requete->bindValue(':genre', $personne->getGenre(), \PDO::PARAM_STR);
        // $requete->bindValue(':role', $personne->getRole(), \PDO::PARAM_STR);
        // $requete->bindValue(':id', $personne->getId(), \PDO::PARAM_INT);
        // $requete->bindValue(':username', $personne->getUsername(), \PDO::PARAM_STR);
        // $requete->bindValue(':password', $personne->getPassword(), \PDO::PARAM_STR);
        // $requete-> execute(); 
        // $this->Connexion = null;

    // CRUD : METHODE SUPPRESSION (DELETE) = OK
    public function supprimer($id) {
        try {
            $sql = "DELETE FROM " . self::TABLE . " WHERE id = :id";
            $requete = $this->Connexion->prepare($sql);
            $requete->bindParam(':id', $id);
            $requete->execute();
            return true;
        } catch (\PDOException $e) {
            throw new ExceptionDao('PersonneDao : SUPPRIMER : KO');
        }
    }

    // CRUD : METHODE CONNECTER = OK
    public function connecter() {
        try {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $sql = "SELECT * FROM " . self::VUE . " WHERE username = :username";
                $requete = $this->Connexion->prepare($sql);
                $requete->bindValue(':username', $username);
                $requete->execute();
    
                $resultat = $requete->fetch(\PDO::FETCH_ASSOC);
                $hpersonne =null;
    
                    if ($resultat) {
                        $passwordHash = $resultat['password'];
                        // password_verify($password, $passwordHash) : permet de vérifier si le mot de passe saisi par l'utilisateur correspond au hash stocké dans la base de données
                        if (password_verify($password, $passwordHash)) {
    
                            $hpersonne = new Personne();
                            $hpersonne ->setId($resultat['id']);
                            $hpersonne ->setPrenom($resultat['prenom']);
                            $hpersonne ->setNom($resultat['nom']);
                            $hpersonne ->setMail($resultat['mail']);
                            $hpersonne ->setAge($resultat['age']);
                            $hpersonne ->setUsername($resultat['username']);
                            $hpersonne ->setPassword($resultat['password']);
    
                            $hgenre = $hpersonne->getGenre();
                            $hgenre->setId($resultat['idgenre']);
                            $hgenre->setLibelle($resultat['Genre_libelle']);
                    
                            $hrole = $hpersonne->getRole();
                            $hrole->setId($resultat['idrole']);
                            $hrole->setLibelle($resultat['Role_libelle']);
                        }
                    } 
                    $this->Connexion = null;
                    return $hpersonne;
            }
        } catch (\PDOException $e) {
            throw new ExceptionDao('PersonneDao :CONNECTER : KO');
        }
    }


}
