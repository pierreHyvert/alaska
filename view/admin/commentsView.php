<?php $title = 'Modération des commentaires';
$page = 'commentsView';
$description = 'Modération des commentaires';

ob_start();
 ?>

<?php
$i=0;
while ($comment = $comments->fetch())
{
  $i++;
  ?>
  <div class="aComment">
    <p><b><?= htmlspecialchars($comment['author']) ?></b> le <?= $comment['comment_date'] ?> </p>
    <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
    <div id="flagger">
    <?php if ($comment['flags']){
        echo $comment['flags'].' signalement(s)';
      } ?>
    </div>
    <p class="right-align" ><a class="modal-trigger red-text right-align" href="#modal<?= $i ?>">Supprimer ce commentaire</a></p>

  </div>

  <div id="modal<?= $i ?>" class="modal">
    <div class="modal-content">
      <h3>Supprimer ce commentaire ?</h3>
      <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
      <p class="red-text">Attention : Pas de retour arrière possible !</p><br>
      <br>
      <br>
        <a href="index.php?action=deleteComment&step=valid&comment_id=<?= $comment['id']; ?>" class="btn orange">Supprimer ce commentaire</a>
    </div>
    <div class="modal-footer">
      <a href="#!" class="btn modal-close waves-effect waves-green">Annuler</a>
    </div>
  </div>


  <?php
}
$comments->closeCursor();
?>


<?php $content = ob_get_clean(); ?>
<?php require('templateAdmin.php'); ?>
