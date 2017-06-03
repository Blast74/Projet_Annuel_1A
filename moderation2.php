<?php
    session_start();
    require "conf.inc.php";
    include "navbar.php";
    require './lib/libSQL.php';

    $connection = dbConnect ();
    $query = $connection -> prepare ("SELECT * FROM USERS WHERE active_account !=0");
    $query -> execute();
    $users = $query -> fetchAll ();

    echo '<div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">UTILISATEURS :</h1>
                </div>
            </div>
            <div>

                <table>
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
                            <th>Actions</th>
                        </tr>
                    </thead>';

        foreach ($users as $user) {
            if ($user["moderator"] == 0){
            echo "<tr>";
            echo "<td>".$user["user_id"]."</td>";
            echo "<td>".$user["pseudo"]."</td>";
            echo "<td>".$user["firstname"]."</td>";
            echo "<td>".$user["lastname"]."</td>";
            echo "<td>".$user["email"]."</td>";
          //date
            echo "<td>".date ("d/m/Y", strtotime($user["birthday"]))."</td>";
          //strtotime (secondes par rapport au 1er janvier 1970)
          //date ("format", time ...) affiche une date avec le format voulu
            echo "<td>".$listOfGender[$user["gender"]]."</td>"; //Affiche 'Homme' au lieu de 'm'
            echo "<td>".$listOfCountry[$user["country"]]."</td>";
            echo "<td>".$listOfStatus[$user["active_account"]]."</td>";
          //Lien vers deleteUser.php?+id de l'utilisateur à supprimer
            echo '<td><input type="button" value="Supprimer" onclick=""></td>';
            echo '<td><input type="button" value="Modifier" onclick=""></td>';
            }if ($user ["moderator"] == 0 && checkSuperModerator($_SESSION["id"])) {
                echo '<td><input type="button" value="Ajouter un Modérateur" onclick=""></td>';
                echo "</tr>";
            } if ($user ["moderator"] == 1 && checkSuperModerator($_SESSION["id"]) {
                echo '<td><input type="button" value="Retirer un Modérateur" onclick=""></td>'; //
                echo "</tr>";
            } else {
                echo "</tr>";
            }
        }
    echo      '</table>';

echo '  </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">MODERATEURS :</h1>
                </div>
            </div>
                <div>
                    <table>
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
                            </tr>
                        </thead>';

        foreach ($users as $user) {
          if (($user ["moderator"] ==1) OR ($user ["moderator"] ==2)){
            echo "<tr>";
            echo "<td>".$user["user_id"]."</td>";
            echo "<td>".$user["pseudo"]."</td>";
            echo "<td>".$user["firstname"]."</td>";
            echo "<td>".$user["lastname"]."</td>";
            echo "<td>".$user["email"]."</td>";
            echo "<td>".date("d/m/Y", strtotime($user["birthday"]))."</td>";
            echo "<td>".$listOfGender[$user["gender"]]."</td>";
            echo "<td>".$listOfCountry[$user["country"]]."</td>";
            echo '<td><input type="button" value="Modifier" onclick=""></td>';
            }if (($user ["moderator"] == 1) ){
              echo '<td><input type="button" value="Ajouter un Supermodérateur" onclick=""></td>'; //
              echo "</tr>";
            }else {
              echo '<td><input type="button" value="Retirer un Supermodérateur" onclick=""></td>'; //
              echo "</tr>";
            }
          }
        }

echo            '</table>

        </div>


        <hr>';

    include "footer.php";
?>
