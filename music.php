<?php
  //PAGE DE BASE HMTL
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TEST AJAX</title>
    <p>TEST AJAX </p>
  </head>

<body >
  <select id="selection" onchange="selection()">
  	<option>Electro</option>
  	<option>Rock</option>
  </select>

  <section id='audiocontainer0'>
  	<p id=musicTitle0></p>
  	<audio id="player0" src='' controls =''></audio>
  </section>
  <section id='audiocontainer1'>
  	<p id=musicTitle0></p>
  	<audio id="player0" src='' controls =''></audio>
  </section>
  <section id='audiocontainer2'>
  	<p id=musicTitle0></p>
  	<audio id="player0" src='' controls =''></audio>
  </section>
  <section id='audiocontainer3'>
  	<p id=musicTitle0></p>
  	<audio id="player0" src='' controls =''></audio>
  </section>
  <section id='audiocontainer4'>
  	<p id=musicTitle0></p>
  	<audio id="player0" src='' controls =''></audio>
  </section>




    <li id="previousContainer">
			<!--<a onclick="previous()" href="#page">Précédent</a>-->
		</li>


    <li id="nextContainer"></li>

<button onclick="dbMusicRequest()"
 type="button" name="button">BOUTON</button>

<script src="ant_musicScript.js"></script>





  </body>
</html>
