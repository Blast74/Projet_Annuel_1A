<?php
    require "/lib.php";
    $pdo = $dbConnect();

     $params = [
       $_POST['subject'],
       $_POST['pseudo']
     ];

     $stmt = $pdo->prepare('INSERT INTO forum_topic (subject, author) VALUES (?, ?)');
     $stmt->execute($params);




     http_response_code(201);
?>
