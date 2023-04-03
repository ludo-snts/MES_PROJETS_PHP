<?php
require_once 'Genre.php';
require_once 'Personne.php';

include 'Header.php'; ?>

<div class="divgeneral">
    <div class="divtab">
        <table id="tab">
            <thead id="thead1">
                <tr>
                    <th scope="col"><?php echo $langArray['id'] ?></th>
                    <th scope="col"><?php echo $langArray['prenom'] ?></th>
                    <th scope="col"><?php echo $langArray['nom'] ?></th>
                    <th scope="col"><?php echo $langArray['mail'] ?></th>
                    <th scope="col"><?php echo $langArray['age'] ?></th>
                    <th scope="col"><?php echo $langArray['genre'] ?></th>
                    <th scope="col"><?php echo $langArray['role'] ?></th>
                    <th scope="col"><?php echo $langArray['modifier'] ?></th>
                    <th scope="col"><?php echo $langArray['supprimer'] ?></th>
                </tr>
            </thead>
            <tbody id="tbody1">
                <?php $tab = $_SESSION['personnes'] ?>
                <?php foreach ($tab as $personne) { ?>
                    <tr>
                        <td><?php echo $personne->getId(); ?></td>
                        <td> <?php echo $personne->getPrenom(); ?> </td>
                        <td> <?php echo $personne->getNom(); ?> </td>
                        <td> <?php echo $personne->getMail(); ?> </td>
                        <td> <?php echo $personne->getAge(); ?> </td>
                        <td> <?php echo $personne->getGenre(); ?> </td>
                        <td> <?php echo $personne->getRole(); ?> </td>
                        <td> <a class="aaa" href="Controleur.php?action=afficher_modification&id=<?php echo $personne->getId(); ?>" style='color:orange'><?php echo $langArray['modifier']; ?></a></td>
                        <td> <a class="aaa" href="Controleur.php?action=supprimerpersonne&id=<?php echo $personne->getId(); ?>" style='color:orange'><?php echo $langArray['supprimer']; ?></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="urlfoot">
    <a href="Controleur.php?action=retouraccueil" style='color:grey'><?php echo $langArray['revenir']  ?></a>
</div>
<?php include 'Footer.php'; ?>