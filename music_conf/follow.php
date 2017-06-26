<?php
session_start();
require_once "../admin/classUsers.php";
require_once '../lib.php';
require_once "../conf.inc.php";


$verifyUser = getUser ($_SESSION["id"]);

if (!empty ($_SESSION)) {
  $userInfo = getUser ($_SESSION['id']);
  $author = new User;
  $author -> createWithPseudo ($_POST["author"]);

}

if (isset ($_POST["author"]) &&  !empty ($userInfo) && !empty ($author -> email) ) {



  $connection = dbConnect ();
  $query = $connection->prepare ("UPDATE FOLLOW SET follow = 1 WHERE email =? AND email_follower = ? ");
  $query ->  execute([
             $author -> email,
              $userInfo ["email"]
            ]);
    $insert = $query->rowCount();

  if ($insert == 0) {
    $connection = dbConnect ();
    $query = $connection->prepare ("INSERT INTO FOLLOW (follow, email, email_follower) VALUES (1, ? ,?)");
    $query ->  execute([
                $author -> email,
                $userInfo['email']
              ]);

  }

echo json_encode ($query->rowCount());

}
else {
  http_response_code(400);
}




 ?>
