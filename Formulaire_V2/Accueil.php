<?php
require_once 'Controleur.php';

// session_name('myid');
// session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">

    <title>Accueil V2</title>
</head>

<body>
    <header>
        <h1>ACCUEIL V2</h1>
    </header>
    <div class="body-container">

        <div class="homepage-container-link">
            <a href="Controleur.php?action=allercreerpersonne">Créer Personne</a>
        </div>
        <div class="homepage-container-link">
            <a href="Controleur.php?action=allerafficherpersonne">Afficher Personne</a>
        </div>
    </div>

    <?php include('Footer.php'); ?>    
