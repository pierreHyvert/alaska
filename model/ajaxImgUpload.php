<?php
header("Content-Type: text/html");
include('Manager.php');
include('ImagesManager.php');
use \Alaska\Model;
use \Alaska\Model\ImagesManager;
if(isset($_FILES["file"]["type"]))
{
  $validextensions = array("jpeg", "jpg", "png");
  $temporary = explode(".", $_FILES["file"]["name"]);
  $file_extension = end($temporary);
  if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
  ) && ($_FILES["file"]["size"] < 2000000)
  && in_array($file_extension, $validextensions)) {
    if ($_FILES["file"]["error"] > 0)
    {
      echo "Code erreur : " . $_FILES["file"]["error"] . "<br/><br/>";
    }
    else
    {
      if (file_exists("../img/upload/" . $_FILES["file"]["name"])) {
        echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
      }
      else
      {
        $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
        $targetPath = "../img/upload/".$_FILES['file']['name']; // Target path where file is to be stored
        move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

        $bddPath ="./img/upload/".$_FILES['file']['name'];
        $imagesManager = new ImagesManager;
        $addImg = $imagesManager-> addImage($_FILES["file"]["name"],$_FILES["file"]["size"],$bddPath);

        if($addImg == true){
      echo "<img id='newImage' src='".$bddPath."' />";
        echo "<span id='success'>Image enregistrée.</span><br/>";
        echo "<br/><b>Nom du fichier :</b> " . $_FILES["file"]["name"] . "<br>";
        echo "<b>Type :</b> " . $_FILES["file"]["type"] . "<br>";
        echo "<b>Poid :</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";

        // echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
      }
      }
    }
  }
  else
  {
    echo "<span id='invalid'>*** Taille ou type de fichier Invalide ***<span>";
  }
}
?>
