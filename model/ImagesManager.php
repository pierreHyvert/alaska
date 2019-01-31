<?php
namespace Alaska\Model;

class ImagesManager extends Manager{

    public function addImage($filename,$filesize,$fileurl){
      $db = $this->dbConnect();
      $image = $db->prepare("INSERT INTO images (up_filename, up_filesize, up_fileurl) VALUES(:filename, :filesize, :fileurl)");
      $affectedLines = $image-> execute(array(
        'filename' => $filename,
        'filesize' => $filesize,
        'fileurl' => $fileurl
      )) or die(print_r($image->errorInfo()));

      return $affectedLines;
    }

    public function deleteImage(){

    }


    public function getAllImages(){
      $db = $this->dbConnect();
      $images = $db->query("SELECT * FROM images") or die(print_r($images->errorInfo()));
      return $images;
    }
}
