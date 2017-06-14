<?php
    session_start();
    include 'navbar.php';
    require_once "lib.php";
    require_once "conf.inc.php";
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
                <form method="POST" action="saveMusic.php"  enctype="multipart/form-data">
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
                        <label>Genre :</label><br>
                        <select name="genre" id="selectSyle">
                            <?php
                            foreach ($listOfGenre as $key => $value) {
                                 $selected =(isset($_SESSION["form_post"]["genre"]) && $_SESSION["form_post"]["genre"] == $key)?"selected='selected'":"";

                                echo "<option value='".$key."' ".$selected.">" .$value."</option>";
                            }
                            ?>
                      </select>

                    </div>


                    <div id='SubtypeDiv'class="control-group form-group">

                    </div>

                    <label>Sélectionner le fichier à ajouter:</label><br>
                    <input type="file" name="music" accept=".mp3"/>


                    <label>Ajoutez une image pour votre musique (Optionnel) :</label><br>
                    <input type="file" name="img" accept=".png,.jpg,.jpeg" />

                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
      <button type="button"  onclick="test ()"name="button">TEST</button>
        </div>



        <script src="addMusic.js"></script>
        <script>
            var ListOfSubtype = <?php echo json_encode($subtypeList); ?>; //A CHANGER PAR DU AJAX
        </script>


        <?php
            include 'footer.php';
            unset($_SESSION["form_post"] );
            unset($_SESSION["form_errors"] );
            unset($_SESSION ["form_message"]);
        ?>
