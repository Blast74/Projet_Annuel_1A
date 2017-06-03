<?php
session_start();
  require "..\lib.php";
  require "libSQL.php";
  $connection = dbConnect ();
  $query = $connection -> prepare ("SELECT * FROM USERS WHERE active_account !=0 ORDER BY :colTable :order");
  $query -> execute(
                      ["colTable"=>$_REQUEST["sortBy"],
                      "order"=>$_REQUEST["sortByOption"]]
                    );
  $users = $query -> fetchAll ();
  $result = '';
  foreach ($users as $user) {
    if (($user ['moderator'] ==1) OR ($user ['moderator'] ==2)){
      $result .= '<tr name = "userSupermodList">';
      $result .= '<td name = "userSupermodList">'.$user['user_id'].'</td>';
      $result .= '<td name = "userSupermodList">'.$user['pseudo'].'</td>';
      $result .= '<td name = "userSupermodList">'.$user['firstname'].'</td>';
      $result .= '<td name = "userSupermodList">'.$user['lastname'].'</td>';
      $result .= '<td name = "userSupermodList">'.$user['email'].'</td>';
      $result .= '<td name = "userSupermodList">'.date('d/m/Y', strtotime($user['birthday'])).'</td>';
      $result .= '<td name = "userSupermodList">'.$listOfGender[$user['gender']].'</td>';
      $result .= '<td name = "userSupermodList">'.$listOfCountry[$user['country']].'</td>';
      $result .= '<td name = "userSupermodList">'.$user['active_account'].'</td>';
      $result .= '<td name = "userSupermodList"><input type="button" value="Modifier" onclick=""></td>';
      if($user['moderator'] == 1 && checkSuperModerator($_SESSION['id'])){
        $result .= '<td name = "userSupermodList"><input type="button" value="Ajouter un Supermodérateur" onclick=""></td>'; //
        $result .= '</tr>';
      }if ($user ['moderator'] == 2 && checkSuperModerator($_SESSION['id'])){
        $result .= '<td name = "userSupermodList"><input type="button" value="Retirer un Supermodérateur" onclick=""></td>';
        $result .= '</tr>';
      }else {
        $result .= '</tr>';
      }
    }
  }
  echo $result;
