<?php $title = 'S\'inscrire';
$page = 'inscription';
$description = '';

ob_start();

if (isset($errors) && !empty($errors)){
  echo ('<p class="erreur">Il y a une ou plusieurs erreurs dans le formulaire, merci de le remplir de nouveau.</p>');
  if(isset($errors['emptyFields'])){echo($errors['emptyFields']);}
  if(isset($missingFields)){
    echo('<div class="missingFields"><p><b>Champs manquants :</b></p><ul>');
      foreach ($missingFields as $field){
        echo('<li>'.$field.'</li>');
      }
    echo('</ul></div>');
    }
}

 ?>

<form action="index.php?action=addUser" method="post" id="addPostForm">
  <div class="row">
    <div class="col s12">
      <div class="form-group ">
        <?php if(isset($errors['name'])){echo($errors['name']);}?>
        <?php if(isset($errors['namelenght'])){echo($errors['namelenght']);}?>
        <label for="name">Nom ou pseudonyme</label><br />
        <input class="form-control" type="text" id="name" name="name" value="<?php if(isset($_POST['name'])){echo($_POST['name']);}?>" />
      </div>
    </div>
    <div class="col s12">
      <div class="form-group ">
        <?php if(isset($errors['email'])){echo($errors['email']);}?>
        <?php if(isset($errors['emailFormat'])){echo($errors['emailFormat']);}?>
        <label for="email">Adresse Email</label><br />
        <input class="form-control" type="email" id="email" name="email" value="<?php if(isset($_POST['email'])){echo($_POST['email']);}?>"  />
      </div>
    </div>
    <div class="col s12">
      <div class="form-group ">
        <?php if(isset($errors['password'])){echo($errors['password']);}?>
        <?php if(isset($errors['passwordlenght'])){echo($errors['passwordlenght']);}?>
        <label for="password">Mot de passe</label><br />
        <input class="form-control" type="password" id="password" name="password" />
      </div>
    </div>
    <div class="col s12">
      <div class="form-group ">
        <?php if(isset($errors['password'])){echo($errors['password']);}?>
        <?php if(isset($errors['passwordlenght'])){echo($errors['passwordlenght']);}?>
        <label for="passwordCheck">Confirmation Mot de passe</label><br />
        <input class="form-control" type="password" id="passwordCheck" name="passwordCheck" />
      </div>
    </div>
  </div>
    <div class="col s4 offset-s3">
        <input type="submit" value="S'inscrire" name="Enregistrer" class="btn orange" />
    </div>

  </div>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
