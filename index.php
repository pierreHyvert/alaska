<?php session_start();
require('controller/frontend.php');
require('controller/backend.php');


if (isset($_GET['action'])) {
    $action=strip_tags($_GET['action']);
  try{
    ////////////////FRONT///////////

    if ($action == 'listPosts') {
      listPosts();
    }

    elseif ($action == 'post') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        $post_id = strip_tags($_GET['id']);
        post($post_id);
      }
      else {throw new Exception('Erreur : aucun identifiant de billet envoyé');}
    }

    elseif ($action== 'addComment'){
      addComment();
    }

    //////// USERS //////

    elseif ($action == 'inscription'){
      require('view/frontend/inscription.php');
    }

    elseif ($action == 'addUser'){
      require('controller/users.php');
      addUser();
    }

    elseif ($action == 'validation'){
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

    elseif ($action == 'editUser'){
      require('controller/users.php');
      editUser();
    }

    elseif ($action == 'user'){
      if (isset($_GET['user_email']) && !empty($_GET['user_email']) ){
        if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'user' ){
          $email= strip_tags($_GET['user_email']);
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

    elseif ($action == 'deleteUser'){
      if (isset($_POST['email']) && !empty($_POST['email']) ){
        require('controller/users.php');
          $email = strip_tags($_POST['email']);
          deleteUser($email);
      }
      else {throw new Exception('Erreur : pas d\'utilisateur à supprimer !');}
    }

    elseif ($action == 'connexion'){
        require('controller/users.php');
        connectUser();
    }

    elseif ($action == 'deconnexion'){
      detruireSession();
      listPosts();
    }

    elseif ($action == 'passwordReset'){
      require('controller/users.php');
      passwordReset(strip_tags($_POST['email']));
      $reset = true;
      require('view/frontend/inscription.php');
    }

    elseif ($action == 'reset'){
      if (isset($_GET['email']) && !empty($_GET['email']) ){
        if (isset($_GET['cle']) && !empty($_GET['cle']) ){
          $email = htmlspecialchars($_GET['email']);
          $cle = $_GET['cle'];
          require('controller/users.php');
          checkResetKey($email, $cle);
        }
      }
      else {throw new Exception('Erreur : certains paramètres de réinitialisation manquent !');}
    }

    elseif ($action == 'resetingThePass') {
      require('controller/users.php');
      resetTheUserPass();
    }


    ////////////ADMIN///////////////

    elseif ($action == 'admin'){
      if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin')
      {
        listAdminPost();
      }
      else {throw new Exception('Erreur : vous n\'êtes pas connecté en tant qu\'administrateur');}
    }

    elseif ($action == 'addPost'){
      if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin')
      {
        $images = getImages();
        require('view/admin/addPostView.php');
      }
      else {throw new Exception('Erreur : vous n\'êtes pas connecté en tant qu\'administrateur');}
    }

    elseif ($action == 'editPost') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        editPost();
      }
      else {throw new Exception('Erreur : aucun identifiant de billet envoyé');}
    }

    elseif ($action == 'insertPost'){
      addPost();
    }

    elseif ($action == 'updatePost'){
        updateThePost();
    }

    elseif ($action == 'deletePost'){
        $post_id = strip_tags($_GET['post_id']);
        deletePost($post_id);
    }

    elseif ($action == 'allComments'){
      allComments();
    }

    elseif ($action == 'deleteComment'){
      if($_GET['comment_id'] && ($_GET['step'] =="valid")){
        $comment_id= strip_tags($_GET['comment_id']);
        deleteComment($comment_id);
      }
      allComments();
    }

    elseif ($action == 'allUsers'){
      getUsers();
    }

    elseif ($action == 'mentions'){
      mentions();
    }

  }
  catch (Exception $e){
    echo 'Erreur : '. $e->getMessage().'<br><a href="index.php">Retour</a>';
  }
}
else {
  listPosts();
}
