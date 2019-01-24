<?php
namespace Alaska\Model;


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
      $req = $db->prepare('SELECT id, name, email, signup_date FROM users WHERE email = ?');
      $req->execute(array($user_email));
      $user = $req->fetch();
      return $user;
    }



    public function checkBans($user_id){
      $db = $this->dbConnect();
      $theBans = $db->prepare('SELECT is_bannished FROM users WHERE id = :user_id');
      $theBans-> execute(array(
        'user_id' => $user_id)) or die(print_r($theBans->errorInfo()));
      $banState = $theBans->fetch();
      $banState = $banState['is_bannished'];
      return $banState;
    }

    public function countUserFlags($user_id){
      $db = $this->dbConnect();
      $nbFlags = $db->prepare('SELECT comment_id FROM flags WHERE user_id = ?');
      $nbFlags-> execute(array($user_id));
      $flagsNb = 0;
      while($allFlags = $nbFlags->fetch())
      {$flagsNb++;}
      // $flagsNb = count($allFlags);
      return $flagsNb;

    }


    public function banManagement($user_id){
      $banState = $this->checkBans($user_id);
        if ($banState == "notBan"){
          $newBanState = "ban";
          $db = $this->dbConnect();
          $banUnban = $db->prepare('UPDATE users SET is_bannished = ? WHERE id = ?');
          $banned = $banUnban->execute(array($newBanState,$user_id)) or die(print_r($banned->errorInfo()));
          return('bannished');
        }
        elseif  ($banState == "ban"){
          $newBanState = "notBan";
          $db = $this->dbConnect();
          $banUnban = $db->prepare('UPDATE users SET is_bannished = ? WHERE id = ?');
          $banned = $banUnban->execute(array($newBanState,$user_id)) or die(print_r($banned->errorInfo()));
          return('unbannished');
        }
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
