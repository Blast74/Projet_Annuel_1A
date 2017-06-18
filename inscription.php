<?php
    session_start ();
    include 'navbar.php';
    require_once "conf.inc.php";
?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inscrivez vous !</h1>
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
                }
                echo "</div>";
                ?>
                <form method="POST" action="saveUser.php" >
                    <input type="hidden" name="user_informations" value="create">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Prénom:</label>
                            <input type="text" name="firstname" placeholder="Votre prénom" class="form-control" required="required" value="<?php echo (isset($_SESSION["form_post"]["firstname"]))?$_SESSION["form_post"]["firstname"]:""; ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nom:</label>
                            <input type="text" name="lastname" placeholder="Votre nom" class="form-control" required="required" value="<?php echo (isset($_SESSION["form_post"]["lastname"]))?$_SESSION["form_post"]["lastname"]:""; ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Pseudo<br>Entre 3 et 30 caractères</nav>:</label>
                            <input type="text" name="pseudo" placeholder="Votre pseudo" class="form-control" required="required" value="<?php echo (isset($_SESSION["form_post"]["pseudo"]))?$_SESSION["form_post"]["pseudo"]:""; ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Adresse email:</label>
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
                        <div class="controls">
                            <label>Date de naissance:</label><br>
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
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>

        </div>

        <?php
            include 'footer.php';
            unset($_SESSION["form_post"] );
            unset($_SESSION["form_errors"] );
        ?>
