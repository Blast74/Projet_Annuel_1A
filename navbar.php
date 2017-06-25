<?php
//a mettre dans tous les fichiers manuellement ou lib.php
//avant tous les affichages et les traitement (echo)
include "header.php";
require_once "admin/libSQL.php";
require_once "admin/libModOne.php";
require_once "lib.php";
?>


<body>
    <!-- menu -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- REGARDER A QUOI CA SERT ??? -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">MUSIQUE REVIEW</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a href="music.php">MUSIQUES</a>
                    </li>
                    <?php
                         // A CHANGER PLUS TARD + PRESENTATION CSS
                        if ( !isset($_SESSION['id'])){
                            echo '
                              <li class="dropdown">
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
                                        <a href="inscription.php">Gérer mes informations personnelles</a>
                                    </li>
                                    <li>
                                        <a href="disconnect.php">Se déconnecter</a>
                                    </li>
                                </ul>
                            </li>';
                        }

                        if ((!empty($_SESSION['id']))) {  //MODERATEUR <=1
                            $checkMod  = checkMod($_SESSION["id"]);
                            if ($checkMod[0]) {
                                echo '<li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">ESPACE MODERATION<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                         <li>
                                            <a href="moderation.php">Gérer les utilisateurs</a>
                                        </li>
                                    </ul>
                                </li>';
                            }
                        }
                        echo ' <li class="dropdown">
                                    <a href="http://www.esgi.fr/ecole-informatique.html">Notre école</a>
                                </li>';
                        // var_dump($_SESSION["id"]);
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
