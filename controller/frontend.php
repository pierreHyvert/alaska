<?php
require_once('model/Manager.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/Globals.php');
require_once('view/functions.php');

use \Alaska\Model\PostManager;
use \Alaska\Model\CommentManager;
use \Alaska\Model\Globals;

if (!isset($_SESSION['user_id'])){$_SESSION['user_id']='';}



////// POSTS ////
function listPosts() {
    $postManager = new PostManager();
    $posts = $postManager->getVisiblePosts();
    require('view/frontend/accueil.php');
}


function post($post_id) {
    $postManager = new PostManager();
    $posts = $postManager->getVisiblePosts();
    $post_infos = $postManager->getPostInfos($posts, $post_id);
    $commentManager = new CommentManager();
    $comments = $commentManager->getComments($post_id);
    require('view/frontend/postView.php');
}


//// COMMENTS /////
function addComment() {
     if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
            $post_id = strip_tags($_GET['id']);
            $comment_author = strip_tags($_POST['author']);
            $comment = strip_tags($_POST['comment']);
            
            $commentManager = new CommentManager();
            $affectedLines = $commentManager->postComment($post_id, $comment_author, $comment);
            if ($affectedLines === false) {
                die('impossible d\'ajouter le commentaire');
            } else {
                header('location: index.php?action=post&id=' . $post_id);
            }
        }
        else {throw new Exception('Erreur : tous les champs ne sont pas remplis !');}
      }
      else {throw new Exception('Erreur : aucun identifiant de billet envoyé');} 
}
