<?php
session_start();
require_once "../conf.inc.php";
require "../lib.php";




$connection = dbConnect (); //FROM MUSIC WHERE subtype_name = :subtype_name AND isDeleted = 0");
$query = $connection->prepare("SELECT * FROM MUSIC WHERE  isDeleted = 0");
$query -> execute ([":subtype_name"=> $_POST['param1'] ]);
$result = $query -> fetchAll();



        //FAIRE TABLEAU  $DATA
        foreach ($result as $key => $value) {

        echo "<br>";

        $data = ([
          $key => [
            "music_id" => $result [$key][1];
          ]

        ]);



        }

//var_dump ($data);


$data = [
"music_id"=>$result["music_id"],
  "music_name"=>$result["music_name"],
  "subtype_type"=>$result["subtype_type"],
  "subtype_name"=>$result["subtype_name"],
  "author_comment"=>$result["author_comment"],
  "lyrics"=>$result["lyrics"],
  "music_image"=>$result["music_image"],
  //"pwd"=>$result["pwd"],
  "note_music"=>$result["note_music"],
  "email"=>$result["email"],
  "dateupload"=>$result["dateupload"]
];

//var_dump ($result);






if (isset($_POST['param1']) ){

  $connection = dbConnect (); //FROM MUSIC WHERE subtype_name = :subtype_name AND isDeleted = 0");
  $query = $connection->prepare("SELECT * FROM MUSIC WHERE  isDeleted = 0");
  $query -> execute ([":subtype_name"=> $_POST['param1'] ]);
  $result = $query -> fetch();

  $data = [
  "music_id"=>$result["music_id"],
    "music_name"=>$result["music_name"],
    "subtype_type"=>$result["subtype_type"],
    "subtype_name"=>$result["subtype_name"],
    "author_comment"=>$result["author_comment"],
    "lyrics"=>$result["lyrics"],
    "music_image"=>$result["music_image"],
    //"pwd"=>$result["pwd"],
    "note_music"=>$result["note_music"],
    "email"=>$result["email"],
    "dateupload"=>$result["dateupload"]
  ];
}
else {
  http_response_code(400);
}


echo json_encode($data);



 ?>
