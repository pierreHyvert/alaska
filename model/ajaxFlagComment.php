<?php
header("Content-Type: text/plain"); // Utilisation d'un header pour spécifier le type de contenu de la page. Ici, il s'agit juste de texte brut (text/plain).
include('Manager.php');
include('CommentManager.php');
include('UsersManager.php');
use \Alaska\Model;
use \Alaska\Model\CommentManager;
use \Alaska\Model\UsersManager;
// function console_log( $data ) {
//     $output = $data;
//     if ( is_array( $output ) )
//         $output = implode( ',', $output);
//     echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
// }

$comment_id = (isset($_GET["theComment"])) ? $_GET["theComment"] : NULL;
$user_id = (isset($_GET["user_id"])) ? $_GET["user_id"] : NULL;
if ($comment_id) {
  $commentManager = new CommentManager();
  $comment = $commentManager->getComment($comment_id);
  $userManager = New UsersManager();

  $data = $comment->fetch();
  $current_flags = $data['flags'];
  $current_flags++;
  $flagged_comment = $commentManager->flagComment($comment_id, $current_flags);
  $update_flags = $commentManager->flagsManagement($comment_id, $user_id);
  echo($update_flags);
} else {
	echo "FAIL";
}
?>
