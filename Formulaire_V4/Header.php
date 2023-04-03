<!DOCTYPE html>

<?php
require_once 'Personne.php';
require_once 'Genre.php';
require_once 'Role.php';

session_name('myid');
session_start();

if (!isset($_SESSION['language'])) {
    $language = 'fr';
} else {
    $language = $_SESSION['language'];
}
include('LOCAL/' . $language . '.php');

?>

<html lang="<?php echo $language ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">

    <script src="https://kit.fontawesome.com/2b128c0ddb.js" crossorigin="anonymous"></script>
    <title><?php echo $languageArray[$_SESSION['currentpage']]; ?></title>
</head>

<body>
    <header>
        <h1 class="page_title"><?php echo $languageArray[$_SESSION['currentpage']]; ?></h1>
        <h1 hidden class="menu_title">MENU</h1>
        <div class="burgermenu">
            <input id="burger" type="checkbox" />

            <label class="burger" for="burger">
                <span></span>
                <span></span>
                <span></span>
            </label>

            <nav class="menu">    
            <ul>
                <li><a href="Controleur.php?action=alleraccueil"><?php echo $languageArray['home_page']; ?></a></li>
                <li><a href="Controleur.php?action=allercreerpersonne"><?php echo $languageArray['create_page']; ?></a></li>
                <li><a href="Controleur.php?action=allerafficherpersonne"><?php echo $languageArray['display_page'];?></a></li>
            </ul>  
            </nav>
            
        </div>

        <div class="language-container-select">
            <label class="language-container-select-label" for="language"></label>
            <select class="language-container-select-select" name="language" id="languageID">
                <option value="0" disabled selected><?php echo $languageArray['language']; ?></option>
                <option value="fr" <?php echo ($language == 'fr') ? 'selected' : '' ?>><?php echo $languageArray['french']; ?></option>
                <option value="en" <?php echo ($language == 'en') ? 'selected' : '' ?>><?php echo $languageArray['english']; ?></option>
                <option value="ca" <?php echo ($language == 'ca') ? 'selected' : '' ?>><?php echo $languageArray['catalan']; ?></option>
            </select>
        </div>
    </header>