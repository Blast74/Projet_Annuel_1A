var currentPage = 0;
var selection;



function dbMusicRequest () {
  var request = new XMLHttpRequest ();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
        truc(request.responseText);
      }
      else {
        console.log('Non');
      }
    }
  }
  request.open('POST', 'ant_musicAjax.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send("param1=Array");
}

//Action: deleteButton \\ createButton.
//Emplacement: previous \\ next
function NavButton (action, emplacement){
  var button, container;
  switch (action) {
    case "createButton":
      container = document.getElementById (emplacement+'Container');
      button = document.createElement ('a');
      button.setAttribute ("onclick", emplacement+"()");
  		//button.setAttribute ("href", "#");
  		button.setAttribute ("id", emplacement+"Button");
      button.innerHTML =  emplacement; //.value ?

      console.log  (button);
      container.appendChild (button);
      break;
    case "deleteButton":
      container = document.getElementById(emplacement+'Container');
      removeButton = document.getElementById(emplacement+'Button');
      container.removeChild(removeButton);
      break;
  }
}



function truc (result) {
  var div = document.getElementById ('result');

result = JSON.parse (result); //Transforme un str en objet JS
console.log ( result);

//  div.innerHTML = result;
}
