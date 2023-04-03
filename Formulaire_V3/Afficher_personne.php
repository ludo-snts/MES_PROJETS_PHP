<?php include('Header.php'); ?>

<div class="body-container">
    <div class="list-container">
        <div>
            <p class="list-container-title"><?php echo $languageArray[$language]['people']; ?></p>
            <table class="list-container-tab">
                <thead class="list-container-tab-head">
                    <tr>
                        <th hidden><?php echo $languageArray[$language]['id']; ?></th>
                        <th><?php echo $languageArray[$language]['firstname']; ?></th>
                        <th><?php echo $languageArray[$language]['lastname']; ?></th>
                        <th><?php echo $languageArray[$language]['age']; ?></th>
                        <th><?php echo $languageArray[$language]['mail']; ?></th>
                        <th><?php echo $languageArray[$language]['gender']; ?></th>
                        <th><?php echo $languageArray[$language]['modify']; ?></th>
                        <th><?php echo $languageArray[$language]['delete']; ?></th>
                    </tr>
                </thead>
                <tbody class="list-container-tab-body">

                    <tr>
                        <?php
                        $tab_personnes = $_SESSION['personnes'];
                        foreach ($tab_personnes as $personne) { ?>
                            <td hidden>
                                <?php echo $personne->getId(); ?>
                            </td>
                            <td>
                                <?php echo $personne->getPrenom(); ?>
                            </td>
                            <td>
                                <?php echo $personne->getNom(); ?>
                            </td>
                            <td>
                                <?php echo $personne->getAge(); ?>
                            </td>
                            <td>
                                <?php echo $personne->getMail(); ?>
                            </td>
                            <td>
                                <?php
                                if ($personne->getGenre()->getLibelle() == "ho") echo $languageArray[$language]['man'];
                                if ($personne->getGenre()->getLibelle() == "fe") echo $languageArray[$language]['woman'];
                                if ($personne->getGenre()->getLibelle() == "au") echo $languageArray[$language]['other'];
                                ?>
                            </td>
                            <td>
                                <a type="submit" class="list-container-tab-body-button" href="Controleur.php?action=afficherunepersonne&id=<?php echo $personne->getId(); ?>"><?php echo $languageArray[$language]['modify']; ?></a>
                            </td>
                            <td>
                                <a id="delete-personne-button" class="list-container-tab-body-button delete-personne" href="Controleur.php?action=supprimerpersonne&id=<?php echo $personne->getId(); ?>"><?php echo $languageArray[$language]['delete']; ?></a>
                            </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>



        </div>
    </div>
    <div class="form-container-link">
        <a href="Controleur.php?action=alleraccueil"><?php echo $languageArray[$language]['home_page']; ?></a>
    </div>
    <div class="form-container-link">
        <a href="Controleur.php?action=allercreerpersonne"><?php echo $languageArray[$language]['create_page']; ?></a>
    </div>
</div>
<?php include('Footer.php'); ?>