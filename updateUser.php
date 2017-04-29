<?php
    session_start();
    include 'navbar.php';
    require "lib.php";
    require_once "conf.inc.php";
    //Récupération des informations de l'utilisateur 
    if (!empty($_GET["id"]) && count ($_GET)==1 && is_numeric($_GET["id"]) ){
    $connection = dbConnect ();
    $query = $connection -> prepare ("SELECT * FROM USERS WHERE user_id=:id");
    $query -> execute ($_GET);//$_GET contient un id d'utilisateur
    //Alimenter le tableau data avec le contenu de la BDD
    $result = $query -> fetch();
    $data = [ //Les données de data permettent de mettre les valeurs de la BDD dans les champs du formulaire 
    "user_id"=>$result["user_id"], 
      "email"=>$result["email"],
      "pseudo"=>$result["pseudo"],
      "gender"=>$result["gender"],
      "firstname"=>$result["firstname"],
      "lastname"=>$result["lastname"],
      "birthday"=>$result["birthday"],
      "country"=>$result["country"],   
      "pwd"=>$result["pwd"],
      "update_date"=>$result["gender"],
      "active_account"=>$result["active_account"]  
    ];
   }

var_dump($_SESSION['form_errors']);




?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">MODIFIER LES INFORMATIONS</h1>              
            </div>
        </div>
        <!-- FORMULAIRE -->
        <div class="row">
            <div class="col-md-8">
                <?php //Affichage des erreurs s'il y en a
                echo '<div class="control-group form-group">';
                
                if (isset ($_SESSION["form_errors"])){      
                    foreach ($_SESSION["form_errors"] as $error)
                    {
                        echo "<li>".$errors[$error];     
                    }
                     $data = $_SESSION["form_post"]; 
                }
                echo "</div>";
                ?>

                <form method="POST" action="saveUser.php?id=<?php echo $_GET['id']?>">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label><?php echo "Prénom : ".$data["firstname"]; ?></label>
                            <input type="text" name="firstname" placeholder="Votre prénom" class="form-control" required="required" value="<?php echo (isset($_SESSION["form_post"]["firstname"]))?$_SESSION["form_post"]["firstname"]:""; ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label><?php echo "Nom : ".$data["lastname"]; ?></label>
                            <input type="text" name="lastname" placeholder="Votre nom" class="form-control" required="required" value="<?php echo (isset($_SESSION["form_post"]["lastname"]))?$_SESSION["form_post"]["lastname"]:""; ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label><?php echo "Pseudo : ".$data["pseudo"]; ?></label>
                            <input type="text" name="pseudo" placeholder="Votre pseudo" class="form-control" required="required" value="<?php echo (isset($_SESSION["form_post"]["pseudo"]))?$_SESSION["form_post"]["pseudo"]:""; ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label><?php echo "Adresse email : ".$data["email"]; ?></label>
                            <input type="email" name="email" placeholder="Votre email" class="form-control" id="phone" required="required" value="<?php echo (isset($_SESSION["form_post"]["email"]))?$_SESSION["form_post"]["email"]:""; ?>">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mot de passe:</label>
                            <input type="password" name="pwd" placeholder="Votre mot de passe" required="required" class="form-control">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Confirmation du mot de passe:</label>
                            <input type="password" name="pwd2" placeholder="Confirmez mot de passe" required="required" class="form-control">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls"><!--MODIFIER L'AFFICHAGE -->
                            <label><?php echo "Date de naissance : ".$data["birthday"]; ?></label><br>
                            <input type="date" name="birthday" placeholder="année-mois-jour" required="required" value="<?php echo (isset($_SESSION["form_post"]["birthday"]))?$_SESSION["form_post"]["birthday"]:""; ?>">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <label>Genre:</label><br>
                        <?php
                        foreach ($listOfGender as $key => $gender) {
                            echo "<label>";
                            echo $gender;
                            $defaultGender = (isset ($_SESSION ["form_post"]["gender"]) )?$_SESSION ["form_post"]["gender"]: $defaultGender;

                            if ($key == $defaultGender){
                                echo "<input type='radio' name='gender' value='".$key."' checked='checked'>";
                            }
                            else{
                                echo "<input type='radio' name='gender' value='".$key."'>";
                            }
                            echo "</label>";
                        }
                        ?>
                    </div>
                    <div class="control-group form-group">
                        <label>Pays:</label><br>
                        <select name="country">
                            <?php
                            foreach ($listOfCountry as $key => $value) {
                                 $selected =(isset($_SESSION["form_post"]["country"]) && $_SESSION["form_post"]["country"] == $key)?"selected='selected'":"";

                                echo "<option value='".$key."' ".$selected.">" .$value."</option>";
                            } 
                            ?>
                      </select>
                    </div>
                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary">Effectuer les modifications</button>
                </form>
            </div>

        </div>


        <?php
            include 'footer.php';
            unset($_SESSION["form_post"] ); 
            unset($_SESSION["form_errors"] );
        ?>




    