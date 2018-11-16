<?php $title = 'Mon blog';
      $page = 'listPostView'
?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
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
