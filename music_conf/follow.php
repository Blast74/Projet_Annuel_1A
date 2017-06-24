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


  //email = La personne qu'un utilisateur souhaite suivre
  $connection = dbConnect ();
  $query = $connection->prepare ("INSERT INTO FOLLOW (follow, email, email_follower) VALUES (1, ? ,?)");
  $query ->  execute([
              $author -> email,
              $userInfo['email']
            ]);

}
else {
  http_response_code(400);
}




 ?>
