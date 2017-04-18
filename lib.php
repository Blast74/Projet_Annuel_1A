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