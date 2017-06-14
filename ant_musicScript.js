var currentpage = 1  ; //Page courante
var selectedStyle ='rock2'; //style musical choisit


//Récupère les musiques de la base de données
//action: count = compte le nombre de musiques à afficher
//action: search = trouve les musiques de la BDD
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
        //console.log("music à afficher :"+number);
        musicDisplay (result, number);
      }
    }
  }
  request.open('GET', 'ant_musicAjax.php?subtype='+musicSubtype+'&currentpage='+currentpage);
  request.send();
}

//Insère les titre et les chemins des musiques dans les lecteurs audio
function musicDisplay (array, numberOfmusics) {
    var audioTagId=0;
    for (var i = 0; i<(numberOfmusics);i++) {
      var musicTitle = document.getElementById('musicTitle'+audioTagId);
    //  console.log(musicTitle);
      var musicName = array[i].music_name+'id :'+array[i].music_id;
      var player = document.getElementById('player'+audioTagId);
      musicTitle.innerHTML = musicName;//Titre
      player.setAttribute ('src', array[i].upload_music);//source
      audioTagId++;
  }
}


function MusicSelection (selectedStyle, currentpage) {
  var selection = document.getElementById ('selection');
  //Refresh le nombre de page en fonction du nombre de musique à afficher
  selectedStyle = selection.value;
  refreshPages ();
}

function refreshPages () {
  currentpage = 1;
  NavButton ("deleteButton", "previous");
  NavButton ("createButton", "next");
  dbMusicRequest (selectedStyle, currentpage);
}


function navigationButton (previous_next) {
  if  (previous_next == 'previous') {
    if (currentpage == 2) {
      NavButton ('deleteButton', 'previous');
    }
    currentpage--;
    NavButton ('createButton', 'next');
    dbMusicRequest (selectedStyle, currentpage);
    }
  else { //NEXT
    currentpage++;
    NavButton ('createButton', 'previous');
    dbMusicRequest (selectedStyle, currentpage);
  }
  console.log("PAGE COOURANTE = "+currentpage);
}

//Boutons de navigation => action: deleteButton | createButton, emplacement: previous | next
function NavButton (action, emplacement){

  var container;
  var button = document.getElementById(emplacement+'Button');

  switch (action) {
    case "createButton":
        if (button == null) {
          container = document.getElementById (emplacement+'Container');
          button = document.createElement ('a');
          button.setAttribute ("id", emplacement+"Button");
          button.setAttribute ("onclick", "navigationButton ('"+emplacement+"')");

          button.innerHTML =  emplacement; //.value ?
          container.appendChild (button);
        }
      break;
    case "deleteButton":
    if (button != null) {
      container = document.getElementById(emplacement+'Container');
      removeButton = document.getElementById(emplacement+'Button');
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
    containerCounter = document.getElementById('audiocontainer'+i).childNodes;
    if (containerCounter.length != 5) {

      audiocontainer = document.getElementById('audiocontainer'+i);
      titleTag = document.createElement('p');
      titleTag.setAttribute ('id', 'musicTitle'+i);
      audioTag = document.createElement ('audio');
      audioTag.setAttribute ('id', 'player'+i);
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
      containerCounter = document.getElementById('audiocontainer'+i).childNodes;
      if (containerCounter.length == 5) {
        audiocontainer = document.getElementById ('audiocontainer'+(i));
        audioTag = document.getElementById('player'+(i));
        titleTag = document.getElementById('musicTitle'+(i));
        audiocontainer.removeChild(audioTag);
        audiocontainer.removeChild(titleTag);

      }
  }
}

function playersDisplay (maxpage, playernumber, currentpage) {
  if (maxpage == 1) {
    //console.log("maxpage=1");
    var containerCounter = document.getElementById('audiocontainer'+i).childNodes;
    for (var i=0;i<playernumber;i++) {
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
    createAudioTag (playernumber);
  }
}
