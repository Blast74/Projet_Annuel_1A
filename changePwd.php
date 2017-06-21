<?php
session_start();
require 'navbar.php';
require 'admin/classUsers.php';

if (isset($_GET["pseudo"]) && isset($_GET["access_token"]) && isset($_GET["user_informations"])) {

  $currentUser = new User;
  $result = $currentUser->createWithToken($_GET["access_token"]);
  if ($result) {

    if($_GET["user_informations"] == 'activate'){

      $userInfo = "activate";

    }elseif($_GET["user_informations" == 'update']){

      $userInfo = "update";

    }else{
      http_response_code(400);
    }



  echo  '<html>
           <head>
             <meta charset="utf-8">
             <title>Validation de compte</title>
           </head>
           <body>'
   echo      '<div class="control-group form-group">';
   if (isset ($_SESSION["form_errors"])){

     foreach ($_SESSION["form_errors"] as $error)
        {
          echo "<li>".$errors[$error];
        }
 }
 echo "</div>";
  echo        '<form action="http://localhost/Projet_Annuel_1A/saveUser.php?&user_informations='.$userInfo.'&pseudo='.$_GET["pseudo"].'&access_token='.$_GET["access_token"].'" method="post">
               <p>Veuillez changer votre mot de passe :</p>
               <p>Votre ancien mot de passe :</p>
               <input type="text" name="old_pwd" value="'.(isset($_SESSION["save_form"]["old_pwd"]))?$_SESSION["save_form"]["old_pwd"]:"").'">
               <p>Votre nouveau mot de passe :</p>
               <input type="text" name="pwd" value="'.(isset($_SESSION["save_form"]["pwd"]))?$_SESSION["save_form"]["pwd"]:"").'">
               <p>confirmation :</p>
               <input type="text" name="pwd2" value="'.(isset($_SESSION["save_form"]["pwd2"]))?$_SESSION["save_form"]["pwd2"]:"").'">
               <p>Validation :</p>
               <input type="submit" name="submit" value="Valider">
               <div id="error-validation">
               </div>
             </form>
           </body>
         </html>';

  }else {
    http_response_code(400);
  }

}else {
  http_response_code(400);
}

  include 'footer.php';
  unset($_SESSION["save_form"]);
  unset($_SESSION["form_errors"]);
  ?>
