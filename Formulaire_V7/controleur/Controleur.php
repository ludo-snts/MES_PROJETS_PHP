<?php

// NAMESPACE
namespace controleur;
//USE ... AS
use modele\entite\Personne as Personne;
use modele\entite\Genre as Genre;
use modele\entite\Role as Role;
use modele\service\PersonneService as PersonneService;
use modele\service\GenreService as GenreService;
use modele\service\RoleService as RoleService;
use modele\service\exception\ExceptionService as ExceptionService;
//AUTOLOADER
require_once '../autoloader.php';


// Initialisation de la session
session_name('myid');
session_start();

// Initialisation de la langue utilisée
if (!isset($_SESSION['language'])) {
    $language = 'fr';
} else {
    $language = $_SESSION['language'];
}
// INCLUDE FICHIER LOCAL/LANGUAGE
include('../vue/LOCAL/' . $language . '.php');



// Initialisation des variables
if(isset($_GET['action'])) :
    switch ($_GET['action']) {

        // Chemin : Aller page = ACCUEIL = OK
        case 'alleraccueil':
            $_SESSION['currentpage'] = 'Accueil.php';
            unset($_SESSION['message']);
            $message = "";
            try {
                header('Location: ../vue/Accueil.php');
            } catch (\Exception $e) {
                $_SESSION['message'] = "ALLER PAGE ACCUEIL : KO";
                header('location: ../vue/Message_Error.php');
                die();
            }
        break;

        // Chemin : Aller page = LOGIN = OK
        case 'allerlogin':
            $_SESSION['currentpage'] = 'Login.php';
            unset($_SESSION['message']);
            $message = "";
            try {
                header('Location: ../vue/Login.php');
            } catch (\Exception $e) {
                $_SESSION['message'] = "ALLER PAGE LOGIN : KO";
                header('location: ../vue/Message_Error.php');
                die();
            }
        break;

        // Chemin : Aller page = CREER PERSONNE = OK
        case 'allercreerpersonne':
            $_SESSION['currentpage'] = 'Creer_personne.php';
            unset($_SESSION['message']);
            $message = "";
            try {
                $hgenreService = new GenreService();
                $tab_genres = $hgenreService->afficher();
                $_SESSION['genres'] = $tab_genres;
                $hroleService = new RoleService();
                $tab_roles = $hroleService->afficher();
                $_SESSION['roles'] = $tab_roles;
                header('Location: ../vue/Creer_personne.php');
            } catch (\Exception $e) {
                $_SESSION['message'] = "ALLER PAGE CREER PERSONNE : KO";
                header('location: ../vue/Message_Error.php');
                die();
            }
        break;

        case 'allerafficherpersonne':
            $_SESSION['currentpage'] = 'Afficher_personne.php';
            unset($_SESSION['message']);
            $message = "";
            try {
                $hpersonneService = new PersonneService();                
                $resultat = $hpersonneService->afficher();
                if ($resultat !== "") {
                    $_SESSION['personnes'] = $resultat;
                    header('Location: ../vue/Afficher_personne.php');
                } else {
                    $_SESSION['message'] = $languageArray['DB_access_broken'];
                    header('location: ../vue/Accueil.php');
                }
            } catch (\Exception $e) {
                $_SESSION['message'] = "ALLER PAGE AFFICHER PERSONNE : KO";
                header('location: ../vue/Message_Error.php');
                die();
            }
        break;

        // Chemin : Aller page = MODIFIER PERSONNE = OK
        case 'allermodifierpersonne':
            $_SESSION['currentpage'] = 'Modifier_personne.php';
            unset($_SESSION['message']);
            $message = "";
            try {
                header('Location: ../vue/Modifier_personne.php');
            } catch (\Exception $e) {
                $_SESSION['message'] = "ALLER PAGE MODIFIER PERSONNE : KO";
                header('location: ../vue/Message_Error.php');
                die();
            }
        break;

        // CHANGEMENT LANGUE = OK
        case 'changerlangue':
            try {
                // echo 'changement langue OK : '.$_GET['languageId'];
                if (!isset($_GET['languageId']))
                    $language = 'fr';
                else
                    $language = $_GET['languageId'];
                include('../vue/LOCAL/'.$language.'.php');
                $_SESSION['language'] = $_GET['languageId'];

                $language = $_SESSION['language'];
                setcookie('language', $language, time() +24*3600, '/', '', true, true);

                $currentpage = $_SESSION['currentpage'];
                header("Location: ../vue/$currentpage");
            } catch (\Exception $e) {
                $_SESSION['message'] = "MODIFIER LANGUE : KO";
                header('location: ../vue/Message_Error.php');
                die();
            }
        break;

        // CRUD : CREER UNE PERSONNE (CREATE) = OK
        case "creerpersonne":
            $_SESSION['currentpage'] = 'Creer_personne.php';
            unset($_SESSION['message']);
            $message = "";
            // SI VERIFIER VALUES CHAMPS = KO
            if ( !verifier ($_POST["prenom"]) || !verifier ($_POST["nom"]) || !verifier ($_POST["mail"]) || !verifier ($_POST["age"]) ||!verifier ($_POST["genre"]) || !verifier ($_POST["role"]) || !verifier ($_POST["username"]) || !verifier ($_POST["password"]) ) {
                $message = $languageArray['create_message_error'];
                // if (!empty($message)) {
                    $_SESSION['message'] = $message;
                    header('location: ../vue/Creer_personne.php');
                // }
            }        
            // SI VERIFIER VALUES CHAMPS = OK      
            else {
                $hpersonne = new Personne();
                // NETTOYER VALUES CHAMPS
                $hpersonne->setPrenom(nettoyer($_POST["prenom"]));
                $hpersonne->setNom(nettoyer($_POST["nom"]));
                $hpersonne->setMail(nettoyer($_POST["mail"]));
                $hpersonne->setAge(nettoyer($_POST["age"]));

                $hgenre = new Genre();

                $hgenre->setId(($_POST["genre"]));
                $hpersonne->setGenre($hgenre);

                $hrole = new Role();

                $hrole->setId(($_POST["role"]));
                $hpersonne->setRole($hrole);

                $hpersonne->setUsername(nettoyer($_POST["username"]));
                // password_hash permet de hasher le mot de passe avant de l'enregistrer dans la base de données
                // PASSWORD_DEFAULT est une constante qui permet de choisir le meilleur algorithme de hashage
                $hpersonne->setPassword(password_hash($_POST["password"],PASSWORD_DEFAULT));
                // $hpersonne->setPassword(nettoyer($_POST["password"]));
            }
            try {
                $hpersonneService = new PersonneService();
                $resultat = $hpersonneService->creer($hpersonne);
                if ($resultat == 1) {
                    $_SESSION['message'] = $languageArray['create_message_success'];
                    header('location: ../vue/Creer_personne.php');
                } else {
                    $_SESSION['message'] = $languageArray['create_message_error_2'];
                    header('location: ../vue/Accueil.php');
                }
            } catch (ExceptionService $e) {
                $_SESSION['message'] = 'Controleur : CREER : KO';
                header('location: ../vue/Creer_personne.php');
                die();
            }
        break;

        // CRUD : AFFICHER UNE PERSONNE SELON SON ID (READ) = OK
        case 'afficherunepersonne':
            $_SESSION['currentpage'] = 'Modifier_personne.php';
            try {
                $hpersonneService = new PersonneService();
                $id = $_GET['id'];
                $personne = $hpersonneService->afficherUn($id);
                $_SESSION['personne'] = $personne;
                header('Location: ../vue/Modifier_personne.php');
            } catch (ExceptionService $e) {
                $_SESSION['message'] = 'Controleur : AFFICHER UN : KO';
                header('location: ../vue/Afficher_personne.php');
                die();
            }
        break;

        // CRUD : MODIFIER UNE PERSONNE SELON SON ID (UPDATE) = KO
        case 'modifierpersonne':
            $_SESSION['currentpage'] = 'Modifier_personne.php';
            unset($_SESSION['message']);
            $message = "";
            try {
                $hpersonneService = new PersonneService();
                $id = $_GET['id'];
                $personne = $hpersonneService -> modifier($id);
                $_SESSION['personne'] = $personne;
                // on recharge la liste des personnes (case allerafficherpersonne)
                $hpersonneService = new PersonneService();
                $tab_personnes = $hpersonneService->afficher();
                $_SESSION['personnes'] = $tab_personnes;
                $message = 'Controleur : MODIFIER : OK';
                $_SESSION['message'] = $message;
                header('Location: ../vue/Afficher_personne.php');
            } catch (ExceptionService $e) {
                $_SESSION['message'] = 'Controleur : MODIFIER : KO';
                header('location: ../vue/Afficher_personne.php');
                die();
            }
        break;

        // CRUD : SUPPRIMER UNE PERSONNE SELON SON ID (DELETE) = OK
        case 'supprimerpersonne':
            $_SESSION['currentpage'] = 'Afficher_personne.php';
            try {
                $hpersonneService = new PersonneService();
                $id = $_GET['id'];
                $hpersonneService->supprimer($id);
                // on recharge la liste des personnes (case allerafficherpersonne)
                $hpersonneService = new PersonneService();
                $tab_personnes = $hpersonneService->afficher();
                $_SESSION['personnes'] = $tab_personnes;
                $message = 'Controleur : SUPPRIMER : OK';
                $_SESSION['message'] = $message;
                header('Location: ../vue/Afficher_personne.php');
            } catch (ExceptionService $e) {
                $_SESSION['message'] = 'Controleur : SUPPRIMER : KO';
                header('location: ../vue/Afficher_personne.php');
                die();
            }
        break;

        // Chemin si problème : Aller page = ACCUEIL = OK
        default:
            $_SESSION['currentpage'] = 'Accueil.php';
            $_SESSION['language'] = $_GET['languageID'];
            try {
            header('Location: ../vue/Accueil.php');
            } catch (\Exception $e) {
                $_SESSION['message'] = "ALLER PAGE DEFAULT : KO";
                header('location: ../vue/Message_Error.php');
                die();
            }
        break;

        case 'connexionreussie' :
            $_SESSION['currentpage'] = 'Login.php';
            unset($_SESSION['message']);
            $message = "";
            if ($_POST['username']==='' || $_POST['password']==='') {
                $message = 'Controleur : CONNEXION (SAISIE INCOMPLETE) : KO';
                $_SESSION['message'] = $message;
                header('Location: ../vue/Login.php');
            }
            else {
                try {
                    $hpersonneService = new PersonneService();
                    $resultat = $hpersonneService->connecter();
                    if ($resultat == 1) { 
                        $_SESSION['personneconnectee'] = $resultat;
                        header('Location: ../vue/Accueil.php');
                    } else {
                        $_SESSION['message'] = 'Controleur : CONNEXION (CHAMP(S) INVALIDE(S)) : KO';
                        header('location: ../vue/Login.php');
                }
                } catch (\Exception $e) {
                    $_SESSION['message'] = 'Controleur : CONNEXION : KO';
                    header('location: ../vue/Login.php');
                    die();
                }
            }
        break;

        case 'deconnexion' :
            try {
                session_destroy();
                header( 'Location: ../vue/Login.php' );
            } catch (\Exception $e) {
                $_SESSION['message'] = 'Controleur : DECONNEXION : KO';
                header('location: ../vue/Message_Error.php');
                die();
            }
        break;

    }

endif;



// FONCTIONS
// Vérifier que les 'required' sont complétés = OK
function verifier($data) {
    if ((!isset($data) || empty($data)))
        return false;
    else
        return true;
}

// trim :  Supprimer les espaces en début et fin de chaîne = OK
// stripslashes : Supprimer les antislashs d'une chaîne = OK
// htmlspecialchars : Convertir les caractères spéciaux en entités HTML = OK
function nettoyer($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}