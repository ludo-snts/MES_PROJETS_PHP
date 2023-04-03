<!DOCTYPE html>

<?php
require_once 'Personne.php';
require_once 'Genre.php';


if (!isset($_SESSION['language'])) {
    $language = 'fr';
} else {
    $language = $_SESSION['language'];
}
include('LOCAL/' . $language . '.php');



session_name('myid');
session_start();

$_SESSION['currentpage'] = 'Accueil.php';
?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title><?php echo $languageArray[$language][$_SESSION['currentpage']]; ?></title>
</head>

<body>
    <header>
        <h1><?php echo $languageArray[$language][$_SESSION['currentpage']]; ?></h1>
        <div class="language-container-select">
            <label class="language-container-select-label" for="language"></label>
            <select class="language-container-select-select" name="language" id="languageID">
                <option value="0" disabled selected><?php echo $languageArray[$language]['language']; ?></option>
                <option value="1" <?php echo ($language == 'fr') ? 'selected' : '' ?>><?php echo $languageArray[$language]['french']; ?></option>
                <option value="2" <?php echo ($language == 'en') ? 'selected' : '' ?>><?php echo $languageArray[$language]['english']; ?></option>
                <option value="3" <?php echo ($language == 'ca') ? 'selected' : '' ?>><?php echo $languageArray[$language]['catalan']; ?></option>
            </select>
        </div>
    </header>