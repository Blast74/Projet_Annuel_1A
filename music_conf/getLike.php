<?php
session_start();
require_once "../admin/classUsers.php";
require_once '../lib.php';
require_once "../conf.inc.php";


if (!empty ($_SESSION)) {
  $userInfo = getUser ($_SESSION['id']);
}



if (isset ($_GET['music_id']) &&
    isset($userInfo['email'])
  ) {


 $connection = dbConnect ();
 $query = $connection->prepare("SELECT *  FROM LINKED WHERE email= :email AND music_id = :music_id AND is_LINKED = 1");
 $query -> execute ([":email"=> $userInfo['email'],
                     ":music_id"=> $_GET['music_id']
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
