<?php
    session_start();
    require "libModOne.php";
    require_once "conf.mod.php";

    if (!empty($_REQUEST)){

      $connection = dbConnect ();
      $query = $connection -> prepare ("SELECT * FROM USERS WHERE email=?");
      $query -> execute ([$_REQUEST["email"]]);
      $result = $query->fetch();

      echo json_encode($result);
      http_response_code(200);
