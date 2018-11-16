<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
use \Alaska\Model\PostManager;
use \Alaska\Model\CommentManager;

function listPosts() {
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
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

function editComment($commentId){
    $commentManager = new CommentManager();
    $theComment = $commentManager->getComment($commentId);
    require('view/frontend/commentView.php');
}

function replaceComment(){
    $commentManager = new CommentManager();
    $newComment = $commentManager->updateComment($_GET['comment_id'],$_GET['post_id'], $_POST['author'], $_POST['comment']);

     if ($newComment === false) {
        die('impossible d\'ajouter le commentaire');
    } else {
        header('location: index.php?action=post&id=' . $_GET['post_id']);
    }

}
