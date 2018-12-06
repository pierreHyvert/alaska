<!DOCTYPE html>
<?php $racine = 'http://localhost/alaska'; ?>


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
        <?= $content ?>
    	</section>
      <script src="<?= $racine ?>/public/js/jquery-3.3.1.min.js"></script>
      <script src="<?= $racine ?>/public/js/materialize.min.js"></script>
      <script src="<?= $racine ?>/public/js/slick.min.js"></script>
      <script src="<?= $racine ?>/public/js/init.js"></script>
    </body>
</html>
