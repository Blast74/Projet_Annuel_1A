var selectedTab = "top"; //Onglet sélectionné News, TOP ou Suggestions

var TabPageInfo = {
top: {style: null, page: 1},     //musiques les plus vues
news: {style: null, page: 1},    //nouvelles musiques
suggestion: {style: null, page:1}//Suggestions
};




//Cherche si l'utilisateur à déja voté ou non renvoi false ou
function test () {
  voteForMusic ();
}
//Enregistre le vote de l'utilisateur en base de donnée
function voteForMusic (music_infos, note) {
  var title = music_infos[0].trim();
  var author = music_infos[1].trim ();
  var request = new XMLHttpRequest ();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log(request.responseText);
      }
      else {
        console.log('Non');
      }
    }
  }
  request.open('POST', 'music_conf/voteForMusic.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send("title="+title+'&author='+author+'&note='+note);
}


//Compte le nombre de balises dans les contenaires de musiques
function childnodeCounter (container) {
  var counter =0;
   for (var i = 0; i< container.length; i++) {
     if ((container[i].tagName == "AUDIO")|| (container[i].tagName == "P" )) {
       counter++;
     }
    }
    if (counter == 3) {
      return true;
    }
    else return false;
}



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
    for (var i = 0; i<(numberOfmusics);i++) {
      var musicTitle = document.getElementById(selectedTab+'-musicTitle-'+i);
      var player = document.getElementById(selectedTab+'-player-'+i);
      var notetag = document.getElementById(selectedTab+'-note-'+i);

      musicTitle.innerHTML = array[i].music_name+" composée par "+array[i].author_pseudo;
      musicTitle.setAttribute ('href', 'artist.php?'+array[i].author_pseudo+'&'+array[i].music_name);
      musicTitle.setAttribute ('class', 'center-block');
      player.setAttribute ('src', array[i].upload_music);//source

      //NOTES
      notetag.innerHTML = (array[i].note_music != null )?"Note : "+array[i].note_music+"/5":"Pas encore de note !";
      //COMMENTAIRES DE L'ARTISTE
      if (array[i]['author_comment'].length != 0){
        var div = document.getElementById (selectedTab+'-comment-'+i);
        div.firstChild.style.color = '#0f4cad';
        if (div.childNodes.length <2) {
          p = document.createElement ('p');
          p.setAttribute ("hidden", '');
          p.innerHTML = array[i]['author_comment'];
          //  p.style.visibitity = 'hidden';
          div.setAttribute('onclick', 'hide (this)');
          div.appendChild(p);
        }
      }
  }
}

//Affiche les commentaires de l'artiste
function hide (comment) {
  comment.firstChild.style.color = 'black';
  comment.childNodes[1].removeAttribute ('hidden', '');
}

//Renvoie true si l'élément est null
function checkNodes (tagId, index) {
  var node = document.getElementById(selectedTab+tagId+index);
  if (node == null ){
    return true;
  }
  return false;
}



//CREATE LECTEURS
//number = nombre de lecteurs à créer
function createAudioTag (number) {
  for (var i =0; i < number; i++) {
    var containerCounter = document.getElementById(selectedTab+'-audiocontainer-'+i).childNodes;
    if (childnodeCounter (containerCounter) == false) { //Taille à changer
      audiocontainer = document.getElementById(selectedTab+'-audiocontainer-'+i);
       if (checkNodes ( '-musicTitle-', i)) {
         titleTag = document.createElement('a'); //CHANGE EN A
         titleTag.setAttribute ('id', selectedTab+'-musicTitle-'+i);
         audiocontainer.appendChild(titleTag);
       }
       if (checkNodes ( '-player-', i)) {
         audioTag = document.createElement ('audio');
         audioTag.setAttribute ('id', selectedTab+'-player-'+i);
         audioTag.setAttribute ('src', '');
         audioTag.setAttribute ('controls', '');
         audiocontainer.appendChild(audioTag);
       }
       if (checkNodes ( '-vote-', i)) {
         audiocontainer = document.getElementById (selectedTab+'-audiocontainer-'+(i));
         noteTag = document.createElement ('div');
         noteTag.id = selectedTab+'-vote-'+i;
         var p = document.createElement ('p');
         p.innerHTML = ('Noter');
         p.setAttribute ('class', 'd-inline');
         p.setAttribute ('onclick', 'note(this)');
         p.id = selectedTab+'-sendvote-'+i;
         noteTag.appendChild (p);
         audiocontainer.appendChild(noteTag);
         noteTag.style.color = '#0d52c1';

         if (checkNodes ('-notelist-', i)) {
           var select = document.createElement ('select');
           select.id = selectedTab+'-select-'+i;
           noteTag.appendChild(select);
           for (var j = 1; j <= 5; j++){
             var option = document.createElement ('option');
             option.value = j;
             option.innerHTML = j;
             if (j==5) {
               option.setAttribute ('selected', 'selected');
             }
             select.appendChild(option);
           }
         }
       }
        if (checkNodes ( '-note-', i)) {
          noteTag = document.createElement ('p');
          noteTag.id = selectedTab+'-note-'+i;
          audiocontainer.appendChild(noteTag);
        }
        //Vérification pour savoir s'il y a deja eu un vote pour une musique
        var info = document.getElementById (selectedTab+'-musicTitle-'+i).innerHTML.split (' composée par ');
        title = info[0];
        author =info [1];
        searchforvote (title, author, i);

        if (checkNodes ( '-comment-', i)) {
          div = document.createElement ('div');
          div.id = selectedTab+'-comment-'+i;
          div.innerHTML = '<i>commentaire de l\'artiste</i>';
          audiocontainer.appendChild(div);
        }
    }
  }
}


