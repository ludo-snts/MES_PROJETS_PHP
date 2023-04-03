<?php 
include('Header.php'); 
$_SESSION['currentpage'] = 'Afficher_personne.php';
?>

<div class="body-container">
    <div class="list-container">
        <div>
            <p class="list-container-title"><?php echo $languageArray['people']; ?></p>
            <table class="list-container-tab">
                <thead class="list-container-tab-head">
                    <tr>
                        <th hidden><?php echo $languageArray['id']; ?></th>
                        <th><?php echo $languageArray['firstname']; ?></th>
                        <th><?php echo $languageArray['lastname']; ?></th>
                        <th><?php echo $languageArray['age']; ?></th>
                        <th><?php echo $languageArray['mail']; ?></th>
                        <th><?php echo $languageArray['gender']; ?></th>
                        <th><?php echo $languageArray['role']; ?></th>
                        <th><?php echo $languageArray['modify']; ?></th>
                        <th><?php echo $languageArray['delete']; ?></th>
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
                                if ($personne->getGenre()->getLibelle() == "ho") echo $languageArray['man'];
                                if ($personne->getGenre()->getLibelle() == "fe") echo $languageArray['woman'];
                                if ($personne->getGenre()->getLibelle() == "au") echo $languageArray['other'];
                                ?>
                            </td>
                            <td>
                            <?php
                                if ($personne->getRole()->getLibelle() == "adm") echo $languageArray['admin'];
                                if ($personne->getRole()->getLibelle() == "usr") echo $languageArray['user'];
                                ?>
                            </td>


                            <!-- <td>test</td> -->
                            <td>
                                <a type="submit" class="list-container-tab-body-button" href="Controleur.php?action=afficherunepersonne&id=<?php echo $personne->getId(); ?>"><?php echo $languageArray['modify_icon']; ?></a>
                            </td>
                            <td>
                                <a id="delete-personne-button" class="list-container-tab-body-button delete-personne" href="Controleur.php?action=supprimerpersonne&id=<?php echo $personne->getId(); ?>"><?php echo $languageArray['delete_icon']; ?></a>
                            </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>



        </div>
    </div>
    <!-- <div class="form-container-link">
        <a href="Controleur.php?action=alleraccueil"><?php echo $languageArray['home_page']; ?></a>
    </div>
    <div class="form-container-link">
        <a href="Controleur.php?action=allercreerpersonne"><?php echo $languageArray['create_page']; ?></a>
    </div> -->
</div>
<?php include('Footer.php'); ?>