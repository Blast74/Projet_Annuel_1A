<?php

  require_once "../admin/classUsers.php";
  require_once '../lib.php';

    $user = new User;
    $user->createWithToken($_GET["sessionId"]);

    $connection = dbConnect();
    $query = $connection->prepare('SELECT follow FROM FOLLOW WHERE email= ? and email_follower= ?');
    $result1 = $query->execute([$_GET["email"], $user->email]);
    $result2 = $query->fetch(PDO::FETCH_ASSOC);

    if($result1){
      echo ($result2["follow"]);
    }else{
      echo "0";
    }

 ?>
