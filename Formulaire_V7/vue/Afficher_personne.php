<?php include('Header.php'); ?>

    <div class="body-container">
    <div class="list-container">
        <div>
            <p class="list-container-title"><?php echo $languageArray['person']; ?></p>
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
                        <th><?php echo $languageArray['username']; ?></th>

                        <?php if ($_SESSION['personneconnectee']->getRole()->getId() === 1) { ?>
                        <th><?php echo $languageArray['modify']; ?></th>
                        <th><?php echo $languageArray['delete']; ?></th>
                        <?php } ?>

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
                            <td>
                                <?php echo $personne->getUsername(); ?>
                            </td>
                            <?php if ($_SESSION['personneconnectee']->getRole()->getId() === 1) { ?>
                            <td>
                                <a class="list-container-tab-body-button" href="../controleur/Controleur.php?action=afficherunepersonne&id=<?php echo $personne->getId(); ?>"><?php echo $languageArray['modify_icon']; ?></a>
                            </td>
                            <td>
                                <?php if ($_SESSION['personneconnectee']->getId() !== $personne->getId()) { ?>
                                <a id="delete-personne-button" class="list-container-tab-body-button delete-personne" href="../controleur/Controleur.php?action=supprimerpersonne&id=<?php echo $personne->getId(); ?>"><?php echo $languageArray['delete_icon']; ?></a>
                                <?php }?>
                            </td>
                            <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
                            


        </div>
        <?php include('Message.php'); ?>
    </div>
</div>
<?php include('Footer.php'); ?>

