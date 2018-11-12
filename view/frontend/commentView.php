<?php $title = 'Billet'; ?>

<?php ob_start(); ?>
        <h1>Éditer un commentaire</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>
        <br>
        <p>Vous pouvez modifier le contenu des champs ci-dessous, en validant vous mettrez à jour le commentaire.</p>
              
<?php $comment = $theComment->fetch()?>
        <form action="index.php?action=replaceComment&amp;comment_id=<?= $comment['id'] ?>&amp;post_id=<?= $comment['post_id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?= htmlspecialchars($comment['author']) ?>" />
    </div>
    <div>
        <label for="comment">Contenu</label><br />
        <textarea id="comment" name="comment" ><?= htmlspecialchars($comment['comment']) ?> </textarea>
    </div>
    <div>
        <input type="submit" name="Modifier commentaire" />
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>