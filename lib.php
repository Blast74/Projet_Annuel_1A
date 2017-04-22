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
        if ($_SESSION['moderator'] != 1) {
            $NoModerator = true;
        }
        else if ($_SESSION['moderator'] == 1) {
            $NoModerator = false;
        }
    }
    else {
        header("Location: index.php");  // modifier navbar et lib.php  il faut la redirection soit faite avant le traitement
        exit ();
    }

    return $NoModerator;
}
