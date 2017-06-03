var numberOfSelection = 0; //Nombre de musiques trouvées pour une catégorie séléectionnée
var currentPage = 1; //Page sur laquelle est l'utilisateur
var lastPageNumberSelectionNumber =0;  //Nombre de musiques sur la dernières page
var lastPageNumber = 0; //n° de la dernières page
var SelectedStyle; //Style de musique choisis par l'utilisateur


function CountPages () { //Calcule
	if (numberOfSelection <5) {
		lastPageNumber =1;
		lastPageNumberSelectionNumber = numberOfSelection;
	}
	else {
		lastPageNumber = (((numberOfSelection-(numberOfSelection%5))/5)+1); //Nombre de pages
		lastPageNumberSelectionNumber = numberOfSelection%5; //Nombre de musiques pour la dernière page
	}
}

function refreshPages () { // il faut ajuster la taille en fonction des suppressions de contenu
	CountPages ();
	container = document.getElementById('currentPage');
	if (lastPageNumber == 1) {
		container.innerHTML ='';
	}
	else {
		container.innerHTML = "Page n°"+currentPage+" / "+lastPageNumber;
	}
	//reset les boutons sur la page:
	var button, container;
	//supprime le bouton précédent
	button = document.getElementById('previousButton');
	if (button != null) {
		container = document.getElementById ('previousContainer');
		button = document.getElementById ('previousButton');
		container.removeChild(button);
	}
	//recréer bouton suivant s'il n'est pas la
	button = document.getElementById('nextButton');
	if (button == null) {
		container = document.getElementById('nextContainer');
		button = document.createElement ('a');
		button.setAttribute ("onclick", "next()");
		button.setAttribute ("href", "#");
		button.setAttribute ("id", "nextButton");
		button.innerHTML = "Suivant";
		container.appendChild(button);
	}
	//Supprime le bouton suivant si il y a moins de 5 musiques à afficher
	if (lastPageNumber == 1) {
		button = document.getElementById('nextButton');
		if (button != null) {
			container = document.getElementById ('nextContainer');
			button = document.getElementById ('nextButton');
			container.removeChild(button);
		}
	}
	playersDisplay('recreate');
}

function previous () {//Page précédente //VERIFIER SI IL EXISTE OU PAS
	CountPages();
	var container, currentPageNumber;
	if (currentPage == lastPageNumber){ //Créer le bouton suivant si on est plus sur la dernières page
		container = document.getElementById('nextContainer');
		var newButton = document.createElement ('a');
		newButton.setAttribute ("onclick", "next()");
		newButton.setAttribute ("href", "#");
		newButton.setAttribute ("id", "nextButton");
		newButton.innerHTML = "Suivant";
		container.appendChild(newButton);
	}
	//Supprime le bouton précécent si on arrive sur la page 1
	if (currentPage == 2) {
		var removeButton;
		container = document.getElementById('previousContainer');
		removeButton = document.getElementById('previousButton');
		container.removeChild(removeButton);
	}
	currentPage --;
	container = document.getElementById('currentPage');
	container.innerHTML = "Page n°"+currentPage+" / "+lastPageNumber;
	//actualise le contenu des lecteur en fonction de la page
	playerContent (SelectedStyle, currentPage);
}


function next () {//Page suivante
	CountPages();
	var container, currentPageNumber;
	if (currentPage == 1){//Créer le bouton précédent si on clique sur suivant (page 1)
		container = document.getElementById('previousContainer');
		var newButton = document.createElement ('a');
		newButton.setAttribute ("onclick", "previous()");
		newButton.setAttribute ("href", "#");
		newButton.setAttribute ("id", "previousButton");
		newButton.innerHTML = "Précédent";
		container.appendChild(newButton) ;
	}
	//Supprime le bouton suivant sur la dernière page
	if (currentPage == (lastPageNumber-1)) { //VERIFIER SI IL EXISTE OU PAS
		var removeButton;
		container = document.getElementById('nextContainer');
		removeButton = document.getElementById('nextButton');
		container.removeChild(removeButton);
	}
	currentPage ++;
	container = document.getElementById('currentPage');
	container.innerHTML = "Page n°"+currentPage+" / "+lastPageNumber;
	playerContent (SelectedStyle, currentPage);
}




function selection () {
	var selection = document.getElementById ('selection');
	numberOfSelection = musicList[selection.value].length; //A REMPLACER PAR LE CONTENU DE LA BDD
	currentPage=1;
	CountPages();
	refreshPages ();//Refresh le nombre de page en fonction du nombre de musique à afficher
	SelectedStyle = selection.value;
	playerContent (SelectedStyle, 1);
}


function playersDisplay (action) {
	var audioTag, audiocontainer, titleTag;
	if (action == 'reduce') {

		//etoiles (note)
		//A VIRER
		console.log ('Elements à afficher: '+lastPageNumberSelectionNumber);
		//supprime les balises audio en fonction du nombe de musique à aficher sur la page
		for (var i = 5; i > lastPageNumberSelectionNumber; i --){
			audiocontainer = document.getElementById ('audiocontainer'+(i-1));
			audioTag = document.getElementById('player'+(i-1));
			titleTag = document.getElementById('musicTitle'+(i-1));
			audiocontainer.removeChild(audioTag);
			audiocontainer.removeChild(titleTag);
		}
	}
	else if (action == 'recreate') {
		for (var i =0; i < 5; i++) {
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
}




function playerContent (musicStyle, currentPage) {//changements de page à faire
	var format = ".mp3";
	var path = "./music/"+musicStyle+"/";
	CountPages();
	//CREATION DES BALISES SI ELLE ONT ETE SUPPRIMEES !!!
	if (lastPageNumber == 1) { //S'il n'y a qu'une page à afficher
		playersDisplay('reduce');
		for (var i = 0; i < lastPageNumberSelectionNumber; i++) {
			//La boucle s'incrémante à chaque passage pour pouvoir changer le contenu des lecteurs
			var musicTitle = document.getElementById('musicTitle'+i);
			var musicName = musicList[musicStyle][i];
			var player = document.getElementById('player'+i);
			musicTitle.innerHTML = musicName;//Titre
			player.setAttribute ('src', path+musicName+format);//source
		}
	}
	else {//S'il y a plus d'une page

		if (currentPage == lastPageNumber){//Si c'est la dernières page
			//Suppression des balises audio en trop
			playersDisplay ('reduce');
			for (var i = 0; i < lastPageNumberSelectionNumber; i++) {
				//La boucle s'incrémante à chaque passage pour pouvoir changer le contenu des lecteurs
				var musicTitle = document.getElementById('musicTitle'+i);
				var musicName = musicList[musicStyle][i];
				var player = document.getElementById('player'+i);
				musicTitle.innerHTML = musicName;//Titre
				player.setAttribute ('src', path+musicName+format);//source
			}
		}
		else {
			//Création des balises manquantes
			playersDisplay ('recreate');
			//Affichage du contenu
			var audioTagId=0;
			for (var i = ((currentPage*5)-5); i<(currentPage*5);i++) {
			//La boucle s'incrémante à chaque passage pour pouvoir changer le contenu des 5 lecteurs
				var musicTitle = document.getElementById('musicTitle'+audioTagId);
				var musicName = musicList[musicStyle][i];
				var player = document.getElementById('player'+audioTagId);
				musicTitle.innerHTML = musicName;//Titre
				player.setAttribute ('src', path+musicName+format);//source
				audioTagId++;
			}
		}
	}

}
