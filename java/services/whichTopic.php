<?php
require "/lib.php";
    $pdo = $dbConnect();



$result = $pdo->prepare("SELECT * FROM forum_topic WHERE subject = ?");
$result-> execute([
	$_POST['subject']
	]);

foreach ($result as $row) {
	echo $row["id_forum"];
}



?>
