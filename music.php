<?php
    session_start();
    include "navbar.php";
 ?>

<?php  //A remplacer par le contenu de la BDD
 $BDDresults = ([

 	"Electro" => [
 		"Energy 52 - Cafe Del Mar",
 		"Kölsch - LORELEY",
 		"The Avener - Fade Out Lines",
 		"Raffaele Attanasio - Roads",
 		"Energy 52 - Cafe Del Mar",

 		"Kölsch - LORELEY",
 		"The Avener - Fade Out Lines",
 		"Raffaele Attanasio - Roads",
 		"Energy 52 - Cafe Del Mar",
 		"Kölsch - LORELEY",

 		"The Avener - Fade Out Lines",


 		"Raffaele Attanasio - Roads"],
 	"Rock" => [
 		"Arcade Fire - No Cars Go",

 		"The Black Keys- Howlin' For You"

 		]
 ]);


 $format = ".mp3";
 $playSong = "./music/Electro/".$BDDresults["Electro"][0].$format;
 echo "<br>";

 ?>

<section>
   <select id="selection" onchange="selection()">
   	<option>Electro</option>
   	<option>Rock</option>
   </select>

   <!--Lecteurs de musique-->
   <section id='audiocontainer0'>
   	<p id=musicTitle0></p>
   	<audio id="player0" src='' controls =''></audio>
   </section>

   <section id='audiocontainer1'>
   	<p id=musicTitle1></p>
   	<audio id="player1" src='' controls =''></audio>
   </section>
   <section id='audiocontainer2'>
   	<p id=musicTitle2></p>
   	<audio id="player2" src='' controls =''></audio>
   </section>
   <section id='audiocontainer3'>
   	<p id=musicTitle3></p>
   	<audio id="player3" src='' controls =''></audio>
   </section>
   <section id='audiocontainer4'>
   	<p id=musicTitle4></p>
   	<audio id="player4" src='' controls =''></audio>
   </section>

   <div> <!--Menu de navigation Précédent/suivant -->
   	<ul id="navigation" class="pager">
   		<li id="previousContainer">
   			<!--<a onclick="previous()" href="#page">Précédent</a>-->
   		</li>
   		<li id="currentPage">Page n°1</li>
   		<li id="nextContainer">
   			<a id="nextButton" onclick="next()" href="#">Suivant</a>
   		</li>
   	</ul>

   </div>
</section>




 <script src="scriptAntoine.js"></script>
 <script>
    var musicList = <?php echo json_encode($BDDresults); ?>; //A CHANGER PAR DU AJAX
    selection (); //Permet d'afficher les musiques de la première page
 </script>




<?php
  include 'footer.php';
?>
