<?php include('Header.php');?>

    <div class="body-container">
        <?php if (isset($_SESSION['personneconnectee'])) { ?>
            <div class="home-container-message">
                <div>
                    <?php echo $languageArray['home_message']; ?> <?php echo $_SESSION['personneconnectee']->getUsername(); ?>
                </div>
                <?php include('Message.php'); ?>
            </div>
            
        <?php } else { ?>
            <div class="home-container-message">
                <p>
                    <?php echo $languageArray['home_message_2']; ?>
                </p>
                <p>
                    <span><?php echo $languageArray['home_message_3']; ?></span>
                    <a href="../controleur/Controleur.php?action=allerlogin"><?php echo $languageArray['login_page'];?></a>
                </p>
                
            </div>
        <?php } ?>
    </div>
        

<?php include('Footer.php'); ?>
