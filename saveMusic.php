<?php
session_start();
require "conf.inc.php";
require "lib.php";

$verifyUser = getUser ($_SESSION["id"]);

if ($verifyUser == false){ //Si le token ne correspond pas à celui de l'utilisateur en BDD
  header("Location: disconnect.php");
  die ();
}

$imageFilesAuthorized = ["png", "jpg", "jpeg"];
//$authorizedFormat = mp3;



$error = false;
$listOfErrors = [];




if( isset($_POST["titre"]) &&
    isset($_POST["genre"]) &&
    isset ($_POST ["subtype"]) &&
    isset($_FILES ["music"]) &&
    count($_POST) == 6 ){
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
        //VERIF array_key_exists  (!!!) tableau à 2 dimensensions subtype [$_POST[genre]] [];
        if( in_array($_POST["subtype"], $subtypeList) ){
            $error = true;
            $listOfErrors[] = 21;
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
          if ( ($musicFile ["type"] != "audio/mp3")  && ($musicFile ["type"] != "audio/mpeg")  ) {
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
        $musicImageDirPath = NULL;


        if (!empty ($imageFile ["size"])){

          //Taille du fichier
          if ($imageFile["size"] > 9040685 ) { //CHANGER VERIF TAILLE
            $error = true;
            $listOfErrors[] = 19;
          }
          //Format du fichier
          $imageExtension = pathinfo ($_FILES ["img"]["name"]);

          if (in_array($imageExtension["extension"], $imageFilesAuthorized) != true){
            $error = true;
            $listOfErrors[] = 20;

          }


          if ($error == false) { //Enregistrement de l'image sur le serveur
            //Si  la musique est enregistrée :
            //path
            $userMusicImageFolder = createDirectory ("music_images","");
            $musicImageDirPath  = $userMusicImageFolder.uniqid().'.'.$imageExtension["extension"];
            //Copie de l'image temporaire sur le serveur
            move_uploaded_file($_FILES ["img"]["tmp_name"], $musicImageDirPath);
          }
        }
        //Connexion à la BDD s'il n'y pas d'erreurs et dernière vérification
        if (!$error) {
            //Vérifie si la musique est déjà dans la BDD
            $connection = dbConnect ();
            $query = $connection->prepare("SELECT music_name FROM MUSIC WHERE music_name=:music_name AND email =:email AND isDeleted = 0");
            $query -> execute (["music_name"=>$_POST["titre"],
                                "email"=> $verifyUser["email"]
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

          $userMusicFolder = createDirectory ("musics", $verifyUser["email"]);
          $musicDirPath = $userMusicFolder.$_POST["titre"].".mp3";


          if (move_uploaded_file($musicFile["tmp_name"], $musicDirPath) == false) {
            $error = true;
            $listOfErrors [] = 18;
          }else {
              //Ajout des infos en BDD
              $connection = dbConnect();
              $querry = $connection -> prepare("INSERT INTO MUSIC (music_name, subtype_type, subtype_name, author_comment, lyrics, music_image, dateupload, upload_music, email) VALUES (:music_name, :subtype_type, :subtype_name, :author_comment, :lyrics, :music_image, STR_TO_DATE (:dateupload, '%Y-%m-%d') , :upload_music, :email)");
              //Chemin de la musique
              $uploadDate = date ('Y-m-d');
              $querry -> execute([
                  "music_name" => $_POST["titre"],
                  "subtype_type" => $_POST ["genre"],
                  "subtype_name" => $_POST ["subtype"],
                  "author_comment" => $_POST["comment"],
                  "lyrics" => $_POST["lyrics"],
                  "music_image" => $musicImageDirPath,
                  "dateupload" => $uploadDate,
                  "upload_music" => $musicDirPath,
                  "email" => $verifyUser['email']
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
