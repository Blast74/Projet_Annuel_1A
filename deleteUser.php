<?php

require "lib.php";



if (!empty($_GET["id"]) && count ($_GET)==1 && is_numeric ($_GET["id"]) ){	
	$connection = dbConnect ();
	$query = $connection->prepare("UPDATE USERS SET active_account =0 WHERE user_id=:id");// :id ==> dans le $_GET on a deja la bonne instruction
	$query-> execute ($_GET); 
}
header ("Location: moderation.php");



