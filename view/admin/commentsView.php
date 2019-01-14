<?php $title = 'Modération des commentaires';
$page = 'commentsView';
$description = 'Modération des commentaires';

ob_start(); ?>

<?php
while ($comment = $comments->fetch())
{
  ?>
  <div class="aComment">
    <p><b><?= htmlspecialchars($comment['author']) ?></b> le <?= $comment['comment_date'] ?> </p>
    <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
    <div id="flagger">
    <?php if ($comment['flags']){
        echo $comment['flags'].' signalement(s)';
      } ?>

      <!-- TODO confirmation en JS  -->
      <a href="index.php?action=deleteComment&step=valid&comment_id=<?= $comment['id']; ?>" class="btn orange">Supprimer ce commentaire</a>

    </div>
  </div>
  <?php
}
$comments->closeCursor();
?>


<?php $content = ob_get_clean(); ?>
<?php require('templateAdmin.php'); ?>
