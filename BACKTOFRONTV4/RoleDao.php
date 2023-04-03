<?php
require_once 'Connexion.php';

class RoleDAO
{
    /*table de personne */
    private const TABLE = "T_ROLE";

    /*connexion de la base de donnée  */
    private $Connection;

    public function __construct()
    {       /*CREER L EXCEPTION A GERER */
        try {
            $hconnection = new Connexion();
            $this->Connection = $hconnection->getConnection();
            /*CREER UNE EXCEPTION QUI SERA RECUE PAR LA METHODE UTILISE LE NEW */
        } catch (Exception $e) {
            throw new Exception("Impossible d établir une connexion");
        }
    }

    public function  findbyId($id) : Role
    {
        $requete = $this->Connection->prepare('SELECT * FROM ' . self::TABLE ." WHERE id_role=?");

         // Executer la requête
        $requete->execute(array($id));

        $result = $requete->fetch(PDO::FETCH_ASSOC);

        $hRole = new Role();
        
        $hRole->setId($result["id_role"]);
        $hRole->setLibelle($result["libelle"]);
        

        return $hRole ;
    }

    public function  findAll(): array

    {

        //Construire la requete
        $requete = $this->Connection->prepare('SELECT * FROM '.self::TABLE);
        // Executer la requête
        $requete->execute();
        // Récupérer le résultat

        // Toutes les lignes sont récupérés
        $result = $requete->fetchAll(PDO::FETCH_ASSOC);

        $tab_role = array();

        // POUR chaque ligne
        foreach ($result as $value) {
            // Créer un objet
            $hRole = new Role();

            ///// placement apes avoir mit a plat 
            $hRole->setLibelle($value["libelle"]);
            $hRole->setId($value['id_role']);

            // Ajouter cet objet à un tableau
            /*Attribution de personne dans le tableau personne */
            $tab_role[] = $hRole;
        }

        /*couper la connection car nous avons toutes les info  */
        $this->Connection = null;

        return $tab_role;
        // Retourner le tableau
    }
}