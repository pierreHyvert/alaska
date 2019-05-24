<?php
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/ImagesManager.php');
require_once('model/UsersManager.php');
require_once('model/Globals.php');
require_once('view/functions.php');

use \Alaska\Model\UsersManager;
use \Alaska\Model\PostManager;
use \Alaska\Model\CommentManager;
use \Alaska\Model\ImagesManager;
use \Alaska\Model\Globals;


class Backend {

  ////// POSTS ////
  
  public function listAdminPost(){
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/admin/adminView.php');
  }

  public function editPost() {
    if (isset($_GET['id'])){
      $post_id = strip_tags($_GET['id']);
      $postManager = new PostManager();
      $post = $postManager->getPostAdmin($post_id);
      $images = getImages();
    }
    require('view/admin/addPostView.php');
  }

  public function addPost() {
    if (!empty($_POST['number_chapter']) && !empty($_POST['title']) && !empty($_POST['post_date']) && !empty($_POST['id_image']) && !empty($_POST['author']) && !empty($_POST['content']) && !empty($_POST['excerpt'])  )
    {
      $visible = 'on';
      if (empty($_POST['is_visible'])){$visible = 'off';}

      $number_chapter = strip_tags($_POST['number_chapter']) ;
      $title = strip_tags($_POST['title']) ;
      $author = strip_tags($_POST['author']) ;
      $post_date = strip_tags($_POST['post_date']) ;
      $id_image = strip_tags($_POST['id_image']) ;
      $content = $_POST['content'] ;
      $excerpt = strip_tags($_POST['excerpt']) ;

      $postManager = new PostManager();
      $affectedLines = $postManager->addPost($number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $visible);
      if ($affectedLines === false) {
        die('impossible d\'ajouter le chapitre');
      } else {
        header('location: index.php?action=admin');
      }
    }
    else {throw new Exception('Erreur insert : tous les champs ne sont pas remplis !');}
  }

  public function updateThePost() {
    if (!empty($_POST['number_chapter']) && !empty($_POST['title']) && !empty($_POST['post_date']) && !empty($_POST['id_image'])
    && !empty($_POST['author']) && !empty($_POST['content']) && !empty($_POST['excerpt']) )
    {
      $visible = 'on';
      if (empty($_POST['is_visible'])){ $visible = 'off'; }
      $post_id = strip_tags($_POST['postID']);
      $number_chapter = strip_tags($_POST['number_chapter']) ;
      $title = strip_tags($_POST['title']) ;
      $author = strip_tags($_POST['author']) ;
      $post_date = strip_tags($_POST['post_date']) ;
      $id_image = strip_tags($_POST['id_image']) ;
      $content = $_POST['content'] ;
      $excerpt = strip_tags($_POST['excerpt']) ;
      $likes = strip_tags($_POST['likes']) ;

      $postManager = new PostManager();
      $affectedLines = $postManager->updatePost($post_id, $number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $visible);
      if ($affectedLines === false) {
        die('impossible de mettre à jour le chapitre');
      } else {
        header('location: index.php?action=editPost&id='.$post_id);
      }
    }
    else {throw new Exception('Erreur insert : tous les champs ne sont pas remplis !');}
  }

  public function deletePost($post_id){
    $postManager = new PostManager();
    $deleted = $postManager->deletePost($post_id);
    if ($deleted === false) {
      die('erreur lors de la suppression du chapitre');
    } else {
      header('location: index.php?action=admin');
    }
  }
  //// COMMENTS /////

  public function allComments(){
    $commentManager = new CommentManager();
    $comments = $commentManager->allComments();
    require('view/admin/commentsView.php');
  }

  public function deleteComment($comment_id){
    $commentManager = new CommentManager();
    $comments = $commentManager->deleteComment($comment_id);
  }

  //// DIVERS /////

  public function getUsers(){
    $usersManager = new UsersManager();
    $users = $usersManager->getUsers();
    require('view/admin/usersView.php');
  }

  public function getImages(){
    $imagesManager = new ImagesManager();
    $images = $imagesManager->getAllImages();
    return $images;
  }
}
