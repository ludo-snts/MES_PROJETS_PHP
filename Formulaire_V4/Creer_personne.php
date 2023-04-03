<?php 
include('Header.php'); 
$_SESSION['currentpage'] = 'Creer_personne.php';
?>


<div class="body-container">
    <div class="form-container">
        <form method="POST" action="Controleur.php?action=creerpersonne">
            <p class="form-container-title"><?php echo $languageArray['data']; ?></p>
            <div hidden class="form-container-input">
                <label hidden class="form-container-input-label" for="id"><?php echo $languageArray['id']; ?></label>
                <input hidden class="form-container-input-input" type="text" name="id" id="id" value="-1">
            </div>
            <div class="form-container-input">
                <label class="form-container-input-label" for="prenom"><?php echo $languageArray['firstname']; ?></label>
                <input class="form-container-input-input" type="text" name="prenom" id="prenom">
            </div>
            <div class="form-container-input">
                <label class="form-container-input-label" for="nom"><?php echo $languageArray['lastname']; ?></label>
                <input class="form-container-input-input" type="text" name="nom" id="nom">
            </div>
            <div class="form-container-input">
                <label class="form-container-input-label" for="date_naissance"><?php echo $languageArray['mail']; ?></label>
                <input class="form-container-input-input" type="mail" name="mail" id="mail">
            </div>
            <div class="form-container-input form-container-input-age">
                <label class="form-container-input-label" for="age"><?php echo $languageArray['age']; ?></label>
                <input class="form-container-input-input" type="text" name="age" id="age">
                <span><?php echo $languageArray['year_old']; ?></span>
            </div>
            <div>
                <?php $tab_genres = $_SESSION['genres']; ?>
                <div class="form-container-select">
                    <label class="form-container-select-label" for="genre"><?php echo $languageArray['gender']; ?></label>
                    <select class="form-container-select-select" name="genre" id="genre">
                        <option value="0" disabled selected><?php echo $languageArray['select_gender']; ?></option>
                        <?php
                        $tab_genres = $_SESSION['genres'];
                        foreach ($tab_genres as $genre) { ?>
                            <option value="<?php echo $genre->getId(); ?>">
                            <?php 
                            if ($genre->getLibelle() == "ho") echo $languageArray['man'];
                            if ($genre->getLibelle() == "fe") echo $languageArray['woman'];
                            if ($genre->getLibelle() == "au") echo $languageArray['other']; 
                            ?> 
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div>
                <?php $tab_roles = $_SESSION['roles']; ?>
                <div class="form-container-select">
                    <label class="form-container-select-label" for="role"><?php echo $languageArray['role']; ?></label>
                    <select class="form-container-select-select" name="role" id="role">
                        <option value="0" disabled selected><?php echo $languageArray['select_role']; ?></option>

                        <?php
                        $tab_roles = $_SESSION['roles'];
                        foreach ($tab_roles as $role) { ?>
                            <option value="<?php echo $role->getId(); ?>">
                            <?php 
                            if ($role->getLibelle() == "adm") echo $languageArray['admin'];
                            if ($role->getLibelle() == "usr") echo $languageArray['user'];
                            ?> 
                            </option>
                        <?php } ?>

                    </select>
                </div>
            </div>

            <?php if (!empty($_SESSION['message'])) { ?>
                <div class="form-container-message" id="message">
                    <?php echo $_SESSION['message']; ?>
                </div>
            <?php } ?>


            <div class="form-container-button">
                <button class="form-container-button-button" type="submit" name="submit" value="submit"><?php echo $languageArray['create']; ?></button>
                <button class="form-container-button-button" type="reset" name="reset" value="reset"><?php echo $languageArray['cancel']; ?></button>
            </div>
        </form>
    </div>
    <!-- <div class="form-container-link">
        <a href="Controleur.php?action=alleraccueil"><?php echo $languageArray['home_page']; ?></a>
    </div>
    <div class="form-container-link">
        <a href="Controleur.php?action=allerafficherpersonne"><?php echo $languageArray['display_page']; ?></a>
    </div> -->
</div>


<?php include('Footer.php'); ?>