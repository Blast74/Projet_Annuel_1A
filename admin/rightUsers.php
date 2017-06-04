<?php
session_start();
  require_once '../lib.php';
  require 'libSQL.php';
  require 'libCountPage.php';
  require 'libModOne.php';

  $checkMod = checkMod($_REQUEST["access_token"]);
  $connection = dbConnect ();
  $query = $connection -> prepare ("SELECT moderator FROM USERS WHERE email =:email");
  $query -> execute(["email"=>$Request["email"]]);
  $users = $query -> fetch ();

  if ($_REQUEST["option"] == "down") {

    switch ($checkMod[1]) {

      case 'User':
        echo "<h4>Bien mais essaie encore :)</h4>";
      }break;

      case 'Moderator':

        if ($user["moderator"] == 1 && $user['access_token'] == $_REQUEST["access_token"]) {
          $query = $connection->prepare("UPDATE USERS SET moderator = 0  WHERE email=:email;");
        	$query -> execute (["email"=>$Request["email"]]);
          echo $users["firstname"].' '.$users["lastname"].' a vu ses droits '.$checkMod[1].' retirés :/';
        } break;

      case 'Supermoderator':

        if ($user["moderator"] == 1) {

          $query = $connection->prepare("UPDATE USERS SET moderator = 0  WHERE email=:email;");
        	$query -> execute (["email"=>$Request["email"]]);
          echo $users["firstname"].' '.$users["lastname"].' a vu ses droits '.$checkMod[1].' retirés :/';

        }if ($user["moderator"] == 2 && $user['access_token'] == $_REQUEST["access_token"]) {

          $query = $connection->prepare("UPDATE USERS SET moderator = 1  WHERE email=:email;");
          $query -> execute (["email"=>$Request["email"]]);
          echo $users["firstname"].' '.$users["lastname"].' a vu ses droits '.$checkMod[1].' retirés :/';
        }
        break;

      case 'Error':

        echo "<h4>Bien mais essaie encore :)</h4>";
        break;

      default:

        echo "<h4>Bien mais essaie encore :)</h4>";
        break;
    }

  }if ($_REQUEST["option"] == "up" && $checkMod == "Supermoderator") {

        if ($user["moderator"] == 1) {

          $query = $connection->prepare("UPDATE USERS SET moderator = 2  WHERE email=:email;");
          $query -> execute (["email"=>$Request["email"]]);
          echo $users["firstname"].' '.$users["lastname"].' a vu ses droits '.$checkMod[1].' augmentés :)';

        if ($user["moderator"] == 0) {

          $query = $connection->prepare("UPDATE USERS SET moderator = 1  WHERE email=:email;");
          $query -> execute (["email"=>$Request["email"]]);
          echo $users["firstname"].' '.$users["lastname"].' a vu ses droits '.$checkMod[1].' augmentés :)';

  }else {
        echo "<h4>Bien mais essaie encore :)</h4>";
  }
  // if ($checkMod[1] != "Error") {
  //   $connection = dbConnect ();
  //   $query = $connection -> prepare ("SELECT moderator FROM USERS WHERE email =:email");
  //   $query -> execute(["email"=>$Request["email"]]);
  //   $users = $query -> fetch ();
  //   if ($user["moderator"] == 1) {
  //     $query = $connection->prepare("UPDATE USERS SET moderator = 0  WHERE email=:email;");
  // 		$query -> execute (["email"=>$Request["email"]]);
  //   }
  //   if ($user["moderator"] == 2) {
  //     $query = $connection->prepare("UPDATE USERS SET moderator = 1  WHERE email=:email;");
  //     $query -> execute (["email"=>$Request["email"]]);
  //   }else{
  //     echo "Impossible de modifier les droits";
  //   }
  //
  //
  // }else {
  //   echo "<h4>Bien mais essaie encore :)</h4>";
  // }
  //

 ?>
