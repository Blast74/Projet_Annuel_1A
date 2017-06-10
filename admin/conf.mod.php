<?php
// fichier de conf pour partie admin

const CHECKMODERATOR = [1, "Moderator"];
const CHECKSUPERMODERATOR = [1, "Supermoderator"];
const CHECKUSER = [0, "User"];
const CHECKERROR = [0, "Error"];

$listPropertyUsers = ["email","firstname","lastname","birthday", "gender", "country", "active_account"];
$listElementSecretKeys = [9, 11, "pwd", "access_token"];


  //     "moderator" => [TRUE, "Moderator"],
  //     "supermoderator" => [TRUE, "Supermoderator"],
  //     "user" => [FALSE, "User"],
  //     "error" => [FALSE, "Error"]
  // ];
