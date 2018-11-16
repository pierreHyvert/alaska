<?php $title = 'Billet';
$page = 'addPostView'
 ?>

<?php ob_start(); ?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=1th9wpvkiopcerfgjylcwiqtjoekfud7wl395s0wkaxd9ksi"></script>
<script>
    tinymce.init({
        selector: '#content'
    });
</script>



<form action="index.php?action=addPost" method="post" id="addPostForm">
    <div class="form-group">
      <label for="title">Titre du chapitre</label><br />
      <input class="form-control" type="text" id="title" name="title" />
    </div>
    <div class="form-group">
      <label for="author">Auteur du chapitre</label><br />
      <input type="text" id="author" name="author" />
    </div>
    <div class="form-group">
      <label for="date">Date de publication</label><br />
      <input type="date" id="post_date" name="post_date" />
    </div>
    <div>
        <textarea id="content" name="content"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

        <p><a href="index.php">Retour à la liste des billets</a></p>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
