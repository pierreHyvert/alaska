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
