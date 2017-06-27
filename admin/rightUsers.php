<?php
session_start();
  require_once '../lib.php';
  require 'classUsers.php';

  $mod = new User;
  $mod->createWithToken($_POST["access_token"]);
  $user = new User;
  $user->createWithEmail($_POST["user_email"]);
  var_dump($_POST["user_email"]);
  var_dump($user);


  if ($_POST["option"] == "down") {

    switch ($mod->isMod()[1]) {

      case 'User':
        http_response_code(401);
      break;

      case 'Moderator':

        if ($user->moderator == 2 && $user->access_token == $mod->access_token) {
          $user->updateUser(["moderator" => 1]);
          echo $user->firstname.' '.$user->lastname.' a vu ses droits Moderator retirés :/';
        }
         break;
      case 'Supermoderator':

        if ($user->moderator == 2) {
          $user->updateUser(["moderator" => 1]);
          echo $user->firstname.' '.$user->lastname.' a vu ses droits Moderator retirés :/';

        }if ($user->moderator == 3 && $user->access_token == $mod->access_token) {
          $user->updateUser(["moderator" => 2]);
          echo $user->firstname.' '.$user->lastname.' a vu ses droits Supermoderator retirés :/';
        }
        break;

      case 'Error':

      http_response_code(402);
        break;

      default:

      http_response_code(403);
        break;
    }

  }if ($_REQUEST["option"] == "up" && $mod->isMod()[1] == "Supermoderator") {

        if ($user->moderator == 2) {

          $user->updateUser(["moderator" => 3]);
          echo $user->firstname.' '.$user->lastname.' a vu ses droits Moderator augmentés :)';
        }
        if ($user->moderator == 1) {

          $user->updateUser(["moderator" => 2]);
          echo $user->firstname.' '.$user->lastname.' a vu ses droits User augmentés :)';
        }
  }else {
        http_response_code(404);
  }
  // if ($user->isMod()[1] != "Error") {
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
