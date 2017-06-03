<?php
require "../lib.php";

$request = $_POST["access_token"];

$connection = dbConnect();
      $query = $connection->prepare("SELECT * FROM USERS where access_token=:access_token;");
      $query -> execute (["access_token" => $request]);
      $result = $query->fetch();

print_r($result);



 ?>
