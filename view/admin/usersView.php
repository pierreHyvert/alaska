<?php $title = 'Gestion des utilisateurs';
$page = 'usersView';
$description = 'Gestion des utilisateurs';

ob_start(); ?>
<h3 class="bleu-clair-text">Liste des Utilisateurs inscrits</h3>

<?php
while ($user = $users->fetch())
{
  $flags = $usersManager->countUserFlags($user['id']);
  $bannishButton = bannisher($user['id']);

  ?>
  <div class="row aUser card">
    <div class="col s8">
    <p><b><?= htmlspecialchars($user['name']) ?></b></p>
      <p>Inscrit le <?= $user['signup_date'] ?> </p>
      <p><?= nl2br(htmlspecialchars($user['email'])) ?></p>
      <?php
      echo $flags.' commentaires signalé(s).<br>';
      ?>
    </div>
      <div class="col s4" id="<?= $user['id'] ?>">
        <?php
        echo $bannishButton; ?>
      </div>
    </div>
    <?php
  } ?>




  <?php
  $users->closeCursor();
  ?>


  <?php $content = ob_get_clean(); ?>
  <?php require('templateAdmin.php'); ?>
