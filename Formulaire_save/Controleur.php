<?php
require_once 'Personne.php';
require_once 'PersonneDao.php';

session_name('myid');
session_start();

if(isset($_GET['action'])) :
    switch ($_GET['action']) {

        // Chemin : Aller page = ACCUEIL
        case 'alleraccueil':
            header('Location: Accueil.php');
        break;

        // Chemin : Aller page = CREER PERSONNE
        case 'allercreerpersonne':
            header('Location: Creer_personne.php');
        break;

        // Chemin : Aller page = AFFICHER PERSONNE
        case 'allerafficherpersonne':
            $hpersonneDao = new PersonneDao();
            $tab_personnes = $hpersonneDao->afficher();
            $_SESSION['personnes'] = $tab_personnes;

            header('Location: Afficher_personne.php');
        break;

        // Chemin : Aller page = MODIFIER PERSONNE
        case 'allermodifierpersonne':
            header('Location: Modifier_personne.php');
        break;





        // CRUD : CREER UNE PERSONNE (CREATE)
        case "creerpersonne":
            unset($_SESSION['message']);
            $message = "";
            if (!verifier($_POST["prenom"]))
                $message = "Prénom non renseigné" . PHP_EOL;
            if (!verifier($_POST["nom"]))
                $message .= "Nom non renseigné";
            if (!verifier($_POST["mail"]))
                $message .= "Mail non renseigné";
            if (!verifier($_POST["age"]))
                $message .= "Age non renseigné";
            if (!verifier($_POST["genre"]))
                $message .= "Genre non renseigné";
            if (!empty($message)) {
                $_SESSION['message'] = $message;
                header('location: Creer_personne.php');
            }
            else {
                $prenom = nettoyer($_POST["prenom"]);
                $nom = nettoyer($_POST["nom"]);
                $mail = nettoyer($_POST["mail"]);
                $age = nettoyer($_POST["age"]);
                $genre = nettoyer($_POST["genre"]);
    
                $personne = new Personne($prenom, $nom, $mail, $age, $genre);
            }
            try {
                $personneDao = new PersonneDAO();
                $resultat = $personneDao->creer($personne);
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

        // CRUD : AFFICHER UNE PERSONNE SELON SON ID (READ)
        case 'afficherunepersonne':
            $hpersonneDao = new PersonneDao();
            $id = $_GET['id'];
            $personne = $hpersonneDao->afficherUn($id);
            $_SESSION['personne'] = $personne;
        
            header('Location: Modifier_personne.php');
        break;

        // // CRUD : MODIFIER UNE PERSONNE SELON SON ID (UPDATE)
        // case 'modifierpersonne':
        //     $hpersonneDao = new PersonneDao();
        //     $id = $_GET['id'];
        //     $hpersonneDao->modifier($id);
        //     // on recharge la liste des personnes (case allerafficherpersonne)
        //     $hpersonneDao = new PersonneDao();
        //     $tab_personnes = $hpersonneDao->afficher();
        //     $_SESSION['personnes'] = $tab_personnes;
        //     header('Location: Afficher_personne.php');
        // break;

        // CRUD : SUPPRIMER UNE PERSONNE SELON SON ID (DELETE)
        case 'supprimerpersonne':
            $hpersonneDao = new PersonneDao();
            $id = $_GET['id'];
            $hpersonneDao->supprimer($id);
            // on recharge la liste des personnes (case allerafficherpersonne)
            $hpersonneDao = new PersonneDao();
            $tab_personnes = $hpersonneDao->afficher();
            $_SESSION['personnes'] = $tab_personnes;
            header('Location: Afficher_personne.php');
        break;


        // Chemin si problème : Aller page = ACCUEIL
        default:
            header('Location: Accueil.php');
        break;

    }
endif;



// FONCTIONS
// Vérifier que les 'required' sont complétés
function verifier($data) {
    if ((!isset($data) || empty($data)))
        return false;
    else
        return true;
}

// trim :  Supprimer les espaces en début et fin de chaîne 
// stripslashes : Supprimer les antislashs d'une chaîne
// htmlspecialchars : Convertir les caractères spéciaux en entités HTML
function nettoyer($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}