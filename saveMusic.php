<?php
session_start();
require "conf.inc.php";
require "lib.php";


 
$error = false;
$listOfErrors = [];
 

if( !empty($_POST["titre"]) &&
    !empty($_POST["genre"]) &&
    !empty($_POST["file"]))
    {
    
        $_POST["titre"] = trim($_POST["titre"]);
        $_POST["album"] = trim($_POST["album"]);
 
 
        //Titre : entre 3 et 30
        $nbChar = strlen($_POST["titre"]);
        if($nbChar < 3 || $nbChar > 30 ){
            $error = true;
            $listOfErrors[] =1;
        }
  
        //Album : entre 3 et 30
        if (!empty($_POST["album"]))
        {
           $nbChar = strlen($_POST["album"]);
            if($nbChar < 3 || $nbChar > 30 ){
                $error = true;
                $listOfErrors[] =2;
            }
        }
  

        //Commentaire auteur : entre 0 et 255
        if (!empty($_POST["comment"]))
        {
           $nbChar = strlen($_POST["comment"]);
            if($nbChar < 3 || $nbChar > 30 ){
                $error = true;
                $listOfErrors[] =3;
            }
        }
        

        //Genre -doit éxister dans le tableau-
        if( !array_key_exists($_POST["genre"], $listOfGenre) ){
            $error = true;
            $listOfErrors[] =4;
        }
        

        //Connexion à la BDD s'il n'y pas d'erreurs et dernières vérifications

        if (!$error) {
            //Vérifie si la musique est déjà dans la BDD
            $connection = dbConnect (); 
            $query = $connection->prepare("SELECT music_name FROM music where music_name=:music_name;");
        //  $name = (empty($_GET["user_id"]))?-1: $_GET["user_id"];  condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
            $query -> execute (["music_name"=>$_POST["titre"]]);
            $result = $query -> fetch(); //fetch retourne le 1er enregistrement
            if (!empty ($result)) {
                $error = true;
                $listOfErrors [] = 5;
            }
            
        }

        //redirection sur addMusic.php s'il y a des erreurs
        if($error){
            $_SESSION["form_post"] = $_POST;
            $_SESSION["form_errors"] = $listOfErrors;
       /*     if (empty ($_GET['id'])){
 			    header("Location: inscription.php");
            }
            else {
                header("Location: updateUser.php?id=".$_GET["id"]);
            }*/

        }else{  //enregistrement du formulaire dans la BDD

        $connection = dbConnect();
                // ":pseudo" (variable sql)   modif!!!!!
            $querry = $connection -> prepare("INSERT INTO music (music_name, music_type, author_comment, lyrics, music_image) VALUES (:music_name, :music_type, :author_comment, :lyrics, :music_image)"); 

echo $_POST["genre"];
            $querry -> execute([     // la ou il y a   :pseudo;, on met la valeur de $_POST["pseudo"]
              /*  "music_name"=> "gna",
                "music_type"=> "gna",
                "author_comment" => "gna",
                "lyrics" => "gna",
                "music_image" => "NULL"
                ]); */

                "music_name" => $_POST["titre"],
                "music_type" => $_POST["genre"],
                "author_comment" => $_POST["comment"],
                "lyrics" => $_POST["lyrics"],
                "music_image" => $_POST["img"]
                ]);
          //      header("Location: index.php");
          //  die();

        }

}else{
    echo "Fatal error !";
    die();
}