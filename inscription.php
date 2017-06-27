<?php
    session_start ();
    include 'navbar.php';
    require_once "conf.inc.php";
    require_once "lib.php";
    require_once "admin/classUsers.php";
    if(isset($_SESSION["inscription"])){
      if ($_SESSION["inscription"] = "notEmail") {
        echo '<div class="alert alert-warning">
                <strong>Attention !</strong> Votre email n\'existe pas ou n\'est pas accessible.
              </div>';
      }
    }
?>


    <div class="container">


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php
                        $user = new User;
                        $url = "";
                        if (!(isset($_SESSION["id"]))) {
                            echo 'Inscrivez vous !';
                            $url = "";
                        }else{
                            echo "Modifier votre profil :";
                            $user->createWithToken($_SESSION["id"]);
                            $url = "&modif_email=".$user->email."&token=".$user->access_token;
                        }
                     ?>
                </h1>

     </div>
        </div>
        <!-- FORMULAIRE -->
        <div class="row">
            <div class="col-md-8">
                <?php //Affichage des erreurs s'il y en a
                    echo '<div "alert alert-danger">';
                    if (isset ($_SESSION["form_errors"])){
                        foreach ($_SESSION["form_errors"] as $error)
                        {
                            echo "<li>".$errors[$error];
                        }
                    }
                    echo "</div>";
                ?>

                <form method="POST" action=<?php echo "saveUser.php?&user_informations=create".$url ?> >
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Prénom:</label>

                            <?php
                              if(isset($_SESSION["id"])){
                                echo   '<input type="text" name="firstname" placeholder="Votre prénom" class="form-control" value="'.$user->firstname.'">';
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
                                echo   '<input type="text" name="lastname" placeholder="Votrenom" class="form-control" value="'.$user->lastname.'">';
                              }else{
                                echo '<input type="text" name="lastname" placeholder="Votre nom" class="form-control" required="required" value="'.((isset($_SESSION["form_post"]["lastname"]))?$_SESSION["form_post"]["lastname"]:"").'">';
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
                                echo   '<input type="text" name="pseudo" placeholder="Votre pseudo" class="form-control" value="'.$user->pseudo.'">';
                              }else{
                                echo '<input type="text" name="pseudo" placeholder="Votre pseudo" class="form-control" required="required" value="'.((isset($_SESSION["form_post"]["pseudo"]))?$_SESSION["form_post"]["pseudo"]:"").'">';
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
                                echo   '<input type="text" name="email" placeholder="Votre email" class="form-control" value="'.$user->email.'">';
                              }else{
                                echo '<input type="text" name="email" placeholder="Votre email" class="form-control" required="required" value="'.((isset($_SESSION["form_post"]["email"]))?$_SESSION["form_post"]["email"]:"").'">';
                              }
                            ?>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Date de naissance:</label><br>
                            <?php
                              if(isset($_SESSION["id"])){
                                echo   '<input type="date" name="birthday" placeholder="Votre date de naissance" class="form-control" value="'.$user->birthday.'">';
                              }else{
                                echo '<input type="date" name="birthday" placeholder="Votre date de naissance" class="form-control" required="required" value="'.((isset($_SESSION["form_post"]["birthday"]))?$_SESSION["form_post"]["birthday"]:"").'">';
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
                                $defaultGender = (isset($user->gender))?$user->gender : 'm';

                                if ($key == 'm'){
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
                    <div class="control-group form-group">
<?php
    if (isset($_SESSION["id"])) {


                // <div class="control-group form-group">
                //     <div class="controls">
                //         <label>Nouveau mot de passe:</label>
                //         <input type="password" name="pwd" placeholder="Votre mot de passe" class="form-control">
                //         <p class="help-block"></p>
                //     </div>
                // </div>
                // <div class="control-group form-group">
                //     <div class="controls">
                //         <label>Confirmation du mot de passe:</label>
                //         <input type="password" name="pwd2" placeholder="Confirmez mot de passe" class="form-control">
                //         <p class="help-block"></p>
                //     </div>
                // </div>
        echo '
                <a href="changePwd.php?user_informations=activate&pseudo='.$user->pseudo.'&access_token='.$user->access_token.'"><input class="btn btn-primary" type="button" name="pwd" value="Changer mot de passe"></a>
                <br />    ';
    }
 ?>
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
            unset($_SESSION["inscription"]);

        ?>
