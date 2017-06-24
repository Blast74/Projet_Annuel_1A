<?php
  require_once "../admin/classUsers.php";
  require_once '../lib.php';

  $user = new User;
  $follower = new User;

  $follower->createWithToken($_POST["sessionId"]);
  $user->createWithEmail($_POST["follow"]);
  $followValue = $_POST["value"];

    $params = [$followValue, $user->email, $follower->email];
    $connection = dbConnect();
    $query = $connection->prepare('INSERT INTO FOLLOW (follow, email,	email_follower) VALUES (?, ?, ?)');
    $result = $query-> execute($params);
    if (!$result) {
      $connection = dbConnect();
      $query = $connection->prepare('UPDATE FOLLOW SET follow=? WHERE email=? and email_follower=?');
      $result = $query-> execute($params);
    }

  if ($result) {
    echo $followValue;
  }else{
    $result;
  }
   var_dump(get_defined_vars());


 ?>
