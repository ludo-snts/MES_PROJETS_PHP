<?php include('Header.php');?>

<div class="body-container">
    <div class="quatre_cent_trois-container">
        <section class="quatre_cent_trois-container-message">
            <p class="quatre_cent_trois-container-message-text"><?php echo $languageArray['403_message_1']; ?></p>
        </section>
        <section class="quatre_cent_trois-container-image">
            <img class="quatre_cent_trois-container-image-image" src="./ASSET/IMG/gandalf.png" alt="403_Gandalf">
        </section>
        <section class="quatre_cent_trois-container-button">
            <a class="quatre_cent_trois-container-button-button" href="../controleur/Controleur.php?action=alleraccueil">
                <?php echo $languageArray['home_page']; ?>
            </a>
        </section>
    </div>
    
</div>

<!-- <?php include('Footer.php'); ?> -->