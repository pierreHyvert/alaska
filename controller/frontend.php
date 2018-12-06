<?php
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('view/functions.php');

use \Alaska\Model\PostManager;
use \Alaska\Model\CommentManager;

function listPosts() {
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/accueil.php');
}

function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

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
