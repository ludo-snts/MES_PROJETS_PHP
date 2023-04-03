<?php 
include('Header.php'); 

// SI NON ADMIN -> ENVOI VERS 403'
if ($_SESSION['personneconnectee']->getRole()->getId() !== 1) {
    header('Location: 403.php');
}
?> 

<div class="body-container">
    <div class="form-container">
        <?php
        $personne = $_SESSION['personne'];
        ?>
        <form method="POST" action="../controleur/Controleur.php?action=modifierpersonne&id=<?php echo $personne->getId(); ?>">
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
                <label class="form-container-input-label" for="mail"><?php echo $languageArray['mail']; ?></label>
                <input class="form-container-input-input" type="email" name="mail" id="mail" value="<?php echo $personne->getMail(); ?>" required>
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

                    <option value="1" <?php echo ($personne->getGenre()->getLibelle() == "ho") ? 'selected' : '' ?>><?php echo $languageArray['man']; ?> </option>
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
            <div class="form-container-input-user">
                <div class="form-container-input">
                    <label class="form-container-input-label" for="username"><?php echo $languageArray['username']; ?></label>
                    <input disabled class="form-container-input-input" type="text" name="username" id="username" value="<?php echo $personne->getUsername(); ?>" required>
                </div>
                <!-- <div class="form-container-input">
                    <label class="form-container-input-label" for="password"><?php echo $languageArray['password']; ?></label>
                    <input disabled class="form-container-input-input" type="password" name="password" id="password" value="<?php echo $personne->getPassword(); ?>" required>
                </div> -->
            </div>
            <?php include('Message.php'); ?>
            <div class="update-container-button">
                <button class="update-container-button-button" type="submit" name="submit" id="submit"><?php echo $languageArray['modify']; ?></button>
                <a href="../controleur/Controleur.php?action=allerafficherpersonne" class="update-container-button-button" id="reset"><?php echo $languageArray['cancel']; ?></a>
            </div>

        </form>
    </div>
</div>


<?php include('Footer.php'); ?>