<?php

require_once "conf.inc.php";


//Connexion à la base de données
function dbConnect (){
	    try {
            $connection = new PDO ( "mysql:host=".HOST.";dbname=".DBNAME , DBUSER , DBPWD );
        } catch (Exception $e){ //on passe dans le catch dès qu'on rencontre une erreur
            die("Erreur SQL".$e -> getMessage() ); //$e -> getMessage() //obtenir le message d'erreur
        }
        return $connection; // si pas de pb on ne rentre pas dans le catch et on se connecte
}

function VerifyModerator () {
    if (isset($_SESSION['id'])) {
        if (($_SESSION['moderator'] != 1) AND ($_SESSION['moderator'] != 2)  ){
            header("Location: index.php");
            exit ();
        }
    }
    else {
        header("Location: index.php");
        exit ();
    }
}

function verifyAdministrator () {
    $Administrator = false;
    if (isset($_SESSION['id'])) {
        if ($_SESSION['moderator'] != 2  ){ //Si pas admin
            header("Location: index.php");
            exit ();
        }
        else if ($_SESSION['moderator'] == 2) {  //Si admin
            $Administrator = true;
            return $Administrator;
        }
    }
    else {
        header("Location: index.php");
        exit ();
    }
}

function errors ($formPost, $formErrors) {
    $_SESSION["form_post"] = $formPost;
    $_SESSION["form_errors"] = $formErrors;
    if (empty ($_GET['id'])){
        header("Location: inscription.php");
    }
    else {
        header("Location: updateUser.php?id=".$_GET["id"]);
    }
}




function getUser ($sessionToken) {
	if (!empty($sessionToken)){
		$connection = dbConnect ();
		$query = $connection->prepare("SELECT * FROM USERS WHERE access_token = :sessionToken");
		$query -> execute ([":sessionToken"=>$sessionToken ]);
		$result = $query -> fetch();
		$data = [
			"id"=>$result["id"],
			"email"=>$result["email"],
			"pseudo"=>$result["pseudo"],
			"gender"=>$result["gender"],
			"firstname"=>$result["firstname"],
			"lastname"=>$result["lastname"],
			"birthday"=>$result["birthday"],
			"country"=>$result["country"],
			"update_date"=>$result["gender"],
			"active_account"=>$result["active_account"]
		];
	}
	else {
		$data = false;
	}
	return $data;
}

//Param 1: nom du dossier parent, param 2: nom du dossier à créer
function createDirectory ($dirType, $dirName) {

	if ($dirType == "musics" ||
		$dirType == "music_images" ||
		$dirType == "images") {
			$parentDirectory = "./".$dirType."/";
	}
	else {
		return false;
	}
	//Dossier parent
	if (!file_exists($parentDirectory)){
	  mkdir($parentDirectory);
	}
	switch ($dirType) {
		case 'musics':
			$directory = $parentDirectory.$dirName."/";
			break;

		default:
 			$directory = $parentDirectory;
			break;
	}
	if (!file_exists($directory)){
	  mkdir($directory);
	}
	return $directory;
}


function registerMailContent($pseudo, $accessToken, $pwdTemp){

	$result = '
      <div>
        <h1>Activer votre compte :</h1>
        <p>Vous venez de créer un compte musique review !</p>
        <h2>Vos identifiants :</h2>
        <p>Login : '.$pseudo.' </p>
        <p>Mot de passe : '.$pwdTemp.'</p>
        <br>

        <a href="http://localhost/Projet_Annuel_1A/changePwd.php?&user_informations=activate&pseudo='.$pseudo.'&access_token='.$accessToken.'">Activer votre compte</a>
      </div>';

    return $result;

}
function mailPwdChanged($pseudo, $pwd){

    $result = '
      <div>
        <h1>Nouveau Mot de passe :</h1>
        <p>Vous venez de modifier le mot de passe de votre compte musique review !</p>
        <h2>Vos identifiants :</h2>
        <p>Login : '.$pseudo.' </p>
        <p>Mot de passe : '.$pwd.'</p>
        <br>

        <a href="https://www.zebrol.fr/index.php">Rendez-vous chez Musique Review !</a>
      </div>';

    return $result;

}

function mailHeaderHtml(){

    $headers = "From: \"Musique Review\"<zebrolfr@gmail.com>\n";
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
    return $headers;

}

