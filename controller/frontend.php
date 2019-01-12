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
