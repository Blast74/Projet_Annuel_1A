<?php
if (empty($_REQUEST)) {
	session_start();
}
require "lib.php";
require "libSQL.php";



if (!empty($_GET["id"]) && count ($_GET)==1 && is_numeric ($_GET["id"]) ){
	$connection = dbConnect ();
	$query = $connection->prepare("UPDATE USERS SET active_account =0 WHERE user_id=:id");// :id ==> dans le $_GET on a deja la bonne instruction
	$query-> execute ($_GET);
}if (!empty($_REQUEST["id_user"]) && (checkModerator($_REQUEST["access_token"]))) {
	$connection = dbConnect ();
	$query = $connection->prepare("UPDATE USERS SET active_account =0 WHERE user_id=:id");// :id ==> dans le $_GET on a deja la bonne instruction
	$query-> execute ($_REQUEST["id"]);
} else {
header ("Location: moderation.php");
}
