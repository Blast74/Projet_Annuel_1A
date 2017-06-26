//================================
//
//Bienvenu dans le javascript des lecteurs audio de Music Review
//
//======== Données MYSQL ========
//
/*
var mysql = require('mysql');

var connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'root',
  database: 'musicreview'
});
connection.connect();

var liked = {
  email: 'son email',
  music_id: 'id de la music',
  music_note: 'notation',
  is_LIKED: 'liked or not'
};

var query = connection.query('insert into liked set ?', liked, function (err, result) {
  if (err) {
    console.error(err);
    return;
  }
  console.error(result);
});
*/
//
//===============================


var nbPlayer = 5;
var player1 = document.getElementById('Player1');
var player2 = document.getElementById('Player2');
var player3 = document.getElementById('Player3');
var player4 = document.getElementById('Player4');
var player5 = document.getElementById('Player5');


for (var i = 1 ; i <= nbPlayer; i++) {
	
		player1.innerHTML = '<div class="wrapper" ><audio id="mytrack1"><source src="audio/track1.mp3"  type="audio/mp3"></audio><h4 id="title1">Burning room</h4>				<div class="lecteur"><div id="defaultBar1" class="defaultBar"><div id="progressBar1" class="progressBar"></div></div><div id="buttons"><button type="button" class="bouton play" id="playButton1" ></button><button type="button" class="bouton mute" id="muteButton1"></button><button type="button" class="bouton repeat" id="repeatButton1"></button><a target="_blank" href="audio/track1.mp3"  download="file.mp3"><button type="button" class="bouton" id="downloadButton"></button></a><span id="currentTime1">0:00</span>/<span id="fullDuration1">0:00</span><br><img src="images/emptyStar.png" id="star11" class="starEmpty"><img src="images/emptyStar.png" id="star12" class="starEmpty"><img src="images/emptyStar.png" id="star13" class="starEmpty"><img src="images/emptyStar.png" id="star14" class="starEmpty"><img src="images/emptyStar.png" id="star15" class="starEmpty"><p id="comment1"></p></div></div></div>';
	if(i == 2)
		player2.innerHTML = '<div class="wrapper" ><audio id="mytrack2"><source src="audio/track2.mp3"  type="audio/mp3"></audio><h4 id="title2">Pokemon 8 bit</h4>				<div class="lecteur"><div id="defaultBar2" class="defaultBar"><div id="progressBar2" class="progressBar"></div></div><div id="buttons"><button type="button" class="bouton play" id="playButton2" ></button><button type="button" class="bouton mute" id="muteButton2"></button><button type="button" class="bouton repeat" id="repeatButton2"></button><a target="_blank" href="audio/track2.mp3"  download="file.mp3"><button type="button" class="bouton" id="downloadButton"></button></a><span id="currentTime2">0:00</span>/<span id="fullDuration2">0:00</span><br><img src="images/emptyStar.png" id="star21" class="starEmpty"><img src="images/emptyStar.png" id="star22" class="starEmpty"><img src="images/emptyStar.png" id="star23" class="starEmpty"><img src="images/emptyStar.png" id="star24" class="starEmpty"><img src="images/emptyStar.png" id="star25" class="starEmpty"><p id="comment2"></p></div></div></div>';
	if(i == 3)
		player3.innerHTML = '<div class="wrapper" ><audio id="mytrack3"><source src="audio/track3.mp3"  type="audio/mp3"></audio><h4 id="title3">Do you believe in magic ?</h4>	<div class="lecteur"><div id="defaultBar3" class="defaultBar"><div id="progressBar3" class="progressBar"></div></div><div id="buttons"><button type="button" class="bouton play" id="playButton3" ></button><button type="button" class="bouton mute" id="muteButton3"></button><button type="button" class="bouton repeat" id="repeatButton3"></button><a target="_blank" href="audio/track3.mp3"  download="file.mp3"><button type="button" class="bouton" id="downloadButton"></button></a><span id="currentTime3">0:00</span>/<span id="fullDuration3">0:00</span><br><img src="images/emptyStar.png" id="star31" class="starEmpty"><img src="images/emptyStar.png" id="star32" class="starEmpty"><img src="images/emptyStar.png" id="star33" class="starEmpty"><img src="images/emptyStar.png" id="star34" class="starEmpty"><img src="images/emptyStar.png" id="star35" class="starEmpty"><p id="comment3"></p></div></div></div>';
	if(i == 4)
		player4.innerHTML = '<div class="wrapper" ><audio id="mytrack4"><source src="audio/track4.mp3"  type="audio/mp3"></audio><h4 id="title4">Lights - Nightcore</h4>		<div class="lecteur"><div id="defaultBar4" class="defaultBar"><div id="progressBar4" class="progressBar"></div></div><div id="buttons"><button type="button" class="bouton play" id="playButton4" ></button><button type="button" class="bouton mute" id="muteButton4"></button><button type="button" class="bouton repeat" id="repeatButton4"></button><a target="_blank" href="audio/track4.mp3"  download="file.mp3"><button type="button" class="bouton" id="downloadButton"></button></a><span id="currentTime4">0:00</span>/<span id="fullDuration4">0:00</span><br><img src="images/emptyStar.png" id="star41" class="starEmpty"><img src="images/emptyStar.png" id="star42" class="starEmpty"><img src="images/emptyStar.png" id="star43" class="starEmpty"><img src="images/emptyStar.png" id="star44" class="starEmpty"><img src="images/emptyStar.png" id="star45" class="starEmpty"><p id="comment4"></p></div></div></div>';
	if(i == 5)
		player5.innerHTML = '<div class="wrapper" ><audio id="mytrack5"><source src="audio/track5.mp3"  type="audio/mp3"></audio><h3 id="title5">What you wanna do ?</h3>		<div class="lecteur"><div id="defaultBar5" class="defaultBar"><div id="progressBar5" class="progressBar"></div></div><div id="buttons"><button type="button" class="bouton play" id="playButton5" ></button><button type="button" class="bouton mute" id="muteButton5"></button><button type="button" class="bouton repeat" id="repeatButton5"></button><a target="_blank" href="audio/track5.mp3"  download="file.mp3"><button type="button" class="bouton" id="downloadButton"></button></a><span id="currentTime5">0:00</span>/<span id="fullDuration5">0:00</span><br><img src="images/emptyStar.png" id="star51" class="starEmpty"><img src="images/emptyStar.png" id="star52" class="starEmpty"><img src="images/emptyStar.png" id="star53" class="starEmpty"><img src="images/emptyStar.png" id="star54" class="starEmpty"><img src="images/emptyStar.png" id="star55" class="starEmpty"><p id="comment5"></p></div></div></div>';




}



