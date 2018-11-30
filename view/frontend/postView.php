<?php
$title = htmlspecialchars($post['title']);
$page = 'postView';
$description = htmlspecialchars($data['excerpt']);
 ?>

<?php ob_start(); ?>
        <h1><?= $post['title'] ?></h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>

        <h2>Commentaires</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
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
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> <span class="">(<a href="index.php?action=editComment&commentId=<?= $comment['id'] ?>">modifier</a>)</span></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        </div>
        <?php
        }
        $comments->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
