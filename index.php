<?php session_start();


require('controller/frontend.php');
require('controller/backend.php');


if (isset($_GET['action'])) {
  $action=strip_tags($_GET['action']);
  try{
    ////////////////FRONT///////////
    $fe = new Frontend();
    $be = new Backend();
    $users = new Users();

    if ($action == 'listPosts') {
      $fe->listPosts();
    }

    elseif ($action == 'post') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        $post_id = strip_tags($_GET['id']);
        $fe->post($post_id);
      }
      else {throw new Exception('Erreur : aucun identifiant de billet envoyé');}
    }

    elseif ($action== 'addComment'){
      $fe->addComment();
    }

    //////// USERS //////

    elseif ($action == 'inscription'){
      require('view/frontend/inscription.php');
    }

    elseif ($action == 'addUser'){
      require('controller/users.php');
      $users->addUser();
    }

    elseif ($action == 'validation'){
      if (isset($_GET['email']) && !empty($_GET['email']) ){
        if (isset($_GET['cle']) && !empty($_GET['cle']) ){
          $email = htmlspecialchars($_GET['email']);
          $cle = htmlspecialchars($_GET['cle']);
          require('controller/users.php');
          $users->validationUser($email, $cle);
        }
      }
      else {throw new Exception('Erreur : certains paramètres de validations manquent !');}
      require('view/frontend/validation.php');
    }

    elseif ($action == 'editUser'){
      require('controller/users.php');
      $users->editUser();
    }

    elseif ($action == 'user'){
      if (isset($_GET['user_email']) && !empty($_GET['user_email']) ){
        if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'user' ){
          $email= strip_tags($_GET['user_email']);
          require('controller/users.php');
          $users->user($email);
        }
        elseif (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin' ){
          $be->listAdminPost();
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
        $users->deleteUser($email);
      }
      else {throw new Exception('Erreur : pas d\'utilisateur à supprimer !');}
    }

    elseif ($action == 'connexion'){
      require('controller/users.php');
      $users->connectUser();
    }

    elseif ($action == 'deconnexion'){
      detruireSession();
      $fe->listPosts();
    }

    elseif ($action == 'passwordReset'){
      require('controller/users.php');
      $users->passwordReset(strip_tags($_POST['email']));
      $reset = true;
      require('view/frontend/inscription.php');
    }

    elseif ($action == 'reset'){
      if (isset($_GET['email']) && !empty($_GET['email']) ){
        if (isset($_GET['cle']) && !empty($_GET['cle']) ){
          $email = htmlspecialchars($_GET['email']);
          $cle = $_GET['cle'];
          require('controller/users.php');
          $users->checkResetKey($email, $cle);
        }
      }
      else {throw new Exception('Erreur : certains paramètres de réinitialisation manquent !');}
    }

    elseif ($action == 'resetingThePass') {
      require('controller/users.php');
      $users->resetTheUserPass();
    }


    ////////////ADMIN///////////////

    elseif ($action == 'admin'){
      if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin')
      {
        $be->listAdminPost();
      }
      else {throw new Exception('Erreur : vous n\'êtes pas connecté en tant qu\'administrateur');}
    }

    elseif ($action == 'addPost'){
      if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin')
      {
        $images = $be->getImages();
        require('view/admin/addPostView.php');
      }
      else {throw new Exception('Erreur : vous n\'êtes pas connecté en tant qu\'administrateur');}
    }

    elseif ($action == 'editPost') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        $be->editPost();
      }
      else {throw new Exception('Erreur : aucun identifiant de billet envoyé');}
    }

    elseif ($action == 'insertPost'){
      $be->addPost();
    }

    elseif ($action == 'updatePost'){
      $be->updateThePost();
    }

    elseif ($action == 'deletePost'){
      $post_id = strip_tags($_GET['post_id']);
      $be->deletePost($post_id);
    }

    elseif ($action == 'allComments'){
      $be->allComments();
    }

    elseif ($action == 'deleteComment'){
      if($_GET['comment_id'] && ($_GET['step'] =="valid")){
        $comment_id= strip_tags($_GET['comment_id']);
        $be->deleteComment($comment_id);
      }
      $be->allComments();
    }

    elseif ($action == 'allUsers'){
      $be->getUsers();
    }

    elseif ($action == 'mentions'){
      $fe->mentions();
    }

  }
  catch (Exception $e){
    echo 'Erreur : '. $e->getMessage().'<br><a href="index.php">Retour</a>';
  }
}
else {
  listPosts();
}
