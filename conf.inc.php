<?php

define ("HOST", "localhost");
define ("DBNAME", "zebrolfrertest");
define ("DBUSER", "root");
define ("DBPWD", "root"); //Windows:    define ("DBPWD", "");


$listOfGenre=[
				"roc" => "Rock",
				"met" => "Metal",
				"rap" => "Rap",
				"blu" => "Blues",
				"chafr" => "Chanson Française",
				"cho" => "Chorale",
				"cou" => "Country",
				"dis" => "Disco",
				"ele" => "Electro",
				"cla" => "Musique classique",
				"tec" => "Techno",
				"hip" => "Hip Hop",
				"reg" => "Reggae"
				];


$listOfCountry=[
				"fr" => "France",
				"it" => "Italie",
				"pl" => "Pologne"
				];

$listOfGender=[
		"m" => "Homme",
		"w" => "Femme",
		"o" => "Autre"
		];

$listOfStatus = [
	"Supprimé",
	"Actif",
	"Banni",
	"Inactif"
];

$defaultGender = "m"; //valeur cochée par défaut la première fois qu'on va sur la page

$errors = [
	1 => "Votre pseudo doit faire entre 3 et 30 caractères",
	2 =>"Votre email n'est pas correct",
	3 =>"Votre mot de passe doit faire entre 8 et 16 caractères et être différent du pseudo",
	4 =>"Le mot de passe de confirmation ne correspond pas",
	5 =>"La date n'est pas correcte",
	6 =>"Veuillez sélectionner un genre dans la liste",
	7 =>"Veuillez sélecitonner un pays dans la liste",
	8 => "Le captcha n'est pas correct",
	9 => "Le mail existe déjà",
	10 => "Le pseudo existe déjà",
	11 => "Ne pas remplir un champs avec uniquement des espaces !",
	12 => "Le titre doit faire entre 3 et 30 caractères",
	13 => "Le nom de l'album doit faire entre 3 et 30 caractères",
	14 => "Le titre de cette musique existe déjà",
	15 => "Veuillez choisir un fichier à uploader",
	16 => "Veuillez sélectionner le bon format (.mp3)",
	17 => "Le fichier est trop gros",
	18 => "Problème d'upload du fichier"

];

$messages = [
	1 => "Votre musique à bien été ajouté !"
];
