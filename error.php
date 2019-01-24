<?php $title = 'Oups, page innexistante';
$page = '404';
$description = 'Oups, page innexistante';

ob_start(); ?>
<h3 class="bleu-clair-text">Oups, page innexistante</h3>
<?php
if (!empty($_SERVER['HTTP_REFERER'])) {
  echo '<p><a href="'.$_SERVER['HTTP_REFERER'].'">Retour page précédente</a></p>';
}
?>

<a href="index.php">Accueil</a>

  <?php $content = ob_get_clean(); ?>
  <?php require('view/frontend/template.php'); ?>
