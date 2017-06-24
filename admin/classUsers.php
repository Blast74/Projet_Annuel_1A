<?php

require_once "libModOne.php";

class User
{
  public $id = "";
  public $email = "";
  public $pseudo = "";
  public $firstname = "";
  public $lastname = "";
  public $birthday = "";
  public $gender = "";
  public $register_date = "";
  public $country = "";
  public $image = "";
  public $update_date = "";
  public $trophy_points = "";
  public $pwd = "";
  public $moderator = "";
  public $access_token = "";
  public $active_account = "";

  //Renvoie les propriétés et leurs valeurs de l'oblet
  public function getPropertiesNames(){
    $result = [];
    foreach ($this as $key => $value) {
      array_push($result, $key);
    }
    return $result;
   }
   //Renvoie les clefs (nom de propriété)
   public function getProperties(){

     $result = [];
     foreach ($this as $key => $value) {
       array_push($result, [$key => $value]);
     }
     return $result;
   }
   //Renvoie les valeurs
  public function getPropertiesValues(){

    $result = [];
    foreach ($this as $key => $value) {
      array_push($result, $value);
    }
    return $result;
  }

  public function verifEmail(){

    return  (!filter_var($user->email, FILTER_VALIDATE_EMAIL));

  }

  public function verifPwd($pwd2){



  }

  public function verifPseudo(){

    $nbCharPseudo = strlen($user->pseudo);
    if($nbCharPseudo < 3 || $nbCharPseudo > 30 ){
        $error = true;
        $listOfErrors[] =1;
    }

  }

  public function createWithToken($access_token)
  {
    $connection = dbConnect ();
    $col = $this->getPropertiesNames();
    $params = implode(',', $col );
    $query = $connection -> prepare ('SELECT '.$params.' FROM USERS WHERE access_token=?');
    $result = $query -> execute([$access_token]);
    $user = $query -> fetch (PDO::FETCH_ASSOC);

<<<<<<< HEAD
    if (!$result) {
        return $result;
    }else{
=======
    if ($result) {
>>>>>>> origin/Dev
      foreach ($user as $key => $value) {
        $this->{$key} = $value;
      }
    }
  }

  public function createWithEmail($email){
    $connection = dbConnect ();
    $col = $this->getPropertiesNames();
    $params = implode(',', $col );
    $query = $connection -> prepare ('SELECT '.$params.' FROM USERS WHERE email=?');
    $result = $query -> execute([$email]);
    $user = $query -> fetch (PDO::FETCH_ASSOC);

<<<<<<< HEAD
    if (!$result) {
        return $result;
    }else{
=======
    if ($result) {
      foreach ($user as $key => $value) {
        $this->{$key} = $value;
      }
    }else{
      return $user;
    }
  }

  public function createWithPseudo ($pseudo){
    $connection = dbConnect ();
    $col = $this->getPropertiesNames();
    $params = implode(',', $col );
    $query = $connection -> prepare ('SELECT '.$params.' FROM USERS WHERE pseudo=?');
    $result = $query -> execute([$pseudo]);
    $user = $query -> fetch (PDO::FETCH_ASSOC);

    if ($result) {
>>>>>>> origin/Dev
      foreach ($user as $key => $value) {
        $this->{$key} = $value;
      }
    }
  }

  public function isMod(){

    return checkMod($this->access_token);

  }

  public function changeToken(){

    $newAccessToken = md5(uniqid().$this->email.time());
    $params = implode(',', $result);
    $connection = dbConnect ();
    $query = $connection -> prepare ("UPDATE USERS SET access_token=? WHERE email= ?;");
    $result = $query -> execute([$newAccessToken, $this->email]);
    if ($result){
      $this->access_token = $newAccessToken;
    }
  }

  public function updateUser($array){

  $result = [];

  foreach ($array as $key => $value) {
    array_push($result, $key."='".$value."'") ;
    $this->{$key} = $value ;
   }
   $params = implode(',', $result);
   $connection = dbConnect ();
   $query = $connection -> prepare ('UPDATE USERS SET '.$params." WHERE access_token='".$this->access_token."';");
   $result = $query -> execute();
   return $result;
  }

  public function changeStatut($param){

    if($param = 1 || $param = 0){
      $connection = dbConnect ();
      $query = $connection -> prepare("UPDATE USERS SET active_account= ? WHERE access_token= ? ;");
      $result = $query->execute([$param, $this->access_token]);
    }
    if ($result){
      $this->active_account = $param ;
    }else{
      return False;
    }
  }


  public function sendMail($subject, $content){
//
// $mail = ('    <!DOCTYPE html>
//     <html>
//       <head>
//         <meta charset="utf-8">
//         <title></title>
//       </head>
//       <body>
//         <div>
//           <h1>Activer votre compte :</h1>
//           <p>Vous venez de créer un compte musique review !</p>
//           <h2>Vos identifiants :</h2>
//           <h3>Login : </h3>
//           <h3>Mot de passe : </h3>
//           <br>
//
//           <input type="button" onclick="parent.location="'.`http://localhost/Projet_Annuel_1A/accountValidation.php?`.'"'.' value="Activer votre Compte">
//
//         </div>
//       </body>
//     </html>');

    return mail($this->mail,$subject, $mail);
  }
}
