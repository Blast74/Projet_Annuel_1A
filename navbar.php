<?php
//a mettre dans tous les fichiers manuellement ou lib.php
//avant tous les affichages et les traitement (echo)
include "header.php";
require_once "admin/libSQL.php";
require_once "lib.php"
?>

 <link rel="stylesheet" href="player.css">
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">MUSIQUE REVIEW</a>
            </div>

<div id="wrapper" style="position: absolute; left : 40%; top: -9px">

    </div>

            <div id="Player0" style="display:inline-block;">
<!--                <div class="wrapper" >
                    <audio id="mytrack0">
                        <source src="audio/track0.mp3"  type="audio/mp3">
                    </audio>
                    <h4 id="title0">Burning room</h4>
                    <div class="lecteur">
                        <div id="defaultBar0" class="defaultBar">
                            <div id="progressBar0" class="progressBar">

                            </div>
                        </div>
                    <div id="buttons">
                    <button type="button" class="bouton play" id="playButton0" ></button>
                    <button type="button" class="bouton mute" id="muteButton0"></button>
                    <button type="button" class="bouton repeat" id="repeatButton0"></button>
                    <a target="_blank" href="audio/track0.mp3"  download="file.mp3">
                    <button type="button" class="bouton" id="downloadButton"></button></a>
                    <span id="currentTime0">0:00</span>/<span id="fullDuration0">0:00</span></div></div></div>
-->



            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a id="news" href="forum.php">NEWS et Forum</a>
                    </li>

                    <li>
                        <a href="music.php">MUSIQUES</a>
                    </li>

                    <?php
                         // A CHANGER PLUS TARD + PRESENTATION CSS
                        if ( !isset($_SESSION['id'])){
                            echo
                            '<li class="dropdown">
                                <a  class="dropdown-toggle" data-toggle="dropdown">Se connecter <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                     <li>
                                        <form method=POST action="connection.php">
                                            <label>Email:</label><br>
                                            <input type="email" name="email" placeholder="Votre email" required="required">
                                            <label>Mot de passe:</label><br>
                                            <input type="password" name="pwd" placeholder="Votre mot de passe" required="required">
                                            <input type="submit" value="Se connecter">
                                        </form>

                                    </li>
                                    <li>
                                </ul>
                            </li>'.
                            "<li>
                                <a href='inscription.php'>S'inscrire</a>
                            </li>";
                        }
                        //Affiche directement le nom de l'utilisateur si il est connecté
                        else if ((isset($_SESSION['id']))) {
                            echo '<li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">MON PROFIL <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li>
                                   <a href="libTrophy.php">Mes Trophés</a>
                               </li>
                                     <li>
                                        <a href="addMusic.php">Gérer mes musiques</a>
                                    </li>
                                    <li>
                                        <a href="account.php">Gérer mes informations personnelles</a>
                                    </li>
                                    <li>
                                        <a href="disconnect.php">Se déconnecter</a>
                                    </li>
                                </ul>
                            </li>';
                        }
                        if ((isset($_SESSION['id'])) && ((checkModerator($_SESSION["id"])) || (checkSuperModerator($_SESSION["id"])))) {  //MODERATEUR ==1 !!!
                            echo '<li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">ESPACE MODERATION<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                     <li>
                                        <a href="moderation.php">Gérer les utilisateurs</a>
                                    </li>
                                </ul>
                            </li>';
                        }

                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!--   <script src="java/radioControls.js"></script> -->


        <script src="forumJava.js"></script>

    </nav>
