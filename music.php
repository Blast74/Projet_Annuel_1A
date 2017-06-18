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
    }
    include 'navbar.php';
?>


<button type="button" name="button" onclick="test(this)">TEST</button>


        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><?php echo  (isset ($verifyUser))? "Bonjour ".$verifyUser["pseudo"]." !": 'Bonjour !';?> </h2>
            </div>
            <div class="col-lg-12">
                <ul id="myTab" class="nav nav-tabs nav-justified">
                    <li class="active" onclick="tabNavigation (this)" id='top'><a href="#service-one" data-toggle="tab"><i class="fa fa-star-o" ></i>Les plus vus</a>
                    </li>
                    <li class="" onclick="tabNavigation(this)"  id='news'><a href="#service-two" data-toggle="tab"><i class="fa fa-exclamation" ></i> Les nouveautés</a>
                    </li>
                    <li class="" onclick="tabNavigation(this)" id='suggestion'><a href="#service-three" data-toggle="tab"><i class="fa fa-sliders"></i> Suggestions</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="service-one">
                        <h4>Les musiques du moment !</h4>
                        <div class="control-group form-group" onchange="MusicSubtypeList()">
                            <label>Genre :</label>
                            <select name="genre" id="topselectSyle">
                                <?php
                                foreach ($listOfGenre as $key => $value) {
                                     $selected =(isset($_SESSION["form_post"]["genre"]) && $_SESSION["form_post"]["genre"] == $key)?"selected='selected'":"";
                                    echo "<option value='".$key."' ".$selected.">" .$value."</option>";
                                }
                                ?>
                          </select>
                        </div>
                        <div id='topSubtypeDiv'class="control-group form-group"></div>

                        <section id='topaudiocontainer0'>
                          <p id=topmusicTitle0></p>
                          <audio id="topplayer0" src='' controls =''></audio>
                        </section>


                        <section id='topaudiocontainer1'>
                          <p id=topmusicTitle1></p>
                          <audio id="topplayer1" src='' controls =''></audio>
                        </section>

                        <section id='topaudiocontainer2'>
                          <p id=topmusicTitle2></p>
                          <audio id="topplayer2" src='' controls =''></audio>
                        </section>

                        <section id='topaudiocontainer3'>
                          <p id=topmusicTitle3></p>
                          <audio id="topplayer3" src='' controls =''></audio>
                        </section>

                        <section id='topaudiocontainer4'>
                          <p id=topmusicTitle4></p>
                          <audio id="topplayer4" src='' controls =''></audio>
                        </section>
                        
                        <div> <!--Menu de navigation Précédent/suivant -->
                          <ul id="topnavigation" class="pager">
                            <li id="toppreviousContainer">
                              <!--<a id="previousButton" onclick="navigationButton('previous')">Précédant</a>-->
                            </li>
                            <li id="topnextContainer">
                              <a id="topnextButton" onclick="navigationButton('next')">Suivant</a>
                            </li>
                          </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="service-two">
                        <h4>Les dernières sorties musicales !</h4>
                        <div class="control-group form-group" onchange="MusicSubtypeList()">
                            <label>Genre :</label>
                            <select name="genre" id="newsselectSyle">
                                <?php
                                foreach ($listOfGenre as $key => $value) {
                                     $selected =(isset($_SESSION["form_post"]["genre"]) && $_SESSION["form_post"]["genre"] == $key)?"selected='selected'":"";

                                    echo "<option value='".$key."' ".$selected.">" .$value."</option>";
                                }
                                ?>
                          </select>
                        </div>
                        <div id='newsSubtypeDiv'class="control-group form-group"></div>
                        <section id='newsaudiocontainer0'>
                          <p id=newsmusicTitle0></p>
                          <audio id="newsplayer0" src='' controls =''></audio>
                        </section>
                        <section id='newsaudiocontainer1'>
                          <p id=newsmusicTitle1></p>
                          <audio id="newsplayer1" src='' controls =''></audio>
                        </section>
                        <section id='newsaudiocontainer2'>
                          <p id=newsmusicTitle2></p>
                          <audio id="newsplayer2" src='' controls =''></audio>
                        </section>
                        <section id='newsaudiocontainer3'>
                          <p id=newsmusicTitle3></p>
                          <audio id="newsplayer3" src='' controls =
                          ''></audio>
                        </section>
                        <section id='newsaudiocontainer4'>
                          <p id=newsmusicTitle4></p>
                          <audio id="newsplayer4" src='' controls =''></audio>
                        </section>
                        <div> <!--Menu de navigation Précédent/suivant -->
                          <ul id="newsnavigation" class="pager">
                            <li id="newspreviousContainer">
                              <!--<a id="previousButton" onclick="navigationButton('previous')">Précédant</a>-->
                            </li>
                            <li id="newsnextContainer">
                              <a id="newsnextButton" onclick="navigationButton('next')">Suivant</a>
                            </li>
                          </ul>
                      </div>
                    </div>



                  <!--Ne pas afficher si l'utilisateur n'est pas connecté -->
                    <div class="tab-pane fade" id="service-three">
                        <h4>Des musiques rien que pour vous !</h4>
                        <div class="control-group form-group" onchange="MusicSubtypeList()">
                            <label>Genre :</label>
                            <select name="genre" id="suggestionselectSyle">
                                <?php
                                foreach ($listOfGenre as $key => $value) {
                                     $selected =(isset($_SESSION["form_post"]["genre"]) && $_SESSION["form_post"]["genre"] == $key)?"selected='selected'":"";

                                    echo "<option value='".$key."' ".$selected.">" .$value."</option>";
                                }
                                ?>
                          </select>
                        </div>

                        <div id='suggestionSubtypeDiv'class="control-group form-group"></div>

                        <section id='suggestionaudiocontainer0'>
                          <p id=suggestionmusicTitle0></p>
                          <audio id="suggestionplayer0" src='' controls =''></audio>
                        </section>
                        <section id='suggestionaudiocontainer1'>
                          <p id=suggestionmusicTitle1></p>
                          <audio id="suggestionplayer1" src='' controls =''></audio>
                        </section>
                        <section id='suggestionaudiocontainer2'>
                          <p id=suggestionmusicTitle2></p>
                          <audio id="suggestionplayer2" src='' controls =''></audio>
                        </section>
                        <section id='suggestionaudiocontainer3'>
                          <p id=suggestionmusicTitle3></p>
                          <audio id="suggestionplayer3" src='' controls =
                          ''></audio>
                        </section>
                        <section id='suggestionaudiocontainer4'>
                          <p id=suggestionmusicTitle4></p>
                          <audio id="suggestionplayer4" src='' controls =''></audio>
                        </section>
                        <div> <!--Menu de navigation Précédent/suivant -->
                          <ul id="suggestionnavigation" class="pager">
                            <li id="suggestionpreviousContainer">
                              <!--<a id="previousButton" onclick="navigationButton('previous')">Précédant</a>-->
                            </li>
                            <li id="suggestionnextContainer">
                              <a id="suggestionnextButton" onclick="navigationButton('next')">Suivant</a>
                            </li>
                          </ul>
                      </div>
                    </div>
                    <!-- -->
                    </div>
                    </div>
                </div>
            </div>
      </div>

<script src="music_conf/getMusics.js"></script>
<script>
  var ListOfSubtype = <?php echo json_encode($subtypeList); ?>;
  MusicSubtypeList ();
  MusicSelection();
</script>

<?php
  include 'footer.php';
?>
