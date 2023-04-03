<?php
require_once 'Personne.php';
require_once 'Genre.php';
require_once 'PersonneDao.php';
require_once 'GenreDao.php';

session_name('myid');
session_start();

if(isset($_GET['action'])) :
    switch ($_GET['action']) {

        // Chemin : Aller page = ACCUEIL = OK
        case 'alleraccueil':
            $_SESSION['currentpage'] = 'Accueil.php';
            header('Location: Accueil.php');
        break;

        // Chemin : Aller page = CREER PERSONNE = OK
        case 'allercreerpersonne':
            $_SESSION['currentpage'] = 'Creer_personne.php';
            unset($_SESSION['message']);
            $hgenreDao = new GenreDao();
            $tab_genres = $hgenreDao->afficher();
            $_SESSION['genres'] = $tab_genres;
            header('Location: Creer_personne.php');
        break;

        // Chemin : Aller page = AFFICHER PERSONNE = OK
        case 'allerafficherpersonne':
            $_SESSION['currentpage'] = 'Afficher_personne.php';
            $hpersonneDao = new PersonneDao();
            $tab_personnes = $hpersonneDao->afficher();
            $_SESSION['personnes'] = $tab_personnes;
            header('Location: Afficher_personne.php');
        break;

        // Chemin : Aller page = MODIFIER PERSONNE = OK
        case 'allermodifierpersonne':
            $_SESSION['currentpage'] = 'Modifier_personne.php';
            header('Location: Modifier_personne.php');
        break;

        // CHANGEMENT LANGUE
        case 'changerlangage':
            // if (!isset($_GET['languageID'])) {
                $language = 'en';
            // }
            // else {
                // $language = $_GET['languageID'];
            // }
            include('LOCAL/'.$language.'.php');

            $_SESSION['language'] = $_GET['languageID'];
            $currentpage = $_SESSION['currentpage'];
            header("Location: $currentpage");
        break;


        // CRUD : CREER UNE PERSONNE (CREATE) = OK
        case "creerpersonne":
            $_SESSION['currentpage'] = 'Creer_personne.php';
            unset($_SESSION['message']);
            $message = "";
            if (!verifier($_POST["prenom"]))
                $message = "Prénom non renseigné . ";
            if (!verifier($_POST["nom"]))
                $message .= "Nom non renseigné . ";
            if (!verifier($_POST["mail"]))
                $message .= "Mail non renseigné . ";
            if (!verifier($_POST["age"]))
                $message .= "Age non renseigné . ";
            if (!verifier($_POST["genre"]))
                $message .= "Genre non selectionné . ";
            if (!empty($message)) {
                $_SESSION['message'] = $message;
                header('location: Creer_personne.php');
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
            }
            try {
                $hpersonneDao = new PersonneDAO();
                $resultat = $hpersonneDao->creer($hpersonne);
                if ($resultat == 1) {
                    $_SESSION['message'] = "Personne créée";
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
            $hpersonneDao = new PersonneDao();
            $id = $_GET['id'];
            $personne = $hpersonneDao->afficherUn($id);
            $_SESSION['personne'] = $personne;
        
            header('Location: Modifier_personne.php');
        break;

        // CRUD : MODIFIER UNE PERSONNE SELON SON ID (UPDATE) = KO
        case 'modifierpersonne':
            $_SESSION['currentpage'] = 'Modifier_personne.php';
            $hpersonneDao = new PersonneDao();
            $id = $_GET['id'];
            $personne = $hpersonneDao->modifier($id);
            $_SESSION['personne'] = $personne;
            // on recharge la liste des personnes (case allerafficherpersonne)
            $hpersonneDao = new PersonneDao();
            $tab_personnes = $hpersonneDao->afficher();
            $_SESSION['personnes'] = $tab_personnes;
            header('Location: Afficher_personne.php');
        break;

        // CRUD : SUPPRIMER UNE PERSONNE SELON SON ID (DELETE) = OK
        case 'supprimerpersonne':
            $_SESSION['currentpage'] = 'Afficher_personne.php';
            $hpersonneDao = new PersonneDao();
            $id = $_GET['id'];
            $hpersonneDao->supprimer($id);
            // on recharge la liste des personnes (case allerafficherpersonne)
            $hpersonneDao = new PersonneDao();
            $tab_personnes = $hpersonneDao->afficher();
            $_SESSION['personnes'] = $tab_personnes;
            header('Location: Afficher_personne.php');
        break;


        // Chemin si problème : Aller page = ACCUEIL = OK
        default:
            $_SESSION['currentpage'] = 'Accueil.php';
            header('Location: Accueil.php');
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