<?php
$title = 'Page d\'accueil';
$page = 'accueil';
$description = '';
ob_start(); ?>

  <div class="row">
    <div class="col s10 offset-s1">
      <div id="slider" class="card-panel hoverable">
        <?php
        while ($data = $posts->fetch())
        {
        ?>
        <article class="slide" id="slide1" style="background-image:url('<?= htmlspecialchars($data['id_image']) ?>')">
            <div class="slide-legende ">
              <h2 class="slide-titre white-text"><a href="index.php?action=post&id=<?= htmlspecialchars($data['id']) ?>"><span class="slide-chap bleu-clair-text">Chapitre <?= htmlspecialchars($data['number_chapter']) ?> - </span><?= htmlspecialchars($data['title']) ?></a></h2>
              <p class="slide-extrait white-text"><?= htmlspecialchars($data['excerpt']) ?></p>
              <div class="slide-footer">
                <span class="nbreLikes left"><?= htmlspecialchars($data['likes']) ?> <i class="material-icons ">thumb_up</i></span><a href="index.php?action=post&id=<?= htmlspecialchars($data['id']) ?>" class="waves-effect deep-orange btn right">Lire le chapitre</a>
              </div>
            </div>
        </article>
      <?php
        }
        ?>
      </div>
      <div id="slider-controls">
        <div id="slider-arrows"></div>
        <div id="slider-dots"></div>
      </div>
    </div>
  </div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
