<?php

require "/lib.php";
    $pdo = $dbConnect();




$result = $pdo->prepare("SELECT * FROM users WHERE access_token = ?");
$result-> execute([
	$_POST['user']
	]);

foreach ($result as $row) {
	echo $row["pseudo"];
}


?>
