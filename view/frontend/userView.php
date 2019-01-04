<?php $title = 'Profil lecteur';
$page = 'profil';
$description = '';
ob_start();
?>
<div class="row">
  <div class="col s8 offset-s2">

    <form action="index.php?action=editUser" method="post" id="editUserForm">
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <label for="name">Nom ou pseudonyme</label><br />
            <input class="form-control" type="text" id="name" name="name" value="<?php if(isset($usersList['name'])){echo($usersList['name']);}?>" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <label for="name">Adresse eMail</label><br />
            <input class="form-control" type="email" id="email" name="email" value="<?php if(isset($usersList['email'])){echo($usersList['email']);}?>" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <p id="changePass">Si vous souhaitez modifier votre mot de passe, merci d'indiquer à deux reprises le nouveau mot de passe désiré, puis de renseigner votre mot de passe actuel avant de valider.</p>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <label for="name">Votre mot de passe actuel</label><br />
            <input class="form-control" type="password" id="oldElPasso" name="oldElPasso" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <label for="name">Nouveau mot de passe désiré</label><br />
            <input class="form-control" type="password" id="newPass" name="newPass" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <label for="name">Vérification nouveau mot de passe</label><br />
            <input class="form-control" type="password" id="newPass2" name="newPass2" />
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
