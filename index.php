<?php
    session_start();
    require "navbar.php";
    if (isset($_SESSION["inscription"])) {
      if ($_SESSION["inscription"] == "Email") {
        echo ('<div class="alert alert-warning">
        <strong>Attention !</strong> Un mail de confirmation vous a été envoyé pour activer votre compte.
        </div>');
      }
      if ($_SESSION["inscription"] == "OK") {
        echo '<div class="alert alert-success">
              <strong>Félicitation !</strong> Votre compte est activé.
              </div>';
      }
    }
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
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/carousel2.jpg');"></div>
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/carousel3.jpg');"></div>
                <div class="carousel-caption">
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
                    Chansons les mieux notées :
                </h1>
            </div>
            <?php
            $indexplayer = getIndexMusics ();


              if (!empty ($indexplayer[0])) {
              echo   '<div class="col-md-4">';
                echo     '<div class="panel panel-default">';
                    echo    ' <div class="panel-heading">';
                      echo       '<h4><i class="fa fa-fw fa-check"></i>'.$indexplayer[0]["music_name"].'</h4>';
                    echo    '</div>';
                    echo    '<audio src="'.$indexplayer[0]["upload_music"].'" controls=""></audio>';
                  echo  '</div>';
              echo ' </div>';
              }

              if (!empty ($indexplayer[1])) {
              echo   '<div class="col-md-4">';
                echo     '<div class="panel panel-default">';
                    echo    ' <div class="panel-heading">';
                      echo       '<h4><i class="fa fa-fw fa-check"></i>'.$indexplayer[1]["music_name"].'</h4>';
                    echo    '</div>';
                    echo    '<audio src="'.$indexplayer[1]["upload_music"].'" controls=""></audio>';
                  echo  '</div>';
              echo ' </div>';
              }


              if (!empty ($indexplayer[2])) {
              echo   '<div class="col-md-4">';
                echo     '<div class="panel panel-default">';
                    echo    ' <div class="panel-heading">';
                      echo       '<h4><i class="fa fa-fw fa-check"></i>'.$indexplayer[2]["music_name"].'</h4>';
                    echo    '</div>';
                    echo    '<audio src="'.$indexplayer[2]["upload_music"].'" controls=""></audio>';
                  echo  '</div>';
              echo ' </div>';
              }



             ?>
        </div>

        <div class="row">
            <div class="col-lg-12">
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive " src="images/image1.jpg"; alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive" src="images/image2.jpg"; alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive " src="images/image3.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive i" src="images/image4.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive " src="images/image5.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.php">
                    <img class="img-responsive " src="images/image6.jpg" alt="">
                </a>
            </div>
        </div>

<?php
    unset($_SESSION["inscription"]);
    include 'footer.php';

?>
