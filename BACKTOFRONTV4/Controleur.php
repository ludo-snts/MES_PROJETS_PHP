<?php
//********LIAISON DES FICHIERS DE CLASSE */
require_once 'Personne.php';
require_once 'PersonneDao.php';
require_once 'GenreDao.php';
require_once 'Genre.php';
require_once 'Role.php';
require_once 'RoleDao.php';

session_id('myid');
session_set_cookie_params(3600, "/");
session_start();


// Récupérer l'action
$action = $_GET["action"];

//Sauvegarde de la page en cour avec la super global 
$pagecour = $_SERVER['HTTP_REFERER'];

//*********VERIFICATION REMPLISSAGE DES CHAMPS */
if (!isset($_SESSION['langue']))
    $lang = 'fr';
else
    $lang = $_SESSION['langue'];

include($lang . '.php');


/**LISTE DES ACTIONS DISPONNIBLE
 * 
 * authentification : afficher la page d'authentification
 * retouraccueil : retourner à la page d'accueil
 * definirlangue
 * supprimerpersonne
 * afficher_modification
 * modifier_personne
 * afficher_creer_personne
 * afficher_liste_personne
 * creer_personne
 * 
 */

switch ($action) {

    case "authentification":

        // Retourner la page d'authentification
        header('Location:login.php');

    break;

    case "connecter":

        try {
            $personneDao = new PersonneDAO();

            $username = nettoyer($_POST["username"]);
            $password = nettoyer($_POST["password"]);

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            /**Sauvegarde dans la base de données.La méthode creer() de PersonneDAO retourne 1 si personne créée en bd */
            $resultat = $personneDao->check_login($username, $password);
            // if($resultat)

            if ($resultat == 1) {
                $_SESSION['message'] .= $langArray['perscrea'];
                header('Location:Creer_personne.php');
            } else {
                $_SESSION['message'] .= $langArray['perscreafail'];
                header('Location:Accueil.php');
            }
        } catch (Exception $e) {
            echo $langArray['accesbase'];
            die();
        }
    break;

    case "retouraccueil":

        header('Location: Accueil.php');

    break;

    case "definirlangue":

        if (!isset($_GET['lang']))
            $langue = 'fr';
        else
            $langue = $_GET['lang'];

        $_SESSION['langue'] = $_GET['lang'];
        $lang = $_SESSION['langue'];

        header('Location:' . $pagecour);

    break;

    case "supprimerpersonne":

        $_SESSION['pagecour'] = "Liste_personne.php";
        $id_sup = $_GET['id'];
        /**refaire une dao car la base de donnée va etre modifier  */
        $dao = new PersonneDAO();
        /** utilisation de la fonction  */
        $bresultat = $dao->Supprimer($id_sup);

        if ($bresultat == 1) {
            /**Affichage si l operation a reussi  */
            $_SESSION["message"] = $langArray['perssup'];
        } else {
            /**Affichage si l operation n a pas reusisi  */
            $_SESSION["message"] = $langArray['perssupfail'];
            header('Location: Liste_personne.php');
            die();
        }
        /*Solicitation pour la base de donnée */

        $dao = new PersonneDAO();
        /**recuperation de tout les information  */
        $_SESSION['personnes'] = $dao->findAll();

        header('Location: Liste_personne.php');
    break;

    // Afficher la page de modification
    case "afficher_modification":
        //$_GET("id");
        
        $id_mod = $_GET['id'];

        // Objet PersonneDAO
        $hPersonneDAO = new PersonneDAO();

        // Appel de la méthode findbyId() de la classe PersonneDAO
        $personne = $hPersonneDAO->findbyId($_GET["id"]);

        // Appel de la méthode Modifier() de la classe PersonneDAO
        // $personne = $hPersonneDAO->Modifier($id_mod);

        $_SESSION['personne'] = $personne;

        $hGenreDAO = new GenreDao();
        $_SESSION['genres'] = $hGenreDAO->findAll();

        $hRoleDAO = new RoleDao();
        $_SESSION['roles'] = $hRoleDAO->findAll();

        header('Location: Modifier_personne.php');
    break;

    case "modifier_personne":

        unset($_SESSION['message']);

        $message = "Modification en cours";
        // Verifier les champs obligatoires
        if (!verifierSaisie($_POST["prenom"]))
            $message = $langArray['prenom'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["nom"]))
            $message .= $langArray['nom'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["mail"]))
            $message .= $langArray['mail'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["age"]))
            $message .= $langArray['age'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["genre"]))
            $message .= $langArray['genre'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["role"]))
            $message .= $langArray['role'] . $langArray["nonrens"];

        if (!empty($message)) {
            $_SESSION['message'] = $message;

            
            header('Location: Modifier_personne.php');
        }
        // SINON
        else {
            // Nettoyer les données
            $prenom = nettoyer($_POST["prenom"]);
            $nom = nettoyer($_POST["nom"]);
            $mail = nettoyer($_POST["mail"]);
            $age = nettoyer($_POST["age"]);
            $username = nettoyer($_POST["username"]);
            $password = nettoyer($_POST["password"]);
            $genre = nettoyer($_POST["genre"]);
            $role = nettoyer($_POST["role"]);
            //creer l objet genre et passé le parametre a l instance personne 
            // Créer un objet Personne
            $personne = new Personne($prenom, $nom, $mail, $age, $username, $password);
            $personne->getGenre()->setId($genre);
            $personne->getRole()->setId($role);

            // FINSI 
        }

        try { /* creation d un objet DAO*/
            $personneDao = new PersonneDAO();

            /**Sauvegarde dans la base de données.La méthode creer() de PersonneDAO retourne 1 si personne créée en bd */
            $resultat = $personneDao->Modifier($personne);

            /**Si personne créée */
            if ($resultat == 1) {
                $_SESSION['message'] = "Personne créée";
                header('Location:Creer_personne.php');
                // if($resultat == 2){

                // }
            } else {
                $_SESSION['message'] = "Personne non créée";
                header('Location:Accueil.php');
            }
        } catch (Exception $e) {
            echo $langArray['accesbase'];
            echo $e;
            die();
            /**fin de script  */
        }

     break;

    case "afficher_creer_personne":
        unset($_SESSION['message']);

        //Recuper tout les genres 
        $hdao = new GenreDAO();
        $hrdao = new RoleDao();
        $genre = $hdao->findAll("libelle");
        $role = $hrdao->findAll("libelle");

        //Positionner le tableau et le retourner en variable de session 
        $_SESSION['genres'] = $genre;
        $_SESSION['roles'] = $role;
        //Appeller creer personne 

        header('Location: Creer_personne.php');

    break;

    case "afficher_liste_personne":

        // $_SESSION['pagecour'] = "Liste_personne.php";

        $hpersonneDao = new PersonneDAO();

        // On récupère un tableau
        $tab_personnes = $hpersonneDao->findAll();

        $_SESSION['personnes'] = $tab_personnes;


        header('Location: Liste_personne.php');
    break;

    case "creer_personne":

        unset($_SESSION['message']);

        $message = "";
        // Verifier les champs obligatoires
        if (!verifierSaisie($_POST["prenom"]))
            $message = $langArray['prenom'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["nom"]))
            $message .= $langArray['nom'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["mail"]))
            $message .= $langArray['mail'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["age"]))
            $message .= $langArray['age'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["genre"]))
            $message .= $langArray['genre'] . $langArray["nonrens"];

        if (!verifierSaisie($_POST["role"]))
            $message .= $langArray['role'] . $langArray["nonrens"];

        if (!empty($message)) {
            $_SESSION['message'] = $message;

            $_SESSION['pagecour'] = "Creer_personne.php";
            header('Location: Creer_personne.php');
        }
        // SINON
        else {
            // Nettoyer les données
            $prenom = nettoyer($_POST["prenom"]);
            $nom = nettoyer($_POST["nom"]);
            $mail = nettoyer($_POST["mail"]);
            $age = nettoyer($_POST["age"]);
            $username = nettoyer($_POST["username"]);
            $password = nettoyer($_POST["password"]);
            $genre = nettoyer($_POST["genre"]);
            $role = nettoyer($_POST["role"]);
            //creer l objet genre et passé le parametre a l instance personne 
            // Créer un objet Personne
            $personne = new Personne($prenom, $nom, $mail, $age, $username, $password);
            $personne->getGenre()->setId($genre);
            $personne->getRole()->setId($role);

            // FINSI 
        }

        try { /* creation d un objet DAO*/
            $personneDao = new PersonneDAO();

            /**Sauvegarde dans la base de données.La méthode creer() de PersonneDAO retourne 1 si personne créée en bd */
            $resultat = $personneDao->creer($personne);

            /**Si personne créée */
            if ($resultat == 1) {
                $_SESSION['message'] = "Personne créée";
                header('Location:Creer_personne.php');
                // if($resultat == 2){

                // }
            } else {
                $_SESSION['message'] = "Personne non créée";
                header('Location:Accueil.php');
            }
        } catch (Exception $e) {
            echo $langArray['accesbase'];
            echo $e;
            die();
            /**fin de script  */
        }

    break;

    default:
        header('Location :Accueil.php');
    break;
}


//FUNCTION POUR METTRE EN FORMAT LES INPUTS
function nettoyer($donnee)
{
    //*** trim (enlever les espace)*** stripslashes(supprime backslash)*** htmlspecialchars (convertit les caracteres speciaux en entité html )
    $donnee = htmlspecialchars($donnee);
    $donnee = trim($donnee);
    $donnee =  stripslashes($donnee);

    return $donnee;
}

//FUNCTION VERIFIE ENTRER DES INPUT
function verifierSaisie($donnee)
{
    ///***VERIFICATION DES CHAMPS */
    if ((!isset($donnee) || empty($donnee)))
        return false;
    else
        return true;
}


// if (isset($_POST['site']))
// {
// $choix = $_POST['site'];
// if ($choix==1)
// {
// header('Location: monsite1.php');
 
// }
// elseif ($choix==2)
// {
// header('Location: monsite2.php');
// }
// elseif ($choix==3)
// {
// header('Location: monsite2.php');
// }
// }
// ?>