<?php
namespace Alaska\Model;

class Manager{
    protected function dbConnect() {
        //$db = new \PDO('mysql:host=phyvertbdd.mysql.db;dbname=phyvertbdd;charset=utf8', 'phyvertbdd', 'chiwawA12');
        $db = new \PDO('mysql:host=localhost;dbname=alaska;charset=utf8', 'root', '');

        return $db;
    }
}
