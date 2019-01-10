<?php
header("Content-Type: text/plain"); // Utilisation d'un header pour spécifier le type de contenu de la page. Ici, il s'agit juste de texte brut (text/plain).
include('Manager.php');
include('CommentManager.php');
use \Alaska\Model;
use \Alaska\Model\CommentManager;


$comment_id = (isset($_GET["theComment"])) ? $_GET["theComment"] : NULL;
if ($comment_id) {
  $commentManager = new CommentManager();
  $comment = $commentManager->getComment($comment_id);
  $data = $comment->fetch();
  $current_flags = $data['flags'];
  $current_flags++;
  $flagged_comment = $commentManager->flagComment($current_flags, $comment_id);
  return $current_flags;
} else {
	echo "FAIL";
}

?>
