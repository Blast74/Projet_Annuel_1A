<?php
require "/lib.php";
    $pdo = $dbConnect();



$result = $pdo->query("SELECT * FROM articles");
$index = 0;

foreach ($result as $row) {
		echo $row["article_author"];
		echo "#@#";
		echo $row["article_title"];
		echo "#@#";
		echo $row["article_content"];
		echo "#@#";
		echo $row["upLoadDate"];
		echo "#_@_#";
		$index++;
}

$index--;
?>
