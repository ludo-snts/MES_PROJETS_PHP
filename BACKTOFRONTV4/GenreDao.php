<?php
require_once 'Connexion.php';

class GenreDao
{
    /*table de personne */
    private const TABLE = "T_GENRE";

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

    public function  findbyId($id) : Genre
    {
        $requete = $this->Connection->prepare('SELECT * FROM ' . self::TABLE ." WHERE id_genre=?");

         // Executer la requête
        $requete->execute(array($id));

        $result = $requete->fetch(PDO::FETCH_ASSOC);

        $hGenre = new Genre();
        
        $hGenre->setId($result["id_genre"]);
        $hGenre->setLibelle($result["libelle"]);
        

        return $hGenre;
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

        $tab_genre = array();

        // POUR chaque ligne
        foreach ($result as $value) {
            // Créer un objet
            $hGenre = new Genre();

            ///// placement apes avoir mit a plat 
            $hGenre->setLibelle($value["libelle"]);
            $hGenre->setId($value['id_genre']);

            // Ajouter cet objet à un tableau
            /*Attribution de personne dans le tableau personne */
            $tab_genre[] = $hGenre;
        }

        /*couper la connection car nous avons toutes les info  */
        $this->Connection = null;

        return $tab_genre;
        // Retourner le tableau
    }
}