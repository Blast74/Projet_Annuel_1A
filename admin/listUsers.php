<?php
  session_start();
  require "../lib.php";
  require "libSQL.php";
  require "classUsers.php";

  // header('Content-type: application/JSON');

  $moderator = new User;
  $moderator->createWithToken($_GET["access_token"]);
    if ($moderator->isMod()[1] != "Error") {


        $connection = dbConnect ();
        $query = $connection -> prepare ('SELECT pseudo, firstname, lastname, email, birthday, gender,country,active_account, moderator FROM USERS');
        $query -> execute();
        $users = $query -> fetchAll (PDO::FETCH_ASSOC);

        // foreach ($users as $key => $user) {
        //   foreach ($user as $key => $value) {
        //     switch ($key) {
        //       case 'pseudo':
        //         # code...
        //         break;
        //       case 'firstname':
        //         # code...
        //         break;
        //       case 'lastname':
        //         # code...
        //         break;
        //       case 'email':
        //         # code...
        //         break;
        //       case 'birth':
        //         # code...
        //         break;
        //       case 'pseudo':
        //         # code...
        //         break;
        //       case 'pseudo':
        //         # code...
        //         break;
        //       case 'pseudo':
        //         # code...
        //         break;
        //
        //       default:
        //         # code...
        //         break;
        //     }
        //   }
        // }
        echo (json_encode($users));

    } else {
      http_response_code(403);
      // echo json_encode($moderator->isMod());
      // echo json_encode($_POST["access_token"]);
    }
