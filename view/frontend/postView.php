<?php
$title = htmlspecialchars($post_infos['title']);
$page = 'postView';
$description = htmlspecialchars($post_infos['excerpt']);

ob_start(); ?>
<div class="row">
  <div class="col s8 offset-s2">
    <div class="section no-pad-bot s8 offset-s2" id="index-banner">
      <h2 class="bleu-fonce-text"><?= $post_infos['title'] ?></h2>
      <div class="infos">
        <p class="left bold">par <?= $post_infos['author'] ?> </p>
        <p class="left italic">&nbsp;le <?= $post_infos['post_date_fr'] ?></p>
        <p class="right"><a href="index.php">Retour à la liste des chapitres</a></p>
        <p class="clearfix"></p>
      </div>
      <div class="contenu">
        <?= $post_infos['content'] ?>
      </div>

      <div id="liker">
      <?php if ($_SESSION['user_id']){
          $likeButton = liker($post_infos['id'], $_SESSION['user_id']);
          echo $likeButton;
        } ?>
      </div>

      <div id="nav-chapitres">
        <div class="prev-chapitre left"><a href="index.php?action=post&id=<?= $post_infos['prevChapId'] ?>" title="chapitre  du roman Allez simple pour l'Alaska">Chapitre précédent (<?= $post_infos['prevChapTitle'] ?>)</a></div>
        <div class="next-chapitre right"><a href="index.php?action=post&id=<?= $post_infos['nextChapId'] ?>" title="chapitre  du roman Allez simple pour l'Alaska">Chapitre suivant (<?= $post_infos['nextChapTitle'] ?>)</a></div>

      </div>
      <div class="commentaires">
        <h3>Commentaires</h3>
        <form action="index.php?action=addComment&amp;id=<?= $post_infos['id'] ?>" method="post">
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
            <div id="flagger">
            <?php if ($_SESSION['user_id']){
                $flagButton = flagger($comment['id'], $_SESSION['user_id']);
                echo $flagButton;
              } ?>
            </div>
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
