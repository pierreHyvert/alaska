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
<div class="row">
  <div class="col m10 offset-m1 s12">
    <div class="section no-pad-bot s10 offset-s1" id="index-banner">
      <h3 class="bleu-fonce-text">Ajouter ou modifier un chapitre</h2>
        <form action="index.php?action=<?php if (isset($post)){echo('updatePost&id='.$post['id']);}else{echo('insertPost');} ?>" method="post" id="addPostForm">
            <input type="hidden" name="postID" value="<?php if (isset($post['id'])){echo($post['id']);} ?>" />
          <div class="row">
            <div class="col s12">
              <div class="form-group ">
                <label for="title">Titre du chapitre</label><br />
                <input class="form-control" type="text" id="title" name="title" <?php if (isset($post['title'])){echo('value="'.$post['title'].'"');} ?> />
              </div>
            </div>
            <div class="col s4">
              <div class="form-group ">
                <label for="title">Numéro de chapitre</label><br />
                <input class="form-control" type="number" id="number_chapter" name="number_chapter" <?php if (isset($post['number_chapter'])){echo('value="'.$post['number_chapter'].'"');} ?> />
              </div>
            </div>
            <div class="col s4">
              <div class="form-group">
                <label for="author">Auteur du chapitre</label><br />
                <input class="form-control" type="text" id="author" name="author" <?php if (isset($post['author'])){echo('value="'.$post['author'].'"');} ?> />
              </div>
            </div>
            <div class="col s4">
              <div class="form-group">
                <label for="date">Date de publication</label><br />
                <input class="form-control" type="date" id="post_date" name="post_date"  <?php if (isset($post['post_date'])){echo('value="'.$post['post_date'].'"');} ?> />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col s12 m8">
              <label for="excerpt">Accroche (pour accueil et métas)</label><br />
              <textarea class="form-control" id="excerpt" name="excerpt"><?php if (isset($post['excerpt'])){echo($post['excerpt']);} ?></textarea>
              <label for="likes">Nombre de likes : <?php if (isset($post['likes'])){echo($post['likes']);} ?> </label>
              <input type="hidden" name="likes" value="<?php if (isset($post['likes'])){echo($post['likes']);} ?>" />

            </div>
            <div class="col s12 m4">
              <!-- Modal Trigger -->
              <label for="id_image">Image d'illustration</label><br />
              <img id="imgPreview" src="<?php if (isset($post['id_image'])){echo($post['id_image']);} else{echo("img/no-image.jpg");} ?>" />
              <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Sélectionner Image</a>
              <input class="form-control" type="hidden" id="id_image" name="id_image" value="<?php if (isset($post['id_image'])){echo($post['id_image']);} else{echo("img/no-image.jpg");} ?>"   />
            </div>
          </div>

          <div class="row">
            <div class="col s12" >
              <br>
              <textarea id="content" rows="25" name="content"> <?php if (isset($post['content'])){echo($post['content']);} ?></textarea>
              <br>
            </div>
          </div>
          <div class="row">
            <!-- <div class="col m4 hide-on-small-only">
          </div> -->
          <div class="col m6  ">
            <label>
              <input type="checkbox" name="is_visible" id="is_visible" class="left"  <?php if (isset($post['is_visible']) && $post['is_visible'] == 'on'){echo('checked');} ?> />
              <span>Publié</span>
            </label>
          </div>
          <div class="col m6 ">

            <input type="submit" value="Enregistrer" name="Enregistrer" class="btn orange right" />
          </div>
        </div>
      </form><br>
      <?php if (isset($post['id'])){ ?><a href="index.php?action=post&id=<?= $post['id']; ?>" class="btn green right" target="_blank" >Voir le chapitre</a><?php } ?>
      <?php if (isset($post)){ ?>
        <a class="modal-trigger red-text left" href="#modal2">Supprimer le chapitre</a>
      <?php } ?>

    </div>
  </div>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
  <div class="modal-content">
<h2>Sélectionnez une image</h2>
    <div id="thePictures">
      <?php
      while ($img = $images->fetch())
      { ?>
<img src="<?= $img['up_fileurl'] ?>" />
      <?php
    }
    ?>
    </div>
    <h2>Ou ajoutez une image</h2>
 <p class="">(puis sélectionnez-là)</p>
    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
      <div id="image_preview"><img id="previewing" src="./img/no-image.jpg" /></div>
      <hr id="line">
      <div id="selectImage">
        <input type="file" name="file" id="file" required />
        <input type="submit" value="Ajouter à la banque d'images" class="submit" />
      </div>
    </form>
  </div>
  <div id="message"></div>
  <div class="modal-footer">
    <a href="#!" class="btn modal-close waves-effect waves-green">Ok</a>
  </div>
</div>


<div id="modal2" class="modal">
  <div class="modal-content">
    <h3>Supprimer cet article ?</h3>
    <p class="red-text">Attention : Pas de retour arrière possible !</p><br>
    <br>
    <p>Vous pouvez dé-publier un article en décochant la case "publié"</p>
    <br>
    <br>
    <?php if (isset($post)){ ?>
      <a href="index.php?action=deletePost&post_id=<?= $post['id'] ?>" class="waves-effect waves-light btn red ">Oui je souhaite supprimer ce chapitre</a>
    <?php } ?>
  </div>
  <div class="modal-footer">
    <a href="#!" class="btn modal-close waves-effect waves-green">Annuler</a>
  </div>
</div>






<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>


<script>

</script>
