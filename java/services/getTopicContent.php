<?php

require "/lib.php";
    $pdo = $dbConnect();




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
