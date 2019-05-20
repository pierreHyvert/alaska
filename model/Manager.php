<?php
namespace Alaska\Model;
$local = true;
if ($local){
  class Manager{
    protected function dbConnect() {
        $db = new \PDO('mysql:host=localhost;dbname=alaska;charset=utf8', 'root', '');
        return $db;
    }
  }
}
  else {
    class Manager{
        protected function dbConnect() {
          $db = new \PDO('mysql:host=phyvertbdd.mysql.db;dbname=phyvertbdd;charset=utf8', 'phyvertbdd', 'chiwawA12');
          return $db;
        }
      }
}
