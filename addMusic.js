var selected = null;//a remplacer par ce que l'utilisateur avait choisit


function test (){
//console.log(Object.keys(ListOfSubtype));
//console.log(selected);
//console.log(ListOfSubtype[selected].length);


 var test  = document.getElementById ('selectContainer');
 //var tag = document.getElementsByName('');
 //console.log(test);
 //console.log(tag.length);
  var tag = test.childNodes;


 for (var i = 0; i<tag.length;i++) {
   var toto = test.removeChild(tag[i]);
   console.log(tag[i]);
 }


}


//Affiche les sous types en fonction de la catégorie choisie
function MusicSubtypeList (){
  var style = document.getElementById ('selectSyle');
  var container = document.getElementById('SubtypeDiv');
  var br = document.createElement ('br');
  var label = document.createElement ('label');
  var select = document.createElement('select');

  if (container.childNodes.length != 1) {
    console.log('remove');
    var test  = document.getElementById ('SubtypeDiv');
    var tag = test.childNodes;
    //console.log(test);
    //console.log(tag.length);
    for (var i = 0; i<tag.length;i++) {
      test.removeChild(tag[i]);
    }
  }

  //Ne pas créer ou supprimer les boutons s'il existent déjà
  //container.removeChild(label);
  //container.removeChild(br);
  //container.removeChild(select);
  label.innerHTML = "Sous Genre";
  container.appendChild(label);
  container.appendChild(br);
  select.setAttribute ('id', 'selectContainer');
  select.setAttribute ('name', 'subtype');
  select.setAttribute ('onchange', 'saveSelection()');
  container.appendChild(select);

  fillSubtypeContainer (style);
}

//Change le contenu des sous types en fonction du style choisis
function fillSubtypeContainer (style) {
  for (var i =0; i< ListOfSubtype[style.value].length; i++){
    selectContainer = document.getElementById('selectContainer');
    var option = document.createElement('option');
    option.setAttribute ('value', ListOfSubtype[style.value][i]);
    option.innerHTML = ListOfSubtype[style.value][i];
    if (selected == ListOfSubtype[style.value][i]) {
      option.setAttribute ('selected', 'selected');
    }
    selectContainer.appendChild(option);
  }
}

function saveSelection () {
  var option = document.getElementById ('selectContainer');
  selected = option.value;
}
