<?php include('Header.php'); ?>

<div class="body-container">
    <div class="form-container">
        <?php
        $personne = $_SESSION['personne'];
        ?>
        <form method="POST" action="Controleur.php?action=modifierpersonne&id=<?php echo $personne->getId(); ?>">
            <p class="form-container-title"><?php echo $languageArray[$language]['modify_data']; ?></p>
            <div hidden class="form-container-input">
                <label hidden class="form-container-input-label" for="id"><?php echo $languageArray[$language]['id']; ?></label>
                <input hidden class="form-container-input-input" type="text" name="id" id="id" value="<?php echo $personne->getId(); ?>">
            </div>
            <div class="form-container-input">
                <label class="form-container-input-label" for="prenom"><?php echo $languageArray[$language]['firstname']; ?></label>
                <input class="form-container-input-input" type="text" name="prenom" id="prenom" value="<?php echo $personne->getPrenom(); ?>" required>
            </div>
            <div class="form-container-input">
                <label class="form-container-input-label" for="nom"><?php echo $languageArray[$language]['lastname']; ?></label>
                <input class="form-container-input-input" type="text" name="nom" id="nom" value="<?php echo $personne->getNom(); ?>" required>
            </div>
            <div class="form-container-input">
                <label class="form-container-input-label" for="date_naissance"><?php echo $languageArray[$language]['mail']; ?></label>
                <input class="form-container-input-input" type="mail" name="mail" id="mail" value="<?php echo $personne->getMail(); ?>" required>
            </div>
            <div class="form-container-input form-container-input-age">
                <label class="form-container-input-label" for="age"><?php echo $languageArray[$language]['age']; ?></label>
                <input class="form-container-input-input" type="text" name="age" id="age" value="<?php echo $personne->getAge(); ?>" required>
                <span><?php echo $languageArray[$language]['year_old']; ?></span>
            </div>
            <div class="form-container-select">
                <label class="form-container-select-label" for="genre"><?php echo $languageArray[$language]['gender']; ?></label>
                <select class="form-container-select-select" name="genre" id="genre">
                    <option value="0" disabled><?php echo $languageArray[$language]['select_gender']; ?></option>
                    <option value="1" <?php echo ($personne->getGenre()->getLibelle() == "ho") ? 'selected' : '' ?>><?php echo $languageArray[$language]['man']; ?></option>
                    <option value="2" <?php echo ($personne->getGenre()->getLibelle() == "fe") ? 'selected' : '' ?>><?php echo $languageArray[$language]['woman']; ?></option>
                    <option value="3" <?php echo ($personne->getGenre()->getLibelle() == "au") ? 'selected' : '' ?>><?php echo $languageArray[$language]['other']; ?></option>
                </select>
            </div>

            <div class="update-container-button">
                <button class="update-container-button-button" type="submit" name="submit" value="submit"><?php echo $languageArray[$language]['modify']; ?></button>
                <a href="Controleur.php?action=allerafficherpersonne" class="update-container-button-button" name="reset"><?php echo $languageArray[$language]['cancel']; ?></a>
            </div>
        </form>
    </div>
    <div class="form-container-link">
        <a href="Controleur.php?action=alleraccueil"><?php echo $languageArray[$language]['home_page']; ?></a>
    </div>
    <div class="form-container-link">
        <a href="Controleur.php?action=allerafficherpersonne"><?php echo $languageArray[$language]['display_page']; ?></a>
    </div>
</div>


<?php include('Footer.php'); ?>