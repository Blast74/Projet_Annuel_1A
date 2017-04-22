<?php
        //Déconnection si l'utilisateur n'est pas modérateur  
    session_start();
    require "conf.inc.php";
    include "lib.php";
    VerifyModerator ();
    /*
    if (isset($_SESSION['id'])) {
        if ($_SESSION['moderator'] != 1) {
            $NoModerator = true;
        }
        else if ($_SESSION['moderator'] == 1) {
            $NoModerator = false;
        }
    }
    else {
        header("Location: index.php");  // modifier navbar et lib.php  il faut la redirection soit faite avant le traitement
        exit ();
    }
    */
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
                        foreach ($users as $user) {
                            if ($user ["moderator"] != 1){
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
                                $supermodo =1;
                                 if ($supermodo ==1){ //A MODIFIER
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


                            //SUPERMODERATOR: à remplacer par du JS
                            $supermodo = 1;



                            if (($user ["moderator"] ==1) OR ($user ["moderator"] ==3)  ){
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
                                if (($supermodo ==1) AND ($user ["moderator"] !=3) ){ //A MODIFIER
                                    echo "<td><a href='deleteUser.php?id=".$user["user_id"]."'>Supprimer</a></td>";
                                    echo "</tr>";
                                }
                            }
                        }
                
                ?>
              </table>

        </div>
       

        <hr>
<?php
    include "footer.php";
?>
