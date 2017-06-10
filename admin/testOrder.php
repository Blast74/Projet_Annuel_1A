<?php
  session_start();
  require "..\lib.php";
  require "libSQL.php";
  require "conf.mod.php";
  require 'libModOne.php';

    $idSession = $_REQUEST["access_token"];
    $checkMod = checkMod($idSession);
    if ($checkMod[1] != "Error") {
      $coltable = $_POST["orderBy"];
      $order = $_POST["order"];
      $nbUsersByPage = $_POST["byPage"];
      $usersPageIndex = 0 ;

      if (in_array($coltable, $listPropertyUsers) && ($order == "ASC" || $order == "DESC")) {

        $connection = dbConnect ();
        $query = $connection -> prepare ('SELECT * FROM USERS WHERE active_account !=0 ORDER BY '.$coltable.' '.$order);
        $query -> execute();
        $users = $query -> fetchAll ();

        $result = array_slice($users, $usersPageIndex, $nbUsersByPage);


        foreach ($result as $key1 => $user) {
          foreach ($user as $key2 => $value) {

            if (in_array($key2, $listElementSecretKeys)) {

              $result[$key1][$key2] = "";

            }

          }

        }

        echo (json_encode($result));

      } else {
        http_response_code(400);
        var_dump (get_defined_vars());
      }
    } else {
      http_response_code(403);
      echo json_encode($_POST["access_token"]);
    }
