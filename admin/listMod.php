<!-- générateur de liste user en ajax  -->
<?php
session_start();
  require_once '../lib.php';
  require 'libSQL.php';
  require 'libCountPage.php';
  require 'libModOne.php';

  $checkMod = checkMod($_REQUEST["access_token"]);
  if ($checkMod[1] != "Error") {
    $connection = dbConnect ();
    $query = $connection -> prepare ("SELECT * FROM USERS WHERE active_account !=0");
    $query -> execute();
    $users = $query -> fetchAll ();
     //array_slice($resultSQL,0,$_REQUEST["nbusers"]+1);
     //  $result = pageSelectorGen(count($resultSQL), $_REQUEST["nbusers"]);
    $result = ' <table id="usersTable" width="100%" >
                        <thead>
                            <tr>
                                <th>Pseudo</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Mail</th>
                                <th>Date de naissance</th>
                                <th>Genre</th>
                                <th>Pays</th>
                                <th>Statut</th>
                                <th>Date d\'enregistrement</th>
                                <th>Fonction</th>
                                <th colspan="3">Actions</th>
                            </tr>
                        </thead>';
    foreach ($users as $user) {
        $result .= '<tr id = '.$user['pseudo'].' name = "userModList">';
        $result .= '<td name = "userModList">'.$user['pseudo'].'</td>';
        $result .= '<td name = "userModList">'.$user['firstname'].'</td>';
        $result .= '<td name = "userModList">'.$user['lastname'].'</td>';
        $result .= '<td name = "userModList">'.$user['email'].'</td>';
        $result .= '<td name = "userModList">'.date('d/m/Y', strtotime($user['birthday'])).'</td>';
        $result .= '<td name = "userModList">'.$listOfGender[$user['gender']].'</td>';
        $result .= '<td name = "userModList">'.$listOfCountry[$user['country']].'</td>';

        if ($user['active_account'] == 1) {
          $result .= '<td name = "userModList">Activé</td>';
        }else {
          $result .= '<td name = "userModList">Désactivé</td>';
        }
        $result .= '<td name = "userModList">'.$user['register_date'].'</td>';

        switch ($user['moderator']) {
          case '0':
            $result .= '<td name = "userModList">Utilisateur</td>';
            break;

          case '1':
            $result .= '<td name = "userModList">Modérateur</td>';
            break;

          case '2':
            $result .= '<td name = "userModList">Supermodérateur</td>';
            break;

          default:
            $result .= '<td name = "userModList">Inconnu</td>';
            break;
        }
        $result .= OptionModeration($user,$_SESSION["id"]);


    }
    $result .= '</table>';
    echo $result;
    //echo var_dump(get_defined_vars());
  }else {
    echo "<h4>Bien mais essaie encore :)</h4>";
  }
?>
</h4>
