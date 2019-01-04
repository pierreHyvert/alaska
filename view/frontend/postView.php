<?php
$title = htmlspecialchars($post['title']);
$page = 'postView';
$description = htmlspecialchars($post['excerpt']);

if ($_GET['id']){
  $postId = $_GET['id'];
  $nextChap = prevNextChap('next', $postId);
  $prevChap = prevNextChap('prev', $postId);
}
ob_start(); ?>
<div class="row">
  <div class="col s8 offset-s2">
    <div class="section no-pad-bot s8 offset-s2" id="index-banner">
      <h2 class="bleu-fonce-text"><?= $post['title'] ?></h2>
      <div class="infos">
        <p class="left bold">par <?= $post['author'] ?> </p>
        <p class="left italic">le <?= $post['post_date_fr'] ?></p>
        <p class="right"><a href="index.php">Retour à la liste des chapitres</a></p>
        <p class="clearfix"></p>
      </div>
      <div class="contenu">
        <?= $post['content'] ?>
      </div>

      <div id="nav-chapitres">
        <div class="prev-chapitre left"><a href="index.php?action=post&id=<?= $prevChap ?>" title="chapitre  du roman Allez simple pour l'Alaska">Chapitre précédent ()</a></div>
        <div class="next-chapitre right"><a href="index.php?action=post&id=<?= $nextChap ?>" title="chapitre  du roman Allez simple pour l'Alaska">Chapitre suivant</a></div>

      </div>
      <div class="commentaires">
        <h3>Commentaires</h3>
        <form action="index.php?action=addComment&amp;id=<?= $postId ?>" method="post">
          <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
          </div>
          <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
          </div>
          <div>
            <input type="submit" />
          </div>
        </form>

        <?php
        while ($comment = $comments->fetch())
        {
          ?>
          <div class="aComment">
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> </p>
            <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
          </div>
          <?php
        }
        $comments->closeCursor();
        ?>
      </div>
    </div>
  </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
