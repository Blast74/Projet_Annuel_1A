<?php
	session_start();
	require "conf.inc.php";
	require "lib.php";
// <form method=POST action="connection.php"> == <form method=POST> car ça redirige sur la même page


//valeurs existent
// récupération en BDD du mot de passe haché
// comparaison du mot de passe saisi avec le mot de passe haché (fonction native)
// redirection ou affichage de l'erreur

if (!empty($_POST["email"]) && !empty($_POST["pwd"])){
	$connection = dbConnect ();
	$query = $connection->prepare("SELECT pwd FROM USERS where email=:email;");
	$query -> execute (["email"=>$_POST["email"]]);
	$result = $query -> fetch();


	//Verification du mot de passe
	if (!empty($result) && password_verify ($_POST["pwd"], $result["pwd"])) {
		//Création du token d'accès
		$accessToken = md5(uniqid().$_POST["email"].time());
  		$query = $connection->prepare("SELECT email FROM USERS WHERE email=:email;");
        $query -> execute (["email"=>$_POST["email"]]);
        $result = $query -> fetch();

  	
  		//Enregistrer la clé et l'ID de l'utilisateur dans la BDD
		$query = $connection->prepare("UPDATE USERS SET access_token =:access_token  WHERE email=:email;");
		$query -> execute (["access_token"=>$accessToken,"email"=>$_POST["email"] ]); 

		//SESSION:
		$_SESSION ['id'] = md5 (uniqid().$_POST['email'].time());
				
		//Vérification du statut modérateur
		$query = $connection->prepare("SELECT moderator FROM USERS where email=:email;");
		$query -> execute (["email"=>$_POST["email"]]);
		$result = $query -> fetch();

			if ($result ['moderator'] == 1) {
				$_SESSION ['moderator'] = 1;

			}
			else {
				$_SESSION ['moderator'] = 0;
			}
			//redirection
			header("Location: index.php");
		}
		else {
            	echo "Vérifiez vos identifiants";
            	//header("Location: connection.php");
        }
}
else {
    	echo "Veuillez saisir des identifiants";
    	//header("Location: connection.php");
}



?>
