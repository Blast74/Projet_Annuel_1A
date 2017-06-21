<?php

session_start();
require '../lib.php';


 // $pseudo = "test";
 // $pwdTemp = "test";
 // $accessToken = "test";
 // var_dump(`{$pseudo}`);

    // $content = registerMailContent($pseudo, $accessToken, $pwdTemp);
    // echo ($content);

    $email = "zebrolfr@gmail.com";
    $pwd = uniqid();
    $accessToken = md5(uniqid().$email.time());
    $contentMail = registerMailContent("test", $accessToken, $pwd);
    echo $contentMail;
    var_dump($contentMail);

    $headers = "From: \"Musique Review Inscription\"<zebrolfr@gmail.com>\n";
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";

    $statusMail = mail($email, "Activation de compte", $contentMail, $headers);

    var_dump($statusMail);
 ?>
