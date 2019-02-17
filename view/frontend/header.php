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
        <link href="<?= $racine ?>/public/css/styles.css" rel="stylesheet" />
        <link href="<?= $racine ?>/public/css/style-add.css" rel="stylesheet" />
        <meta property="og:url"           content="<?= $racine."/".$page ?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?= $title ?>" />
        <meta property="og:description"   content="<?= $description ?>" />
        <?php if(isset($image)){?>
          <meta property="og:image"         content="<?= $racine.$image ?>" />
        <?php }else{ ?>
          <meta property="og:image"         content="<?= $racine."/img/facebookDefault.jpg" ?>" />
        <?php } ?>

    </head>

    <body id="<?= $page ?>">
<nav class="white" role="navigation">
  <div class="nav-wrapper valign-wrapper">
    <a id="logo-container" class="bleu-fonce-text" href="index.php" class="brand-logo"><img src="img/logo.jpg" alt="Logo du blog"/></a>
    <div id="titre" class="">
      <h1 class="bleu-fonce-text ">ALLEZ SIMPLE POUR L'ALASKA</h1>
      <p id="sous-titre" class="bleu-fonce-text hide-on-med-and-down">Un roman publié en ligne chapitre par chapitre</p>
    </div>

<p id="auteur" class="bleu-fonce-text">Jean Forteroche</p>
    <ul class="right hide-on-med-and-down">
      <li><a class="bleu-fonce-text"  href="index.php?action=user&user_email=<?php if (isset($_SESSION['user_email'])){echo($_SESSION['user_email']);} ?>"><img src="img/icone-compte.png" alt="Se connecter pour pouvoir commenter"/></a></li>
      <li><a class="bleu-fonce-text"  href="index.php?action=deconnexion" title="se déconnecter"><img src="img/icone-partager.png" alt="déconnexion"/></a></li>
    </ul>


    <ul id="nav-mobile" class="sidenav ">
      <li><a class="bleu-fonce-text"  href="index.php?action=deconnexion">Déconnexion</a></li>
      <li><a class="bleu-fonce-text"  href="index.php?action=user&user_email=<?php if (isset($_SESSION['user_email'])){echo($_SESSION['user_email']);} ?>">Se connecter</a></li>
    </ul>
    <a href="#" data-target="nav-mobile" class="sidenav-trigger "><i class="material-icons bleu-fonce-text">menu</i></a>
  </div>
</nav>
<div class="section" id="page">
