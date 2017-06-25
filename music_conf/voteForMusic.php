<?php
session_start();
require_once "../conf.inc.php";
require "../lib.php";
header ('Content-type:application/json'); //Type de contenu que cette page renvoi


if (!empty ($_SESSION)) {
  $userInfo = getUser ($_SESSION['id']);
}


if (isset ($_POST['title']) &&
    isset ($_POST['author']) &&
    isset($userInfo['email']) &&
    isset ($_POST['note']) &&
    ($_POST['note'] >= 0 ) &&
    ($_POST['note'] <= 5 )
  ) {

        //ID de la musique
        $connection = dbConnect ();
        $query = $connection->prepare("SELECT music_id FROM MUSIC WHERE music_name = :title AND author_pseudo =:author");

        $query -> execute ([":title"=> $_POST['title'],
                            ":author"=> $_POST['author']
                          ]);
        $result = $query -> fetch (PDO::FETCH_ASSOC ); //Nombre de musiques à afficher
        $music_id = intval ($result ["music_id"]);


        //Mise en place du lien entre l'utilisateur et la musique
        if (is_int ($music_id)){
          $query = $connection->prepare ("INSERT INTO LINKED (email, music_id, music_note) VALUES (?,?,?)");
          $query ->  execute([
                      $userInfo['email'],
                      $music_id,
                      $_POST ['note']
                    ]);
          if ($query->rowCount() != 1) {

              //UPDATE Si un lien existe déjà
              $query = $connection->prepare ("UPDATE LINKED SET music_note = ? WHERE music_id =? AND email = ? ");
              $query ->  execute([
                          $_POST ['note'],
                          $music_id,
                          $userInfo ["email"]
                        ]);
          }


          //On récupère la moyenne de la musique
          $query = $connection->prepare("SELECT ROUND (AVG (music_note)) AS 'average' FROM LINKED, MUSIC WHERE  LINKED.music_id = MUSIC.music_id AND MUSIC.music_id =?");
          $query ->  execute([$music_id]);
          $result = $query -> fetch (PDO::FETCH_ASSOC );




          //On met la moyenne dans la table MusicSubtypeList
          $query = $connection->prepare("UPDATE MUSIC SET  note_music =?, number_of_votes = ( number_of_votes +1) WHERE music_id = ?");
          $query ->  execute([
                     $result ["average"],
                      $music_id
                    ]);



          }

echo json_encode ($result["average"]);

} else {
  http_response_code(400);
}






 ?>