var like = [];
for (var ivar = 1; i <= nbPlayer; i++)
		like[i] = false;

var comment = [];
for (var i = 1; i <= nbPlayer; i++)
		comment[i] = document.getElementById('comment'+i);

var showingNote = [];
for (var i = 1; i <= nbPlayer; i++)
		showingNote[i] = false;



for (var i = 1; i <= nbPlayer; i++)
		showNote(i);

var logged = true;


var mytrack = [];
for (var i = 1; i <= nbPlayer; i++)
		mytrack[i] = document.getElementById('mytrack'+i);



var paused = [];
for (var i = 1; i <= nbPlayer; i++)
		paused[i] = true;


var repeating = [];
for (var i = 1; i <= nbPlayer; i++)
		repeating[i] = false;

var voted = [];

if (logged)
	for (var i = 1; i <= nbPlayer; i++)
		voted[i] = false;
else
{
	for (var i = 1; i <= nbPlayer; i++)
	{
		voted[i] = true;
		showNote(i);
	}
}





var progressBar = [];
for (var i = 1; i <= nbPlayer; i++)
		progressBar[i] = document.getElementById('progressBar'+i);





//mytrack1.addEventListener("loadedmetadata", changeDuration(fullDuration1));
/*mytrack2.addEventListener("loadedmetadata", changeDuration());
mytrack3.addEventListener("loadedmetadata", changeDuration(3));
mytrack4.addEventListener("loadedmetadata", changeDuration(4));
mytrack5.addEventListener("loadedmetadata", changeDuration(5));*/





