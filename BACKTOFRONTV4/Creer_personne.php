 <?php
    require_once 'Genre.php';
    require_once 'Role.php';
    include 'Header.php';
    ?>
 <div id="containeurcrea">
     <div class="divheader" id="headercrea"><?php echo $langArray['creation'] ?></div>

     <form class="formcrea" method="POST" action="Controleur.php?action=creer_personne">
         <div class="divlegend" id="legendcrea">
             <legend><?php echo $langArray['cara'] ?></legend>
         </div>

         <div class="labelinput">

             <p>
                 <label class="label" for="prenom" ;><?php echo $langArray['prenom'] ?> : </label>
                 <input class="input" type="text" id="prenom" name="prenom" placeholder="<?php echo $langArray['enter'].$langArray['prenom'] ?>" size='20'>
                 <img src="asset/png/champ.png" alt="astérisque rouge">
             </p>
             <p>
                 <label class="label" for="nom"><?php echo $langArray['nom'] ?>: </label>
                 <input class="input" type="text" id="nom" name="nom" placeholder="<?php echo $langArray['enter'].$langArray['nom'] ?>" size='20'>
                 <img src="asset/png/champ.png" alt="astérisque rouge">
             </p>
             <p><label class="label" for="mail"><?php echo $langArray['mail'] ?>: </label>
                 <input class="input" type="email" id="mail" name="mail" placeholder="<?php echo $langArray['enter'].$langArray['mail'] ?>" size='20'>
                 <img src="asset/png/champ.png" alt="astérisque rouge">
             </p>
             <p>
                 <label class="label" for="age"><?php echo $langArray['age'] ?>: </label>
                 <input class="input" type="number" id="age" name="age" placeholder="<?php echo $langArray['enter'].$langArray['age'] ?>" size='20'><img src="asset/png/champ.png" alt="astérisque rouge">
             </p>
             <p><label class="label" for="username"><?php echo $langArray['user'] ?>: </label>
                 <input class="input" type="text" id="username" name="username" placeholder="<?php echo $langArray['enter'].$langArray['user'] ?>" size='20'>
                 <img src="asset/png/champ.png" alt="astérisque rouge">
             </p>
             <p><label class="label" for="password"><?php echo $langArray['pass'] ?>: </label>
                 <input class="input" type="text" id="password" name="password" placeholder="<?php echo $langArray['enter'].$langArray['pass'] ?>">
                 <img src="asset/png/champ.png" alt="astérisque rouge">
             </p>
             <p>
                 <label><?php echo $langArray['genre'] ?> : </label><?php $tab_genres = $_SESSION['genres']; ?>
                 <select class="select" name="genre" id="combobox" style="width: 149px">

                     <option value="" disabled selected><?php echo $langArray['choix'] ?></option>
                     <?php foreach ($tab_genres as $genre) { ?>
                         <option value="<?php echo $genre->getId(); ?>">
                             <?php if (strcmp($genre->getLibelle(), "Masculin"))
                                    echo $langArray['ho'];
                                    else
                                    echo $langArray['fe'];?></option>
                     <?php } ?>
                 </select>
                 <img src="asset/png/champ.png" alt="astérisque rouge">
             </p>
             <p>
                 <label><?php echo $langArray['role'] ?> : </label><?php $tab_roles = $_SESSION['roles']; ?>
                 <select class="select" name="role" id="comborole" style="width: 149px">
                     <option value="" disabled selected><?php echo $langArray['choix'] ?></option>
                     <?php foreach ($tab_roles as $role) { ?>
                         <option value="<?php echo $role->getId(); ?>">
                             <?php if (strcmp($role->getLibelle(), "Administrateur"))
                                    echo $langArray['util'];
                                    else
                                    echo $langArray['admini'];?></option>
                     <?php } ?>
                 </select>
                 <img src="asset/png/champ.png" alt="astérisque
                 rouge">
             </p>
         </div>

         <p class="pphp">
             <?php
                if (isset($_SESSION['message']))
                    echo $_SESSION['message'] ;
                ?>
         </p>
         <div  id="champsobligatoires" class="fincrea"> <?php echo $langArray['champ'] ?><img class="imgchamp" src="asset/png/champ.png" alt="astérisque rouge"></div>

         <div  id="divbutton" class="fincrea">
             <button class="buttoncrea" id="submit" name="submit" type="submit"><?php echo $langArray['valider'] ?></button>
             <button class="buttoncrea" type="reset" id="reset" name="reset"><?php echo $langArray['effacer'] ?></button>
         </div>
         <p class="fincrea"><?php echo $langArray['deja'] ?> <a href="Controleur.php?action=retouraccueil" style='color:grey'><?php echo $langArray['revenir'] ?></a></p>
     </form>
 </div>
 <?php include 'Footer.php'; ?>