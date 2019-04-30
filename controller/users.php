<?php

require_once('model/UsersManager.php');
require_once('model/Globals.php');
require_once('view/functions.php');
use \Alaska\Model\UsersManager;
use \Alaska\Model\Globals;


function addUser(){
  $userManager = new UsersManager();
  $usersList = $userManager->getUsers();
  $errors = array();
  $missingFields = array();

  // Si un champ est vide, on le signale, mais on continue les controles, ce sera toujours ça de fait...
  if (empty($_POST['name']) OR empty($_POST['password']) OR empty($_POST['passwordCheck']) OR empty($_POST['email']))
  {
    $errors['emptyFields'] = '<p class="erreur">Au moins un des champs n\'est pas rempli, veuillez vérifier votre saisie.<br> Tous les champs sont obligatoires.</p>';
  }

  // check Email (format et pas existant dans bdd)
  if (isset($_POST['email']) && !empty($_POST['email'])){
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email= $_POST['email'];
    } else {
      $errors['emailFormat'] = '<p class="erreur">Le format de l\'adresse email indiquée est incorrect, merci de la vérifier</p>';
    }
    while($user = $usersList->fetch()){
      if($user['email'] == $email){
        $errors['email'] = '<p class="erreur">Cet email est déjà dans nos bases, veuillez en choisir un autre, ou vous connecter en utilisant cet email.</p>';
      }
    }
  }
  else {
    $missingFields[] = "Adresse email.";
  }

  // check Nom (format et pas existant dans bdd)
  if (isset($_POST['name']) && !empty($_POST['name'])){
    $name = $_POST['name'];
    if (strlen($name)<3){
      $errors['namelenght'] ='<p class="erreur">Ce pseudo est trop court, merci de choisir un pseudo de 3 caractères minimum.</p>';
    }
    while($user = $usersList->fetch()){
      if($user['name'] == $name){
        $errors['name'] = '<p class="erreur">Ce nom/pseudo est déjà dans nos bases, veuillez en choisir un autre, ou vous connecter en utilisant ce nom/pseudo.</p>';
      }
    }
  }
  else {
    $missingFields[] = "Nom.";
  }

  // check de la répétition du pass et hashage "avec sel" si c'est ok
  if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['passwordCheck']) && !empty($_POST['passwordCheck'])){
    if ($_POST['password'] == $_POST['passwordCheck'] ){
      $password = $_POST['password'];
      if (strlen($password)<8){
        $errors['passwordlenght'] = '<p class="erreur">Ce mot de passe est trop court, merci de choisir un mot de passe de 8 caractères minimum.</p>';
      }
      if (isset($_POST['name']) && !empty($_POST['name'])){
        // $sale = salaison($password, $name);
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
      }
    }
    else {
      $errors['password'] = '<p class="erreur">Les deux mots de passe indiqués sont différents, veuillez les saisir de nouveau.</p>';
    }
  }
  else {
    $errors['password'] = '<p class="erreur">Vous n\'avez pas saisi les deux mots de passe.</p>';
    $missingFields[] = "Un ou les deux champs Mots de passe.";
  }

  if(empty($errors)){
    $affectedLines = $userManager->addUser($name, $hashed_pass, $email);
    $sendValidationMail = $userManager->sendValidationMail($email);


    if ($affectedLines === false) {
      die('impossible d\'ajouter l\utilisateur');
    } else {
      header('location: index.php?action=user&message=1&user_email='.$email);
    }  }
    else{

      require('view/frontend/inscription.php');
    }
  }

function validationUser($email, $cle){
  $userManager = new UsersManager();
  $usersValidate = $userManager->validateUser($email, $cle);
  return $usersValidate;
}

function user($email){
    $userManager = new UsersManager();
    $usersList = $userManager->getUser($email);
    require('view/frontend/userView.php');
}

function admin($email){
    $userManager = new UsersManager();
    $usersList = $userManager->getUser($email);
    require('view/admin/adminView.php');
}


