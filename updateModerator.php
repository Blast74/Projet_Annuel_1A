<?php
session_start();
require "lib.php";
var_dump($_GET["id"]);


if (!empty($_GET["id"]) && count ($_GET)==1 && is_numeric($_GET["id"]) ){
	if ( verifyAdministrator ()){
		echo '<br>connexion';
		echo '<br>';
		echo '<br>admin bdd';
		//if
		// ACTION SUR LA BDD EN FONCTION DE L'URL
	}
	else { //Redirection si pas administrateur
		//header('location: moderation.php?id=OK');
		echo '<br>pas admin redirection';
	}


	$connection = dbConnect ();
	$query = $connection->prepare("UPDATE USERS SET active_account =0 WHERE user_id=:id");// :id ==> dans le $_GET on a deja la bonne instruction
	$query-> execute ($_GET);
   // $querry = $connection -> prepare("UPDATE USERS SET moderator = 3 WHERE id=:id)";

  	    // $querry -> execute([
            //    "id" => $GET["id"]]); // la ou il y a   :pseudo;, on met la valeur de $_POST["pseudo"]

 }
 else {
 	echo '<br>pas moderateur ni admin redirection';
 	//header('location: moderation.php?id=OK');
 }
