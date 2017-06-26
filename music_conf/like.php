<?php
session_start();
require_once "../admin/classUsers.php";
require_once '../lib.php';
require_once "../conf.inc.php";


$verifyUser = getUser ($_SESSION["id"]);



if (!empty ($_SESSION)) {
  $userInfo = getUser ($_SESSION['id']);
}

if (isset ($_POST['title']) &&
    isset ($_POST['author']) &&
    isset($userInfo['email'])
  ) {

    //ID de la musique
    $connection = dbConnect ();
    $query = $connection->prepare("SELECT music_id FROM MUSIC WHERE music_name = :title AND author_pseudo =:author");

    $query -> execute ([":title"=> $_POST['title'],
                        ":author"=> $_POST['author']
                      ]);
    $result = $query -> fetch (PDO::FETCH_ASSOC ); //Nombre de musiques à afficher
    $music_id = intval ($result ["music_id"]);

    $query = $connection->prepare ("INSERT INTO LINKED (email, music_id, is_LINKED) VALUES (?, ? ,1)");
    $query ->  execute([
                $userInfo ["email"],
                $music_id
              ]);


    if ($query->rowCount() != 1) {

        //UPDATE Si un lien existe déjà
        $query = $connection->prepare ("UPDATE LINKED SET is_LINKED = 1 WHERE music_id =? AND email = ? ");
        $query ->  execute([
                    $music_id,
                    $userInfo ["email"]
                  ]);
    }

}
else {
  http_response_code(400);
}













 ?>
