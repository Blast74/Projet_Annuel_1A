<?php
//a mettre dans tous les fichiers manuellement ou lib.php
//avant tous les affichages et les traitement (echo)
include "header.php";
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
                        <a href="news.php">NEWS</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown"> MUSIQUES <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="music.php"> Musiques récentes </a> <!-- Se déconnecté si déjà connecté -->
                            </li>
                            <li>
                                <a href="music.php"> Rock </a>
                            </li>
                            <li>
                                <a href="music.php"> Rap </a>
                            </li>
                            <li>
                                <a href="music.php"> Electro </a>
                            </li>
                            <li>
                                <a href="music.php"> Musiques...</a>
                            </li>
                        </ul>
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
                        else if ((isset($_SESSION['id'])) &&  ($_SESSION['moderator'] == 0) ) {
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
                         else if ((isset($_SESSION['id'])) &&  ($_SESSION['moderator'] == 1) OR ($_SESSION['moderator'] == 2)  ) {  //MODERATEUR ==1 !!!
                            echo '<li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">ESPACE MODERATION <b class="caret"></b></a>
                                <ul class="dropdown-menu">

                                     <li>
                                        <a href="moderation.php">Gérer les utilisateurs</a>
                                    </li>
                                    <li>
                                        <a href="disconnect.php">Se déconnecter</a>
                                    </li>
                                </ul>
                            </li>';
                        }

                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
