<?php

require_once "../../lib.php";

$pdo = dbConnect ();


$result = $pdo->query("SELECT * FROM forum_topic");
$index = 0;

foreach ($result as $row) {
		echo $row["id_forum"];
		echo "#@#";
		echo $row["subject"];
		echo "#@#";
		echo $row["author"];
		echo "#_@_#";
		$index++;
}

$index--;
?>