<?php
session_start();
require_once "../conf.inc.php";
require "../lib.php";
header ('Content-type:application/json'); //Type de contenu que cette page renvoi


if (!empty ($_SESSION)) {
  $userInfo = getUser ($_SESSION['id']);
}









 ?>
