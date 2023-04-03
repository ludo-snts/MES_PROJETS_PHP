<?php 
include('Header.php');

// session_destroy(); 

// SI DEJA CONNECTE -> ENVOI VERS ACCUEIL
if (isset($_SESSION['personneconnectee'])) {
    header('Location: Accueil.php');
}
?> 

<div class="body-container">
    <div class="login-container">
        <form method="POST" action="../controleur/Controleur.php?action=connexionreussie">
            <p class="login-container-title"><?php echo $languageArray['connect']; ?></p>
            <div class="login-container-input">
                <label class="login-container-input-label" for="username"><?php echo $languageArray['username']; ?></label>
                <input class="login-container-input-input" type="text" name="username" id="username">
            </div>
            <div class="login-container-input form-container-input-password">
                <label class="login-container-input-label" for="password"><?php echo $languageArray['password']; ?></label>
                <input class="login-container-input-input" type="password" name="password" id="password">
                <i class="fa-solid fa-lock" id="toggleicon"></i>
            </div>
            <?php if (!empty($_SESSION['message'])) { ?>
                    <div class="form-container-message" id="message">
                        <?php echo $_SESSION['message']; ?>
                    </div>
            <?php } ?>
            <div class="login-container-button">
                <button class="login-container-button-button" type="submit" name="submit" value="submit"><?php echo $languageArray['connect']; ?></button>
            </div>
        </form>
    </div>  
</div>

<?php include('Footer.php'); ?>    
