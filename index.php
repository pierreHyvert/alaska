<?php session_start();
require('controller/frontend.php');
$_SESSION['connected'] = 'admin';

try{

  ////////////////FRONT///////////
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }

        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
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

        elseif ($_GET['action']== 'user'){
          require('controller/users.php');
          user();
        }


////////////ADMIN///////////////

        elseif ($_GET['action']== 'admin'){
            if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin')
            {
              require('controller/backend.php');
              listAdminPost();
            }
            else {throw new Exception('Erreur : vous n\'êtes pas connecté en tant qu\'administrateur');}
        }


        /// TEMPORAIRE
        elseif ($_GET['action']== 'addPost'){
          require('view/admin/addPostView.php');
        }

        elseif ($_GET['action'] == 'editPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                editPost();
            }
            else {throw new Exception('Erreur : aucun identifiant de billet envoyé');}
        }

        elseif ($_GET['action']== 'insertPost'){

                if (!empty($_POST['number_chapter']) && !empty($_POST['title']) && !empty($_POST['post_date']) && !empty($_POST['id_image']) && !empty($_POST['author']) && !empty($_POST['content']) && !empty($_POST['excerpt']) && !empty($_POST['is_visible']) )
                {
                    addPost($_POST['number_chapter'], $_POST['title'], $_POST['post_date'], $_POST['id_image'], $_POST['author'], $_POST['content'], $_POST['excerpt'], $_POST['is_visible']);
                }
                else {throw new Exception('Erreur : tous les champs ne sont pas remplis !');}
        }


        // elseif ($_GET['action']== 'editComment'){
        //     if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
        //         editComment($_GET['commentId']);
        //     }
        //     else {throw new Exception('Erreur : aucun identifiant de commentaire envoyé');}
        // }
        //
        // elseif ($_GET['action']== 'replaceComment'){
        //     if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
        //         if (!empty($_POST['author']) && !empty($_POST['comment'])) {
        //            replaceComment($_GET['comment_id'],$_GET['post_id'], $_POST['author'], $_POST['comment']);
        //         }
        //         else{throw new Exception('Erreur : tous les champs ne sont pas remplis !');}
        //     }
        //     else {throw new Exception('Erreur : aucun identifiant de commentaire envoyé');}
        // }


    }
///

    else {
        listPosts();
    }
}
 catch (Exception $e){
    echo 'Erreur : '. $e->getMessage();
    listPosts();
 }
