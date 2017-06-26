function addArticle()
{

	var title = document.getElementById("title").value;
	var content = document.getElementById("content").value;
	var author = document.getElementById("author").value;
	
	var request = new XMLHttpRequest();
	
	request.onreadystatechange = function() {
    	if(request.readyState == 4) {
	    	if(request.status == 201) {
		      
    		}
		}
	};
	request.open('POST', `java/services/addingArticle.php`, 0);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("title="+title+"&content="+content+"&author="+author);

	var params = [
    `user=${title}`,
    `user=${content}`,
    `user=${author}`
  ];
	console.log(request.responseText)
}