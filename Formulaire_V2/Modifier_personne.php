<!DOCTYPE html>

<?php
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
    <title>Afficher Personne V2</title>
</head>

<body>
    <header>
        <h1>MODIFIER PERSONNE V2</h1>
    </header>
    <div class="body-container">
        <div class="form-container">
            <?php 
                $personne = $_SESSION['personne'];
            ?>
            <form method="POST" action="Controleur.php?action=modifierpersonne&id=<?php echo $personne->getId(); ?>">
                <p class="form-container-title">Informations</p>
                <div hidden class="form-container-input">
                    <label hidden class="form-container-input-label" for="id">Id</label>
                    <input hidden class="form-container-input-input" type="text" name="id" id="id" value="<?php echo $personne->getId(); ?>">
                </div>
                <div class="form-container-input">
                    <label class="form-container-input-label" for="prenom">Prénom</label>
                    <input class="form-container-input-input" type="text" name="prenom" id="prenom" value="<?php echo $personne->getPrenom(); ?>" required>
                </div>
                <div class="form-container-input">
                    <label class="form-container-input-label" for="nom">Nom</label>
                    <input class="form-container-input-input" type="text" name="nom" id="nom" value="<?php echo $personne->getNom(); ?>" required>
                </div>
                <div class="form-container-input">
                    <label class="form-container-input-label" for="date_naissance">Mail</label>
                    <input class="form-container-input-input" type="mail" name="mail" id="mail" value="<?php echo $personne->getMail(); ?>" required>
                </div>
                <div class="form-container-input form-container-input-age">
                    <label class="form-container-input-label" for="age">Age</label>
                    <input class="form-container-input-input" type="text" name="age" id="age" value="<?php echo $personne->getAge(); ?>" required>
                    <span>ANS</span>
                </div>
                <div class="form-container-select">
                    <label class="form-container-select-label" for="genre">Genre</label>
                        <select class="form-container-select-select" name="genre" id="genre">
                            <option value="0" disabled>Choisir un genre </option>
                            <option value="1" <?php echo ($personne->getGenre()->getLibelle() == "ho")?'selected':'' ?>>homme</option>
                            <option value="2" <?php echo ($personne->getGenre()->getLibelle() == "fe")?'selected':'' ?>>femme</option>
                            <option value="3" <?php echo ($personne->getGenre()->getLibelle() == "au")?'selected':'' ?>>autre</option>
                        </select>
                </div>

                <div class="update-container-button">
                    <button class="update-container-button-button" type="submit" name="submit" value="submit">Modifier</button>
                    <a href="Controleur.php?action=allerafficherpersonne" class="update-container-button-button" name="reset">Annuler</a>
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