var currentTime = document.getElementById('currentTime');

var barSize = 300;


var bar1 = document.getElementById('defaultBar1');
var bar2 = document.getElementById('defaultBar2');
var bar3 = document.getElementById('defaultBar3');
var bar4 = document.getElementById('defaultBar4');
var bar5 = document.getElementById('defaultBar5');





// Boutons playX
playButton1.addEventListener('click', function () { 	playOrPause(1);},false);
if(nbPlayer > 1)
	playButton2.addEventListener('click', function () { 	playOrPause(2);},false);
if(nbPlayer > 2)
	playButton3.addEventListener('click', function () { 	playOrPause(3);},false);
if(nbPlayer > 3)
	playButton4.addEventListener('click', function () { 	playOrPause(4);},false);
if(nbPlayer > 4)
	playButton5.addEventListener('click', function () { 	playOrPause(5);},false);

// Boutons muteX
muteButton1.addEventListener('click', function() {	muteOrUnmute(1);},false);
if(nbPlayer > 1)
	muteButton2.addEventListener('click', function() {	muteOrUnmute(2);},false);
if(nbPlayer > 2)
	muteButton3.addEventListener('click', function() {	muteOrUnmute(3);},false);
if(nbPlayer > 3)
	muteButton4.addEventListener('click', function() {	muteOrUnmute(4);},false);
if(nbPlayer > 4)
	muteButton5.addEventListener('click', function() {	muteOrUnmute(5);},false);

// Boutons repeatX
repeatButton1.addEventListener('click', function() {	repeatOrNot(1);},false);
if(nbPlayer > 1)
	repeatButton2.addEventListener('click', function() {	repeatOrNot(2);},false);
if(nbPlayer > 2)
	repeatButton3.addEventListener('click', function() {	repeatOrNot(3);},false);
if(nbPlayer > 3)
	repeatButton4.addEventListener('click', function() {	repeatOrNot(4);},false);
if(nbPlayer > 4)
	repeatButton5.addEventListener('click', function() {	repeatOrNot(5);},false);

// a factoriser !
bar1.addEventListener('click', clickedBar1,false);
if(nbPlayer > 1)
bar2.addEventListener('click', clickedBar2,false);
if(nbPlayer > 2)
bar3.addEventListener('click', clickedBar3,false);
if(nbPlayer > 3)
bar4.addEventListener('click', clickedBar4,false);
if(nbPlayer > 4)
bar5.addEventListener('click', clickedBar5,false);






var star = [];

for(var i = 1; i <= nbPlayer; i++)
{
	star[i] = new Array(5);
}

var inter;

i = 1;
for (var j = 1; j <= nbPlayer; j++)
{

	for (var i = 1; i <= 5; i++) {
		inter = document.getElementById("star"+j+i);
		star[j][i] = inter;
		
	}
}


//console.log(star[3][2]);





