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
<nav class="white" role="navigation">
  <div class="nav-wrapper valign-wrapper">
    <a id="logo-container" class="bleu-fonce-text" href="index.php" class="brand-logo"><img src="img/logo.jpg" alt="Logo du blog"/></a>
    <div id="titre" class="">
      <h1 class="bleu-fonce-text ">ALLEZ SIMPLE POUR L'ALASKA</h1>
      <p id="sous-titre" class="bleu-fonce-text hide-on-med-and-down">Un roman publié en ligne chapitre par chapitre</p>
    </div>

    <p id="auteur" class="bleu-fonce-text">Jean Forteroche</p>
    <ul class="right hide-on-med-and-down">
      <li><a class="bleu-fonce-text"  href="#"><img src="img/icone-partager.png" alt="Partager ce blog sur les réseaux sociaux"/></a></li>
      <li><a class="bleu-fonce-text"  href="index.php?action=inscription"><img src="img/icone-compte.png" alt="Se connecter pour pouvoir commenter"/></a></li>
    </ul>

    <ul id="nav-mobile" class="sidenav ">
      <li><a class="bleu-fonce-text"  href="#">Partager</a></li>
      <li><a class="bleu-fonce-text"  href="index.php?action=inscription">Se connecter</a></li>
    </ul>
    <a href="index.php" data-target="nav-mobile" class="sidenav-trigger "><i class="material-icons bleu-fonce-text">menu</i></a>
  </div>
</nav>
<div class="container">
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



<footer class="page-footer bleuclair">
  <div class="footer-copyright">
    <div class="container">
      &copy; Jean Forteroche -  <a class="white-text" href="index.php?page=mentions" title="mentions légales">Mentions légales</a>
    </div>
  </div>
</footer>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
