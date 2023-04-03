<?php
include "Header.php";
?> 
<form class="box" action="Controleur.php?action=connecter" method="post" name="login">
  <h1 class="box-title"><?php echo $langArray['connex'] ?></h1>
  <input type="text" id="userinput" class="box-input" name="username" placeholder="<?php echo $langArray['user'] ?>">
  <input type="password" id="passinput" class="box-input" name="password" placeholder="<?php echo $langArray['pass'] ?>">
  <input type="submit" value="Connexion " name="submit" class="box-button">

  <p class="box-register"><?php echo $langArray['nouveau'] ?> <a href="Controleur.php?action=afficher_creer_personne"><?php echo $langArray['inscr'] ?></a></p>

  <?php if (!empty($message)) { ?>

    <p class="errorMessage"><?php echo $message; ?></p>
  <?php } ?>
</form>
<?php include "Footer.php"; ?>