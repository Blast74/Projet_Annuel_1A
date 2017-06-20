<?php
session_start();
require "lib.php";
require "conf.trophy.php";

if (isset($_SESSION["id"])) {


    $connection = dbConnect();

    $query = $connection->prepare("SELECT * FROM USERS where user_id=:user;");// condition ternaire si l'id est vide ça renvoit -1 sert aussi pour le pseudo !!
    $query -> execute (["user"=>$_SESSION["user"]]);
    $result = $query -> fetch(); //fetch retourne le 1er enregistrement


    var_dump($result);

    var_dump(md5($test["name"]));
    var_dump($_SESSION["id"]);

}else {
  //header("Location: index.php");
  $test = get_defined_vars();
  var_dump($test);
}



 ?>
