<?php

require_once "../../lib.php";

//header('Content-Type: application/json');

$pdo = dbConnect ();

//	$requete = $pdo->prepare('SELECT rate FROM (SELECT rate FROM note WHERE email = ?) WHERE genre = ? ');

//	$_GET['email'] = "email@email.com";


$result = $pdo->prepare("SELECT * FROM forum_topic WHERE subject = ?");
$result-> execute([
	$_POST['subject']
	]);

foreach ($result as $row) {
	echo $row["id_forum"];
}



?>