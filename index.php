<?php 
    include "navbar.php";
 ?>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('images/carousel1.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Artiste de la semaine</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/carousel2.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Album de la semaine</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/carousel3.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Whatever de la semaine</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Articles les plus vus
                </h1>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i>Article 1</h4>
                    </div>
                    <div class="panel-body">
                        <p>Sélection des articles dans la BDD</p>
                        <a href="news.php" class="btn btn-default">En savoir plus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i>Article 2</h4>
                    </div>
                    <div class="panel-body">
                        <p>Article 2...</p>
                        <a href="news.php" class="btn btn-default">En savoir plus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i>Article 3</h4>
                    </div>
                    <div class="panel-body">
                        <p>Article 3...</p>
                        <a href="news.php" class="btn btn-default">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">MISE EN AVANT DES UTILISATEURS suivant les goûts du User connecté</h2><!--Varie en fonction de ce qu'il y a en BDD-->
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive img-portfolio img-hover" src="images/image1.jpg"; " alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive img-portfolio img-hover" src="images/image2.jpg"; alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive img-portfolio img-hover" src="images/image3.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive img-portfolio img-hover" src="images/image4.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive img-portfolio img-hover" src="images/image5.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive img-portfolio img-hover" src="images/image6.jpg" alt="">
                </a>
            </div>
        </div>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Sélection de la semaine</h2>
            </div>
            <div class="col-md-6">
                <p>Les principales informations de la semaine:</p>
                <ul>
                    <li>Le lama qui s'évade de prison</li>
                    <li>David Ghetta arrête la drogue</li>
                    <li>Le dernier film de Marvel n'a aucun sens</li>
                    <li>Encore un concert réussi pour M.Pokora, mais jusqu'où va t-il aller</li>
                    <li>Les vidéos de chatton font rire les grand-mères</li>
                    <li>Coca Cola dévoile sa recette, ça va vous étonner</li>
                </ul>
                <p>Encore une semaine riche en rebondissement</p>
            </div>
            <div class="col-md-6">
                <img class="img-responsive" src="images/image7.jpg" alt=""> <!-- 700X450-->
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <hr>

<?php
    include 'footer.php';
?>
  