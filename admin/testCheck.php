<?php

session_start();
require "..\lib.php";
require "libSQL.php";
require "conf.mod.php";
require 'libModOne.php';


 $test = checkMod($_SESSION["id"]);
 var_dump($_SESSION["id"]);
 var_dump($test);

 $test2 = 0;

 echo ($_SESSION["id"] == 0);

 $test3= NULL;
 $test4 = 0;

 echo ($test3 === NULL);
 echo ($test4 === NULL);



 ?>
