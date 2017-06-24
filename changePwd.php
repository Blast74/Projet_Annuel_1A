<?php
session_start();
require 'navbar.php';
require 'admin/classUsers.php';

if (isset($_GET["pseudo"]) && isset($_GET["access_token"]) && isset($_GET["user_informations"])) {
  echo 'Test 1';
  $user = new User;
  $user->createWithToken($_GET["access_token"]);

  if ($user->id = null) {
    var_dump ($result);
    http_response_code(400);

  }else {

    if($_GET["user_informations"] == 'activate'){
      echo 'Test 3';

      $userInfo = "activate";

    }elseif($_GET["user_informations" == 'update']){
      echo 'Test 4';

      $userInfo = "update";

    }else{
      http_response_code(400);
    }



    echo  '<html>
             <head>
               <meta charset="utf-8">
               <title>Validation de compte</title>
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
    echo        '<form action="http://localhost/Projet_Annuel_1A/saveUser.php?user_informations='.$userInfo.'&pseudo='.$_GET["pseudo"].'&access_token='.$_GET["access_token"].'" method="post">
                 <p>Veuillez changer votre mot de passe :</p>
                 <p>Votre ancien mot de passe :</p>
                 <input type="password" name="old_pwd" value="';

    if (isset($_SESSION["form_post"]["old_pwd"])) {
      echo $_SESSION["form_post"]["old_pwd"];
    }else{
      echo"";
    }

    echo       '">
                 <p>Votre nouveau mot de passe :</p>
                 <input type="password" name="pwd" value="';

    if (isset($_SESSION["form_post"]["pwd"])) {
      echo $_SESSION["form_post"]["pwd"];
    }else{
      echo"";
    }

    echo         '">
                 <p>confirmation :</p>
                 <input type="password" name="pwd2" value="';

    if (isset($_SESSION["form_post"]["pwd2"])) {
      echo $_SESSION["form_post"]["pwd2"];
    }else{
      echo"";
    }

    echo         '">
                 <p>Validation :</p>
                 <input type="submit" name="submit" value="Valider">
                 <div id="error-validation">
                 </div>
               </form>
             </body>
           </html>';
  }

}else {
  http_response_code(400);
}
var_dump(get_defined_vars());
  include 'footer.php';
  unset($_SESSION["form_post"]);
  unset($_SESSION["form_errors"]);
  ?>
