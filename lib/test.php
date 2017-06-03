<?php
session_start();
require "../lib.php";


$connection = dbConnect();
      $query = $connection->prepare("SELECT * FROM USERS where access_token=:access_token");
  //  $name = (empty($_GET["user_id"]))?-1: $_GET["user_id"];  condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
      $query -> execute(["access_token"=>$_SESSION["id"]]);
      $result = $query->fetch();

      //var_dump($_SESSION["id"]);
      var_dump($result);
      //var_dump(get_defined_vars());






 ?>
