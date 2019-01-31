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
  <link href="<?= $racine ?>/public/css/styles.css" rel="stylesheet" />
  <link href="<?= $racine ?>/public/css/style-add.css" rel="stylesheet" />
</head>

<body id="adminView">
  <section id="contenu" class="">
    <div class="row">
      <div class="col m10 s12 offset-m1">

        <section id="adminLeft" class="col m3 s12 z-depth-2">
          <h3>Bienvenue Admin</h3>
          <a href="index.php?action=admin" class="waves-effect waves-light btn col s12 bleufonce white-text">Liste des chapitres</a>
          <p>&nbsp;</p>
          <p><a class="waves-effect waves-light btn col s12" href="index.php?action=addPost">Ajouter un chapitre</a></p>
          <p>&nbsp;</p>
          <p><a class="waves-effect waves-light btn col s12"  href="index.php?action=allComments">Gestion commentaires</a></p>
          <p>&nbsp;</p>
          <p><a class="waves-effect waves-light btn col s12"  href="index.php?action=allUsers">Gestion utilisateurs</a></p>
          <p>&nbsp;</p>
          <p><a class="waves-effect waves-light btn col s12 orange"  href="index.php">Accueil du blog</a></p>
        </section>

        <section id="adminright" class="col m8 offset-m1 s12 z-depth-1">
          <?= $content ?>
        </section>

      </div>
    </div>
  </section>
  <script src="<?= $racine ?>/public/js/jquery-3.3.1.min.js"></script>
  <script src="<?= $racine ?>/public/js/ajax.js"></script>
  <script src="<?= $racine ?>/public/js/imgUpload.js"></script>
  <script src="<?= $racine ?>/public/js/materialize.min.js"></script>
  <script src="<?= $racine ?>/public/js/slick.min.js"></script>
  <script src="<?= $racine ?>/public/js/init.js"></script>
<script>
  $(document).ready(function(){
    $('.modal').modal();
  });
  </script>
</body>
</html>
