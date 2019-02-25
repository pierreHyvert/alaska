<?php session_start();
require('controller/frontend.php');
require('controller/backend.php');


if (isset($_GET['action'])) {
  try{
    ////////////////FRONT///////////

    if ($_GET['action'] == 'listPosts') {
      listPosts();
    }

    elseif ($_GET['action'] == 'post') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        post($_GET['id']);
        // check user
        // check ban
      }
      else {throw new Exception('Erreur : aucun identifiant de billet envoyé');}
    }

    elseif ($_GET['action']== 'addComment'){
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
          addComment($_GET['id'], $_POST['author'], $_POST['comment']);
        }
        else {throw new Exception('Erreur : tous les champs ne sont pas remplis !');}
      }
      else {throw new Exception('Erreur : aucun identifiant de billet envoyé');}
    }

    //////// USERS //////

    elseif ($_GET['action']== 'inscription'){
      require('view/frontend/inscription.php');
    }

    elseif ($_GET['action']== 'addUser'){
      require('controller/users.php');
      addUser();
    }

    elseif ($_GET['action']== 'validation'){
      if (isset($_GET['email']) && !empty($_GET['email']) ){
        if (isset($_GET['cle']) && !empty($_GET['cle']) ){
          $email = htmlspecialchars($_GET['email']);
          $cle = htmlspecialchars($_GET['cle']);
          require('controller/users.php');
          validationUser($email, $cle);
        }
      }
      else {throw new Exception('Erreur : certains paramètres de validations manquent !');}

      require('view/frontend/validation.php');
    }


    elseif ($_GET['action']== 'editUser'){
      require('controller/users.php');
      editUser();
    }



    elseif ($_GET['action']== 'user'){
      if (isset($_GET['user_email']) && !empty($_GET['user_email']) ){
        if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'user' ){
          $email= $_GET['user_email'];
          require('controller/users.php');
          user($email);
        }
        elseif (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin' ){
          listAdminPost();
        }
        else {
          require('view/frontend/inscription.php');
        }
      }
      else {
        require('view/frontend/inscription.php');
      }
    }

    elseif ($_GET['action']== 'deleteUser'){
      if (isset($_POST['email']) && !empty($_POST['email']) ){
        require('controller/users.php');
          deleteUser($_POST['email']);
      }
      else {throw new Exception('Erreur : pas d\'utilisateur à supprimer !');}


    }



    elseif ($_GET['action']== 'connexion'){
        require('controller/users.php');
        connectUser();
    }

    elseif ($_GET['action']== 'deconnexion'){
      detruireSession();
      listPosts();
    }




    ////////////ADMIN///////////////

    elseif ($_GET['action']== 'admin'){
      if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin')
      {
        listAdminPost();
      }
      else {throw new Exception('Erreur : vous n\'êtes pas connecté en tant qu\'administrateur');}
    }

    elseif ($_GET['action']== 'addPost'){
      if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin')
      {
        $images = getImages();
        require('view/admin/addPostView.php');
      }
      else {throw new Exception('Erreur : vous n\'êtes pas connecté en tant qu\'administrateur');}
    }

    elseif ($_GET['action'] == 'editPost') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        editPost();
      }
      else {throw new Exception('Erreur : aucun identifiant de billet envoyé');}
    }

    elseif ($_GET['action']== 'insertPost'){

      if (!empty($_POST['number_chapter']) && !empty($_POST['title']) && !empty($_POST['post_date']) && !empty($_POST['id_image']) && !empty($_POST['author']) && !empty($_POST['content']) && !empty($_POST['excerpt'])  )
      {
        if (empty($_POST['is_visible'])){$visible = 'off';};
        addPost($_POST['number_chapter'], $_POST['title'], $_POST['author'], $_POST['post_date'], $_POST['id_image'], $_POST['content'], $_POST['excerpt'], $visible);
      }
      else {throw new Exception('Erreur insert : tous les champs ne sont pas remplis !');}
    }

    elseif ($_GET['action']== 'updatePost'){
      if (!empty($_POST['number_chapter']) && !empty($_POST['title']) && !empty($_POST['post_date']) && !empty($_POST['id_image'])
      && !empty($_POST['author']) && !empty($_POST['content']) && !empty($_POST['excerpt']) )
      {
        $visible = 'on';
        if (empty($_POST['is_visible'])){
          $visible = 'off';
        }
        updateThePost($_GET['id'], $_POST['number_chapter'], $_POST['title'], $_POST['author'], $_POST['post_date'], $_POST['id_image'], $_POST['content'], $_POST['excerpt'], $visible);
      }
      else { var_dump($_POST);
        $visible = 'on';
        if (empty($_POST['is_visible'])){
          $visible = 'off';
        }
        updateThePost($_GET['id'], $_POST['number_chapter'], $_POST['title'], $_POST['author'], $_POST['post_date'], $_POST['id_image'], $_POST['content'], $_POST['excerpt'], $visible);      }
      }

    elseif ($_GET['action']== 'allComments'){
      allComments();
    }

    elseif ($_GET['action']== 'deleteComment'){
      if($_GET['comment_id'] && ($_GET['step'] =="valid")){
        deleteComment($_GET['comment_id']);
      }
      allComments();
    }

    elseif ($_GET['action']== 'allUsers'){
      getUsers();
    }



    ///


  }
  catch (Exception $e){
    echo 'Erreur : '. $e->getMessage().'<br><a href="index.php">Retour</a>';
  }
}
else {
  listPosts();

}
