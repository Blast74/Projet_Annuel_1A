


function getNews()
{
	var request = new XMLHttpRequest();
	request.onreadystatechange =( function()
	{
		if(request.readyState == 4 && request.status == 200)
		{

		}
	})
	var test = 0;
	request.open('GET', `java/services/getNews.php`, 0);
	request.send();

	console.log(request.responseText);

	return(request.responseText);
}



function displayNews()
{
	getNews();

	var makeTopic = document.getElementById("makeTopic");
	makeTopic.style = "display : none;";
	var content = getNews();
	var bigDaddy = document.getElementById("bigDaddy");

	bigDaddy.innerHTML = "";


	topic = content.split('#_@_#');
	
	var forum = [];
	var index = 0;
	while(topic[index] != "")
	{

		forum[index] = topic[index].split("#@#");
		index++;
	}
	index--;
	console.log(forum[0]);
	console.log(forum[1]);

	for(var i=0; i < forum.length; i++)
	{
		var div = document.createElement("div");
		div.id = "div"+i;
		bigDaddy.appendChild(div);
		var divA = document.getElementById("div"+i);
		divA.innerHTML = `<div><a><h2>`+forum[i][1]+`</h2></a><p></p><hr><p><i class="fa fa-clock-o"></i> Posté le `+forum[i][3]+`</p><p>`+forum[i][2]+` </p><hr></div><p>Un article de `+forum[i][0]+` </p><br><br>`;
	// save > i <
	}
}





displayNews();
