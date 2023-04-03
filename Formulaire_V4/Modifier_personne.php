<?php include('Header.php'); 
$_SESSION['currentpage'] = 'Modifier_personne.php';
?>

<div class="body-container">
    <div class="form-container">
        <?php
        $personne = $_SESSION['personne'];
        ?>
        <form method="POST" action="Controleur.php?action=modifierpersonne&id=<?php echo $personne->getId(); ?>">
            <p class="form-container-title"><?php echo $languageArray['modify_data']; ?></p>
            <div hidden class="form-container-input">
                <label hidden class="form-container-input-label" for="id"><?php echo $languageArray['id']; ?></label>
                <input hidden class="form-container-input-input" type="text" name="id" id="id" value="<?php echo $personne->getId(); ?>">
            </div>
            <div class="form-container-input">
                <label class="form-container-input-label" for="prenom"><?php echo $languageArray['firstname']; ?></label>
                <input class="form-container-input-input" type="text" name="prenom" id="prenom" value="<?php echo $personne->getPrenom(); ?>" required>
            </div>
            <div class="form-container-input">
                <label class="form-container-input-label" for="nom"><?php echo $languageArray['lastname']; ?></label>
                <input class="form-container-input-input" type="text" name="nom" id="nom" value="<?php echo $personne->getNom(); ?>" required>
            </div>
            <div class="form-container-input">
                <label class="form-container-input-label" for="date_naissance"><?php echo $languageArray['mail']; ?></label>
                <input class="form-container-input-input" type="mail" name="mail" id="mail" value="<?php echo $personne->getMail(); ?>" required>
            </div>
            <div class="form-container-input form-container-input-age">
                <label class="form-container-input-label" for="age"><?php echo $languageArray['age']; ?></label>
                <input class="form-container-input-input" type="text" name="age" id="age" value="<?php echo $personne->getAge(); ?>" required>
                <span><?php echo $languageArray['year_old']; ?></span>
            </div>
            <div class="form-container-select">
                <label class="form-container-select-label" for="genre"><?php echo $languageArray['gender']; ?></label>
                <select class="form-container-select-select" name="genre" id="genre">
                    <option value="0" disabled><?php echo $languageArray['select_gender']; ?></option>
                    <option value="1" <?php echo ($personne->getGenre()->getLibelle() == "ho") ? 'selected' : '' ?>><?php echo $languageArray['man']; ?></option>
                    <option value="2" <?php echo ($personne->getGenre()->getLibelle() == "fe") ? 'selected' : '' ?>><?php echo $languageArray['woman']; ?></option>
                    <option value="3" <?php echo ($personne->getGenre()->getLibelle() == "au") ? 'selected' : '' ?>><?php echo $languageArray['other']; ?></option>
                </select>
            </div>
            <div class="form-container-select">
                <label class="form-container-select-label" for="role"><?php echo $languageArray['role']; ?></label>
                <select class="form-container-select-select" name="role" id="role">
                    <option value="0" disabled><?php echo $languageArray['select_role']; ?></option>
                    <option value="1" <?php echo ($personne->getRole()->getLibelle() == "adm") ? 'selected' : '' ?>><?php echo $languageArray['admin']; ?></option>
                    <option value="2" <?php echo ($personne->getRole()->getLibelle() == "usr") ? 'selected' : '' ?>><?php echo $languageArray['user']; ?></option>
                </select>
            </div>

            <div class="update-container-button">
                <button class="update-container-button-button" type="submit" name="submit" value="submit"><?php echo $languageArray['modify']; ?></button>
                <a href="Controleur.php?action=allerafficherpersonne" class="update-container-button-button" name="reset"><?php echo $languageArray['cancel']; ?></a>
            </div>
        </form>
    </div>
    <div class="form-container-link">
        <a href="Controleur.php?action=alleraccueil"><?php echo $languageArray['home_page']; ?></a>
    </div>
    <div class="form-container-link">
        <a href="Controleur.php?action=allerafficherpersonne"><?php echo $languageArray['display_page']; ?></a>
    </div>
</div>


<?php include('Footer.php'); ?>