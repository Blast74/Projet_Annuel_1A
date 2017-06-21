<?php
session_start();
require_once "conf.inc.php";
require_once 'lib.php';
require 'admin/classUsers.php';

$error = false;
$listOfErrors = [];


switch ($_GET["user_informations"]) {
    case 'update': //MODIFICATION D'UTILISATEUR PAR UN MODERATEUR
        echo 'cas update :';
        echo 'mod     ';
        var_dump($_POST);

        echo "<br>";
        echo "<br>";
        echo "<br>";
        var_dump (count ($_POST)) ;
        //if (count ($_POST)

        break;

    case 'create'://CREATION D'UN UTILISATEUR

        if(!empty($_POST["firstname"]) &&
        !empty($_POST["lastname"]) &&
        !empty($_POST["pseudo"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["birthday"]) &&
        !empty($_POST["gender"]) &&
        !empty($_POST["country"]) &&
        count($_POST) == 7) {
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
            /*
            //CAPTACHA A FAIRE
            if($_POST["captcha"] != $_SESSION ["captcha"]){
                $error = true; //SESSION:
                $listOfErrors[] =8;
            }
            */

            //Connexion à la BDD s'il n'y pas d'erreurs et dernières vérifications
            if (!$error) {
                //Vérifie si le mail est déjà dans la BDD
                $connection = dbConnect ();
                $query = $connection->prepare("SELECT user_id FROM USERS where email=:email AND user_id != :id;");
                $id = (empty($_GET["user_id"]))?-1: $_GET["user_id"]; // condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
                $query -> execute (["email"=>$_POST["email"], "id"=>$id]);
                $result = $query -> fetch(); //fetch retourne le 1er enregistrement
                if (!empty ($result)) {
                    $error = true;
                    $listOfErrors [] = 9;
                }
                //Vérifie si le pseudo existe dans la BBD
                $query = $connection->prepare("SELECT user_id FROM USERS WHERE pseudo=:pseudo AND user_id !=:id;");
                $query -> execute (["pseudo"=>$_POST["pseudo"], "id"=>$id] );
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
                $accessToken = md5(uniqid().$_POST["email"].time());
                $contentMail = registerMailContent($_POST["pseudo"], $accessToken, $pwd);
                $headers = mailHeaderHtml();
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
                //IL FAUT SE CONNECTER AUTOMATIQUEMENT APRES L'INSCRIPTION //REDIRECTION SUR CONNECT.PHP
                header("Location: index.php");
                die();

                }else {
                    $error = true;
                    $listOfErrors[] =2;
                    errors ($_POST, $listOfErrors);
                }
            }
        }
        else{
            echo "Bien essayé !";
            die();
        }
    break;

    case 'activate':

    if (password_verify ($_POST["old_pwd"], $user->pwd)) {
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
      $user = new User;
      $user->createWithToken($_GET["access_token"]);
      $pwd = password_hash ($_POST["pwd"], PASSWORD_DEFAULT);
      $user->updateUser(["pwd" => $pwd]);
      $user->changeStatut(1);
      $content = mailPwdChanged($user->pseudo, $_POST["pwd"]);
      mail($user->email, "Identifiant changés", $content);
      header("Location: index.php");
      die();
    }else{
      $_SESSION["save_form"] = $_POST;
      $_SESSION["form_errors"] = $listOfErrors;
      header('"location: "http://localhost/Projet_Annuel_1A/changePwd.php?&user_informations=activate&pseudo='.$_GET["pseudo"].'&access_token='.$_GET["access_token"].'"');

  }

    break;

    default:
    var_dump($_GET["user_informations"]);
    echo 'pb $_POST';
    break;
}
