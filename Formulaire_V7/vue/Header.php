<!DOCTYPE html>

<?php
// require_once '../modele/entite/Personne.php';
// require_once '../modele/entite/Genre.php';
// require_once '../modele/entite/Role.php';

require_once '../autoloader.php';

session_name('myid');
if(session_status() === PHP_SESSION_NONE) 
    session_start();

if (!isset($_SESSION['language'])) {
    $language = 'fr';
} else {
    $language = $_SESSION['language'];
}
include('LOCAL/' . $language . '.php');


// RECUPERER l'URL DE LA PAGE EN COURS ET SEPARER CHAQUE ELEMENTS ENTRE LES /
$url= explode('/',$_SERVER['SCRIPT_NAME']);
// PRENDRE LE DERNIER ELEMENT QUI CORRESPOND A NOTRE PAGE EN COURS (EX:ACCUEIL.PHP)
$currentpage = $url[count($url)-1];
//DEFINIR EN CURRENT PAGE de $_SESSION CET ELEMENT
$_SESSION['currentpage'] = $currentpage;
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
        <h1 class="page-title"><?php echo $languageArray[$_SESSION['currentpage']]; ?></h1>
        <h1 hidden class="menu-title">MENU</h1>

        <?php if (isset($_SESSION['personneconnectee'])) { ?>
        <div class="burgermenu">
            <input id="burger" type="checkbox">

            <label class="burger" for="burger">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <nav class="menu">
                <ul>
                    <?php if ($_SESSION['currentpage'] !== 'Accueil.php') { ?>
                        <li><a href="../controleur/Controleur.php?action=alleraccueil"><?php echo $languageArray['home_page']; ?></a></li>
                    <?php } ?>
                    <?php if ($_SESSION['currentpage'] !== 'Creer_personne.php' && $_SESSION['personneconnectee']->getRole()->getId() === 1) { ?>
                        <li><a href="../controleur/Controleur.php?action=allercreerpersonne"><?php echo $languageArray['create_page']; ?></a></li>
                    <?php } ?>
                    <?php if ($_SESSION['currentpage'] !== 'Afficher_personne.php') { ?>
                    <li><a href="../controleur/Controleur.php?action=allerafficherpersonne"><?php echo $languageArray['display_page'];?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <?php } ?>
        <div class="user-container">
            <?php if (isset($_SESSION['personneconnectee'] )) { ?>
                <div class="user-container-hello"><?php echo $languageArray['hello_message'];?><?php echo $_SESSION['personneconnectee']->getUsername(); ?></div>
            <?php } else { ?>
                <div class="user-container-hello"><?php echo $languageArray['hello_message'];?><?php echo $languageArray['guest']; ?></div>
            <?php } ?>



            <div class="user-container-block">
                <div class="user-container-block-icon"><i class="fa-solid fa-user fa-xl"></i></div>
                <?php if (isset($_SESSION['personneconnectee'])) { ?>
                <div class="user-container-block-text">
                    <a href="../controleur/Controleur.php?action=deconnexion" class="user-container-block-text-link"><?php echo $languageArray['logout']; ?></a>
                </div>
                <?php }?>
                    


            </div>
        </div>
        <div class="language-container-select">
            <label class="language-container-select-label" for="languageID"></label>
            <select class="language-container-select-select" name="language" id="languageID">
                <option value="0" disabled><?php echo $languageArray['language']; ?></option>
                <option value="fr" <?php echo ($language == 'fr') ? 'selected' : '' ?>><?php echo $languageArray['french']; ?></option>
                <option value="en" <?php echo ($language == 'en') ? 'selected' : '' ?>><?php echo $languageArray['english']; ?></option>
                <option value="ca" <?php echo ($language == 'ca') ? 'selected' : '' ?>><?php echo $languageArray['catalan']; ?></option>
            </select>
        </div>
    </header>