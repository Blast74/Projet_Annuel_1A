<?php
    require "/lib.php";
    $pdo = $dbConnect();

     $params = [
       $_POST['title'],
       $_POST['content'],
       $_POST['author']
     ];

     $stmt = $pdo->prepare('INSERT INTO articles (article_title, article_content, article_author) VALUES (?, ?, ?)');
     $stmt->execute($params);


     http_response_code(201);
?>
