<?php

// Initialisation des fichiers de classes
require_once 'Personne.php';
require_once 'Genre.php';
require_once 'Role.php';

// Initialisation des fichiers de DAO
// require_once 'PersonneDao.php';
// require_once 'GenreDao.php';
// require_once 'RoleDao.php';

// Initialisation des fichiers de SERVICE
require_once 'PersonneService.php';
require_once 'GenreService.php';
require_once 'RoleService.php';


// Initialisation de la session
session_name('myid');
session_start();

if (!isset($_SESSION['language'])) {
    $language = 'fr';
} else {
    $language = $_SESSION['language'];
}
include('LOCAL/' . $language . '.php');

// Initialisation des variables
if(isset($_GET['action'])) :
    switch ($_GET['action']) {

        // Chemin : Aller page = ACCUEIL = OK
        case 'alleraccueil':
            $_SESSION['currentpage'] = 'Accueil.php';
            header('Location: Accueil.php');
        break;

        // Chemin : Aller page = LOGIN = OK
        case 'allerlogin':
            $_SESSION['currentpage'] = 'Login.php';
            unset($_SESSION['message']);
            $message = "";
            header('Location: Login.php');
        break;

        // Chemin : Aller page = CREER PERSONNE = OK
        case 'allercreerpersonne':
            $_SESSION['currentpage'] = 'Creer_personne.php';
            unset($_SESSION['message']);
            
            $hgenreService = new GenreService();
            $tab_genres = $hgenreService->afficher();
            $_SESSION['genres'] = $tab_genres;

            $hroleService = new RoleService();
            $tab_roles = $hroleService->afficher();
            $_SESSION['roles'] = $tab_roles;
            header('Location: Creer_personne.php');
        break;

        // Chemin : Aller page = AFFICHER PERSONNE = OK
        case 'allerafficherpersonne':
            $_SESSION['currentpage'] = 'Afficher_personne.php';
            unset($_SESSION['message']);
            $hpersonneService = new PersonneService();
            $tab_personnes = $hpersonneService->afficher();
            $_SESSION['personnes'] = $tab_personnes;
            header('Location: Afficher_personne.php');
        break;

        // Chemin : Aller page = MODIFIER PERSONNE = OK
        case 'allermodifierpersonne':
            $_SESSION['currentpage'] = 'Modifier_personne.php';
            unset($_SESSION['message']);
            header('Location: Modifier_personne.php');
        break;

        // CHANGEMENT LANGUE = OK
        case 'changerlangue':
            // echo 'changement langue OK : '.$_GET['languageId'];
            if (!isset($_GET['languageId']))
                $language = 'fr';
            else
                $language = $_GET['languageId'];
            include('LOCAL/'.$language.'.php');
            $_SESSION['language'] = $_GET['languageId'];

            $language = $_SESSION['language'];
            setcookie('language', $language, time() +24*3600, '/', '', true, true);


            // $_SESSION['currentpage'] = 'Accueil.php';
            $currentpage = $_SESSION['currentpage'];
            header("Location: $currentpage");
        break;

        


        // CRUD : CREER UNE PERSONNE (CREATE) = OK
        case "creerpersonne":
            $_SESSION['currentpage'] = 'Creer_personne.php';
            unset($_SESSION['message']);
            $message = "";
            if ( !verifier($_POST["prenom"]) ||
                !verifier($_POST["nom"]) || 
                !verifier($_POST["mail"]) || 
                !verifier($_POST["age"]) || 
                !verifier($_POST["genre"]) || 
                !verifier($_POST["role"]) ||
                !verifier($_POST["username"]) ||
                !verifier($_POST["password"]) )
                {
                    $message = $languageArray['create_message_error'];
                    if (!empty($message)) {
                        $_SESSION['message'] = $message;
                        header('location: Creer_personne.php');
                    }
                }                
            else {
                $hpersonne = new Personne();

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
                    header('location:Creer_personne.php');
                } else {
                    $_SESSION['message'] = "Personne non créée";
                    header('location:Accueil.php');
                }
            } catch (Exception $e) {
                echo "Probléme d' accés à la base de données.";
                die();
            }
        break;

        // CRUD : AFFICHER UNE PERSONNE SELON SON ID (READ) = OK
        case 'afficherunepersonne':
            $_SESSION['currentpage'] = 'Modifier_personne.php';
            $hpersonneService = new PersonneService();
            $id = $_GET['id'];
            $personne = $hpersonneService->afficherUn($id);
            $_SESSION['personne'] = $personne;
        
            header('Location: Modifier_personne.php');
        break;

        // CRUD : MODIFIER UNE PERSONNE SELON SON ID (UPDATE) = KO
        case 'modifierpersonne':
            $_SESSION['currentpage'] = 'Modifier_personne.php';
            $hpersonneService = new PersonneService();
            $id = $_GET['id'];
            $personne = $hpersonneService->modifier($id);
            $_SESSION['personne'] = $personne;
            // on recharge la liste des personnes (case allerafficherpersonne)
            $hpersonneService = new PersonneService();
            $tab_personnes = $hpersonneService->afficher();
            $_SESSION['personnes'] = $tab_personnes;
            header('Location: Afficher_personne.php');
            
        break;

        // CRUD : SUPPRIMER UNE PERSONNE SELON SON ID (DELETE) = OK
        case 'supprimerpersonne':
            $_SESSION['currentpage'] = 'Afficher_personne.php';
            $hpersonneService = new PersonneService();
            $id = $_GET['id'];
            $hpersonneService->supprimer($id);
            // on recharge la liste des personnes (case allerafficherpersonne)
            $hpersonneService = new PersonneService();
            $tab_personnes = $hpersonneService->afficher();
            $_SESSION['personnes'] = $tab_personnes;
            $message = $languageArray['delete_message_success'];
            if (!empty($message)) {
                $_SESSION['message'] = $message;
            }
            header('Location: Afficher_personne.php');
        break;

        // Chemin si problème : Aller page = ACCUEIL = OK
        default:
            $_SESSION['currentpage'] = 'Accueil.php';
            $_SESSION['language'] = $_GET['languageID'];
            header('Location: Accueil.php');
        break;

        case 'connexionreussie' :
            $_SESSION['currentpage'] = 'Login.php';
            unset($_SESSION['message']);
            $message = "";
            $hpersonneService = new PersonneService();
            $personne = $hpersonneService->connecter();
            $_SESSION['personneconnectee'] = $personne;
            // var_dump ($_SESSION['personneconnectee']);
            header('Location: Accueil.php');
        break;

        case 'deconnexion' :
            // session_name('myid');
            // session_start();
            session_destroy();
            header( 'Location:Login.php' );
            // if(session_status() === PHP_SESSION_ACTIVE) echo 'session OK ! ';
            // if(session_status() === PHP_SESSION_NONE) echo 'pas de session';
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