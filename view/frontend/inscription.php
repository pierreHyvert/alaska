<?php $title = 'S\'inscrire';
$page = 'inscription';
$description = '';

ob_start();
?>
<div class="row">
  <div class="col s10 offset-s1">
  <?php
  if (isset($errors) && !empty($errors)){
    echo ('<p class="erreur">Il y a une ou plusieurs erreurs dans le formulaire, merci de le remplir de nouveau.</p>');
    if(isset($errors['emptyFields'])){echo($errors['emptyFields']);}
    if(isset($missingFields && !empty($missingFields))){
      echo('<div class="missingFields"><p><b>Champs manquants :</b></p><ul>');
      foreach ($missingFields as $field){
        echo('<li>'.$field.'</li>');
      }
      echo('</ul></div>');
    }
  }
  if (isset($_GET['message']) && !empty($_GET['message'])){
    echo('<div class="missingFields"><p><b>Votre inscription a été prise en compte, vous allez recevoir un email contenant un lien de validation de votre compte utilisateur.</b></p></div>');
  }
  ?>
</div>
  <div class="col m4 s10 offset-s1 offset-m1">
    <h3>Inscription</h3>
    <form action="index.php?action=addUser" method="post" id="addUserForm">
      <div class="row">
        <div class="col s12">
          <div class="form-group">
            <?php if(isset($errors['name'])){echo($errors['name']);}?>
            <?php if(isset($errors['namelenght'])){echo($errors['namelenght']);}?>
            <label for="name">Nom ou pseudonyme <span class="black-text">*</span></label><br />
            <input class="form-control" type="text" id="name" name="name" value="<?php if(isset($_POST['name'])){echo($_POST['name']);}?>" />
          </div>
        </div>
        <div class="col s12">
          <div class="form-group ">
            <?php if(isset($errors['email'])){echo($errors['email']);}?>
            <?php if(isset($errors['emailFormat'])){echo($errors['emailFormat']);}?>
            <label for="email">Adresse Email <span class="black-text">*</span></label><br />
            <input class="form-control" type="email" id="email" name="email" value="<?php if(isset($_POST['email'])){echo($_POST['email']);}?>"  />
          </div>
        </div>
        <div class="col s12">
          <div class="form-group ">
            <?php if(isset($errors['password'])){echo($errors['password']);}?>
            <?php if(isset($errors['passwordlenght'])){echo($errors['passwordlenght']);}?>
            <label for="password">Mot de passe <span class="black-text">*</span></label><br />
            <input class="form-control" type="password" id="password" name="password" />
          </div>
        </div>
        <div class="col s12">
          <div class="form-group ">
            <?php if(isset($errors['password'])){echo($errors['password']);}?>
            <?php if(isset($errors['passwordlenght'])){echo($errors['passwordlenght']);}?>
            <label for="passwordCheck">Confirmation Mot de passe <span class="black-text">*</span></label><br />
            <input class="form-control" type="password" id="passwordCheck" name="passwordCheck" />
          </div>
        </div>
        <div class="col s12">
          <p><span class="black-text">*</span> Champs obligatoires</p>
        </div>
      </div>
      <div class="col s4 offset-s8">
        <input type="submit" value="S'inscrire" name="Enregistrer" class="btn orange monBtn" />
      </div>
    </form>
  </div>

  <div class="col m4 s10 offset-s1 offset-m1">
    <h3>Connexion</h3>
    <form action="index.php?action=connexion" method="post" id="connectUserForm">
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <?php if(isset($errorsC['noEmail'])){echo($errorsC['noEmail']);}?>
            <label for="email">Adresse Email</label><br />
            <input class="form-control" type="email" id="email" name="email" value="<?php if(isset($_POST['email'])){echo($_POST['email']);}?>"  />
          </div>
        </div>
        <div class="col s12">
          <div class="form-group ">
            <?php if(isset($errorsC['wrongPass'])){echo($errorsC['wrongPass']);}?>
            <label for="password">Mot de passe</label><br />
            <input class="form-control" type="password" id="password" name="password" />
          </div>
        </div>
      </div>
      <div class="col s4 offset-s8">
        <input type="submit" value="Se connecter" name="Enregistrer" class="btn orange monBtn" />
      </div>
    </form>
  </div>
</div>



<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
