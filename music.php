<?php
  session_start();
  include 'navbar.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TEST AJAX</title>
    <p>TEST AJAX </p>
  </head>


  <select id="selection" ><!--fonction JS pour afficher les sous types -->
  	<option>Electro</option>
  	<option>Rock</option>
  </select>

  <select id="subtypeSelection" onchange="MusicSelection()">
  	<option>Trance</option>
  	<option>Electro</option>
    <option>Hardtek</option>
    <option>GOA</option>
    <option>House</option>
    <option>Drum & Bass</option>
  </select>

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
  	<audio id="player3" src='' controls =
    ''></audio>
  </section>
  <section id='audiocontainer4'>
  	<p id=musicTitle4></p>
  	<audio id="player4" src='' controls =''></audio>
  </section>

  <div> <!--Menu de navigation Précédent/suivant -->
  	<ul id="navigation" class="pager">
  		<li id="previousContainer">
  			<!--<a id="previousButton" onclick="navigationButton('previous')">Précédant</a>-->
  		</li>

  		<li id="nextContainer">
  			<a id="nextButton" onclick="navigationButton('next')">Suivant</a>
  		</li>
  	</ul>
  </div>


<button onclick="refreshPages()" type="button" name="button">BOUTON</button>
<script src="ant_musicScript.js"></script>





<?php
    include 'footer.php';
?>
