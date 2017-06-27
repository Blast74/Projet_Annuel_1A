<?php

require_once "../../lib.php";

$pdo = dbConnect ();

     $params = [
       $_POST['exposure'],
       $_POST['pseudo'],
       $_POST['id_topic']

     ];

     $stmt = $pdo->prepare('INSERT INTO forum_msg (content, author, id_topic) VALUES (?, ?, ?)');
     $stmt->execute($params);




     http_response_code(201);
?>