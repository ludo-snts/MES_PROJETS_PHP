<?php include 'Header.php'; ?>
<div class="accbox">
    <div class="pagacc">
        <h1><strong><?php echo $langArray['titre'] ?></strong></h1>
    </div>

    <div class="pagacc">
        <a href="Controleur.php?action=afficher_liste_personne" style='color:orange'><?php echo $langArray['liste'] ?></a>
    </div>
    <div class="pagacc">
        <a href="Controleur.php?action=afficher_creer_personne" style='color:orange'><?php echo $langArray['creapers'] ?></a>
    </div>

</div>
<?php include 'Footer.php' ?>