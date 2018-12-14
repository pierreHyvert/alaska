<?php
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/Globals.php');
require_once('view/functions.php');

use \Alaska\Model\PostManager;
use \Alaska\Model\CommentManager;
use \Alaska\Model\Globals;


function listAdminPost(){
      $postManager = new PostManager();
      $posts = $postManager->getPosts();
      require('view/admin/adminView.php');
  }
