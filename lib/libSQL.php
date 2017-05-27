<?php
function checkModerateur(){
  if (!empty($_SESSION["id"])) {

    $connection = dbConnect ();
          $query = $connection->prepare("SELECT moderator FROM USERS where access_token=:access_token;");
      //  $name = (empty($_GET["user_id"]))?-1: $_GET["user_id"];  condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
          $result = $query -> execute (["access_token"=>$_SESSION["id"]]);

    if ($result["moderator"] == 1) {

    return $true;

    }else {
    return $false;
    }
  }else {
    return $false;
  }
}
function checkSuperModerateur(){
  if (!empty($_SESSION["id"])) {

    $connection = dbConnect ();
          $query = $connection->prepare("SELECT moderator FROM USERS where access_token=:access_token;");
      //  $name = (empty($_GET["user_id"]))?-1: $_GET["user_id"];  condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
          $result = $query -> execute (["access_token"=>$_SESSION["id"]]);

    if ($result["moderator"] == 2) {

    return $true;

    }else {
    return $false;
    }
  }else {
    return $false;
  }
}








 ?>
