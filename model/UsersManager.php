<?php
namespace Alaska\Model;
require_once('model/Manager.php');

class UsersManager extends Manager {

    public function addUser($name, $hashed_pass, $email){
      $db = $this -> dbConnect();
      $req = $db->prepare('INSERT INTO users(name, email, password, signup_date) VALUES(:name, :email, :pass, CURDATE())');
      $req->execute(array(
      'name' => $name,
      'pass' => $hashed_pass,
      'email' => $email));
    }

    public function getUsers(){
      $db = $this -> dbConnect();
      $req = $db->query('SELECT * FROM users');
      return $req;
    }

    public function getUser($user_email){
      $db = $this -> dbConnect();
      $req = $db->prepare('SELECT name, email, signup_date FROM users WHERE email = ?');
      $req->execute(array($user_email));
      $user = $req->fetch();
      return $user;
    }


    public function connectUser(){

    }
    //
    //
    //
    //
    // public function editUser($userId){
    //
    // }
    //
    //
    // public function deleteUser($userId){
    //
    // }
    //

}
