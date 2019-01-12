<!DOCTYPE html>
<?php $racine = 'http://localhost/alaska';?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta name="description" content="<?= $description ?>" />
  <title><?= $title ?></title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cormorant" rel="stylesheet">
  <link href="<?= $racine ?>/public/css/materialize.css" rel="stylesheet" />
  <link href="<?= $racine ?>/public/css/slick.css" rel="stylesheet" />
  <link href="<?= $racine ?>/public/css/styleC.css" rel="stylesheet" />
  <!-- To DO : transferer styles.css vers le .less pour la prod -->
  <link href="<?= $racine ?>/public/css/styles.css" rel="stylesheet" />
</head>

<body id="<?= $page ?>">
  <section id="contenu" class="">
    <div class="row">
      <div class="col m10 s12 offset-m1">

        <section id="adminLeft" class="col m3 s12 z-depth-2">
          <a href="index.php?action=admin"><h3 class="waves-effect waves-light btn col s12 bleufonce white-text">Bienvenue Admin</h3></a>
          <p>&nbsp;</p>
          <p><a class="waves-effect waves-light btn col s12" href="index.php?action=addPost">Ajouter un chapitre</a></p>
          <p>&nbsp;</p>
          <p><a class="waves-effect waves-light btn col s12"  href="index.php?action=allComments">Modération des commentaires</a></p>
          <p>&nbsp;</p>
          <p><a class="waves-effect waves-light btn col s12 orange"  href="index.php">Acueil du blog</a></p>
        </section>

        <section id="adminright" class="col m8 offset-m1 s12 z-depth-1">
          <?= $content ?>
        </section>

      </div>
    </div>
  </section>
  <script src="<?= $racine ?>/public/js/jquery-3.3.1.min.js"></script>
  <script src="<?= $racine ?>/public/js/materialize.min.js"></script>
  <script src="<?= $racine ?>/public/js/slick.min.js"></script>
  <script src="<?= $racine ?>/public/js/init.js"></script>
</body>
</html>
