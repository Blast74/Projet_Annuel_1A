<?php
	session_start();
	require "conf.inc.php";
	require "lib.php";
	include "admin/libSQL.php";

if (!empty($_POST["email"]) && !empty($_POST["pwd"])){
	$connection = dbConnect ();
	$query = $connection->prepare("SELECT pwd FROM USERS where email=:email;");
	$query -> execute (["email"=>$_POST["email"]]);
	$result = $query -> fetch();

	//Verification du mot de passe
	if (!empty($result) && password_verify ($_POST["pwd"], $result["pwd"])) {
		//Création du token d'accès
		$accessToken = md5(uniqid().$_POST["email"].time());
  		$query = $connection->prepare("SELECT email, user_id FROM USERS WHERE email=:email;");
        $query -> execute (["email"=>$_POST["email"]]);
        $result = $query -> fetch();

  		//Enregistrer la clé et l'ID de l'utilisateur dans la BDD
		$query = $connection->prepare("UPDATE USERS SET access_token =:access_token  WHERE email=:email;");
		$query -> execute (["access_token"=>$accessToken,"email"=>$_POST["email"] ]);

		//SESSION:
		$_SESSION ['id'] = $accessToken;

            	header("Location:index.php");
            	//header("Location: connection.php");
        }else {
				    	echo "identifiants incorrect";
				    	//header("Location: connection.php");
				}
}
else {
    	echo "Veuillez saisir des identifiants";
    	//header("Location: connection.php");
}
