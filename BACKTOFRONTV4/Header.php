<?php
session_id('myid');
session_start();
// if (!isset($_SESSION["username"])) {
// header("Location: login.php");
// exit();
//}
if (!isset($_SESSION['langue']))
    $lang = 'fr';
else
    $lang = $_SESSION['langue'];

include($lang . '.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="js/JSback.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="creation de compte client ">
    <meta name="keywords" content="creation,user,account,read and love">
    <link rel="icon" type="image/ico" href="asset/ico/terre.ico">
    <link rel="stylesheet" href="style/headerfooter.css">
    <link rel="stylesheet" href="style/creerpersonne.css">
    <link rel="stylesheet" href="style/styleListe_personne.css">
    <link rel="stylesheet" href="style/login.css" />
    <link rel="stylesheet" href="style/accueil.css" />
    <title>Accueil</title>
</head>
<body>
    <div class="boxconteneur" id="conteneur">

        <p class="pheader" id="backto"><?php echo $langArray['backto'] ?></p>

        <p class="pheader" id="choix">
            <select name="langue" id="lang">
                <option value="0" disabled selected><?php echo $langArray['choix'] ?></option>
                <option value="fr"><?php echo $langArray['languefr'] ?></option>
                <option value="en"><?php echo $langArray['langueen'] ?></option>
            </select>
        </p>
        <div id="userdeco">
            <p class="pheader" id="bienvenue">
                <?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?>
            </p>

            <p class="pheader" id="deco">
                <a href="logout.php"><?php echo $langArray['deco'] ?></a>
            </p>
        </div>
    </div>
</body>

</html>