<?php
use \Alaska\Model\PostManager;
use \Alaska\Model\CommentManager;
use \Alaska\Model\UsersManager;
use \Alaska\Model\Globals;
$racine = 'http://localhost/alaska';


require ('view/lessc.inc.php');
try {
    lessc::ccompile('public/css/styles.less', 'public/css/styles.css');
} catch (exception $ex) {
    exit('lessc fatal error:<br />'.$ex->getMessage());
}


// Retourne l'ID du chapitre suivant ou précédent
function prevNextChap($sens, $postId){
  $globals = new Globals();
  $nbrePosts = $globals->countPosts();

    if ($sens =='next'){
      if ($postId < $nbrePosts){
      $prevNextChap = $postId + 1;
      }
      else{
        $prevNextChap = 1;
      }
    }
    elseif ($sens == 'prev') {
      if ($postId > 1){
      $prevNextChap = $postId - 1;
      }
      else{
        $prevNextChap = $nbrePosts;
      }
    }
    return $prevNextChap;
}


function detruireSession(){
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
}

function console_log( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);
    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function flagger($comment_id, $user_id){
  $commentManager = new CommentManager();
  $flagged = $commentManager->checkFlags($comment_id, $user_id);
if($flagged==null){
  $flagButton = '<input type="button" class="flagger button" id="'.$comment_id.'" onclick="flagRequest(flag,'.$comment_id.','.$user_id.',\'up\');" title="signaler ce commentaire comme offenssant ou innapproprié" value="Signaler" />';
}
elseif($flagged>0){
  $flagButton = '<input type="button" class="flagger button" id="'.$comment_id.'" onclick="flagRequest(flag,'.$comment_id.','.$user_id.',\'down\');" title="Annuler le signalement" value="Annuler le signalement" />';
}
return $flagButton;
}


function liker($post_id, $user_id){
  $postManager = new PostManager();
  $liked = $postManager->checkLikes($post_id, $user_id);
if($liked==null){
  $likeButton = '<input type="button" class="liker button" id="'.$post_id.'" onclick="likeRequest(like,'.$post_id.','.$user_id.',\'up\');" title="aimer ce post" value="J\'aime" />';
}
elseif($liked>0){
  $likeButton = '<input type="button" class="liker button" id="'.$post_id.'" onclick="likeRequest(like,'.$post_id.','.$user_id.',\'down\');" title="Unlike" value="Je n\'aime plus" />';
}
return $likeButton;
}

function bannisher($user_id){
  $userManager = new UsersManager();
  $banished = $userManager->checkBans($user_id);
if($banished=="notBan"){
  $bannishButton = '<input type="button" class="bannisher button" onclick="banRequest(ban,'.$user_id.',\'up\');" title="Bannir cet utilisateur" value="Bannir cet utilisateur" />';
}
else{
  $bannishButton = '<input type="button" class="bannisher button" onclick="banRequest(ban,'.$user_id.',\'down\');" title="De-Bannir cet utilisateur" value="De-Bannir cet utilisateur" />';
}
return $bannishButton;
}





//
// function postToArray(){
//
//   $postArray = array(
//     number_chapter =>'',
//     title =>'',
//     author =>'',
//     post_date_fr =>'',
//     id_image =>'',
//     content =>'',
//     excerpt =>'',
//     likes ='',
//     is_visible =''
//   )
//
//   if (isset($_GET['id'])){
//     $postArray[''] = ""
//
//
//   }
//
//
//
// }
