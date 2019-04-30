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
    if(isset($missingFields) && !empty($missingFields)){
      echo('<div class="missingFields"><p><b>Champs manquants :</b></p><ul>');
      foreach ($missingFields as $field){
        echo('<li>'.$field.'</li>');
      }
      echo('</ul></div>');
    }
  }
  ?>
</div>


  <div class="col m4 s10 offset-s1 offset-m1">
    <h3>Réinitialisation de mot de passe</h3>
    <p>Pour l'adresse email suivante : <?= $_SESSION['userValidEmail'] ?>
    <p>Merci d'indiquer à deux reprises le nouveau mot de passe que vous souhaitez utiliser</p>
    <form action="index.php?action=resetingThePass" method="post" id="connectUserForm">
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <label for="password1">Nouveau mot de passe</label><br />
            <input class="form-control" type="password" id="password1" name="password1" />
          </div>
        </div>
        <div class="col s12">
          <div class="form-group ">
            <label for="password2">Nouveau mot de passe (vérification)</label><br />
            <input class="form-control" type="password" id="password2" name="password2" />

          </div>
        </div>
      </div>
      <div class="col s4 offset-s8">
        <input type="submit" value="Enregistrer" name="Enregistrer" class="btn orange monBtn" />
      </div>
    </form>
  </div>
</div>




<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
