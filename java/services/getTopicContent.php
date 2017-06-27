<?php

require_once "../../lib.php";
//header('Content-Type: application/json');


$pdo = dbConnect ();
//	$requete = $pdo->prepare('SELECT rate FROM (SELECT rate FROM note WHERE email = ?) WHERE genre = ? ');

//	$_GET['email'] = "email@email.com";




$result = $pdo->query("SELECT * FROM forum_msg WHERE id_topic = ".$_POST['id']);




// '#@#'
if(isset($result))
{
foreach ($result as $row) {
		echo $row["id_msg"];
		echo "#@#";
		echo $row["content"];
		echo "#@#";
		echo $row["author"];
		echo "#_@_#";
	}
}



















?>