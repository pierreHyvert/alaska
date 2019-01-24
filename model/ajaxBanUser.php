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

$user_id = (isset($_GET["user_id"])) ? $_GET["user_id"] : NULL;
// $sens = (isset($_GET["sens"])) ? $_GET["sens"] : NULL;
if ($user_id) {
  $usersManager = new UsersManager();
  $newBanState = $usersManager->banManagement($user_id);
  echo($newBanState);
} else {
	echo "FAIL";
}
?>
