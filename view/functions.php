<?php
$racine = 'http://localhost/alaska';


require ('view/lessc.inc.php');
try {
    lessc::ccompile('public/css/styles.less', 'public/css/styleC.css');
} catch (exception $ex) {
    exit('lessc fatal error:<br />'.$ex->getMessage());
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
