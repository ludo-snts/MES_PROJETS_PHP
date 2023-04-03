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
    <title>Afficher Personne</title>
</head>

<body>
    <header>
        <h1>AFFICHER PERSONNE</h1>
    </header>
    <div class="body-container">
        <div class="list-container">
            <div>
                <p class="list-container-title">Personnes</p>
                <table class="list-container-tab">
                    <thead class="list-container-tab-head">
                        <tr>
                        <th hidden>Id</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Age</th>
                            <th>Mail</th>
                            <th>Genre</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody class="list-container-tab-body">

                        <tr>
                            <?php
                            $tab_personnes = $_SESSION['personnes'];
                            foreach ($tab_personnes as $personne) { ?>
                                <td hidden >
                                    <?php echo $personne->getId(); ?>
                                </td>
                                <td>
                                    <?php echo $personne->getPrenom(); ?>
                                </td>
                                <td>
                                    <?php echo $personne->getNom(); ?>
                                </td>
                                <td>
                                    <?php echo $personne->getAge(); ?>
                                </td>
                                <td>
                                    <?php echo $personne->getMail(); ?>
                                </td>
                                <td>
                                    <?php echo $personne->getGenre(); ?>
                                </td>
                                <td>
                                <a type="submit" class="list-container-tab-body-button" href="Controleur.php?action=afficherunepersonne&id=<?php echo $personne->getId(); ?>">MOD</a>
                                </td>
                                <td>
                                    <a id="delete-personne-button" class="list-container-tab-body-button delete-personne" href="Controleur.php?action=supprimerpersonne&id=<?php echo $personne->getId(); ?>">SUPP</a>
                                </td>
                            </tr>
                    <?php } ?>
                    </tbody>
                </table>



            </div>
        </div>
        <div class="form-container-link">
            <a href="Controleur.php?action=alleraccueil">Retour à l'accueil </a>
        </div>
        <div class="form-container-link">
            <a href="Controleur.php?action=allercreerpersonne">Créer Personne</a>
        </div>
    </div>
    <?php include('Footer.php'); ?>