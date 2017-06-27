	var musicList = [];
musicList[1] = document.getElementById('mytrack');
 
var actual = 1;

var playButton = document.getElementById('playButton0');
var muteButton = document.getElementById('muteButton0');
var nextButton = document.getElementById('nextButton');

var duration = document.getElementById('fullDuration0');
var radioCurrentTime = document.getElementById('currentTime0');

var barSize = 300;
var radioBar = document.getElementById('defaultBar0');
var radioProgressBar = document.getElementById('progressBar0');

nextButton.addEventListener('click', next, false)
playButton0.addEventListener('click', playOrPause, false);




function next(){
	console.log(mytrack);
	console.log(actual);
	var playing = document.getElementById('radio').src;
//	console.log(playing);
	var re = /[0-9]/i;
	var found = playing.match(re);
	
	var request = new XMLHttpRequest()
	
	var alea = Math.floor((Math.random() * 10) + 1);

	mytrack.pause();
	
	request.onreadystatechange =( function()
	{
		if(request.readyState == 4 && request.status == 200)
		{
			

			
			
			

			mytrack = "<audio id='mytrack'> <source src='"+request.responseText+"' type='audio/mp3' id='radio'></audio>";
			

			var rad = document.getElementById("radio");
			rad.src = request.responseText;
			mytrack.load();
			mytrack.play();


			console.log(mytrack); 
		}
	}
);
	request.open('POST', `java/services/radioMusicSelect.php`, 0);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("alea="+alea);

	var params = [
    `alea=${alea}`
  ];


}

function playOrPause() {
	console.log(mytrack);
	if(!mytrack.paused && !mytrack.ended)
	{
		mytrack.pause();
		playButton0.style.backgroundImage = 'url(images/play.png)';
		

	}
	else
	{
		mytrack.play();
		playButton0.style.backgroundImage = 'url(images/pause.png)';
		
		

	}

}




//updateTime = setInterval(update,500, 1);
