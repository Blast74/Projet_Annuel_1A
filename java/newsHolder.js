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

	
	return(request.responseText);
}



function displayNews()
{
	console.log("ok !");


	var addingTopic = document.getElementById("addingTopic");
	addingTopic.innerHTML = "";
	var BigDaddy = document.getElementById("BigDaddy");
	BigDaddy.innerHTML = "";


	var content = getNews()

/*
	
	
	topic = content.split('#_@_#');
	

	console.log("++++++++");
	console.log(topic);


	var forum = []
	var index = 0;
	while(topic[index] != "")
	{
		
		forum[index] = topic[index].split("#@#");
		index++;
	}

	
 for (var i=0; i < forum.length; i++){
 


	var div = document.createElement("div");
	div.id = "div"+i;

	BigDaddy.appendChild(div);

	var divA = document.getElementById("div"+i);

	divA.innerHTML = `<div onclick="check(`+i+`)"><a><h2>`+forum[i][1]+`</h2></a><p><i class="fa fa-clock-o"></i> Posted on August 28, 2013 at 10:45 PM</p><hr><a href="articles.php"></a><hr></div>`;



<h2>
                    <a href="articles.php">C'était mieux avant</a>
                </h2>
                
                <p><i class="fa fa-clock-o"></i> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <a href="articles.php">
                    <img class="img-responsive img-hover" src="images/900x300.jpg" alt="">
                </a>
                <hr>
                <p>C'était mieux avant</p>
                <a class="btn btn-primary" href="articles.php">En savoir plus <i class="fa fa-angle-right"></i></a>

                <hr>
            }
        }*/
    