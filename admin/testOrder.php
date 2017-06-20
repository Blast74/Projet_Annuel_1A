<?php
  session_start();
  require "..\lib.php";
  require "libSQL.php";
  require "conf.mod.php";
  require 'libModOne.php';

  // header('Content-type: application/JSON');

    $idSession = $_GET["access_token"];
    $checkMod = checkMod($idSession);
    if ($checkMod[1] != "Error") {


        $connection = dbConnect ();
        $query = $connection -> prepare ('SELECT pseudo, firstname, lastname, email, birthday, gender,country,active_account FROM USERS');
        $query -> execute();
        $users = $query -> fetchAll (PDO::FETCH_ASSOC);


        echo (json_encode($users));

    } else {
      http_response_code(403);
      echo json_encode($checkMod );
      echo json_encode($_POST["access_token"]);
    }
