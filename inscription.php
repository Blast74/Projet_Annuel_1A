<?php
    session_start ();
    include 'navbar.php';
    require_once "conf.inc.php";
    require_once "lib.php";
    require_once "admin/classUsers.php";
?>


    <div class="container">


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php
                        if (!(isset($_SESSION["id"]))) {
                            echo 'Inscrivez vous !';
                        }else{
                            echo "Modifier votre profil :";
                            $user = new User;
                            $user->createWithToken($_SESSION["id"]);
                        }
                     ?>
                </h1>

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

                    if (isset($_SESSION["id"])) {
                      $userInfo = "?&user_informations=update";
                    }else{
                      $userInfo = "?&user_informations=create";
                    }
                ?>

                <form method="POST" action=<?php echo "saveUser.php".$userInfo ?> >
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Prénom:</label>

                            <?php
                              if(isset($_SESSION["id"])){
                                echo   '<input type="text" name="firstname" placeholder="Votre prénom" class="form-control" required="required" value="'.$user->firstname.'">';
                              }else{
                                echo '<input type="text" name="firstname" placeholder="Votre prénom" class="form-control" required="required" value="'.((isset($_SESSION["form_post"]["firstname"]))?$_SESSION["form_post"]["firstname"]:"").'">';
                              }
                            ?>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nom:</label>
                            <?php
                              if(isset($_SESSION["id"])){
                                echo   '<input type="text" name="lastname" placeholder="Votre prénom" class="form-control" required="required" value="'.$user->lastname.'">';
                              }else{
                                echo '<input type="text" name="lastname" placeholder="Votre prénom" class="form-control" required="required" value="'.((isset($_SESSION["form_post"]["lastname"]))?$_SESSION["form_post"]["lastname"]:"").'">';
                              }
                            ?>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Pseudo<br>Entre 3 et 30 caractères</nav>:</label>
                            <?php
                              if(isset($_SESSION["id"])){
                                echo   '<input type="text" name="pseudo" placeholder="Votre prénom" class="form-control" required="required" value="'.$user->pseudo.'">';
                              }else{
                                echo '<input type="text" name="pseudo" placeholder="Votre prénom" class="form-control" required="required" value="'.((isset($_SESSION["form_post"]["pseudo"]))?$_SESSION["form_post"]["pseudo"]:"").'">';
                              }
                            ?>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Adresse email:</label>
                            <?php
                              if(isset($_SESSION["id"])){
                                echo   '<input type="text" name="email" placeholder="Votre prénom" class="form-control" required="required" value="'.$user->email.'">';
                              }else{
                                echo '<input type="text" name="email" placeholder="Votre prénom" class="form-control" required="required" value="'.((isset($_SESSION["form_post"]["email"]))?$_SESSION["form_post"]["email"]:"").'">';
                              }
                            ?>
                        </div>
                    </div>
                    <?php
                        if (isset($_SESSION["id"])) {

                            echo '
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Nouveau mot de passe:</label>
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
                                    </div>';
                        }
                     ?>
                    <!-- <div class="control-group form-group">
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
                    </div> -->
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Date de naissance:</label><br>
                            <?php
                              if(isset($_SESSION["id"])){
                                echo   '<input type="text" name="birthday" placeholder="Votre prénom" class="form-control" required="required" value="'.$user->birthday.'">';
                              }else{
                                echo '<input type="text" name="birthday" placeholder="Votre prénom" class="form-control" required="required" value="'.((isset($_SESSION["form_post"]["birthday"]))?$_SESSION["form_post"]["birthday"]:"").'">';
                              }
                            ?>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <label>Genre:</label><br>
                        <?php
                            foreach ($listOfGender as $key => $gender) {
                                echo "<label>";
                                echo $gender;
                                $defaultGender = ($user->gender)?$user->gender : $defaultGender;

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
                                    $selected =($user->country == $key)?"selected='selected'":"";
                                    echo "<option value='".$key."' ".$selected.">".$value."</option>";
                                }
                            ?>
                      </select>
                    </div>
                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary">
                        <?php
                            if (!(isset($_SESSION["id"]))) {
                                echo 'S\'inscrire';
                            }else{
                                echo "Modifier";
                            }
                         ?>
                    </button>
                </form>
            </div>

        </div>

        <?php
            include 'footer.php';
            unset($_SESSION["form_post"] );
            unset($_SESSION["form_errors"] );
            var_dump(get_defined_vars());
        ?>
