<?php
use \Alaska\Model\PostManager;
use \Alaska\Model\CommentManager;
use \Alaska\Model\Globals;
$racine = 'http://localhost/alaska';


require ('view/lessc.inc.php');
try {
    lessc::ccompile('public/css/styles.less', 'public/css/styleC.css');
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
