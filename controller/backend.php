<?php
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UsersManager.php');
require_once('model/Globals.php');
require_once('view/functions.php');

use \Alaska\Model\UsersManager;
use \Alaska\Model\PostManager;
use \Alaska\Model\CommentManager;
use \Alaska\Model\Globals;


function listAdminPost(){
      $postManager = new PostManager();
      $posts = $postManager->getPosts();
      require('view/admin/adminView.php');
  }

function editPost() {
  if (isset($_GET['id'])){
    $postManager = new PostManager();
    $post = $postManager->getPostAdmin($_GET['id']);
  }
  require('view/admin/addPostView.php');
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


function updateThePost($post_id, $number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $is_visible) {
    $postManager = new PostManager();
    $affectedLines = $postManager->updatePost($post_id, $number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $is_visible);
    if ($affectedLines === false) {
        die('impossible de mettre à jour le chapitre');
    } else {
        header('location: index.php?action=editPost&id='.$post_id);
    }
}

function allComments(){
  $commentManager = new CommentManager();
  $comments = $commentManager->allComments();
  require('view/admin/commentsView.php');
}

function deleteComment($comment_id){
  $commentManager = new CommentManager();
  $comments = $commentManager->deleteComment($comment_id);
}



function getUsers(){
  $usersManager = new UsersManager();
  $users = $usersManager->getUsers();
  require('view/admin/usersView.php');

}

  // function updateThePost($post_id, $number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $is_visible) {
  //     $postManager = new PostManager();
  //     $affectedLines = $postManager->updatePost($post_id, $number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $is_visible);
  //     if ($affectedLines === false) {
  //         die('impossible de mettre à jour le chapitre');
  //     } else {
  //         header('location: index.php?action=editPost&id='.$post_id);
  //     }
  // }
