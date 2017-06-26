<?php
    session_start();
    if(!empty($_SESSION))
    {
        setcookie("accesstoken", $_SESSION["id"]);  
    }

    include 'navbar.php';
?>

<meta charset="UTF-8">

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <br>
            <div class="col-md-8">

        
            <?php 
            



            echo '<input value="News" id="123" type="button" onClick="displayNews()" />';
            echo '<input value="Forum" id="123" type="button" onClick="refresh()" />';
            echo '<input value="Créer un topic !" id="makeTopic" type="button" onClick="prepareTopic()" style="display : none"/>';
            ?>


<div id="addingTopic">



</div>


<div id="content0" style="display: none;" >
    <?php echo $content0; ?>
</div>       

<div id="bigDaddy">



    
</div>








            <!-- Blog Sidebar Widgets Column -->
            

        </div>
        <!-- /.row -->
<script type="text/javascript" src="forumJava.js"></script>
<script src="newsHolder.js"></script>

<?php
    include 'footer.php'; 
?>