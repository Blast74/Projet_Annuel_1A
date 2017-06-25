<?php
session_start();
require_once "../admin/classUsers.php";
require_once '../lib.php';
require_once "../conf.inc.php";


if (!empty ($_SESSION)) {
  $userInfo = getUser ($_SESSION['id']);
  $author = new User;
  $author -> createWithPseudo ($_GET ["author"]);
}


if (!empty ($author -> email) &&  !empty ($userInfo["email"]) ){


 $connection = dbConnect ();
 $query = $connection->prepare("SELECT *  FROM FOLLOW WHERE email= :email AND email_follower = :follower AND follow != 0");
 $query -> execute ([":email"=> $author -> email,
                     ":follower"=> $userInfo["email"]
                   ]);
 $result = $query -> fetch (PDO::FETCH_ASSOC ); //Nombre de musiques à afficher

if ($result) {
  echo json_encode (true);
}else {
  echo json_encode ($result);
}


}
else {
    http_response_code(400);
}



?>
