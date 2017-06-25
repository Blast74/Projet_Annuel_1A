<?php
    session_start();
    include "navbar.php";
    $moderator = New User;
    $moderator->createWithToken($_SESSION["id"]);
    // $access = checkMod($_SESSION["id"]);
    if($moderator->isMod()[0] != 1){

        header("Location: index.php");
        die();
    }
?>
        <div class="container">
            </div>

            <div class="container">
                <div class="col-lg-12">
                    <h1 class="page-header">UTILISATEURS :</h1>
                </div>
            </div>
            <div id="ListParamUsers" class="form-group">
                <h3>Trier Par:</h3>
            <select class="form-control" id="orderDisplay" onchange='listHtmlUsers("listUsers")'>
                <option value="pseudo" >Pseudo</option>
                <option value="firstname" >Prénom</option>
                <option value="lastname" >Nom</option>
                <option value="email" selected="selected">Email</option>
                <option value="birthday" >Date de naissance</option>
                <option value="gender" >Genre</option>
                <option value="country" >Pays</option>
                <option value="active_account">Statut</option>
            <select>
            <select class="form-control" id="sortByOptionSelectUsers" onchange='listHtmlUsers("listUsers")'>
                <option value="ASC">Croissant</option>
                <option value="DESC">Décroissant</option>
            </select>
            <br>
            <h3>Nombre d'utilisateurs souhaités :</h3>
            <select class="form-control" id="nbByPages" onchange='listHtmlUsers("listUsers")'>
                <option value="5" selected="selected">5</option>
                <option value="10" >10</option>
                <option value="20" >20</option>
                <option value="30" >30</option>
            <select>
            </div>
            <div id="resultRightOperation">

            </div>
             <div id="listUsers" class="container" >

             </div>

        <hr>
    <script src="admin/libJS2.js"></script>
    <script src="admin/libJS.js"></script>
    <script type="text/javascript">
        listHtmlUsers("listUsers");
    </script>



<?php
var_dump(get_defined_vars());
    include "footer.php";
?>
