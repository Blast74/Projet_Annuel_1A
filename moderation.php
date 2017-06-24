<?php
    session_start();
    include "navbar.php";

    $access = checkMod($_SESSION["id"]);
    if($access[0] != 1){

        header("Location: index.php");
        die();
    }
?>
        <div class="container">
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">UTILISATEURS :</h1>
                </div>
            </div>
            <div id="ListParamUsers">
                <p>Trier Par:</p>
            <select id="orderDisplay">
                <option value="pseudo" >Pseudo</option>
                <option value="firstname" >Prénom</option>
                <option value="lastname" >Nom</option>
                <option value="email" selected="selected">Mail</option>
                <option value="birthday" >Date de naissance</option>
                <option value="gender" >Genre</option>
                <option value="country" >Pays</option>
                <option value="active_account">Statut</option>
            <select>
            <select id="sortByOptionSelectUsers">
                <option value="ASC">Croissant</option>
                <option value="DESC">Décroissant</option>
            </select>
            <input id="refreshButton" type="button" onclick='listUsers("listUsers")' value ="Actualiser"></input>
            <br>
            <p>Nombre d'utilisateurs souhaités :</p>
            <select id="nbByPages">
                <option value="5" selected="selected">5</option>
                <option value="10" >10</option>
                <option value="20" >20</option>
                <option value="30" >30</option>
            <select>
            </div>
            <div id="resultRightOperation">

            </div>
             <div id="listUsers">
                 <input type="button"  value="cookies" onclick="console.log(getCookie('access'))">

        </div>
        <!--    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">MODERATEURS :</h1>
                </div>
            </div>
            <div id="ListParamMod">
                <p>Trier Par:</p>
            <select id="sortBySelectMod">
                <option value="user_id" selected="selected">id</option>
                <option value="pseudo" >Pseudo</option>
                <option value="prenom" >Prénom</option>
                <option value="nom" >Nom</option>
                <option value="email" >Mail</option>
                <option value="birthday" >Date de naissance</option>
                <option value="gender" >Genre</option>
                <option value="country" >Pays</option>
                <option value="active_account">Statut</option>
            <select>
            <select id="sortByOptionSelectMod">
                <option value="ASC">Croissant</option>
                <option value="DESC">Décroissant</option>
            </select>
            <input id=tagButtonView type="button" onclick='recupParam("Mod")' value ="Actualiser"></input>
            <br>
            <p>Nombre d'utilisateurs souhaités :</p>
            <select id="nbusersSelectMod">
                <option value="5" selected="selected">5</option>
                <option value="10" >10</option>
                <option value="20" >20</option>
                <option value="30" >30</option>
            <select>
            </div>
            <div>
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
                                <th>Date d'enregistrement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
 PHP
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
            if (($user ["moderator"] == 1 && checkSuperModerator($_SESSION["id"])) ){
              echo '<td><input type="button" value="Ajouter un Supermodérateur" onclick=""></td>'; //
              echo "</tr>";
            }if (($user ["moderator"] == 2 && checkSuperModerator($_SESSION["id"])) ){
              echo '<td><input type="button" value="Retirer un Supermodérateur" onclick=""></td>';
              echo "</tr>";
            }else {
              echo "</tr>";
            }
          }
        }

           </table>

        </div> -->


        <hr>
<script src="admin\libJS.js"></script>
<!--
    getJSAccessToken();
 ?> -->
<!-- <script src="admin\libSupMod.js"></script> -->


<?php
    var_dump(checkMod($_SESSION["id"]));
    var_dump(get_defined_vars());
    include "footer.php";
?>
