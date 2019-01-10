<?php
namespace Alaska\Model;


class Globals extends Manager {
  public function countPosts(){
    $db = $this -> dbConnect();
    $req = $db->query('SELECT * FROM chapters WHERE is_visible = "on"');
    $count = 0;
    while ($data = $req->fetch()){
      $count++;
    }
    return $count;
  }
}
