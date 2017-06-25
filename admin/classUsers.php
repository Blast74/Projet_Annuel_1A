<?php

// require ("/lib.php");

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

  const CHECKMODERATOR = [1, "Moderator",2];
  const CHECKSUPERMODERATOR = [1, "Supermoderator", 3];
  const CHECKUSER = [0, "User", 1];
  const CHECKERROR = [0, "Error", 0];

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

  public function changePwd($newPwd){

    $nbCharPwd = strlen($_POST["pwd"]);
    if($nbCharPwd < 8 || $nbCharPwd > 16 ){
        $error = true;
        $listOfErrors[] =3;
        $result = [$err];
    }

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


    if (!$result) {
        return $result;
    }else{

      if ($result) {

        foreach ($user as $key => $value) {
          $this->{$key} = $value;
        }
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

    if (!$result) {
        return $result;
    }else{

      if ($result) {
        foreach ($user as $key => $value) {
          $this->{$key} = $value;
        }
      }
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

      foreach ($user as $key => $value) {
        $this->{$key} = $value;
      }
    }
  }

  public function isMod(){

      if (!empty($this->access_token)) {

        $connection = dbConnect();
        $query = $connection->prepare("SELECT * FROM USERS where access_token=:access_token");
        $query -> execute (["access_token" => $this->access_token]);
        $result = $query->fetch();

          switch ($result["moderator"]) {

            case 1:
              return self::CHECKUSER;
              break;
            case 2:
              return self::CHECKMODERATOR;
              break;
            case 3:
              return self::CHECKSUPERMODERATOR;
              break;
             default:
               return self::CHECKERROR;
               break;
          }

      }else {
        return self::CHECKERROR;
      }
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
    return mail($this->mail,$subject, $mail);
  }
}