function connectUser(){
  $usersManager = new UsersManager();
  $usersList = $usersManager->getUsers();
  $errorsC = array();
  $missingFieldsC = array();
  $errorsC['wrongPass'] = 'Le mot de passe est incorrect.';
  $errorsC['noEmail'] = 'Il n\'y a pas de compte utilisateur associé à cette adresse email.';
  if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['email']) && !empty($_POST['email'])){
      $password = $_POST['password'];
      $email = $_POST['email'];
      while ($user = $usersList->fetch()){
        if ($user['email'] == $email){
          $errorsC['noEmail'] = '';
          $name = $user['name'];
          if (password_verify($password, $user['password'])){
            $errorsC['wrongPass'] = '';
            if ($user['email'] == 'phyvert@wanadoo.fr'){
              $_SESSION['connected'] = 'admin';
            }
            else{
              $_SESSION['connected'] = 'user';
            }
            $_SESSION['user_email'] = $email;
            $_SESSION['user_id'] = $user['id'];
            $userBlackListed = $usersManager->isBlackListed($user['email']);
            if($userBlackListed){$_SESSION['blacklisted']= true;}
            else {
              $_SESSION['blacklisted']= false;            }
          }
        }
      }
      if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'user'){
        header('location: index.php?action=user&user_email='.$email);
      }
      elseif (isset($_SESSION['connected']) && $_SESSION['connected'] == 'admin'){
        listAdminPost();
      }
      else{
        require('view/frontend/inscription.php');
      }
    }
    else {
      $missingFields[] = "Un ou les deux champs ne sont pas remplis.";
      require('view/frontend/inscription.php');
    }
  }

  function editUser(){
    $userManager = new UsersManager();
    $usersList = $userManager->getUsers();
    $errors = array();
    $missingFields = array();
    $errorsC['wrongPass'] = 'wrong';
    // Si un champ est vide, on le signale, mais on continue les controles, ce sera toujours ça de fait...
    if (empty($_POST['oldElPasso']) OR empty($_POST['newPass']) OR empty($_POST['newPass2']))
    {
      $errors['emptyFields'] = '<p class="erreur">Au moins un des champs n\'est pas rempli, veuillez vérifier votre saisie.</p>';
    }
    // check de la répétition du pass et comparaison avec le pass déjà en bdd
    if (isset($_POST['oldElPasso']) && !empty($_POST['oldElPasso']) && isset($_POST['newPass']) && !empty($_POST['newPass']) && isset($_POST['newPass2']) && !empty($_POST['newPass2'])){
      while($user = $usersList->fetch()){
        if (password_verify($_POST['oldElPasso'], $user['password'])){
          $errorsC['wrongPass'] = '';
          break;
        }
      }
        if($errorsC['wrongPass'] == ''){
            if ($_POST['newPass'] == $_POST['newPass2'] ){
              $password = $_POST['newPass'];
              if (strlen($password)<8){
                $errors['passwordlenght'] = '<p class="erreur">Le nouveau mot de passe choisi est trop court, merci de choisir un mot de passe de 8 caractères minimum.</p>';
              }
              else{
                $new_hashed_pass = password_hash($password, PASSWORD_DEFAULT);
              }
            }
            else {
              $errors['password'] = '<p class="erreur">Les deux mots de passe (nouveau) indiqués sont différents, veuillez les saisir de nouveau.</p>';
            }
          }
        else{
          $errorsC['wrongPass'] = 'Le mot de passe (ancien) est incorrect.';
        }
      }
    else {
      $errors['password'] = '<p class="erreur">Vous n\'avez pas saisi les trois mots de passe.</p>';
      $missingFields[] = "Un ou les deux ou les 3 champs Mots de passe.";
    }
    if(empty($errors)){
      $email=$_SESSION['user_email'];
      $affectedLines = $userManager->editUser($email, $new_hashed_pass);
      if ($affectedLines === false) {
        die('impossible d\'ajouter l\utilisateur');
      } else {
        header('location: index.php?action=user&user_email='.$email);
      }
    }
      else{
        require('view/frontend/inscription.php');
      }
    }


function deleteUser($user){
  $usersManager = new UsersManager();
  $usersList = $usersManager->deleteUser($user);
  require('view/frontend/inscription.php');
}


function passwordReset($email){
  $usersManager = new UsersManager();
  $user = $usersManager->passwordResetMail($email);

}

function checkResetKey($email, $cle)
{
  $usersManager = new UsersManager();
  $usersList = $usersManager->checkResetKey($email, $cle);
}

function resetTheUserPass()
{
  $email = $_SESSION['userValidEmail'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];

  if (isset($_POST['password1']) && !empty($_POST['password1']) && isset($_POST['password2']) && !empty($_POST['password2'])){
    if ($_POST['password1'] == $_POST['password2'] ){
      $password1 = $_POST['password1'];
      if (strlen($password1)<8){
        $errors['passwordlenght'] = '<p class="erreur">Ce mot de passe est trop court, merci de choisir un mot de passe de 8 caractères minimum.</p>';
      }
      if (isset($email) && !empty($email)){
          $hashed_pass = password_hash($password1, PASSWORD_DEFAULT);
          $usersManager = new UsersManager();
          $usersList = $usersManager->updatethePass($email, $hashed_pass);
      }
    }
    else {
      $errors['password'] = '<p class="erreur">Les deux mots de passe indiqués sont différents, veuillez les saisir de nouveau.</p>';
    }
  }
  else {
    $errors['password'] = '<p class="erreur">Vous n\'avez pas saisi les deux mots de passe.</p>';
    $missingFields[] = "Un ou les deux champs Mots de passe.";
  }


}
