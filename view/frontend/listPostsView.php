<?php $title = 'Mon blog';
      $page = 'listPostView';
      $description = 'Aller simple pour l\'Alaska est un roman de Jean Forteroche publié en ligne chapitre par chapitre.';
?>

<?php ob_start(); ?>


<h1>Liste des chapitres</h1>
<?php
while ($data = $posts->fetch())
{
?>
    <div class="unExtraitChapitre">
            <a href="index.php?action=post&id=<?= htmlspecialchars($data['id']) ?>">
                    <h3>
                        <?= htmlspecialchars($data['title']) ?><br>
                        <em>le <?= $data['post_date_fr'] ?></em>
                    </h3>
                </a>

    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
