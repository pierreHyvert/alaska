<?php
require_once('model/Manager.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/Globals.php');
require_once('view/functions.php');

use \Alaska\Model\PostManager;
use \Alaska\Model\CommentManager;
use \Alaska\Model\Globals;



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

function addPost($number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $is_visible) {
    $postManager = new PostManager();

    $affectedLines = $postManager->addPost($number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $is_visible);

    if ($affectedLines === false) {
        die('impossible d\'ajouter le chapitre');
    } else {
        header('location: index.php?action=admin');
    }
}

function editPost() {
  if (isset($_GET['id'])){
    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);
  }
  require('view/backend/addPostView.php');
}

//// COMMENTS /////
function addComment($postId, $author, $comment) {
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    if ($affectedLines === false) {
        die('impossible d\'ajouter le commentaire');
    } else {
        header('location: index.php?action=post&id=' . $postId);
    }
}

function deleteComment($commentId){
}
