<?php
$title = 'Page d\'accueil';
$page = 'postView';
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
    <article class="slide" id="slide1" style="background-image:url('img/slide1.jpg')">
        <div class="slide-legende ">
          <h2 class="slide-titre white-text"><span class="slide-chap bleu-clair-text">Chapitre 1 - </span>Titre du chapitre 1</h2>
          <p class="slide-extrait white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
          <div class="slide-footer">
            <span class="nbreLikes">35 <i class="material-icons ">thumb_up</i></span><a class="waves-effect deep-orange btn">Lire le chapitre</a>
          </div>
        </div>
    </article>
    <article class="slide" id="slide2" style="background-image:url('img/slide2.jpg')">
      <div class="slide-legende ">
        <h2 class="slide-titre white-text"><span class="slide-chap bleu-clair-text">Chapitre 1 - </span>Titre du chapitre 1</h2>
        <p class="slide-extrait white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
        <div class="slide-footer">
          <a class="waves-effect deep-orange btn">Lire le chapitre</a>
        </div>
      </div>
    </article>
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
