<?php 

require_once "conf.inc.php";


//Connexion à la base de données
function dbConnect (){
	    try { 
            $connection = new PDO ( "mysql:host=".HOST.";dbname=".DBNAME , DBUSER , DBPWD ); 
        } catch (Exception $e){ //on passe dans le catch dès qu'on rencontre une erreur
            die("Erreur SQL".$e -> getMessage() ); //$e -> getMessage() //obtenir le message d'erreur
        }
        return $connection; // si pas de pb on ne rentre pas dans le catch et on se connecte
}

function VerifyModerator () {
    if (isset($_SESSION['id'])) {
        if (($_SESSION['moderator'] != 1) AND ($_SESSION['moderator'] != 2)  ){
            header("Location: index.php");  
            exit ();
        }
    }
    else {
        header("Location: index.php");  
        exit ();
    }
}

function verifyAdministrator () {
    $Administrator = false;
    if (isset($_SESSION['id'])) { 
        if ($_SESSION['moderator'] != 2  ){ //Si pas admin
            header("Location: index.php");  
            exit ();
        }
        else if ($_SESSION['moderator'] == 2) {  //Si admin
            $Administrator = true;
            return $Administrator;
        }
    }
    else {
        header("Location: index.php");  
        exit ();
    }
}

