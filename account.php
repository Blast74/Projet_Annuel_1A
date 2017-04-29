<?php
    session_start();
    include "navbar.php";
    include "lib.php";

?>

    
    <div class="container">

       
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mes informations</h1>
            </div>
        </div>
        <div>
            <?php 
                $connection = dbConnect ();
                $query = $connection -> prepare ("SELECT * FROM USERS WHERE active_account=1"); 
                $query -> execute(); 
                $users = $query -> fetchAll (); //PAS DE FETCHALL
            ?>
            <table> 
                <thead>
                    <tr> <!-- A MODIFIER POUR AVOIR LES BONNES VALEURS-->
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Date d'anniversaire</th>
                        <th>Genre</th>
                        <th>Pays</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                    <?php  // A MODIFIER POUR AVOIR LES BONNES DONNEES
                        foreach ($users as $user) {
                            echo "<tr>";
                            echo "<td>".$user["id"]."</td>";
                            echo "<td>".$user["pseudo"]."</td>";
                            echo "<td>".$user["email"]."</td>";
                            //date
                            echo "<td>".date ("d/m/Y", strtotime($user["birthday"]))."</td>";
                            //strtotime (secondes par rapport au 1er janvier 1970)
                            //date ("format", time ...) affiche une date avec le format voulu
                            echo "<td>".$listOfGender[$user["gender"]]."</td>"; //Affiche 'Homme' au lieu de 'm'
                            echo "<td>".$listOfCountry[$user["country"]]."</td>";
                            echo "<td>".$user["comment"]."</td>";
                            echo "<td>".$listOfStatus[$user["status"]]."</td>"; 
                            //Lien vers deleteUser.php?+id de l'utilisateur à supprimer
                            echo "<td><a href='deleteUser.php?id=".$user["id"]."'>Supprimer</a><a href='updateUser.php?id=".$user["id"]."'>Modifier</a></td>";
                            echo "</tr>";
                        }
                ?>
              </table>

        </div>
       

        <hr>
<?php
    include "footer.php";
?>
