<?php
namespace Alaska\Model;


class UsersManager extends Manager {

    public function addUser($name, $hashed_pass, $email){
      $db = $this -> dbConnect();
      $req = $db->prepare('INSERT INTO users(name, email, password, signup_date, is_bannished, is_valid, val_key) VALUES(:name, :email, :pass, CURDATE(), "notBan", 0, "")');
      $req->execute(array(
      'name' => $name,
      'pass' => $hashed_pass,
      'email' => $email));
    }


    public function sendValidationMail($email){
      $cle = md5(microtime(TRUE)*100000);
      $db = $this -> dbConnect();
      $stmt = $db->prepare("UPDATE users SET val_key=:cle WHERE email like :email");
      $stmt->bindParam(':cle', $cle);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      $destinataire = $email;
      $sujet = "Activer votre compte" ;
      $entete = "From: inscription@alaska.com" ;

      $message = 'Bienvenue sur Alaska.com,

      Pour activer votre compte, veuillez cliquer sur le lien ci dessous
      ou copier/coller dans votre navigateur internet.

      http://localhost/alaska/index.php?action=validation&email='.$email.'&cle='.urlencode($cle).'

      ---------------
      Ceci est un mail automatique, Merci de ne pas y répondre.';
      mail($destinataire, $sujet, $message, $entete) ;
    }


    public function validateUser($email, $cle){
      $db = $this -> dbConnect();
      $req = $db->prepare('SELECT * FROM users WHERE email = ? ');
      $req->execute(array($email));
      $data = $req->fetch();
        if($data['val_key'] == $cle){
          $db = $this -> dbConnect();
          $updateReq = $db->prepare("UPDATE users SET is_valid=1 WHERE email like ?");
          $updateReq->execute(array($email));
        }
        else{
          throw new \Exception("Clé de validation incorrecte");
        }
      }


    public function editUser($email, $newPass){
      $db = $this -> dbConnect();
      $updateReq = $db->prepare("UPDATE users SET password = ? WHERE email like ?");
      $updateReq->execute(array($newPass,$email)) or die(print_r($updateReq->errorInfo()));
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

    public function getUserById($user_id){
      $db = $this -> dbConnect();
      $req = $db->prepare('SELECT email FROM users WHERE id = ?');
      $req->execute(array($user_id));
      $user = $req->fetch();
      return $user['email'];
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

    public function blackList($user_email){
      $db = $this->dbConnect();
      $blackList = $db->prepare('SELECT * FROM blacklist WHERE bl_email = ? ');
      $blackList->execute(array($user_email)) or die(print_r($blackList->errorInfo()));

      $blState = $blackList->fetch();
      if($blState['id']>0){
        $remover=$db->prepare("DELETE FROM blacklist WHERE bl_email = ?");
        $remover->execute(array($user_email)) or die(print_r($remover->errorInfo()));
      }
      else{
        $adder=$db->prepare("INSERT INTO blacklist(bl_email) VALUES(?)");
        $adder->execute(array($user_email)) or die(print_r($adder->errorInfo()));
      }
    }

    public function isBlackListed($user_email){
    $blacklisted ='';
    $db = $this->dbConnect();
      $blackList = $db->query('SELECT * FROM blacklist');
      while($bl = $blackList->fetch()){
        if($bl['bl_email'] == $user_email){
          $blacklisted = true ;
        }
        else{
          $blacklisted =false;
        }
      }
      return $blacklisted;

    }

    // public function connectUser(){
    //
    // }

    public function deleteUser($email){
      $db = $this->dbConnect();
      $deleter = $db->prepare('DELETE FROM users WHERE email = ? ');
      $deleter->execute(array($email)) or die(print_r($deleter->errorInfo()));
    }


}
