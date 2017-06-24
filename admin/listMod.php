<?php
session_start();
  require "..\lib.php";
  require "libSQL.php";
  $connection = dbConnect ();
  $query = $connection -> prepare ("SELECT * FROM USERS WHERE active_account !=0 ORDER BY :colTable DESC");
  $query -> execute(
                      ["colTable"=>$_REQUEST["sortBy"]]
                    );
  $resultSQL = $query -> fetchAll ();
  $users = array_slice($resultSQL,0,$_REQUEST["nbusers"]+1);
  $result = ' <table>
                      <thead>
                          <tr>
                              <th>Identifiant</th>
                              <th>Pseudo</th>
                              <th>Prénom</th>
                              <th>Nom</th>
                              <th>Mail</th>
                              <th>Date de naissance</th>
                              <th>Genre</th>
                              <th>Pays</th>
                              <th>Statut</th>
                              <th>Date d\'enregistrement</th>
                              <th>Actions</th>
                          </tr>
                      </thead>';
  foreach ($users as $user) {
    if ($user ['moderator'] ==0){
      $result .= '<tr name = "userModList">';
      $result .= '<td name = "userModList">'.$user['user_id'].'</td>';
      $result .= '<td name = "userModList">'.$user['pseudo'].'</td>';
      $result .= '<td name = "userModList">'.$user['firstname'].'</td>';
      $result .= '<td name = "userModList">'.$user['lastname'].'</td>';
      $result .= '<td name = "userModList">'.$user['email'].'</td>';
      $result .= '<td name = "userModList">'.date('d/m/Y', strtotime($user['birthday'])).'</td>';
      $result .= '<td name = "userModList">'.$listOfGender[$user['gender']].'</td>';
      $result .= '<td name = "userModList">'.$listOfCountry[$user['country']].'</td>';
      $result .= '<td name = "userModList">'.$user['active_account'].'</td>';
      $result .= '<td name = "userModList">'.$user['register_date'].'</td>';
      $result .= '<td name = "userModList"><input type="button" value="Modifier" onclick=""></td>';
      if($user ["moderator"] == 0 && checkSuperModerator($_SESSION["id"])) {
        $result .= '<td name = "userModList"><input type="button" value="Ajouter un Modérateur" onclick=""></td>';
        $result .= '</tr>';
      }if ($user ["moderator"] == 1 && checkSuperModerator($_SESSION["id"])) {
        $result .= '<td name = "userModList"><input type="button" value="Retirer un Modérateur" onclick=""></td>';
        $result .= '</tr>';
      }else {
        $result .= '</tr>';
      }
    }
  }
  $result .= '</table>';
  echo $result;


?>
