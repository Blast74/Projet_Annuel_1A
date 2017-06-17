var selectedTab = "top"; //Onglet sélectionné News, TOP ou Suggestions

var TabPageInfo = {
top: {style: null, page: 1},     //musiques les plus vues
news: {style: null, page: 1},    //nouvelles musiques
suggestion: {style: null, page:1}//Suggestions
};

//Définie l'onglet en cours d'utilisation
function tabNavigation (tabName) {
selectedTab = tabName.id;
  MusicSubtypeList ();
}

//Récupère les musiques de la base de données
function dbMusicRequest (musicSubtype, currentpage) {
    var request = new XMLHttpRequest ();
    request.onreadystatechange =  function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
         result = JSON.parse (request.responseText);
      }
      if (request.readyState  == 4 && request.status == 200 ) {
        var number = CountPages (result);
        var maxpage = CountMaxPageNumber (result ["maxresults"]);
        playersDisplay (maxpage, number, currentpage)
        musicDisplay (result, number);
      }
    }
  }
  request.open('GET', 'music_conf/getMusics.php?subtype='+musicSubtype+'&currentpage='+currentpage);
  request.send();
}

//Insère les titre et les chemins des musiques dans les lecteurs audio
function musicDisplay (array, numberOfmusics){
    var audioTagId=0;
    for (var i = 0; i<(numberOfmusics);i++) {
      var musicTitle = document.getElementById(selectedTab+'musicTitle'+audioTagId);
      var musicName = array[i].music_name+'id :'+array[i].music_id; //RETIRER ID !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
      var player = document.getElementById(selectedTab+'player'+audioTagId);
      musicTitle.innerHTML = musicName;//Titre
      player.setAttribute ('src', array[i].upload_music);//source
      audioTagId++;
  }
}

//currentTab top / news /suggestion
function MusicSelection () {
  var selection = document.getElementById (selectedTab+'selectContainer');
  //Refresh le nombre de page en fonction du nombre de musique à afficher
  TabPageInfo[selectedTab]["style"] = selection.value;
  refreshPages ();
}

//Rafraichit l'affichage de la page
function refreshPages () {
  page = TabPageInfo[selectedTab]["page"];
  dbMusicRequest (TabPageInfo[selectedTab]["style"], page);
}

//Navigation précédent et suivant (permet de définir la page en cours d'utilsation)
function navigationButton (previous_next) {
  if  (previous_next == 'previous') {
    if (TabPageInfo[selectedTab]["page"] == 2) {
      NavButton ('deleteButton', 'previous');
    }
    TabPageInfo[selectedTab]["page"]--;
    NavButton ('createButton', 'next');
    dbMusicRequest (TabPageInfo [selectedTab]["style"], TabPageInfo[selectedTab]["page"]);
    }
  else { //NEXT
    TabPageInfo[selectedTab]["page"]++;
    NavButton ('createButton', 'previous');
    dbMusicRequest (TabPageInfo [selectedTab]["style"], TabPageInfo[selectedTab]["page"]);
  }
}

//Boutons de navigation => action: deleteButton | createButton, emplacement: previous | next
function NavButton (action, emplacement){
  var container;
  var button = document.getElementById(selectedTab+emplacement+'Button');
  switch (action) {
    case "createButton":
        if (button == null) {
          container = document.getElementById (selectedTab+emplacement+'Container');
          button = document.createElement ('a');
          button.setAttribute ("id", selectedTab+emplacement+"Button");
          button.setAttribute ("onclick", "navigationButton ('"+emplacement+"')");
          if (emplacement == 'next') {
            button.innerHTML =  'Suivant';
          }else {
            button.innerHTML =  'Précédent';
          }
          container.appendChild (button);
        }
      break;
    case "deleteButton":
    if (button != null) {
      container = document.getElementById(selectedTab+emplacement+'Container');
      removeButton = document.getElementById(selectedTab+emplacement+'Button');
      container.removeChild(removeButton);
      break;
    }
  }
}

//Compte le nombre de musiques à afficher
function CountPages (musicObject) {
  var number = 5;
  for (var i = 0;i < 5; i++) {
    if (result [i] == undefined){
      number -=1;
    }
  }
  return number;
}

