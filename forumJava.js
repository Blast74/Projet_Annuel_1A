//update(500);

var cookies = document.cookie.split(";");



function addTopic()
{
	// on obtient l'user
	var subject = document.getElementById("subject").value;
	var exposure = document.getElementById("exposure").value;



	var request = new XMLHttpRequest();
		var who = cookies[0].split('=');
		var user = who[1];

	request.onreadystatechange = function() {
    	if(request.readyState == 4) {
	    	if(request.status == 201) {

    		}
		}
	};
	request.open('POST', `java/services/getUser.php`, 0);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("user="+user);

	var params = [
    `user=${user}`
  ];



	var pseudo = request.responseText;

//premiere requete en topic


  	request.onreadystatechange = function() {
    	if(request.readyState == 4) {
	    	if(request.status == 201) {

    		}
		}
	};
	request.open('POST', `java/services/addTopic.php`, 0);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("subject="+subject+"&pseudo="+pseudo);


	var params = [
    `subject=${subject}`,
    `pseudo=${pseudo}`
  ];

  console.log(request.responseText);


//recupération de l'id
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
    	if(request.readyState == 4) {
	    	if(request.status == 201) {

    		}
		}
	};
	request.open('POST', `java/services/whichTopic.php`, 0);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("subject="+subject);

	var params = [
    `subject=${subject}`
  ];

	var id_topic = request.responseText;





// derniere phase

	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
    	if(request.readyState == 4) {
	    	if(request.status == 201) {

    		}
		}
	};
	request.open('POST', `java/services/addSubject.php`, 0);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("id_topic="+id_topic+"&exposure="+exposure+"&pseudo="+pseudo);

	var params = [
    `id_topic=${id_topic}`,
    `exposure=${exposure}`,
    `pseudo=${pseudo}`
  ];
console.log(params);
  	console.log(request.responseText);

	var addingtopic = document.getElementById("addingTopic");
	addingtopic.innerHTML = "";

	refresh();
}


function prepareTopic()
{
	refresh();
	var addingtopic = document.getElementById("addingTopic");
	addingtopic.innerHTML = `<br><input type="text" id="subject" placeholder="Sujet"><br><textarea id="exposure"></textarea><br><input type="button" id="topicAdder" value="Créer"><br><br>`;

	topicAdder.addEventListener('click', addTopic, false);

}




function getCookies(){
  var cookies = document.cookie.split(";");
  var result = [];
  cookies.forEach(function(cookie){
    result.push(cookie.split("="));
  });
  return result;
}

//trouve le cookie qui correspond au nom
function getCookie(name){
  var cookies = getCookies();
  var result;
  cookies.forEach(function(cookie){
    if (cookie[0] == name){
      result = cookie;
    }
    }
  );
  if (result != null) {
    return result;
  }else {
    return null;
  }
}



function addComment(id)
{
	var commentaire = document.getElementById("comment").value;
	var request = new XMLHttpRequest();



		var who = cookies[0].split('=');
		var user = who[1];

	request.onreadystatechange = function() {
    	if(request.readyState == 4) {
	    	if(request.status == 201) {

    		}
		}
	};
	request.open('POST', `java/services/getUser.php`, 0);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("user="+user);

	var params = [
    `user=${user}`
  ];
  	var answer = []
	answer[1] = id;
	answer[2] = commentaire;
	answer[3] = request.responseText;
	var pseudo = request.responseText;



  	request.onreadystatechange = function() {
    	if(request.readyState == 4) {
	    	if(request.status == 201) {

    		}
		}
	};
	request.open('POST', `java/services/addReply.php`, 0);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("id="+id+"&commentaire="+commentaire+"&pseudo="+pseudo);

	var params = [
    `id=${id}`,
    `commentaire=${commentaire}`,
    `pseudo=${pseudo}`
  ];
}


function check(id)
{
		refresh();
		displaying = true;
		var content = getContent(id);

		msg = content.split('#_@_#');

		var forum = []
		var index = 0;
		while(msg[index] != "")
		{

			forum[index] = msg[index].split("#@#");
			index++;
		}

		var divA = document.getElementById('div'+id);


    	for (var i = 0; i < forum.length; i++)
	    {
			var div = document.createElement("div");
			div.id = "post"+i;
			div.style = "border :border-style: solid;border : 50px;"

			divA.appendChild(div);
			div.innerHTML = "<h4>"+forum[i][1]+"</h4><p>By : "+forum[i][2]+"</p><br>";
		}
			var comment = document.createElement("comment");
			divA.appendChild(comment);
			comment.innerHTML = `<p> Donnez votre avis ! </p><textarea id="comment" name="toto" value="Un commentaire ?"></textarea><br><input type="submit" value="Valider" id="submitComment">`

		var submitComment = document.getElementById('submitComment');
		submitComment.addEventListener('click', function () { 	addComment(id);},false);
		//addEventListener
}


function getTopic()
{
	var request = new XMLHttpRequest();
	request.onreadystatechange =( function()
	{
		if(request.readyState == 4 && request.status == 200)
		{

		}
	})
	var test = 0;
	request.open('GET', `java/services/getForumContent.php`, 0);
	request.send();


	return(request.responseText);
}

function getContent(id)
{
	var request = new XMLHttpRequest();
	request.onreadystatechange =( function()
	{
		if(request.readyState == 4 && request.status == 200)
		{

		}
	})
	var test = 0;
	var params = `id=${id}`;
	request.open('POST', `java/services/getTopicContent.php`, 0);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("id="+id);


	return(request.responseText);
}





function refresh()
{
	var makeTopic = document.getElementById("makeTopic");
	makeTopic.style = "display : allign;"
	var addingTopic = document.getElementById("addingTopic");
	addingTopic.innerHTML = "";
	var button = document.getElementById("123");
	var bigDaddy = document.getElementById("bigDaddy");
	bigDaddy.innerHTML = "";

	var content = getTopic()

	topic = content.split('#_@_#');


	var forum = []
	var index = 0;
	while(topic[index] != "")
	{

		forum[index] = topic[index].split("#@#");
		index++;
	}

	index--;

 for (var i = index; i > 0; i--){
 	var BigDaddy = document.getElementById("bigDaddy");


	var div = document.createElement("div");
	div.id = "div"+i;

	BigDaddy.appendChild(div);

	var divA = document.getElementById("div"+i);

	divA.innerHTML = `<div onclick="check(`+i+`)"><a><h2>`+forum[i][1]+`</h2></a><p><i class="fa fa-clock-o"></i> Posted on August 28, 2013 at 10:45 PM</p><hr><a href="articles.php"></a><hr></div>`;
}


}

/*
updateTime = setInterval(update,500, 0);
updateTime = setInterval(update,5000, 1);

*/
