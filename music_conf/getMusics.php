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
        $query = $connection->prepare("SELECT * FROM 	MUSIC, FOLLOW where FOLLOW.email_follower = ?  AND MUSIC.subtype_name = ? AND MUSIC.email = FOLLOW.email  AND FOLLOW.follow =1 AND isDeleted = 0 ");
        $query -> execute ([$userInfo['email'],$_GET['subtype'] ]);
        $length = count ($query -> fetchAll (PDO::FETCH_ASSOC));



        $query = $connection->prepare("SELECT * FROM 	MUSIC, FOLLOW where FOLLOW.email_follower = ?  AND MUSIC.subtype_name = ? AND MUSIC.email = FOLLOW.email  AND FOLLOW.follow =1 AND isDeleted = 0 LIMIT 5 OFFSET ".$offset);
        $query -> execute ([$userInfo['email'], $_GET['subtype'] ]);
        $result = $follows = $query -> fetchAll (PDO::FETCH_ASSOC);

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