star[1][1].addEventListener('mouseover', function() {staring(1, 1);},false);
star[1][2].addEventListener('mouseover', function() {staring(1, 2);},false);
star[1][3].addEventListener('mouseover', function() {staring(1, 3);},false);
star[1][4].addEventListener('mouseover', function() {staring(1, 4);},false);
star[1][5].addEventListener('mouseover', function() {staring(1, 5);},false);
if (nbPlayer > 1){
star[2][1].addEventListener('mouseover', function() {staring(2, 1);},false);
star[2][2].addEventListener('mouseover', function() {staring(2, 2);},false);
star[2][3].addEventListener('mouseover', function() {staring(2, 3);},false);
star[2][4].addEventListener('mouseover', function() {staring(2, 4);},false);
star[2][5].addEventListener('mouseover', function() {staring(2, 5);},false);
}
if (nbPlayer > 2){
star[3][1].addEventListener('mouseover', function() {staring(3, 1);},false);
star[3][2].addEventListener('mouseover', function() {staring(3, 2);},false);
star[3][3].addEventListener('mouseover', function() {staring(3, 3);},false);
star[3][4].addEventListener('mouseover', function() {staring(3, 4);},false);
star[3][5].addEventListener('mouseover', function() {staring(3, 5);},false);
}
if (nbPlayer > 3){
star[4][1].addEventListener('mouseover', function() {staring(4, 1);},false);
star[4][2].addEventListener('mouseover', function() {staring(4, 2);},false);
star[4][3].addEventListener('mouseover', function() {staring(4, 3);},false);
star[4][4].addEventListener('mouseover', function() {staring(4, 4);},false);
star[4][5].addEventListener('mouseover', function() {staring(4, 5);},false);
}
if (nbPlayer > 4){
star[5][1].addEventListener('mouseover', function() {staring(5, 1);},false);
star[5][2].addEventListener('mouseover', function() {staring(5, 2);},false);
star[5][3].addEventListener('mouseover', function() {staring(5, 3);},false);
star[5][4].addEventListener('mouseover', function() {staring(5, 4);},false);
star[5][5].addEventListener('mouseover', function() {staring(5, 5);},false);
}

star[1][1].addEventListener('click', function() {starClick(1, 1);},false);
star[1][2].addEventListener('click', function() {starClick(1, 2);},false);
star[1][3].addEventListener('click', function() {starClick(1, 3);},false);
star[1][4].addEventListener('click', function() {starClick(1, 4);},false);
star[1][5].addEventListener('click', function() {starClick(1, 5);},false);
if (nbPlayer > 1){
star[2][1].addEventListener('click', function() {starClick(2, 1);},false);
star[2][2].addEventListener('click', function() {starClick(2, 2);},false);
star[2][3].addEventListener('click', function() {starClick(2, 3);},false);
star[2][4].addEventListener('click', function() {starClick(2, 4);},false);
star[2][5].addEventListener('click', function() {starClick(2, 5);},false);
}
if (nbPlayer > 2){
star[3][1].addEventListener('click', function() {starClick(3, 1);},false);
star[3][2].addEventListener('click', function() {starClick(3, 2);},false);
star[3][3].addEventListener('click', function() {starClick(3, 3);},false);
star[3][4].addEventListener('click', function() {starClick(3, 4);},false);
star[3][5].addEventListener('click', function() {starClick(3, 5);},false);
}
if (nbPlayer > 3){
star[4][1].addEventListener('click', function() {starClick(4, 1);},false);
star[4][2].addEventListener('click', function() {starClick(4, 2);},false);
star[4][3].addEventListener('click', function() {starClick(4, 3);},false);
star[4][4].addEventListener('click', function() {starClick(4, 4);},false);
star[4][5].addEventListener('click', function() {starClick(4, 5);},false);
}
if (nbPlayer > 4){
star[5][1].addEventListener('click', function() {starClick(5, 1);},false);
star[5][2].addEventListener('click', function() {starClick(5, 2);},false);
star[5][3].addEventListener('click', function() {starClick(5, 3);},false);
star[5][4].addEventListener('click', function() {starClick(5, 4);},false);
star[5][5].addEventListener('click', function() {starClick(5, 5);},false);
}








