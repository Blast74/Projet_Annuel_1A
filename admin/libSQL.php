<?php
function checkModerator($idSession){
  if (!empty($idSession)) {

    $connection = dbConnect();
          $query = $connection->prepare("SELECT * FROM USERS where access_token=:access_token;");
      //  $name = (empty($_GET["user_id"]))?-1: $_GET["user_id"];  condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
          $query -> execute (["access_token" => $idSession]);
          $result = $query->fetch();
    if ($result["moderator"] == 1) {

    return TRUE;

    }else {
    return FALSE;
    }
  }else {
    return FALSE;
  }
}
function checkSuperModerator($idSession){
  if (!empty($idSession)) {

    $connection = dbConnect();
          $query = $connection->prepare("SELECT * FROM USERS where access_token=:access_token;");
      //  $name = (empty($_GET["user_id"]))?-1: $_GET["user_id"];  condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
          $query -> execute (["access_token"=>$idSession]);
          $result = $query->fetch();
    if ($result["moderator"] == 2) {

    return TRUE;

    }else {
    return FALSE;
    }
  }else {
    return FALSE;
  }
}








 ?>
