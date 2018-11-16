<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="./public/css/styles.css" rel="stylesheet" />
        <link href="./public/css/bootstrap.min.css" rel="stylesheet" />
    </head>

    <body class="<?= $page ?>">
    	<section id="page"  class="container">
        <?= $content ?>
    	</section>
      <script src="./public/js/jquery-3.3.1.min.js"></script>
      <script src="./public/js/bootstrap.min.js"></script>
    </body>
</html>
