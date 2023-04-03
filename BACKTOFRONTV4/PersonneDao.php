
<?php
require_once 'Connexion.php';
define('ENCODE_KEY', '~nu!j_EBK,:XE2e{kQ!bhuQ9j]%SlF]z3L^Qy.Q[Gn?NCe&lt;BBy&gt;^LHv~1P]nq~&amp;;');

class PersonneDAO
{
    //table de personne 
    private const TABLE = "T_PERSONNE";
    //connexion de la base de donnée  
    private $Connection;

    public function __construct()
    {
        try {
            $hconnection = new Connexion();
            $this->Connection = $hconnection->getConnection();
            /*CREER UNE EXCEPTION QUI SERA RECUE PAR LA METHODE UTILISE LE NEW */
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function creer($personne)
    {
        //creration de la requete 
        $requete = $this->Connection->prepare("INSERT INTO " . self::TABLE . " (prenom,nom,mail,age,username,password,id_genre,id_role) 
        VALUES (:prenom,:nom,:mail,:age,:username,:password,:id_genre,:id_role)");
        //execution de la requete 
        $result = $requete->execute(array(
            "prenom" => $personne->getPrenom(), "nom" => $personne->getNom(), "mail" => $personne->getMail(),
            "age" => $personne->getAge(), "username" => $personne->getUsername(), "password" => $personne->getPassword(),
            "id_genre" => $personne->getGenre()->getId(), "id_role" => $personne->getRole()->getId()
        ));
        //fermer la connexion a la bdd 
        $this->Connection = null;
        //Retourner le resultat : true ou false 
        return $result;
    }

    public function  findbyId($id): Personne
    {
        $requete = $this->Connection->prepare('SELECT * FROM ' . self::TABLE . " WHERE id_personne=?");

        // Executer la requête
        $requete->execute(array($id));
        //resultat de la requete a passer par fetch
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        //recuperation de la requete dans un handdle 
        $hPersonne = new Personne($result['prenom'], $result["nom"], $result["mail"], $result["age"], $result["username"], $result["password"], $result["id_genre"], $result["id_role"]);
        $hPersonne->setId($result['id_personne']);

        $hGenreDao = new GenreDAO();
        $hGenre = $hGenreDao->findbyId($result['id_genre']);
        $hPersonne->setGenre($hGenre);

        $hRoleDao = new RoleDAO();
        $hRole = $hRoleDao->findbyId($result['id_role']);
        $hPersonne->setRole($hRole);

        return $hPersonne;
    }

    public function  findAll(): array
    {

        //Construire la requete
        $requete = $this->Connection->prepare('SELECT * FROM ' . self::TABLE);

        // Executer la requête
        $requete->execute();

        // Récupérer le résultat
        $result = $requete->fetchAll(PDO::FETCH_ASSOC);

        $tab_personne = array();

        // POUR chaque ligne de personne
        foreach ($result as $valeur) {
            // Créer un objet
            $hPersonne = new Personne($valeur['prenom'], $valeur['nom'], $valeur['mail'], $valeur['age'], $valeur['username'], $valeur['password']);
            $hPersonne->setId($valeur['id_personne']);

            // Ajouter cet objet à un tableau
            $hGenreDao = new GenreDAO();
            $hGenre = $hGenreDao->findbyId($valeur['id_genre']);
            $hPersonne->setGenre($hGenre);

            //Afficher le role de la table 
            $hRoleDao = new RoleDAO();
            $hRole = $hRoleDao->findbyId($valeur['id_role']);
            $hPersonne->setRole($hRole);

            /*Attribution de personne dans le tableau personne */
            $tab_personne[] = $hPersonne;
        }

        /*Couper la connection   */
        $this->Connection = null;

        return $tab_personne;
        // Retourner le tableau
    }

    // // update//
    function Modifier($personne)
    {
        // $personne =$this->Personne->findById($id);
        //creation de la requete
        echo ('minou');
        $requete = $this->Connection->prepare("UPDATE " . self::TABLE . " SET prenom,nom,mail, age,username,password,id_genre,id_role) VALUES (:prenom,:nom,:mail,:age,:username,:password,:id_genre,:id_role)");
        //execution de la requete
        $result = $requete->execute(array(
            "prenom" => $personne->getPrenom(), "nom" => $personne->getNom(), "mail" => $personne->getMail(),
            "age" => $personne->getAge(), "username" => $personne->getUsername(), "password" => $personne->getPassword(),
            "id_genre" => $personne->getGenre()->getId(), "id_role" => $personne->getRole()->getId()
        ));       
        $this->Connection = null;
        return $result;
    }


    function Supprimer($id_sup)
    {

        //creation de la requete 
        $requete = $this->Connection->prepare("DELETE FROM " . self::TABLE . " WHERE id_personne= ?");
        /*execution de la requete */
        $bresult = $requete->execute(array($id_sup));
        /*fermer la connexion a la bdd */
        $this->Connection = null;
        /*Retourner le resultat : true ou false */
        return $bresult;
    }
    function  check_login($username, $password)
    {
        if (isset($username) and isset($password)) {
            if (!empty($username) and !empty($password)) {

                $req = $this->Connection->prepare('SELECT id_personne, password FROM t_personne WHERE username = :username');
                $req->execute(array(
                    'username' => $username
                ));

                $resultat = $req->fetch();


                if (!$resultat or !password_verify($password, $resultat['password'])) {
                    echo 'Identifiant ou Mot De Passe incorrect.<br/>';
                } else {
                    echo 'Vous êtes connecté ' . $username . '! ';
                }
                $req->closeCursor();
            } else {
                echo 'Renseignez un Username et un Mot De Passe';
            }
        }
    }


    function encrypter($pass, $codage = ENCODE_KEY)
    {
        $codage = sha1($codage);
        $passLen = strlen($pass);
        $codageLen = strlen($codage);
        $j = 0;
        $passhash = '';
        for ($i = 0; $i < $passLen; $i++) {
            $ordPass = ord(substr($pass, $i, 1));
            if ($j == $codageLen) {
                $j = 0;
            }
            $ordCodage = ord(substr($codage, $j, 1));
            $j++;
            $passhash .= strrev(base_convert(dechex($ordPass + $ordCodage), 16, 36));
        }
        return $passhash;
    }

    function decrypter($pass, $codage = ENCODE_KEY)
    {
        $codage = sha1($codage);
        $passLen = strlen($pass);
        $codageLen = strlen($codage);
        $j = 0;
        $passhash = '';
        for ($i = 0; $i < $passLen; $i += 2) {
            $ordPass = hexdec(base_convert(strrev(substr($pass, $i, 2)), 36, 16));
            if ($j == $codageLen) {
                $j = 0;
            }
            $ordCodage = ord(substr($codage, $j, 1));
            $j++;
            $passhash .= chr($ordPass - $ordCodage);
        }
        return $passhash;
    }
}
