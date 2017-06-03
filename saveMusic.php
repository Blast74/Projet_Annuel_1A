<<<<<<< HEAD
<?php
session_start();
require "conf.inc.php";
require "lib.php";

//fonction id ();
//vérification
//nom musique + id user
//

$verifyUser = getUser ($_SESSION["id"]);

if ($verifyUser == false){ //Si le token ne correspond pas à celui de l'utilisateur en BDD
  header("Location: disconnect.php");
  die ();
}

$imageFilesAuthorized = ["png", "jpg", "jpeg"];

define("MUSIC_DIR_PATH", "./musics");
define("MUSIC_IMAGE_DIR_PATH", "./music_images");
//$authorizedFormat = mp3;
$error = false;
$listOfErrors = [];

if (!file_exists(MUSIC_DIR_PATH)){ //Dossier musiques
  mkdir(MUSIC_DIR_PATH); //créer le dossier s'il n'existe pas
}
if (!file_exists(MUSIC_IMAGE_DIR_PATH)){ //Dossier d'image des musiques
  mkdir(MUSIC_IMAGE_DIR_PATH);
}


if( isset($_POST["titre"]) &&
    isset($_POST["genre"]) &&
    isset($_FILES ["music"]) &&
    count($_POST) == 5 ){
        $_POST["titre"] = trim($_POST["titre"]);

        //Titre : entre 3 et 30
        $nbChar = strlen($_POST["titre"]);

        if ( $nbChar == 0 ){
            $error = true;
            $listOfErrors [] = 11;
        }
        else if($nbChar < 3 || $nbChar > 30 ){
            $error = true;
            $listOfErrors[] = 12;
        }
        //Album : entre 3 et 30
        if (!empty($_POST["album"]) ){
          $_POST["album"] = trim($_POST["album"]);
           $nbChar = strlen($_POST["album"]);
           if ( $nbChar == 0) {
             $error = true;
             $listOfErrors [] = 11;
           }
            else if($nbChar < 3 || $nbChar > 30 ){
                $error = true;
                $listOfErrors[] = 13;
            }
        }
        //Commentaire auteur : entre 0 et 255
        if (!empty($_POST["comment"]))
        {
          $_POST["comment"] = trim ($_POST["comment"]);
          $nbChar = strlen($_POST["comment"]);
        }
        //Le genre doit éxister dans le tableau-
        if( !array_key_exists($_POST["genre"], $listOfGenre) ){
            $error = true;
            $listOfErrors[] = 6;
        }
        //Vérification du la musique
        $musicFile = $_FILES["music"];
        if (!empty ($musicFile ["size"])){

          //Taille du fichier
          if ($musicFile["size"] > 9040685 ) {
            $error = true;
            $listOfErrors[] = 17;
          }
          //Format du fichier
          if ($musicFile ["type"] != "audio/mp3" ) {
            $error = true;
            $listOfErrors[] = 16;
          }
        }
        else { //Le $_FILES musiques est vide
          $error = true;
          $listOfErrors[] = 15;
        }





        //Vérification de l'image


        $imageFile = $_FILES["img"];
        if (!empty ($imageFile ["size"])){
          //Taille du fichier
          if ($imageFile["size"] > 9040685 ) { //CHANGER VERIF TAILLE
            $error = true;
            $listOfErrors[] = 19;
          }
          //Format du fichier
          $imageExtension = pathinfo ($_FILES ["img"]["name"]);
          $musicImageDirPath = MUSIC_IMAGE_DIR_PATH.uniqid().".".$imageExtension;
          echo $musicImageDirPath;
          if ($musicFile ["type"] != "audio/mp3" ) {
            $error = true;
            $listOfErrors[] = 20;
          }
        }



        //Connexion à la BDD s'il n'y pas d'erreurs et dernière vérification
        if (!$error) {
            //Vérifie si la musique est déjà dans la BDD
            $connection = dbConnect ();
            $query = $connection->prepare("SELECT music_name FROM MUSIC WHERE music_name=:music_name AND user_id =:user_id AND isDeleted = 0");
            $query -> execute (["music_name"=>$_POST["titre"],
                                "user_id"=> $_SESSION["user"]
                                ]);
            $result = $query -> fetch(); //fetch retourne le 1er enregistrement

            if (!empty ($result)) {
                $error = true;
                $listOfErrors [] = 14;
            }
        }
        //redirection sur addMusic.php s'il y a des erreurs
        if($error){
            $_SESSION["form_post"] = $_POST;
            $_SESSION["form_errors"] = $listOfErrors;
            header("Location: addMusic.php");
        }
        else {
          //On met la musique et l'image au bon endroit


          $musicDirPath = MUSIC_DIR_PATH."/id:".$verifyUser["user_id"]."-".$_POST["titre"].".mp3";
          if ($musicFile ["error"] == 0 ) {
            //  move_uploaded_file($musicFile["tmp_name"], $musicDirPath);

            //Vérification que l'image y est A FAIRE

          }
          if (move_uploaded_file($musicFile["tmp_name"], $musicDirPath) == false) {
            $error = true;
            $listOfErrors [] = 18;
          } else {
              //Ajout des infos en BDD
              $connection = dbConnect();
              $querry = $connection -> prepare("INSERT INTO MUSIC (music_name, author_comment, lyrics, music_image, dateupload, upload_music, user_id) VALUES (:music_name,  :author_comment, :lyrics, :music_image, STR_TO_DATE (:dateupload, '%Y-%m-%d') , :upload_music, :user_id)");
              //uploadDate
              //Chemin de la musique



              $uploadDate = date ('Y-m-d');

              $querry -> execute([
                  "music_name" => $_POST["titre"],
                  "author_comment" => $_POST["comment"],
                  "lyrics" => $_POST["lyrics"],
                  "music_image" => $musicImageDirPath,
                  "dateupload" => $uploadDate,
                  "upload_music" => $musicDirPath,
                  "user_id" => $_SESSION['user']
                  ]);
            $listOfMessages [] = 1;
            $_SESSION ["form_message"] = $listOfMessages;
            header("Location: addMusic.php");
            die();
          }

        }
}
else{
    echo "Fatal error !";
    die();
}
=======
<?php
session_start();
require "conf.inc.php";
require "lib.php";
 
