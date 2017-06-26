<?php
session_start();
require_once "../conf.inc.php";
require "../lib.php";
header ('Content-type:application/json'); //Type de contenu que cette page renvoi





if (!empty ($_SESSION)) {
  $userInfo = getUser ($_SESSION['id']);
}


if (isset ($_GET['title']) &&
    isset ($_GET['author']) &&
    isset($userInfo['email'])
  ) {

    $connection = dbConnect ();
    $query = $connection->prepare("SELECT music_id FROM MUSIC WHERE music_name = :title AND author_pseudo =:author");

    $query -> execute ([":title"=> $_GET['title'],
                        ":author"=> $_GET['author']
                      ]);
    $result = $query -> fetch (PDO::FETCH_ASSOC ); //Nombre de musiques à afficher
    $music_id = intval ($result ["music_id"]);


    $connection = dbConnect ();
    $query = $connection->prepare("SELECT music_note  FROM LINKED WHERE email= :email AND music_id = :music_id");
    $query -> execute ([":email"=> $userInfo['email'],
                        ":music_id"=> $music_id
                      ]);
    $result = $query -> fetch (PDO::FETCH_ASSOC ); //Nombre de musiques à afficher




    if (($result["music_note"] == false) || ($result["music_note"] == null) ){
      echo json_encode (false);
    }elseif  ($result == true){
    echo json_encode (true);
    }


  }
  else {
    http_response_code(400);
  }






 ?>