function showNote(id) {
	// Requete SQL pour aller chercher les données, sera ici simulé par une variable
	
	var note = 2.4;
	var i = 1;
	while (i < note)
	{
		if (note > i)
		{
			document.getElementById('star'+id+i).src='images/fullStar.png';
			
		}
		i++;
		
	}
	if (note%1 >= 0.75)
	{
		document.getElementById('star'+id+i).src='images/thirdStar.png';
		 i++;
	}
	else if (note%1 >= 0.5)
	{
		document.getElementById('star'+id+i).src='images/halfStar.png';
		i++;
	}
	else if (note%1 >= 0.25)
	{
		document.getElementById('star'+id+i).src='images/firstThirdStar.png';
		i++;
	}
	
	while (i <= 5) 
	{
		document.getElementById('star'+id+i).src='images/emptyStar.png';
		i++;
	}
	
	
	
	
}



function staring(id, nb) {
	if (!voted[id])
	{
		for (var i = 1; i <= nb; i++) {
			document.getElementById('star'+id+i).src='images/notingStar.png';
		}
		while(i <= 5)
		{
			document.getElementById('star'+id+i).src='images/emptyStar.png';
			i++;
		}

	}
	else
	{
		for (var i = 1; i <= noted[id]; i++) {
			document.getElementById('star'+id+i).src='images/notingStar.png';
		}
		while(i <= 5)
		{
			document.getElementById('star'+id+i).src='images/emptyStar.png';
			i++;
		}
	}
}


function starClick(id, nb) {
	if((!voted[id]) && (logged))
	{
		voted[id] = true;
		var pts = nb - 2;
		preference(id, nb);
		showNote(id);
	}
	else if (voted[id])
		showNote(id);
}




function changeDuration() {

	var minutes;
	var seconds;

	minutes = parseInt(mytrack1.duration/60);
	seconds = parseInt(mytrack1.duration%60);
	if (seconds < 10)
		fullDuration1.innerHTML = minutes + ':' +  '0' + seconds;
	else
		fullDuration1.innerHTML = minutes + ':' + seconds;
	
	if(nbPlayer > 1)
	{
	minutes = parseInt(mytrack2.duration/60);
	seconds = parseInt(mytrack2.duration%60);
	if (seconds < 10)
		fullDuration2.innerHTML = minutes + ':' +  '0' + seconds;
	else
		fullDuration2.innerHTML = minutes + ':' + seconds;
	}
	if(nbPlayer > 1)
	{
	minutes = parseInt(mytrack3.duration/60);
	seconds = parseInt(mytrack3.duration%60);
	if (seconds < 10)
		fullDuration3.innerHTML = minutes + ':' +  '0' + seconds;
	else
		fullDuration3.innerHTML = minutes + ':' + seconds;
	}
	if(nbPlayer > 1)
	{
	minutes = parseInt(mytrack4.duration/60);
	seconds = parseInt(mytrack4.duration%60);
	if (seconds < 10)
		fullDuration4.innerHTML = minutes + ':' +  '0' + seconds;
	else
		fullDuration4.innerHTML = minutes + ':' + seconds;
	}
	if(nbPlayer > 1)
	{
	minutes = parseInt(mytrack5.duration/60);
	seconds = parseInt(mytrack5.duration%60);
	if (seconds < 10)
		fullDuration5.innerHTML = minutes + ':' +  '0' + seconds;
	else
		fullDuration5.innerHTML = minutes + ':' + seconds;
}

	


}


function playOrPause(id) 
{	
	if(!paused[id])
	{
		mytrack[id].pause();
		paused[id] = true;
		window.clearInterval(updateTime);

		// A factoriser
		if(id==1)
			playButton1.style.backgroundImage = 'url(images/play.png)';
		if(id==2)
			playButton2.style.backgroundImage = 'url(images/play.png)';
		if(id==3)
			playButton3.style.backgroundImage = 'url(images/play.png)';
		if(id==4)
			playButton4.style.backgroundImage = 'url(images/play.png)';
		if(id==5)
			playButton5.style.backgroundImage = 'url(images/play.png)';


	}
	else if(paused[id])
	{
		if(like[id] == false)
		{
			like[id] = true;
			preference(id, 1);
		}
		mytrack[id].play();
		paused[id] = false;
		updateTime = setInterval(update,500, id);

		// A factoriser
		if(id==1)
			playButton1.style.backgroundImage = 'url(images/pause.png)';
		if(id==2)
			playButton2.style.backgroundImage = 'url(images/pause.png)';
		if(id==3)
			playButton3.style.backgroundImage = 'url(images/pause.png)';
		if(id==4)
			playButton4.style.backgroundImage = 'url(images/pause.png)';
		if(id==5)
			playButton5.style.backgroundImage = 'url(images/pause.png)';

	}
}


