<?php
    session_start();
    include 'navbar.php';

    var_dump(get_defined_vars());

    

    include 'footer.php';
    unset($_SESSION["form_post"] );
    unset($_SESSION["form_errors"] );
?>
