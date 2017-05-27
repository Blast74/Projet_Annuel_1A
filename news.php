<?php
    session_start();    
    include 'navbar.php';
?>
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Articles récents
                  
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Acceuil</a>
                    </li>
                    <li class="active">Articles récents</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- First Blog Post -->
                <h2>
                    <a href="articles.php">C'était mieux avant</a>
                </h2>
                
                <p><i class="fa fa-clock-o"></i> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <a href="articles.php">
                    <img class="img-responsive img-hover" src="images/900x300.jpg" alt="">
                </a>
                <hr>
                <p>C'était mieux avant</p>
                <a class="btn btn-primary" href="articles.php">En savoir plus <i class="fa fa-angle-right"></i></a>

                <hr>

                <!-- Second Blog Post -->
                <h2>
                    <a href="articles.php">C'est mieux maintenant</a>
                </h2>
                
                <p><i class="fa fa-clock-o"></i> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <a href="articles.php">
                    <img class="img-responsive img-hover" src="images/900x300.jpg" alt="">
                </a>
                <hr>
                <p>Oh oui oui, bien mieux...</p>
                <a class="btn btn-primary" href="articles.php">En savoir plus <i class="fa fa-angle-right"></i></a>

                <hr>

                <!-- Third Blog Post -->
                <h2>
                    <a href="articles.php">Après une longue absence, Mozart revient avec un nouvel album</a>
                </h2>
                
                <p><i class="fa fa-clock-o"></i> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <a href="articles.php">
                    <img class="img-responsive img-hover" src="images/900x300.jpg" alt="">
                </a>
                <hr>
                <p>Mozart reprend les meilleurs musiques de cette décenie dans un album plein d'émotion</p>
                <a class="btn btn-primary" href="articles.php">En savoir plus <i class="fa fa-angle-right"></i></a>

                <hr>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Plus ancients</a>
                    </li>
                    <li class="next">
                        <a href="#">Plus récents &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Rechercher</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">ZOUK</a>
                                </li>
                                <li><a href="#">Anakin Luckwalker</a>
                                </li>
                                <li><a href="#">Vape Nation</a>
                                </li>
                                <li><a href="#">Dac Memarco</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">BLA</a>
                                </li>
                                <li><a href="#">BLA</a>
                                </li>
                                <li><a href="#">BLA</a>
                                </li>
                                <li><a href="#">BLA</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

             </div>

        </div>
        <!-- /.row -->

        

<?php
    include 'footer.php';
?>
   