function muteOrUnmute(id) {
	if(!mytrack[id].muted)
	{
		mytrack[id].muted = true;

		// a factoriser
		if(id==1)
			muteButton1.style.backgroundImage = 'url(images/mute.png)';
		if(id==2)
			muteButton2.style.backgroundImage = 'url(images/mute.png)';
		if(id==3)
			muteButton3.style.backgroundImage = 'url(images/mute.png)';
		if(id==4)
			muteButton4.style.backgroundImage = 'url(images/mute.png)';
		if(id==5)
			muteButton5.style.backgroundImage = 'url(images/mute.png)';

	}
	else if(mytrack[id].muted )
	{
		mytrack[id].muted = false;

		// a factoriser
		if(id==1)
			muteButton1.style.backgroundImage = 'url(images/sound.png)';
		if(id==2)
			muteButton2.style.backgroundImage = 'url(images/sound.png)';
		if(id==3)
			muteButton3.style.backgroundImage = 'url(images/sound.png)';
		if(id==4)
			muteButton4.style.backgroundImage = 'url(images/sound.png)';
		if(id==5)
			muteButton5.style.backgroundImage = 'url(images/sound.png)';

	}
}



function update(id)
{
	if (id == 0)
		changeDuration();
	

	if(!mytrack[1].ended)	{

		var playedMinutes = parseInt(mytrack[1].currentTime/60);
		var playedSeconds = parseInt(mytrack[1].currentTime%60);
		if (playedSeconds < 10)
			currentTime1.innerHTML = playedMinutes + ':' +  '0' + playedSeconds;
		else
			currentTime1.innerHTML = playedMinutes + ':' + playedSeconds;
		var size = parseInt(mytrack[1].currentTime*barSize/mytrack[1].duration);
		progressBar1.style.width = size + "px";
	}
	
	
	if(nbPlayer >= 2)
		if(!mytrack[2].ended)	{
			var playedMinutes = parseInt(mytrack[2].currentTime/60);
			var playedSeconds = parseInt(mytrack[2].currentTime%60);
			if (playedSeconds < 10)
				currentTime2.innerHTML = playedMinutes + ':' +  '0' + playedSeconds;
			else
				currentTime2.innerHTML = playedMinutes + ':' + playedSeconds;
			var size = parseInt(mytrack[2].currentTime*barSize/mytrack[2].duration);
			progressBar2.style.width = size + "px";
		}
	
	if(nbPlayer >= 3)
		if(!mytrack[3].ended)	{
			var playedMinutes = parseInt(mytrack[3].currentTime/60);
			var playedSeconds = parseInt(mytrack[3].currentTime%60);
			if (playedSeconds < 10)
				currentTime3.innerHTML = playedMinutes + ':' +  '0' + playedSeconds;
			else
				currentTime3.innerHTML = playedMinutes + ':' + playedSeconds;
			var size = parseInt(mytrack[3].currentTime*barSize/mytrack[3].duration);
			progressBar3.style.width = size + "px";
		}

	if(nbPlayer >= 4)
		if(!mytrack[4].ended)	{
			var playedMinutes = parseInt(mytrack[4].currentTime/60);
			var playedSeconds = parseInt(mytrack[4].currentTime%60);
			if (playedSeconds < 10)
				currentTime4.innerHTML = playedMinutes + ':' +  '0' + playedSeconds;
			else
				currentTime4.innerHTML = playedMinutes + ':' + playedSeconds;
			var size = parseInt(mytrack[4].currentTime*barSize/mytrack[4].duration);
			progressBar4.style.width = size + "px";
		}
	if(nbPlayer >= 5)
		if(!mytrack[5].ended)	{
			var playedMinutes = parseInt(mytrack[5].currentTime/60);
			var playedSeconds = parseInt(mytrack[5].currentTime%60);
			if (playedSeconds < 10)
				currentTime5.innerHTML = playedMinutes + ':' +  '0' + playedSeconds;
			else
				currentTime5.innerHTML = playedMinutes + ':' + playedSeconds;
			var size = parseInt(mytrack[5].currentTime*barSize/mytrack[5].duration);
			progressBar5.style.width = size + "px";
		}
	

	if ((repeating[id]) &&(mytrack[id].ended))	{
		mytrack[id].currentTime = 0;
		mytrack[id].play();
		preference(id, 2);
	}

}



