<?php
    session_start();

    require_once "lib.php";
    require_once "conf.inc.php";

    //Il faut alléger la fonction de vérification ??
    if (!empty ($_SESSION["id"])) {
      $verifyUser = getUser ($_SESSION["id"]);
      if ($verifyUser == false){ //Si le token ne correspond pas à celui de l'utilisateur en BDD
        header("Location: disconnect.php");
        die ();
      }
    }else {
      header("Location: index.php");
      die ();
    }

    include 'navbar.php';

?>
    <div class="container">
    <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ajout d'une musique</h1>
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
                if (isset ($_SESSION["form_message"])){

                    foreach ($_SESSION["form_message"] as $message)
                    {
                        echo "<li>".$messages[$message];
                    }
                }
                echo "</div>";
                ?>
                <form method="POST" action="music_conf/saveMusic.php"  enctype="multipart/form-data" onsubmit="return verifForm(this);">
                  <!-- ONSUBMIT = RETURN VERIF () -->
                <!--enctype = nécessaire pour uploader sinon $_FILES est null -->
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Titre :</label>
                            <input type="text" name="titre" placeholder="Titre" class="form-control" required="required" value="<?php echo (isset($_SESSION["form_post"]["titre"]))?$_SESSION["form_post"]["titre"]:""; ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Album (Optionnel) :</label>
                            <input type="text" name="album" placeholder="Album" class="form-control" value="<?php echo (isset($_SESSION["form_post"]["artist"]))?$_SESSION["form_post"]["artist"]:""; ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Commentaire de l'auteur (Optionnel) :</label>
                            <input type="text" name="comment" placeholder="Votre commentaire" class="form-control" value="<?php echo (isset($_SESSION["form_post"]["comment"]))?$_SESSION["form_post"]["comment"]:""; ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>


                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Paroles (Optionnel) :</label>
                            <textarea name="lyrics" placeholder="Paroles..." class="form-control" value="<?php echo (isset($_SESSION["form_post"]["lyrics"]))?$_SESSION["form_post"]["lyrics"]:""; ?>"></textarea>
                            <p class="help-block"></p>
                        </div>
                    </div>


                    <div class="control-group form-group" onchange="MusicSubtypeList()">
                        <label>Genre :</label>
                        <select name="genre" id="selectSyle">
                            <?php
                            foreach ($listOfGenre as $key => $value) {
                                 $selected =(isset($_SESSION["form_post"]["genre"]) && $_SESSION["form_post"]["genre"] == $key)?"selected='selected'":"";
                                echo "<option value='".$key."' ".$selected.">" .$value."</option>";
                            }

                            ?>
                      </select>


                    </div>

                    <div id='SubtypeDiv'class="control-group form-group"></div>

                    <label>Sélectionner le fichier à ajouter:</label>
                    <input type="file" name="music" accept=".mp3"/>


                    <label>Ajoutez une image pour votre musique (Optionnel) :</label>
                    <input type="file" name="img" accept=".png,.jpg,.jpeg" />

                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
        <script src="music_conf/addMusic.js"></script>
        <script>
            var ListOfSubtype = <?php echo json_encode($subtypeList); ?>;
        </script>


        <?php
            include 'footer.php';
            unset($_SESSION["form_post"] );
            unset($_SESSION["form_errors"] );
            unset($_SESSION ["form_message"]);
        ?>
