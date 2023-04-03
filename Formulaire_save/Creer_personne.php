<!DOCTYPE html>
<?php
session_name('myid');
session_start();
?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Créer Personne</title>
</head>

<body>
    <header>
        <h1>CRÉER PERSONNE</h1>
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
                    <input class="form-container-input-input" type="text" name="prenom" id="prenom" >
                </div>
                <div class="form-container-input">
                    <label class="form-container-input-label" for="nom">Nom</label>
                    <input class="form-container-input-input" type="text" name="nom" id="nom" >
                </div>
                <div class="form-container-input">
                    <label class="form-container-input-label" for="date_naissance">Mail</label>
                    <input class="form-container-input-input" type="mail" name="mail" id="mail" >
                </div>
                <div class="form-container-input form-container-input-age">
                    <label class="form-container-input-label" for="age">Age</label>
                    <input class="form-container-input-input" type="text" name="age" id="age" >
                    <span>ANS</span>
                </div>
                <div class="form-container-radio">
                    <span class="form-container-radio-title">Genre</span>
                    <div class="form-container-radio-check-group">
                        <span class="form-container-radio-check">
                            <label class="form-container-radio-check-container" for="femme">Femme
                                <input type="radio" id="femme" name="genre" value="femme">
                                <span class="form-container-radio-check-checkmark"></span>
                            </label>
                        </span>
                        <span class="form-container-radio-check">
                            <label class="form-container-radio-check-container" for="homme">Homme
                                <input type="radio" id="homme" name="genre" value="homme">
                                <span class="form-container-radio-check-checkmark"></span>
                            </label>
                        </span>
                        <span class="form-container-radio-check">
                            <label class="form-container-radio-check-container" for="autre">Autre
                                <input type="radio" id="autre" name="genre" value="autre">
                                <span class="form-container-radio-check-checkmark"></span>
                            </label>
                        </span>
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