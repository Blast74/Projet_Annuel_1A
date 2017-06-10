<?php
// <!-- librairie php admin -->
require_once 'conf.mod.php';

//verifie le niveau de modération
function checkMod($idSession){
  if (!empty($idSession)) {

    $connection = dbConnect();
    $query = $connection->prepare("SELECT * FROM USERS where access_token=:access_token");
    $query -> execute (["access_token" => $idSession]);
    $result = $query->fetch();

      switch ($result["moderator"]) {

        case 1:
          return CHECKUSER;
          break;
        case 2:
          return CHECKMODERATOR;
          break;
        case 3:
          return CHECKSUPERMODERATOR;
          break;
         default:
           return CHECKERROR;
           break;
      }

  }else {
    return CHECKERROR;
  }
}
//attribut les droit en fonction de l'access_token
function OptionModeration ($user, $idSession){
  $checkMod = checkMod($idSession);
  if ($checkMod[0]) {

    $returnOption = '';
    switch ($user["moderator"]) {
      case 0:
        if(($checkMod[1]=="Moderator" || $checkMod[1]=="Supermoderator")) {
          $returnOption .= '<td name = "userModList"><input type="button" value="Modifier" onclick="paramRight(this)"></td>';

        }if($checkMod[1]=="Supermoderator") {
          $returnOption .= '<td name = "userModList"><input type="button" value="Ajouter un Modérateur" onclick=""></td>';
        }
        break;

      case 1:
        if($user["moderator"] == 1 && $checkMod[1]=="Supermoderator") {
          $returnOption .= '<td name = "userModList"><input type="button" value="Modifier" onclick="paramRight(this)"></td>';

        }
        if($user["access_token"] == $idSession && $checkMod[1]=="Moderator") {
          $returnOption .= '<td name = "userModList"><input type="button" value="Modifier" onclick="paramRight(this)"></td>';

        }if ($user["access_token"] == $idSession) {
          $returnOption .= '<td name = "userModList"><input type="button" value="Retirer un Modérateur" onclick=""></td>';

        }if($checkMod[1]=="Supermoderator") {
          $returnOption .= '<td name = "userModList"><input type="button" value="Retirer un Modérateur" onclick=""></td>';

        }if ($checkMod[1]=="Supermoderator") {
          $returnOption .= '<td name = "userSupermodList"><input type="button" value="Ajouter un Supermodérateur" onclick=""></td>';

        }
        break;

      case 2:
        if ($user["access_token"] == $idSession) {
            $returnOption .= '<td name = "userSupermodList"><input type="button" value="Retirer un Supermodérateur" onclick=""></td>';

        }
        break;

      default:
        # code...
        break;
    }
    $returnOption .= '</tr>';
  }else {
    var_dump($checkMod);
  }
  return $returnOption;
}

function getJSAccessToken(){
  if (isset($_SESSION["id"])) {
    echo $_SESSION["id"];
  } else {
    echo "NULL";
  }

}

//old
//
// if($user["moderator"] == 0 && $checkMod[0] && ($checkMod[1]=="Moderator" || $checkMod[1]=="Supermoderator")) {
// echo '<td name = "userModList"><input type="button" value="Modifier" onclick=""></td>';
//
// }if($user["moderator"] == 0 && $checkMod[0] && $checkMod[1]=="Supermoderator") {
//   echo '<td name = "userModList"><input type="button" value="Ajouter un Modérateur" onclick=""></td>';
//
// }}if ($user["access_token"] == $idSession && $checkMod[0] && $checkMod[2]=="Moderator") {
//   echo '<td name = "userModList"><input type="button" value="Retirer un Modérateur" onclick=""></td>';
//
// }if($user["moderator"] == 1 && $checkMod[0] && $checkMod[1]=="Supermoderator") {
//   echo '<td name = "userModList"><input type="button" value="Retirer un Modérateur" onclick=""></td>';
//
// }if ($user["moderator"] == 1 && $checkMod[0] && $checkMod[2]=="Supermoderator") {
//   echo '<td name = "userSupermodList"><input type="button" value="Ajouter un Supermodérateur" onclick=""></td>';
//
// }if ($user["access_token"] == $idSession && $checkMod[0] && $checkMod[2]=="Supermoderator") {
//     echo '<td name = "userSupermodList"><input type="button" value="Retirer un Supermodérateur" onclick=""></td>';
//
// }
//
// $result .= '<td name = "userSupermodList"><input type="button" value="Modifier" onclick=""></td>';
// if($user['moderator'] == 1 && checkSuperModerator($_SESSION['id'])){
//   $result .= ; //
//   $result .= '</tr>';
// }if ($user ['moderator'] == 2 && checkSuperModerator($_SESSION['id'])){
//   $result .= '<td name = "userSupermodList"><input type="button" value="Retirer un Supermodérateur" onclick=""></td>';
//   $result .= '</tr>';
 ?>
