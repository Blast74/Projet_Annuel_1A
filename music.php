<?php
    session_start();
    setcookie ("access", $_SESSION['id']);
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


        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header  "><?php echo  (isset ($verifyUser))? "Bonjour ".$verifyUser["pseudo"]." !": 'Bonjour !';?> </h3>
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
                            <select class="selectpicker" name="genre" id="topselectSyle">
                                <?php
                                foreach ($listOfGenre as $key => $value) {
                                     $selected =(isset($_SESSION["form_post"]["genre"]) && $_SESSION["form_post"]["genre"] == $key)?"selected='selected'":"";
                                    echo "<option value='".$key."' ".$selected.">" .$value."</option>";
                                }
                                ?>
                          </select>
                        </div>
                        <div id='topSubtypeDiv'class="control-group form-group"></div>

                        <section class="well" id='top-audiocontainer-0'>
                          <p id=top-musicTitle-0 class='center-block'></p>
                          <audio id="top-player-0" src='' controls =''></audio>
                        </section>


                        <section class="well1" id='top-audiocontainer-1'>
                          <p id=top-musicTitle-1></p>
                          <audio id="top-player-1" src='' controls =''></audio>
                        </section>

                        <section class="well" id='top-audiocontainer-2'>
                          <p id=top-musicTitle-2></p>
                          <audio id="top-player-2" src='' controls =''></audio>
                        </section>

                        <section class="well1" id='top-audiocontainer-3'>
                          <p id=top-musicTitle-3></p>
                          <audio id="top-player-3" src='' controls =''></audio>
                        </section>

                        <section class="well" id='top-audiocontainer-4'>
                          <p id=top-musicTitle-4></p>
                          <audio id="top-player-4" src='' controls =''></audio>
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
                        <section class="well1" id='news-audiocontainer-0'>
                          <p id=news-musicTitle-0></p>
                          <audio id="news-player-0" src='' controls =''></audio>
                        </section>
                        <section class="well" id='news-audiocontainer-1'>
                          <p id=news-musicTitle-1></p>
                          <audio id="news-player-1" src='' controls =''></audio>
                        </section>
                        <section class="well1"  id='news-audiocontainer-2'>
                          <p id=news-musicTitle-2></p>
                          <audio id="news-player-2" src='' controls =''></audio>
                        </section>
                        <section class="well" id='news-audiocontainer-3'>
                          <p id=news-musicTitle-3></p>
                          <audio id="news-player-3" src='' controls =
                          ''></audio>
                        </section>
                        <section class="well1" id='news-audiocontainer-4'>
                          <p id=news-musicTitle-4></p>
                          <audio id="news-player-4" src='' controls =''></audio>
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

                        <section  class="well" id='suggestion-audiocontainer-0'>
                          <p id=suggestion-musicTitle-0></p>
                          <audio id="suggestion-player-0" src='' controls =''></audio>
                        </section>
                        <section class="well1" id='suggestion-audiocontainer-1'>
                          <p id=suggestion-musicTitle-1></p>
                          <audio id="suggestion-player-1" src='' controls =''></audio>
                        </section>
                        <section  class="well" id='suggestion-audiocontainer-2'>
                          <p id=suggestion-musicTitle-2></p>
                          <audio id="suggestion-player-2" src='' controls =''></audio>
                        </section>
                        <section class="well1" id='suggestion-audiocontainer-3'>
                          <p id=suggestion-musicTitle-3></p>
                          <audio id="suggestion-player-3" src='' controls =
                          ''></audio>
                        </section>
                        <section  class="well" id='suggestion-audiocontainer-4'>
                          <p id=suggestion-musicTitle-4></p>
                          <audio id="suggestion-player-4" src='' controls =''></audio>
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

<button type="button" name="button" onclick='test()'>TST</button>
<script src="music_conf/getMusics.js"></script>
<script>
  var ListOfSubtype = <?php echo json_encode($subtypeList); ?>;
  MusicSubtypeList ();
  MusicSelection();
</script>

<?php
  include 'footer.php';
?>
