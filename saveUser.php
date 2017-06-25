<?php
session_start();
require_once "conf.inc.php";
require_once 'lib.php';
require 'admin/classUsers.php';

$error = false;
$listOfErrors = [];

if(isset($_POST["modifEmail"]) && isset($_GET["token"])){
  $user = New User;
  $user->createWithEmail($_POST["modifEmail"]);
  $currentUser = New User;
  $currentUser->createWithEmail($GET["token"]);
  if ($user->access_token == $user->access_token) {
    $right = TRUE;
  }else{
    $right = FALSE;
  }
  if($user->isMod()[2] < $currentUser->isMod()[2] ){
    $right = TRUE;
  }else{
    $right = FALSE;
  }

}


if ($_GET["user_informations"] == "create"){
  if(!empty($_POST["firstname"]) &&
    !empty($_POST["lastname"]) &&
    !empty($_POST["pseudo"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["birthday"]) &&
    !empty($_POST["gender"]) &&
    !empty($_POST["country"]) &&
    count($_POST) >= 7) {

    $_POST["firstname"] = trim($_POST["firstname"]);
    $_POST["lastname"] = trim($_POST["lastname"]);
    $_POST["pseudo"] = trim($_POST["pseudo"]);
    $_POST["email"] = trim($_POST["email"]);

    //Pseudo : entre 3 et 30
    $nbCharPseudo = strlen($_POST["pseudo"]);
    if($nbCharPseudo < 3 || $nbCharPseudo > 30 ){
        $error = true;
        $listOfErrors[] =1;
    }
    //email
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  { //&& !empty($_POST["email"])){
        $error = true;
        $listOfErrors[] =2;
    }
    //Date de naissance
    $explodeArray = explode("-", $_POST["birthday"]);

    $time120 = time()- (120*31536000);
    $time10 = time()- (10*31536000);
    $timeBirthday = strtotime($_POST["birthday"]);
    //année - mois - jours
    if( count($explodeArray)!=3 ||
        !is_numeric($explodeArray[0]) || !is_numeric($explodeArray[1]) || !is_numeric($explodeArray[2]) ||
        !checkdate($explodeArray[1], $explodeArray[2], $explodeArray[0]) || //checkdate vérifie si la date existe (mois-jour-année)
        $time120>$timeBirthday || $time10<$timeBirthday){

            $error = true;
        $listOfErrors[] =5;
    }
    //Genre -doit éxister dans le tableau-
    if( !array_key_exists($_POST["gender"], $listOfGender) ){
        $error = true;
        $listOfErrors[] =6;
    }
    //Pays
    if( !array_key_exists($_POST["country"], $listOfCountry) ){ //vérifie si une clé existe dans un tableau
        $error = true;
        $listOfErrors[] =7;
    }

    //Connexion à la BDD s'il n'y pas d'erreurs et dernières vérifications
    if (!$error) {
        //Vérifie si le mail est déjà dans la BDD
        $connection = dbConnect ();
        $query = $connection->prepare("SELECT email FROM USERS where email=:email");
        $id = $po; // condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
        $query -> execute (["email"=>$_POST["email"]]);
        $result = $query -> fetch(); //fetch retourne le 1er enregistrement
        if (!empty ($result)) {
            $error = true;
            $listOfErrors [] = 9;
        }
        //Vérifie si le pseudo existe dans la BBD
        $query = $connection->prepare("SELECT email FROM USERS WHERE pseudo=:pseudo");
        $query -> execute (["pseudo"=>$_POST["pseudo"]] );
        $result = $query -> fetch();
        if (!empty ($result)){
            $error = true;
            $listOfErrors [] = 10;
        }
    }
    //redirection sur inscription.php s'il y a des erreurs
    if($error){
        errors ($_POST, $listOfErrors); //Fonction qui affiche les erreurs s'il y en a !
    }else{  //enregistrement du formulaire dans la BDD

        $pwd = uniqid();
        var_dump($pwd);
        $accessToken = md5(uniqid().$_POST["email"].time());
        $contentMail = registerMailContent($_POST["pseudo"], $accessToken, $pwd);
        $headers = mailHeaderHtml();
        //Envoie d'un mail pour activer le compte
        $statusMail = mail($_POST['email'], "Activation de compte", $contentMail, $headers);

        if($statusMail)  {

        $connection = dbConnect();
        $querry = $connection -> prepare("INSERT INTO USERS (email, pseudo, gender, firstname, lastname, birthday, register_date, country, pwd, access_token, active_account) VALUES (:email, :pseudo, :gender, :firstname, :lastname, :birthday, :register_date, :country, :pwd, :access_token, :active_account)");

        $pwd = password_hash ($pwd, PASSWORD_DEFAULT);
        $active_account = 0;


        $querry -> execute([     // la ou il y a   :pseudo;, on met la valeur de $_POST["pseudo"]
            "email" => $_POST["email"],
            "pseudo" => $_POST["pseudo"],
            "gender" => $_POST["gender"],
            "firstname" => $_POST["firstname"],
            "lastname" => $_POST["lastname"],
            "birthday" => $_POST["birthday"],
            "register_date" => $_POST["birthday"], //A CHANGER
            "country" => $_POST["country"],
            "pwd" => $pwd,
            "access_token" => $accessToken,
            "active_account" => $active_account
            ]);
                // var_dump(get_defined_vars());
        //IL FAUT SE CONNECTER AUTOMATIQUEMENT APRES L'INSCRIPTION //REDIRECTION SUR CONNECT.PHP
        $_SESSION["inscription"] = "Email";
        header('Location: index.php');
        die();

        }else {
            $error = true;
            $listOfErrors[] =2;
            $_SESSION["form_post"] = $_POST;
            $_SESSION["form_errors"] = $listOfErrors;
            $_SESSION["inscription"] = "notEmail";
            header('location: inscription.php');
            die();
        }
    }
  }else{
      echo "Bien essayé !";
      die();
  }
}

if ($_GET["user_informations"] == "activate"){
  $user = new User;
  $user->createWithToken($_GET["access_token"]);
  if ($user->id != null) {
    if (!(password_verify ($_POST["old_pwd"], $user->pwd))) {
        $error = true;
        $listOfErrors[] =21;
    }

    $nbCharPwd = strlen($_POST["pwd"]);
    if($nbCharPwd < 8 || $nbCharPwd > 16 ){
        $error = true;
        $listOfErrors[] =3;
    }
    //Confirmation du mot de passe
    if($_POST["pwd"] != $_POST["pwd2"]){
        $error = true;
        $listOfErrors[] =4;
    }
    if (!$error){

        $pwd = password_hash ($_POST["pwd"], PASSWORD_DEFAULT);
        $user->updateUser(["pwd" => $pwd]);
        $user->changeStatut(1);
        $content = mailPwdChanged($user->pseudo, $_POST["pwd"]);
        $headers = mailHeaderHtml();
        mail($user->email, "Identifiant changés", $content, $headers);
        echo 'test';
        $_SESSION["inscription"] = "OK";
        header('Location: index.php');
        die();

    }else{
        $_SESSION["form_post"] = $_POST;
        $_SESSION["form_errors"] = $listOfErrors;
        var_dump(get_defined_vars());
        var_dump(!(password_verify ($_POST["old_pwd"], $user->pwd)));
        var_dump($user->pwd);
        var_dump($_POST["old_pwd"]);

         header('location: changePwd.php?user_informations=activate&pseudo='.$_GET["pseudo"].'&access_token='.$_GET["access_token"]);
         die();
    }
  }else{
      http_response_code(400);
  }
}
