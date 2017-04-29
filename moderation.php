<?php
        //Déconnection si l'utilisateur n'est pas modérateur  
    session_start();
    require "conf.inc.php";
    include "lib.php";
    VerifyModerator ();
    include "navbar.php";
?>

   
    <div class="container">       
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">INFORMATIONS UTILISATEURS</h1>
            </div>
        </div>
        <div>
            <?php         
                $connection = dbConnect ();
                $query = $connection -> prepare ("SELECT * FROM USERS WHERE active_account !=0"); 
                $query -> execute(); 
                $users = $query -> fetchAll ();                
            ?>
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
                </thead>
                <?php 
                    foreach ($users as $user) { //$user["moderator"] 1 = MODERATEUR  //$user["moderator"] 2 = ADMIN
                        if (($user["moderator"] != 1) AND ($user["moderator"] != 2) ){
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
                            echo "<td><a href='deleteUser.php?id=".$user["user_id"]."'>Supprimer</a><a href='updateUser.php?id=".$user["user_id"]."'>Modifier</a></td>";
                      
                             if ($_SESSION['moderator'] ==2 ){ //A MODIFIER
                                echo "<td><a href='updateModerator.php?id=".$user["user_id"]."'>Nommer modérateur</a></td>";
                                echo "</tr>";
                            }
                            echo "</tr>";

                        }
                    }
                
                ?>
            </table>
        </div>
         <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">INFORMATIONS MODERATEURS</h1>
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
                </thead>
                    <?php 
                        foreach ($users as $user) {
                            if (($user ["moderator"] ==1) OR ($user ["moderator"] ==2)  ){
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
                                if ($_SESSION['moderator']==2){
                                    if ($user ["moderator"] ==1){ // 2 = ADMIN
                                        echo "<td><a href='updateModerator.php?id=".$user["user_id"]."'>Retirer les droits</a></td>";
                                 
                                    }
                                }
                                echo "</tr>";
                            }
                        }               
                     ?>
              </table>

        </div>
       

        <hr>
<?php
    include "footer.php";
?>
