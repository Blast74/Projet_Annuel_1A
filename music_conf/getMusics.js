var selectedTab = "top"; //Onglet sélectionné News, TOP ou Suggestions

var TabPageInfo = {
top: {style: null, page: 1},     //musiques les plus vues
news: {style: null, page: 1},    //nouvelles musiques
suggestion: {style: null, page:1}//Suggestions
};


function like (tag) {
  var id = tag.id.split ('-');
  var index = id[2];
  id.splice  (1, 1 ,'musicTitle');
  id = id.join ('-');
  var infos  = document.getElementById(id);
  var infos = infos.innerHTML.split (' composée par ');

  title = infos[0];
  author = infos[1];

  var request = new XMLHttpRequest ();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
      }
    }
  }
  request.open('POST', 'music_conf/like.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send("title="+title+'&author='+author);
  //modification du bouton like
  tag.setAttribute ('class','btn btn-warning btn-xs');
  tag.setAttribute ('onclick','unlike (this)');
  tag.innerHTML ='Ne plus aimer';
}


function unlike (tag) {
  var id = tag.id.split ('-');
  var index = id[2];
  id.splice  (1, 1 ,'musicTitle');
  id = id.join ('-');
  var infos  = document.getElementById(id);
  var infos = infos.innerHTML.split (' composée par ');

  title = infos[0];
  author = infos[1];

  var request = new XMLHttpRequest ();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
      }
    }
  }
  request.open('POST', 'music_conf/unlike.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send("title="+title+'&author='+author);
    //modification du bouton
  tag.setAttribute ('class','btn btn-primary btn-xs');
  tag.setAttribute ('onclick','like (this)');
  tag.innerHTML ='J\'aime';
}




function getFollow (author) {
  var request = new XMLHttpRequest ();
  request.onreadystatechange =  function () {
  if (request.readyState == 4) {
    if (request.status == 200) {
       result = JSON.parse (request.responseText);
    }

  }
}
request.open('GET', 'music_conf/getFollow.php?author='+author, 0);
request.send();
return request.responseText;
}


function getLike (music_id) {

  var request = new XMLHttpRequest ();
  request.onreadystatechange =  function () {
  if (request.readyState == 4) {
    if (request.status == 200) {
       result = JSON.parse (request.responseText);
    }

  }
}
  request.open('GET', 'music_conf/getLike.php?music_id='+music_id, 0);
  request.send();
  return request.responseText;
}




//Suivre un utilisateur
function follow (tag) {
  var author = tag.value;
  var request = new XMLHttpRequest ();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log(request.responseText);
      }
    }
  }
  request.open('POST', 'music_conf/follow.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send("author="+author);

  var author = tag.value;
  var button = document.getElementsByTagName ("button");
  for (var i = 0; i < button.length; i++) {
    if (button[i].value == author) {
      button[i].innerHTML = "Ne plus suivre";
      button[i].setAttribute ('class', 'btn btn-danger btn-xs');
      button[i].setAttribute  ('onclick', 'unfollow (this)');
    }
  }

}




//Ajoute des informations dans l'Objet musique (follow et like)
function getSocialFeatures (objMusic, index){
  //creation du tableau contenant différents pseudo de la page affichée
  var followtab = [];
  for (var i = 0; i < index; i++) {
    if (followtab.indexOf (objMusic[i].author_pseudo) == -1   ){
      followtab.push( objMusic[i]["author_pseudo"]);
    }
  }

  //Appel de la fonction getFollow en fonction des pseudo du tableau followtab
  for (var i = 0; i < followtab.length; i++) {
    var infos = getFollow (followtab[i]);
     if (infos == 'true') {
       for (var j = 0; j < index; j++) {
         if ((objMusic [j]["author_pseudo"]).includes (followtab[i])  ) {
           objMusic [j] ['follow'] = 'yes';
         }
       }
     }
  }
  //Appel de la fonction GetLike pour récupérer les like d'une musique
  for (var i = 0; i < index; i++) {
      infos = getLike (objMusic[i]['music_id']);
      if (infos == 'true') {
        objMusic [i] ['like'] = 'yes';
      }
  }

  return objMusic;
}

//Définie l'onglet en cours d'utilisation
function tabNavigation (tabName) {
selectedTab = tabName.id;
  MusicSubtypeList ();
}

//Récupère les musiques de la base de données
function dbMusicRequest (musicSubtype, currentpage, selectedTab) {
    var request = new XMLHttpRequest ();
    request.onreadystatechange =  function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
         result = JSON.parse (request.responseText);
      }
      if (request.readyState  == 4 && request.status == 200 ) {
        var number = CountPages (result);
        var maxpage = CountMaxPageNumber (result ["maxresults"]);
        //FOLLOW + LIKE
        result = getSocialFeatures (result, number);
        playersDisplay (maxpage, number, currentpage );
        musicDisplay (result, number);
        deleteVoteButton ('vote', number);
      }
    }
  }
  request.open('GET', 'music_conf/getMusics.php?subtype='+musicSubtype+'&currentpage='+currentpage+'&tabname='+selectedTab, 0);
  request.send();
}

