<?php
header("Content-Type: text/plain"); 
include('Manager.php');
include('PostManager.php');
include('UsersManager.php');
use \Alaska\Model;
use \Alaska\Model\PostManager;
use \Alaska\Model\UsersManager;
// function console_log( $data ) {
//     $output = $data;
//     if ( is_array( $output ) )
//         $output = implode( ',', $output);
//     echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
// }

$post_id = (isset($_GET["thePost"])) ? $_GET["thePost"] : NULL;
$user_id = (isset($_GET["user_id"])) ? $_GET["user_id"] : NULL;
$sens = (isset($_GET["sens"])) ? $_GET["sens"] : NULL;
if ($post_id) {
  $postManager = new PostManager();
  $posts = $postManager->getVisiblePosts();
  $post = $postManager->getPostInfos($posts, $post_id);
  $userManager = New UsersManager();
  $current_likes = $post['likes'];
  if($sens == "up"){++$current_likes;}
  if($sens == "down"){--$current_likes;}
  $liked_post = $postManager->likePost($post_id, $current_likes);
  $update_likes = $postManager->likesManagement($post_id, $user_id);
  echo($update_likes);
} else {
	echo "FAIL";
}
?>
