<?php
session_start();
setcookie("access", $_SESSION["id"]);
require('../navbar.php');

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>test</title>
   </head>
   <body>
     <input type="button" name="jaime" value="jaime" onclick="">
     <input type="button" name="signaler" value="signaler" onclick="">
     <input type="button" name="bloquer" value="bloquer" onclick="">
     <input type="button" name="suivre" value="suivre" onclick="followUser('terence74@gmail.com', this)">
     <input type="button" name="suivre" value="suivre" onclick="getFollowVal('terence74@gmail.com')">


     <div id="test" onload="">

     </div>

   </body>
   <script src="libButton.js"></script>
   <script src="../admin/libJS.js"></script>
 </html>