//Insère les titre et les chemins des musiques dans les lecteurs audio
function musicDisplay (array, numberOfmusics){

    for (var i = 0; i<(numberOfmusics);i++) {
      var musicTitle = document.getElementById(selectedTab+'-musicTitle-'+i);
      var player = document.getElementById(selectedTab+'-player-'+i);
      var notetag = document.getElementById(selectedTab+'-note-'+i);

      musicTitle.innerHTML = array[i].music_name+" composée par "+array[i].author_pseudo;
      musicTitle.style.fontWeight = "800";
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

    //FOLLOW
    var button = document.getElementById (selectedTab+'-follow-'+i);
    button.value = array [i]["author_pseudo"];
    if (array[i]["follow"] =='yes') {
      button.innerHTML = "Ne plus suivre";
      button.setAttribute ('class', 'btn btn-danger btn-xs');
      button.setAttribute  ('onclick', 'unfollow (this)');
    }
    else {
      button.innerHTML = "Suivre";
      button.setAttribute ('class', 'btn btn-success btn-xs');
      button.setAttribute  ('onclick', 'follow (this)');
    }

    //LIKE
    var button = document.getElementById (selectedTab+'-like-'+i);
    if ((array [i]["like"]) == 'yes') {
      button.setAttribute ('class','btn btn-warning btn-xs');
      button.setAttribute ('onclick','unlike (this)');
      button.innerHTML ='Ne plus aimer';
    } else {
      button.setAttribute ('class','btn btn-primary btn-xs');
      button.setAttribute ('onclick','like (this)');
      button.innerHTML ='J\'aime';
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

//CREATION DES BALISES  LECTEURS AUDIO
//number = nombre de lecteurs à créer
function createAudioTag (number) {
  for (var i =0; i < number; i++) {
    var containerCounter = document.getElementById(selectedTab+'-audiocontainer-'+i).childNodes;
    if (childnodeCounter (containerCounter) == false) { //Taille à changer
      audiocontainer = document.getElementById(selectedTab+'-audiocontainer-'+i);
       if (checkNodes ( '-musicTitle-', i)) {
         titleTag = document.createElement('p');
         titleTag.setAttribute ('id', selectedTab+'-musicTitle-'+i);
         audiocontainer.appendChild(titleTag);
       }
       if (checkNodes ( '-player-', i)) {
         audioTag = document.createElement ('audio');
         audioTag.setAttribute ('id', selectedTab+'-player-'+i);
         audioTag.setAttribute ('src', '');
         audioTag.setAttribute ('controls', '');
         audiocontainer.appendChild(audioTag);
       }  //Bouton noter !

       if (checkNodes ( '-vote-', i) ) {
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
         //Select pour la note
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
        //Affiche la note
        if (checkNodes ( '-note-', i)) {
          noteTag = document.createElement ('p');
          noteTag.id = selectedTab+'-note-'+i;
          audiocontainer.appendChild(noteTag);
        }

        if (checkNodes ( '-comment-', i)) {
          div = document.createElement ('div');
          div.id = selectedTab+'-comment-'+i;
          div.innerHTML = '<i>commentaire de l\'artiste</i>';
          audiocontainer.appendChild(div);
        }

        if (checkNodes ( '-follow-', i)) {
          var button = document.createElement ('button');
          button.id = selectedTab+'-follow-'+i;

          audiocontainer.appendChild(button);
        }
        if (checkNodes ( '-like-', i)) {
          var button = document.createElement ('button');
          button.id = selectedTab+'-like-'+i;
          audiocontainer.appendChild(button);

        }
    }
  }
}




//Enregistre le vote de l'utilisateur en base de donnée
function voteForMusic (music_infos, note) {
  var title = music_infos[0].trim();
  var author = music_infos[1].trim ();
  var request = new XMLHttpRequest ();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
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


function unfollow (tag) {
  var author = tag.value;
  var request = new XMLHttpRequest ();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
      }
    }
  }
  request.open('POST', 'music_conf/unfollow.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send("author="+author);


  var author = tag.value;
  var button = document.getElementsByTagName ("button");
  for (var i = 0; i < button.length; i++) {
    if (button[i].value == author) {
      button[i].innerHTML = "Suivre";
      button[i].setAttribute ('class', 'btn btn-success btn-xs');
      button[i].setAttribute  ('onclick', 'follow (this)');
    }
  }
}



function deleteVoteButton (typeOfButton, numberOfTag) {
  if (typeOfButton == 'vote') {
    for (var i = 0; i < numberOfTag ; i++) {
      //Vérification pour savoir s'il y a deja eu un vote pour une musique
      var info = document.getElementById (selectedTab+'-musicTitle-'+i).innerHTML.split (' composée par ');
      title = info[0];
      author = info [1];
      voted = searchforvote (title, author, i);
      if (voted == 'true' ) {
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




//supprime le bouton de vote si l'utilisateur à déjà voté
function searchforvote (title, author, i) {
  var request = new XMLHttpRequest ();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
         var result =  (request.responseText);
         console.log(request.responseText);
      }
    }
  }
  request.open('GET', 'music_conf/getVote.php?title='+title+'&author='+author, 0);
  request.send();
  return (request.responseText);
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
      if (!checkNodes ( '-follow-', i)) {
        removeTag  = document.getElementById(selectedTab+'-follow-'+i);
        audiocontainer.removeChild(removeTag);
      }
      if (!checkNodes ( '-like-', i)) {
        removeTag  = document.getElementById(selectedTab+'-like-'+i);
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
  dbMusicRequest (TabPageInfo[selectedTab]["style"], page, selectedTab);
}

//Navigation précédent et suivant (permet de définir la page en cours d'utilsation)
function navigationButton (previous_next) {
  if  (previous_next == 'previous') {
    if (TabPageInfo[selectedTab]["page"] == 2) {
      NavButton ('deleteButton', 'previous');
    }
    TabPageInfo[selectedTab]["page"]--;
    NavButton ('createButton', 'next');
    dbMusicRequest (TabPageInfo [selectedTab]["style"], TabPageInfo[selectedTab]["page"], selectedTab);
    }
  else { //NEXT
    TabPageInfo[selectedTab]["page"]++;
    NavButton ('createButton', 'previous');
    dbMusicRequest (TabPageInfo [selectedTab]["style"], TabPageInfo[selectedTab]["page"], selectedTab);
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
