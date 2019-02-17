<?php $title = 'Profil lecteur';
$page = 'profil';
$description = '';
ob_start();
?>
<div class="row">
  <div class="col s8 offset-s2">
      <div class="card center">
        Votre inscription a bien été validée, merci.<br>
        <a href="index.php?action=inscription">Vous pouvez maintenant vous connecter</a>
      </div>

  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
