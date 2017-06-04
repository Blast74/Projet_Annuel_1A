<?php
session_start();
require "lib.php";
require "conf.trophy.php";

if (isset($_SESSION["id"])) {

    $email = "venzo.terence@gmail.com";
    $connection = dbConnect();

    $query = $connection->prepare("SELECT access_token FROM USERS where email=:email;");// condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
    $query -> execute (["email"=>$email]);
    $result = $query -> fetch(); //fetch retourne le 1er enregistrement


}else {
  //header("Location: index.php");
  $test = get_defined_vars();
  var_dump($test);
}


 ?>
