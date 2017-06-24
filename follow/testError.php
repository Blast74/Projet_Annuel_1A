<?php

  session_start();

  require_once "../admin/classUsers.php";
  require_once '../lib.php';

  $follower = new User;

  $follower->createWithToken($_SESSION["id"]."I");

  var_dump($follower->id);


 ?>
