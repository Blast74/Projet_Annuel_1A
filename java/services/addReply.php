<?php

require_once "../../lib.php";

echo ($_POST['id']);
echo ($_POST['commentaire']);
echo ($_POST["pseudo"]);


$pdo = dbConnect ();

     $params = [
       $_POST['id'],
       $_POST['commentaire'],
       $_POST['pseudo']
     ];

     $stmt = $pdo->prepare('INSERT INTO forum_msg (id_topic, content, author) VALUES (?, ?, ?)');
     $stmt->execute($params);
     http_response_code(201);
?>