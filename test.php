<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
        <link href="./public/css/styles.css" rel="stylesheet" />
        <link href="./public/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=1th9wpvkiopcerfgjylcwiqtjoekfud7wl395s0wkaxd9ksi"></script>
    <script>
        tinymce.init({
            selector: '#content'
        });
    </script>
    <body class="">
    	<section id="page" class="container">
        <form action="index.php?action=addPost" method="post" id="addPostForm">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group ">
                <label for="title">Titre du chapitre</label><br />
                <input class="form-control" type="text" id="title" name="title" />
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="author">Auteur du chapitre</label><br />
                <input class="form-control" type="text" id="author" name="author" />
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="date">Date de publication</label><br />
                <input class="form-control" type="date" id="post_date" name="post_date" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
                <label for="excerpt">Accroche (pour accueil et métas)</label><br />
                <textarea class="form-control" id="excerpt" name="excerpt"></textarea>
            </div>
            <div class="col-sm-4">
                <label for="id_image">Image d'illustration</label><br />
                <input  type="file" id="id_image" name="id_image"></input>
            </div>

          </div>

          <div class="row">
            <div class="col-sm-12" >
              <br>
                <textarea id="content" rows="15" name="content"></textarea>
                <br>

            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-3">
                <input type="submit" value="Enregistrer" name="Enregistrer" />
            </div>
            <div class="col-sm-3">
                <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="is_visible">
              <label class="form-check-label" for="is_visible">
              Publié
              </label>
            </div>
            </div>
          </div>
        </form>

    	</section>
      <script src="./public/js/jquery-3.3.1.min.js"></script>
      <script src="./public/js/bootstrap.min.js"></script>
    </body>
</html>