//fonction id ();
//vérification
//nom musique + id user
//
 
$verifyUser = getUser ($_SESSION["id"]);
 
if ($verifyUser == false){ //Si le token ne correspond pas à celui de l'utilisateur en BDD
  header("Location: disconnect.php");
  die ();
}
 
$imageFilesAuthorized = ["png", "jpg", "jpeg"];
 
define("MUSIC_DIR_PATH", "./musics");
define("MUSIC_IMAGE_DIR_PATH", "./music_images");
//$authorizedFormat = mp3;
$error = false;
$listOfErrors = [];
 
if (!file_exists(MUSIC_DIR_PATH)){ //Dossier musiques
  mkdir(MUSIC_DIR_PATH); //créer le dossier s'il n'existe pas
}
if (!file_exists(MUSIC_IMAGE_DIR_PATH)){ //Dossier d'image des musiques
  mkdir(MUSIC_IMAGE_DIR_PATH);
}
 
 
if( isset($_POST["titre"]) &&
    isset($_POST["genre"]) &&
    isset($_FILES ["music"]) &&
    count($_POST) == 5 ){
        $_POST["titre"] = trim($_POST["titre"]);
 
        //Titre : entre 3 et 30
        $nbChar = strlen($_POST["titre"]);
 
        if ( $nbChar == 0 ){
            $error = true;
            $listOfErrors [] = 11;
        }
        else if($nbChar < 3 || $nbChar > 30 ){
            $error = true;
            $listOfErrors[] = 12;
        }
        //Album : entre 3 et 30
        if (!empty($_POST["album"]) ){
          $_POST["album"] = trim($_POST["album"]);
           $nbChar = strlen($_POST["album"]);
           if ( $nbChar == 0) {
             $error = true;
             $listOfErrors [] = 11;
           }
            else if($nbChar < 3 || $nbChar > 30 ){
                $error = true;
                $listOfErrors[] = 13;
            }
        }
        //Commentaire auteur : entre 0 et 255
        if (!empty($_POST["comment"]))
        {
          $_POST["comment"] = trim ($_POST["comment"]);
          $nbChar = strlen($_POST["comment"]);
        }
        //Le genre doit éxister dans le tableau-
        if( !array_key_exists($_POST["genre"], $listOfGenre) ){
            $error = true;
            $listOfErrors[] = 6;
        }
        //Vérification du la musique
        $musicFile = $_FILES["music"];
        if (!empty ($musicFile ["size"])){
 
          //Taille du fichier
          if ($musicFile["size"] > 9040685 ) {
            $error = true;
            $listOfErrors[] = 17;
          }
          //Format du fichier
          if ($musicFile ["type"] != "audio/mp3" ) {
            $error = true;
            $listOfErrors[] = 16;
          }
        }
        else { //Le $_FILES musiques est vide
          $error = true;
          $listOfErrors[] = 15;
        }
 
 
 
 
 
        //Vérification de l'image
 
 
        $imageFile = $_FILES["img"];
        if (!empty ($imageFile ["size"])){
          //Taille du fichier
          if ($imageFile["size"] > 9040685 ) { //CHANGER VERIF TAILLE
            $error = true;
            $listOfErrors[] = 19;
          }
          //Format du fichier
          $imageExtension = pathinfo ($_FILES ["img"]["name"]);
          $musicImageDirPath = MUSIC_IMAGE_DIR_PATH.uniqid().".".$imageExtension;
          echo $musicImageDirPath;
          if ($musicFile ["type"] != "audio/mp3" ) {
            $error = true;
            $listOfErrors[] = 20;
          }
        }
 
 
 
        //Connexion à la BDD s'il n'y pas d'erreurs et dernière vérification
        if (!$error) {
            //Vérifie si la musique est déjà dans la BDD
            $connection = dbConnect ();
            $query = $connection->prepare("SELECT music_name FROM MUSIC WHERE music_name=:music_name AND user_id =:user_id AND isDeleted = 0");
            $query -> execute (["music_name"=>$_POST["titre"],
                                "user_id"=> $_SESSION["user"]
                                ]);
            $result = $query -> fetch(); //fetch retourne le 1er enregistrement
 
            if (!empty ($result)) {
                $error = true;
                $listOfErrors [] = 14;
            }
        }
        //redirection sur addMusic.php s'il y a des erreurs
        if($error){
            $_SESSION["form_post"] = $_POST;
            $_SESSION["form_errors"] = $listOfErrors;
            header("Location: addMusic.php");
        }
        else {
          //On met la musique et l'image au bon endroit
 
 
          $musicDirPath = MUSIC_DIR_PATH."/id:".$verifyUser["user_id"]."-".$_POST["titre"].".mp3";
          if ($musicFile ["error"] == 0 ) {
            //  move_uploaded_file($musicFile["tmp_name"], $musicDirPath);
 
            //Vérification que l'image y est A FAIRE
 
          }
          if (move_uploaded_file($musicFile["tmp_name"], $musicDirPath) == false) {
            $error = true;
            $listOfErrors [] = 18;
          } else {
              //Ajout des infos en BDD
              $connection = dbConnect();
              $querry = $connection -> prepare("INSERT INTO MUSIC (music_name, author_comment, lyrics, music_image, dateupload, upload_music, user_id) VALUES (:music_name,  :author_comment, :lyrics, :music_image, STR_TO_DATE (:dateupload, '%Y-%m-%d') , :upload_music, :user_id)");
              //uploadDate
              //Chemin de la musique
 
 
 
              $uploadDate = date ('Y-m-d');
 
              $querry -> execute([
                  "music_name" => $_POST["titre"],
                  "author_comment" => $_POST["comment"],
                  "lyrics" => $_POST["lyrics"],
                  "music_image" => $musicImageDirPath,
                  "dateupload" => $uploadDate,
                  "upload_music" => $musicDirPath,
                  "user_id" => $_SESSION['user']
                  ]);
            $listOfMessages [] = 1;
            $_SESSION ["form_message"] = $listOfMessages;
            header("Location: addMusic.php");
            die();
          }
 
        }
}
else{
    echo "Fatal error !";
    die();
}
>>>>>>> refs/remotes/origin/Dev
