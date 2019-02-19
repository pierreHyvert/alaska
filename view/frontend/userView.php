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
            <h5>Nom ou pseudonyme</h5>
            <p class="form-control bold" ><?php if(isset($usersList['name'])){echo($usersList['name']);}?></p>
            <!-- <input class="form-control" type="text" id="name" name="name" disabled value="" /> -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <h5>Adresse eMail</h5>
            <p class="form-control" ><?php if(isset($usersList['email'])){echo($usersList['email']);}?></p>
            <!-- <input class="form-control" type="email" id="email" disabled name="email" value="" /> -->
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


<?php if(isset($_SESSION['connected'])) { ?>
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <input class="btn orange" type="submit" id="leSubmit" value="Mettre à jour" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="form-group ">
            <p class="btn red-text right-align" id="suppresser">Supprimer mon compte</p>
          </div>
        </div>
      </div>
      <div id="suppress" class="modal">
        <div class="modal-content">
          <h3>Supprimer votre compte ?</h3>
          <p class="red-text">Attention : Pas de retour arrière possible !</p><br>
          <br>
          <br>
          <form action="index.php?action=deleteUser" method="post">
            <div class="form-group ">
              <input type="hidden" value="<?php ?>" name="session" >
              <input type="hidden" value="<?php if(isset($usersList['email'])){echo($usersList['email']);}?>" name="email" >
              <input class="btn orange" type="submit" value="Supprimer mon compte" />          
              <p id="canceler" class="btn modal-close waves-effect waves-green">Annuler</a>

            </div>
          </form>
        </div>
      </div>

<?php } ?>
    </form>

  </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
