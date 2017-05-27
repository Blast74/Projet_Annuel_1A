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


// $connection = dbConnect();
//         // ":pseudo" (variable sql)   modif!!!!!
//     $querry = $connection -> prepare("INSERT INTO trophy (trophy_name, trophy_image, trophy_description, trophy_points, user_id) VALUES (:name, :image,:descr,:points,:user)");
//
//     $querry -> execute([     // la ou il y a   :pseudo;, on met la valeur de $_POST["pseudo"]
//       "name" => $test["name"],
//       "image" => $test["image"],
//       "descr" => $test["desc"],
//       "points" => $test["point"],
//       "user" => $result["user_id"]
//         ]);
//


 ?>
