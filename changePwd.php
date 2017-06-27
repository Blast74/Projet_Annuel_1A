<?php
session_start();
require 'navbar.php';
require_once 'admin/classUsers.php';

if (isset($_GET["pseudo"]) && isset($_GET["access_token"]) && isset($_GET["user_informations"])) {

  $user = new User;
  $user->createWithToken($_GET["access_token"]);

  if ($user->id = null) {
    var_dump ($result);
    http_response_code(400);

  }else {

    if($_GET["user_informations"] == 'activate'){


      $userInfo = "activate";

    }elseif($_GET["user_informations" == 'update']){


      $userInfo = "update";

    }else{
      http_response_code(400);
    }

$title = "Validation de compte";

    echo  '<html>
             <head>
               <meta charset="utf-8">
               <title>'.$title.'</title>
             </head>
             <body>';
     echo      '<div "alert alert-danger">';
     if (isset ($_SESSION["form_errors"])){

       foreach ($_SESSION["form_errors"] as $error)
          {
            echo "<li>".$errors[$error];
          }
    }
    echo "</div>";
    echo        '<div class="control-group form-group controls">
                <form class="form-group" action="http://localhost/Projet_Annuel_1A/saveUser.php?user_informations='.$userInfo.'&pseudo='.$_GET["pseudo"].'&access_token='.$_GET["access_token"].'" method="post">
                  <div class= "controls">
                  <p>Changer votre mot de passe :</p>
                  <p>Votre ancien mot de passe :</p>
                  <input type="password" name="old_pwd" value="';

     if (isset($_SESSION["form_post"]["old_pwd"])) {
       echo $_SESSION["form_post"]["old_pwd"];
     }else{
       echo"";
     }

     echo       '">

                  </div>
                  <div class= "controls">
                  <p>Votre nouveau mot de passe :</p>
                  <input type="password" name="pwd" value="';

     if (isset($_SESSION["form_post"]["pwd"])) {
       echo $_SESSION["form_post"]["pwd"];
     }else{
       echo"";
     }

     echo         '">
                  </div>
                  <div>
                  <p>confirmation :</p>
                  <input type="password" name="pwd2" value="';
     if (isset($_SESSION["form_post"]["pwd2"])) {
       echo $_SESSION["form_post"]["pwd2"];
     }else{
       echo"";
     }
     echo         '">
                  </div>


                <div class= "controls">
                <p>Validation :</p>
                <input class="btn btn-primary" type="submit" name="submit" value="Valider">
                </div>

                 </div>
                 <div id="error-validation">
                 </div>
               </form>
             </body>
           </html>';
  }

}else {
  http_response_code(400);
}
  include 'footer.php';
  unset($_SESSION["form_post"]);
  unset($_SESSION["form_errors"]);
  ?>
