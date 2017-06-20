
//Affiche les sous types en fonction de la catégorie choisie
function MusicSubtypeList (){
  var style = document.getElementById ('selectSyle');
  var container = document.getElementById('SubtypeDiv');
  var label = document.createElement ('label');
  var select = document.createElement('select');

  //supprime les ancienes entrées
  while (container.childNodes.length != 0) {
    container.childNodes.forEach(function (tag) {
       tag.parentNode.removeChild(tag);
    });
  }

  //Ne pas créer ou supprimer les boutons s'il existent déjà
  //container.removeChild(label);
  //container.removeChild(br);
  //container.removeChild(select);
  label.innerHTML = "Sous Genre :";
  container.appendChild(label);
  select.setAttribute ('id', 'selectContainer');
  select.setAttribute ('name', 'subtype');
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
    selectContainer.appendChild(option);
  }
}

function verifForm (form) {
  var valid = false;
  var subtype = document.getElementById('selectContainer');
  if (subtype == null){
    MusicSubtypeList ();
  }else {
    valid = true;
  }
    return valid;
}
