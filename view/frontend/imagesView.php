<?php $title = 'Bibliothèque d\'images';
      $page = 'imagesView'
?>

<?php ob_start(); ?>
<h1>Bibliothèque d'images</h1>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="unExtraitChapitre">
            <a href="index.php?action=post&id=<?= htmlspecialchars($data['id']) ?>">
                    <h3>
                        <?= htmlspecialchars($data['title']) ?><br>
                        <em>le <?= $data['creation_date_fr'] ?></em>
                    </h3>
                </a>

    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
