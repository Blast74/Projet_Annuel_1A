<?php
session_start();
require "lib.php";

if (!empty($_GET["id"]) && count ($_GET)==1 && is_numeric($_GET["id"]) ){
    $connection = dbConnect ();
    $supermoderator = 3;
    $supermoderator;
    $querry = $connection -> prepare("UPDATE USERS SET moderator = 3 WHERE id=:id)";

  	     $querry -> execute([
                "id" => $GET["id"]]); // la ou il y a   :pseudo;, on met la valeur de $_POST["pseudo"]
         	

 }

