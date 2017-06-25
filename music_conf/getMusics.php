<?php
session_start();
require_once "../conf.inc.php";
require "../lib.php";
header ('Content-type:application/json'); //Type de contenu que cette page renvoi




if (isset($_GET['subtype']) && (isset($_GET['currentpage'])) && (isset ($_GET['tabname']))  ){



    //VERIF OFFSET
    if ($_GET['currentpage'] == 1) {
      $offset = 0;
    }else {
      $offset = intval ((($_GET['currentpage']-1)*5));
    }


    if ($_GET['tabname'] == 'top') {
      //Nombre de musiques à afficher
      $connection = dbConnect ();
      $query = $connection->prepare("SELECT COUNT(*) FROM MUSIC WHERE subtype_name = :subtype_name AND isDeleted = 0");
      $query -> execute ([":subtype_name"=> $_GET['subtype'] ]);
      $length = $query -> fetch ();

      $query = $connection->prepare("SELECT music_id, music_name, subtype_type, subtype_name, author_pseudo, note_music,  author_comment, lyrics,
        music_image, note_music, dateupload, upload_music, email FROM MUSIC WHERE subtype_name = :subtype_name AND isDeleted = 0 ORDER BY number_of_votes DESC LIMIT 5 OFFSET ".$offset);
      $query -> execute ([":subtype_name"=> $_GET['subtype']
        ]);

      $result = $query -> fetchAll (PDO::FETCH_ASSOC); // constante retourne un tableau indéxé cf doc

      $result+= ["maxresults" => $length[0]]; //Ajout du nombre de musique total a afficher

      echo json_encode ($result);

    }

    if ($_GET['tabname'] == 'news') {
      $connection = dbConnect ();
      $query = $connection->prepare("SELECT COUNT(*) FROM MUSIC WHERE subtype_name = :subtype_name AND isDeleted = 0");
      $query -> execute ([":subtype_name"=> $_GET['subtype'] ]);
      $length = $query -> fetch ();

      $query = $connection->prepare("SELECT music_id, music_name, subtype_type, subtype_name, author_pseudo, note_music,  author_comment, lyrics,
        music_image, note_music, dateupload, upload_music, email FROM MUSIC WHERE subtype_name = :subtype_name AND isDeleted = 0 ORDER BY dateupload DESC LIMIT 5 OFFSET ".$offset);
      $query -> execute ([":subtype_name"=> $_GET['subtype']
        ]);

      $result = $query -> fetchAll (PDO::FETCH_ASSOC); // constante retourne un tableau indéxé cf doc

      $result+= ["maxresults" => $length[0]]; //Ajout du nombre de musique total a afficher

      echo json_encode ($result);

    }

    if ($_GET['tabname'] == 'suggestion') {
      if (!empty ($_SESSION)) {
        $userInfo = getUser ($_SESSION['id']);

        $connection = dbConnect ();
        $query = $connection->prepare("SELECT * FROM 	MUSIC, FOLLOW where FOLLOW.email_follower = ? AND MUSIC.email = FOLLOW.email AND isDeleted = 0");
        $query -> execute ([$userInfo['email']]);
        $counter1 = $query -> fetchAll (PDO::FETCH_ASSOC);

        $query = $connection->prepare("SELECT * FROM MUSIC, LINKED WHERE LINKED.email = ? AND LINKED.music_id = MUSIC.music_id AND isDeleted = 0");
        $query -> execute ([$userInfo['email']]);
        $counter2 = $query -> fetchAll (PDO::FETCH_ASSOC);

        $length =  count ($counter1);// + count ($counter2);

$followlimit = 5;
$likedlimit = 0;

/*
if (count ($counter1) > count ($counter2) ) {
  $maxPage = $length/$count2;
  if ($offset >= $maxPage) {
    $followlimit = 0;
    $likedlimit = 5;
  }
}else {
  $maxPage = $length/$count1;
  if ($offset >= $maxPage) {
  $followlimit = 5;
  $likedlimit = 0;
  }
}
*/
        $result = [];

        $query = $connection->prepare("SELECT * FROM 	MUSIC, FOLLOW where FOLLOW.email_follower = ? AND MUSIC.email = FOLLOW.email AND isDeleted = 0 LIMIT ".$followlimit." OFFSET ".$offset);
        $query -> execute ([$userInfo['email']]);
        $follows = $query -> fetchAll (PDO::FETCH_ASSOC);

        $query = $connection->prepare("SELECT * FROM MUSIC, LINKED WHERE LINKED.email = ? AND LINKED.music_id = MUSIC.music_id AND isDeleted = 0 LIMIT ".$likedlimit." OFFSET ".$offset);
        $query -> execute ([$userInfo['email']]);
        $liked = $query -> fetchAll (PDO::FETCH_ASSOC);



        $i = 0;
        foreach ($follows as $key => $value) {
          $result [$i] = $follows[$i];
          $i++;
        }
        $j=0;

        foreach ($liked as $key => $value) {
          $result [$i] = $follows[$j];
            $i++;
        }


         $result+= ["maxresults" => $length];


        echo json_encode ($result);
      }
      else {
        http_response_code(400);
      }

    }

  }
  else {
    http_response_code(400);
  }
