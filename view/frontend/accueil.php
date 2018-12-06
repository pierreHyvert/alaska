<?php
$title = 'Page d\'accueil';
$page = 'accueil';
$description = '';
ob_start(); ?>
<nav class="white" role="navigation">
  <div class="nav-wrapper valign-wrapper">
    <a id="logo-container" class="bleu-fonce-text" href="#" class="brand-logo"><img src="img/logo.jpg" alt="Logo du blog"/></a>
    <div id="titre" class="">
      <h1 class="bleu-fonce-text ">ALLEZ SIMPLE POUR L'ALASKA</h1>
      <p id="sous-titre" class="bleu-fonce-text hide-on-med-and-down">Un roman publié en ligne chapitre par chapitre</p>
    </div>

<p id="auteur" class="bleu-fonce-text">Jean Forteroche</p>
    <ul class="right hide-on-med-and-down">
      <li><a class="bleu-fonce-text"  href="#"><img src="img/icone-partager.png" alt="Partager ce blog sur les réseaux sociaux"/></a></li>
      <li><a class="bleu-fonce-text"  href="#"><img src="img/icone-compte.png" alt="Se connecter pour pouvoir commenter"/></a></li>
    </ul>


    <ul id="nav-mobile" class="sidenav ">
      <li><a class="bleu-fonce-text"  href="#">Partager</a></li>
      <li><a class="bleu-fonce-text"  href="#">Se connecter</a></li>
    </ul>
    <a href="#" data-target="nav-mobile" class="sidenav-trigger "><i class="material-icons bleu-fonce-text">menu</i></a>
  </div>
</nav>
<div class="section no-pad-bot" id="index-banner">

  <div id="slider">
    <?php
    while ($data = $posts->fetch())
    {
    ?>
    <article class="slide" id="slide1" style="background-image:url('img/slide1.jpg')">
        <div class="slide-legende ">
          <h2 class="slide-titre white-text"><a href="index.php?action=post&id=<?= htmlspecialchars($data['id']) ?>"><span class="slide-chap bleu-clair-text">Chapitre <?= htmlspecialchars($data['number_chapter']) ?> - </span><?= htmlspecialchars($data['title']) ?></a></h2>
          <p class="slide-extrait white-text"><?= htmlspecialchars($data['excerpt']) ?></p>
          <div class="slide-footer">
            <span class="nbreLikes"><?= htmlspecialchars($data['likes']) ?> <i class="material-icons ">thumb_up</i></span><a href="index.php?action=post&id=<?= htmlspecialchars($data['id']) ?>" class="waves-effect deep-orange btn">Lire le chapitre</a>
          </div>
        </div>
    </article>
  <?php } ?>
  </div>

  <div id="slider-controls">
    <div id="slider-arrows"></div>
    <div id="slider-dots"></div>
  </div>

</div>




<footer class="page-footer bleuclair">
  <div class="footer-copyright">
    <div class="container">Copyright Jean Forteroche - Mentions légales
    &copy; Jean Forteroche -  <a class="white-text" href="index.php?page=mentions" title="mentions légales">Mentions légales</a>
    </div>
  </div>
</footer>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
