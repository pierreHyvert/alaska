<?php $title = 'Ajouter un chapitre';
$page = 'addPostView';
$description = '';
//$postToEdit = postToArray();
 ?>

<?php ob_start(); ?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=1th9wpvkiopcerfgjylcwiqtjoekfud7wl395s0wkaxd9ksi"></script>
<script>
    tinymce.init({
        selector: '#content'
    });
</script>



<form action="index.php?action=addPost" method="post" id="addPostForm">
  <div class="row">
    <div class="col s12">
      <div class="form-group ">
        <label for="title">Titre du chapitre</label><br />
        <input class="form-control" type="text" id="title" name="title" />
      </div>
    </div>
    <div class="col s4">
      <div class="form-group ">
        <label for="title">Numéro de chapitre</label><br />
        <input class="form-control" type="number" id="number_chapter" name="number_chapter" />
      </div>
    </div>
    <div class="col s4">
      <div class="form-group">
        <label for="author">Auteur du chapitre</label><br />
        <input class="form-control" type="text" id="author" name="author" />
      </div>
    </div>
    <div class="col s4">
      <div class="form-group">
        <label for="date">Date de publication</label><br />
        <input class="form-control" type="date" id="post_date" name="post_date" />
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m8">
        <label for="excerpt">Accroche (pour accueil et métas)</label><br />
        <textarea class="form-control" id="excerpt" name="excerpt"></textarea>
    </div>
    <div class="col s12 m4">
        <label for="id_image">Image d'illustration (indiquer chiffre)</label><br />
        <!-- <input  type="file" id="id_image" name="id_image"></input> -->
        <input class="form-control" type="number" id="id_image" name="id_image" />

    </div>
  </div>

  <div class="row">
    <div class="col s12" >
      <br>
        <textarea id="content" rows="25" name="content"></textarea>
        <br>
    </div>
  </div>
  <div class="row">
    <div class="col m4 hide-on-small-only">
    </div>
    <div class="col m4 s12 ">
      <label>
            <input type="checkbox" name="is_visible" id="is_visible" />
            <span>Publié (cocher pour mettre le chapitre en ligne)</span>
          </label>
    </div>
    <div class="col s4 offset-s3">
        <input type="submit" value="Enregistrer" name="Enregistrer" class="btn orange" />
    </div>

  </div>
</form>

        <p><a href="index.php">Retour à la liste des billets</a></p>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