//Compte le numéro de la dernière page
function CountMaxPageNumber (fetchedMusicNumber) {
  var lastPageNumber = 1;
  if (fetchedMusicNumber > 5) {
    lastPageNumber = (((fetchedMusicNumber-(fetchedMusicNumber%5))/5)+1);
    return lastPageNumber;
  }
  return lastPageNumber;
}

//number = nombre de lecteurs à créer
function createAudioTag (number) {
  for (var i =0; i < number; i++) {
    containerCounter = document.getElementById(selectedTab+'audiocontainer'+i).childNodes;
    if (containerCounter.length != 5) {

      audiocontainer = document.getElementById(selectedTab+'audiocontainer'+i);
      titleTag = document.createElement('p');
      titleTag.setAttribute ('id', selectedTab+'musicTitle'+i);
      audioTag = document.createElement ('audio');
      audioTag.setAttribute ('id', selectedTab+'player'+i);
      audioTag.setAttribute ('src', '');
      audioTag.setAttribute ('controls', '');
      audiocontainer.appendChild(titleTag);
      audiocontainer.appendChild(audioTag);
    }
  }
}
//number = nombre de lecteurs à conserver, suppression des lecteurs en trop
function deleteAudioTag (number) {

    for (var i = number; i <  5; i ++){
      containerCounter = document.getElementById(selectedTab+'audiocontainer'+i).childNodes;
      if (containerCounter.length == 5) {
        audiocontainer = document.getElementById (selectedTab+'audiocontainer'+(i));
        audioTag = document.getElementById(selectedTab+'player'+(i));
        titleTag = document.getElementById(selectedTab+'musicTitle'+(i));
        audiocontainer.removeChild(audioTag);
        audiocontainer.removeChild(titleTag);
      }
  }
}


//Adapte le nombre de lecteur et les boutons en fonction de ce qu'il faut afficher
function playersDisplay (maxpage, playernumber, currentpage) {

  if (maxpage == 1) {
    for (var i=0;i<playernumber;i++) {
        var containerCounter = document.getElementById(selectedTab+'audiocontainer'+i).childNodes;
      if (containerCounter != 5) {
        createAudioTag (playernumber);
      }
    }
    deleteAudioTag (playernumber);
    NavButton ("deleteButton", "previous");
    NavButton ("deleteButton", "next");
  }
  else if (maxpage == currentpage) {
    NavButton ("deleteButton", "next");
    deleteAudioTag (playernumber);
  }
  else {
    if (currentpage == 1) {
      createAudioTag (playernumber);
      NavButton ("deteteButton", "previous");
      NavButton ("createButton", "next");
    }
    else {
      createAudioTag (playernumber);
      NavButton ("createButton", "previous");
      NavButton ("createButton", "next");
    }
  }
}



//Affiche les sous types en fonction de la catégorie choisie
function MusicSubtypeList (){
  var style = document.getElementById (selectedTab+'selectSyle');
  var container = document.getElementById(selectedTab+'SubtypeDiv');
  var label = document.createElement ('label');
  var select = document.createElement('select');

  //supprime les ancienes entrées
  while (container.childNodes.length != 0) {
    container.childNodes.forEach(function (tag) {
       tag.parentNode.removeChild(tag);
    });
  }
  label.innerHTML = "Sous Genre :";
  container.appendChild(label);
  select.setAttribute ('id', selectedTab+'selectContainer');
  select.setAttribute ('name', 'subtype');
  select.setAttribute ('onchange', 'MusicSelection()');
  container.appendChild(select);
  fillSubtypeContainer (style);
  MusicSelection ();
}

//Change le contenu des sous types en fonction du style choisis
function fillSubtypeContainer (style) {
  for (var i =0; i< ListOfSubtype[style.value].length; i++){
    selectContainer = document.getElementById(selectedTab+'selectContainer');
    var option = document.createElement('option');
    option.setAttribute ('value', ListOfSubtype[style.value][i]);
    option.innerHTML = ListOfSubtype[style.value][i];
    if (i==0) {
      option.setAttribute ('selected', 'selected');
    }
    selectContainer.appendChild(option);
  }
}