function clickedBar1 (e) {
	if(!mytrack[1].ended) {
		var mouseX = e.pageX - bar1.offsetLeft;
		var newtime = mouseX*mytrack[1].duration/barSize;
		mytrack[1].currentTime = newtime;
		progressBar[1].style.width = mouseX + 'px';
	}
}
function clickedBar2 (e) {
	if(!mytrack[2].ended) {
		var mouseX = e.pageX - bar2.offsetLeft;
		var newtime = mouseX*mytrack[2].duration/barSize;
		mytrack[2].currentTime = newtime;
		progressBar[2].style.width = mouseX + 'px';
	}
}
function clickedBar3 (e) {
	if(!mytrack[3].ended) {
		var mouseX = e.pageX - bar3.offsetLeft;
		var newtime = mouseX*mytrack[3].duration/barSize;
		mytrack[3].currentTime = newtime;
		progressBar[3].style.width = mouseX + 'px';
	}
}
function clickedBar4 (e) {
	if(!mytrack[4].ended) {
		var mouseX = e.pageX - bar4.offsetLeft;
		var newtime = mouseX*mytrack[4].duration/barSize;
		mytrack[4].currentTime = newtime;
		progressBar[4].style.width = mouseX + 'px';
	}
}
function clickedBar5 (e) {
	if(!mytrack[5].ended) {
		var mouseX = e.pageX - bar5.offsetLeft;
		var newtime = mouseX*mytrack[5].duration/barSize;
		mytrack[5].currentTime = newtime;
		progressBar[5].style.width = mouseX + 'px';
	}
}








function repeatOrNot(id) 
{
	if(!repeating[id])
	{

		repeating[id] = true;
		
		// a factoriser
		if(id==1)
			repeatButton1.style.backgroundImage = 'url(images/repeating.png)';
		if(id==2)
			repeatButton2.style.backgroundImage = 'url(images/repeating.png)';
		if(id==3)
			repeatButton3.style.backgroundImage = 'url(images/repeating.png)';
		if(id==4)
			repeatButton4.style.backgroundImage = 'url(images/repeating.png)';
		if(id==5)
			repeatButton5.style.backgroundImage = 'url(images/repeating.png)';

	}
	else if(repeating[id])
	{
		repeating[id] = false;

		// a factoriser
		if(id==1)
			repeatButton1.style.backgroundImage = 'url(images/repeat.png)';
		if(id==2)
			repeatButton2.style.backgroundImage = 'url(images/repeat.png)';
		if(id==3)
			repeatButton3.style.backgroundImage = 'url(images/repeat.png)';
		if(id==4)
			repeatButton4.style.backgroundImage = 'url(images/repeat.png)';
		if(id==5)
			repeatButton5.style.backgroundImage = 'url(images/repeat.png)';

	}
	
}

function test() {
	console.log("coucou");
}


var noted = [];
/*
for (var i = 1; i <= 5; i++)
		noted[i] = 0;
*/

	


function preference(id, nb)
{
		noted[id] = nb;

}







updateTime = setInterval(update,500, 0);