//supprime le bouton de vote si l'utilisateur à déjà voté
function searchforvote (title, author, i) {
  var request = new XMLHttpRequest ();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
         var result =  (request.responseText);
         console.log(result+i);

          if (result == 'true') {
            var containerToRemove = document.getElementById (selectedTab+'-audiocontainer-'+(i));
            var tagRemove  = document.getElementById (selectedTab+'-vote-'+(i));
            if (tagRemove != undefined ) {
              containerToRemove.removeChild (tagRemove);
              tagRemove = undefined;
            }
          }
      }
    }
  }
  request.open('GET', 'music_conf/getVote.php?title='+title+'&author='+author, 0);
  request.send();
}



//Vote pour une musique et supprime le select
function note (tag) {
  var id = tag.id.split ('-');
  var index = id[2];
  id.splice  (1, 1 ,'musicTitle');
  id = id.join ('-');
  var infos  = document.getElementById(id);
  var infos = infos.innerHTML.split (' composée par ');

  //Appel de la fonction AJAX
  var note = document.getElementById (selectedTab+'-select-'+index).value;
  voteForMusic(infos, note);
  remove = document.getElementById (tag.parentNode.childNodes[1].id);
  if (remove != undefined) {
    remove = document.getElementById (tag.parentNode.childNodes[1].id);
    tag.parentNode.removeChild(remove);
  }
  tag.removeAttribute ('onclik');
  tag.style.color ='black';
  tag.innerHTML = 'Merci !';
}







//number = nombre de lecteurs à conserver, suppression des lecteurs en trop
function deleteAudioTag (number) {
  var removeTag;
    for (var i = 4; i >=  number; i --){
        audiocontainer = document.getElementById (selectedTab+'-audiocontainer-'+(i));
        if (!checkNodes ( '-player-', i)) {
          removeTag = document.getElementById(selectedTab+'-player-'+(i));
          audiocontainer.removeChild(removeTag);
        }
        if (!checkNodes ( '-musicTitle-', i)) {
          removeTag = document.getElementById(selectedTab+'-musicTitle-'+(i));
          audiocontainer.removeChild(removeTag);
        }

        if (!checkNodes ( '-note-', i)) {
          removeTag  = document.getElementById(selectedTab+'-note-'+i);
          audiocontainer.removeChild(removeTag);
        }
        if (!checkNodes ( '-vote-', i)) {
          removeTag  = document.getElementById(selectedTab+'-vote-'+i);
          audiocontainer.removeChild(removeTag);
        }
        if (!checkNodes ( '-comment-', i)) { // A INTEGRER
          removeTag  = document.getElementById(selectedTab+'-comment-'+i);
          audiocontainer.removeChild(removeTag);
        }
        if (!checkNodes ( '-notelist-', i)) { // A INTEGRER
          removeTag  = document.getElementById(selectedTab+'-notelist-'+i);
          audiocontainer.removeChild(removeTag);
        }

  }
}

//Renseigne le style musical sélectionné dans une variable globale
function MusicSelection () {
  var selection = document.getElementById (selectedTab+'selectContainer');
  TabPageInfo[selectedTab]["style"] = selection.value;
  refreshPages ();
}

//Rafraichit l'affichage de la page (style et n° de page à afficher)
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
    lastPageNumber =   (fetchedMusicNumber - (fetchedMusicNumber%5))/5;
    if ((fetchedMusicNumber%5)!=0) {
      lastPageNumber++;
    }
  }
  return lastPageNumber;
}



//Adapte le nombre de lecteur et les boutons en fonction de ce qu'il faut afficher
function playersDisplay (maxpage, playernumber, currentpage){
  if (maxpage == 1){
    for (var i=0;i<playernumber;i++){
        var containerCounter = document.getElementById(selectedTab+'-audiocontainer-'+i).childNodes;
      if (childnodeCounter (containerCounter) == false) { //A modifier en fonction du nombre de balise à mettre
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

//Affiche les sous-types en fonction du style musical choisit
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
