<?php include('Header.php'); ?> 

    <div class="body-container">

        <div class="homepage-container-link">
            <a href="Controleur.php?action=allercreerpersonne"><?php echo $languageArray[$language]['create_page'];?></a>
        </div>
        <div class="homepage-container-link">
            <a href="Controleur.php?action=allerafficherpersonne"><?php echo $languageArray[$language]['display_page'];?></a>
        </div>
    </div>

    <?php include('Footer.php'); ?>    
