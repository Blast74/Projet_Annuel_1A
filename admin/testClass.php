<?php
session_start();
require 'classUsers.php';

$test = new User;
$test->createWithEmail("venzo.terence@hotmail.fr");

$connection = dbConnect ();
$query = $connection -> prepare ('SELECT * FROM USERS WHERE access_token=?');
$query -> execute([$_SESSION["id"]]);
$user = $query -> fetchAll (PDO::FETCH_ASSOC);

var_dump($user);

$testEmpty = new User;

$testEmpty->createWithEmail("venzo.terence@mail.fr");



print_r( $testEmpty->isMod());

$test->changeStatut(0);

var_dump($test->changeStatut(0));
echo "<br>";



$connection = dbConnect ();
$query = $connection -> prepare ('SELECT * FROM USERS WHERE access_token=?');
$query -> execute([$_SESSION["id"]]);
$user = $query -> fetchAll (PDO::FETCH_ASSOC);

var_dump($user);

 ?>
