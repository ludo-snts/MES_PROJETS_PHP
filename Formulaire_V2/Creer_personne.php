<!DOCTYPE html>

<?php
require_once 'Genre.php';
require_once 'Personne.php';

session_name('myid');
session_start();
?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Créer Personne V2</title>
</head>

<body>
    <header>
        <h1>CRÉER PERSONNE V2</h1>
    </header>
    <div class="body-container">
        <div class="form-container">
            <form method="POST" action="Controleur.php?action=creerpersonne">
                <p class="form-container-title">Informations</p>
                <div hidden class="form-container-input">
                    <label hidden class="form-container-input-label" for="id">Id</label>
                    <input hidden class="form-container-input-input" type="text" name="id" id="id" value="-1">
                </div>
                <div class="form-container-input">
                    <label class="form-container-input-label" for="prenom">Prénom</label>
                    <input class="form-container-input-input" type="text" name="prenom" id="prenom">
                </div>
                <div class="form-container-input">
                    <label class="form-container-input-label" for="nom">Nom</label>
                    <input class="form-container-input-input" type="text" name="nom" id="nom">
                </div>
                <div class="form-container-input">
                    <label class="form-container-input-label" for="date_naissance">Mail</label>
                    <input class="form-container-input-input" type="mail" name="mail" id="mail">
                </div>
                <div class="form-container-input form-container-input-age">
                    <label class="form-container-input-label" for="age">Age</label>
                    <input class="form-container-input-input" type="text" name="age" id="age">
                    <span>ANS</span>
                </div>
                <div>
                    <?php $tab_genres = $_SESSION['genres']; ?>                  
                    <div class="form-container-select">
                        <label class="form-container-select-label" for="genre">Genre</label>
                        <select class="form-container-select-select" name="genre" id="genre">
                            <option value="0" disabled selected>Choisir un genre</option>

                            <?php 
                            $tab_genres = $_SESSION['genres'];
                            foreach ($tab_genres as $genre) { ?>
                                <option value="<?php echo $genre->getId(); ?>"><?php if ($genre->getLibelle() == "ho") echo "homme"; if ($genre->getLibelle() == "fe") echo "femme"; if ($genre->getLibelle() == "au") echo "autre"; ?> </option>
                            <?php } ?>

                        </select>
                    </div>
                </div>

                    <?php if (!empty($_SESSION['message'])) { ?>
                    <div class="form-container-message" id="message">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                <?php } ?>


                    <div class="form-container-button">
                        <button class="form-container-button-button" type="submit" name="submit" value="submit">Créer</button>
                        <button class="form-container-button-button" type="reset" name="reset" value="reset">Annuler</button>
                    </div>
            </form>
        </div>
        <div class="form-container-link">
            <a href="Controleur.php?action=alleraccueil">Retour à l'accueil </a>
        </div>
        <div class="form-container-link">
            <a href="Controleur.php?action=allerafficherpersonne">Afficher Personne</a>
        </div>
    </div>


    <?php include('Footer.php'); ?>