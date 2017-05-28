<?php
    session_start ();
    include '../navbar.php';
    require_once "../conf.inc.php";
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <input type="button" name="formulaire" onclick="showFormPopup()">
    <div id="formPopup">
      <form action="index.html" method="post">
        <input type="Text" name="pseudo" placeholder="Votre pseudo" value="<?php echo (isset($_SESSION["form_post"]["email"]))?$_SESSION["form_post"]["email"]:""; ?>">
        <input type="Text" name="prenom" placeholder="Votre email" value="<?php echo (isset($_SESSION["form_post"]["email"]))?$_SESSION["form_post"]["email"]:""; ?>">
        <input type="Text" name="nom" placeholder="Votre email" value="<?php echo (isset($_SESSION["form_post"]["email"]))?$_SESSION["form_post"]["email"]:""; ?>">
        <input type="date" name="email" placeholder="Votre email" value="<?php echo (isset($_SESSION["form_post"]["email"]))?$_SESSION["form_post"]["email"]:""; ?>">
        <?php
        foreach ($listOfGender as $key => $gender) {
            echo "<label>";
            echo $gender;
            $defaultGender = (isset ($_SESSION ["form_post"]["gender"]) )?$_SESSION ["form_post"]["gender"]: $defaultGender;

            if ($key == $defaultGender){
                echo "<input type='radio' name='gender' value='".$key."' checked='checked'>";
            }
            else{
                echo "<input type='radio' name='gender' value='".$key."'>";
            }
            echo "</label>";
        }
        ?>
        <input type="Text" name="email" placeholder="Votre email"  value="<?php echo (isset($_SESSION["form_post"]["email"]))?$_SESSION["form_post"]["email"]:""; ?>">


      </form>

    </div>
    <input type="button" name="formulaire" onclick="hideFormPopup()">







    <script src="./formulaire.js"></script>

  </body>
</html>
