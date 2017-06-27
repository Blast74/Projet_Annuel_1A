<?php

//header('Content-Type: application/json');

$pdo = dbConnect ();

$result = $pdo->query("SELECT * FROM music");
$index = 0;

foreach ($result as $row) {
		$row["music_URL"];
		$index++;
}

if ($index > $_POST["alea"])
	$picked = $index %$_POST["alea"];

if ($index < $_POST["alea"])
	$picked = $_POST["alea"]%$index;


echo $picked;




/*
$result = $pdo->query("SELECT * FROM note WHERE email = $_GET['email'] AND genre = rock ");
$rock = 0;

$params = [
	[
		"email@email.com",
		"test@gmail.com"
	],
	[
		"rock",
		"electro",
		"variete",
		"rap"
	]
];

foreach ($result as $row) {
	$rock = $rock + $row["rate"];
	echo $row["rate"];
	echo " + ";
}
echo " = ";
echo $rock;




	$requete = $pdo->prepare('SELECT * FROM note WHERE email = ? AND genre = ? ');

$i = 0;
$rock = 0;
$rap = 0;
$variete = 0;
$electro = 0;

for ($i=0; $i < 1; $i++) { 
	
	$resultat = $requete->execute(['email', 'rock']);
	var_dump($requete);
	var_dump($resultat);
	$rock = $rock + intval($resultat['rate']);
	
	$resultat = $requete->execute(['rap', 'email']);

	$rap = $rap + $resultat['rate'];
	$resultat = $requete->execute(['variete', 'email']);
	$variete = $variete + $resultat['rate'];
	$resultat = $requete->execute(['electro', 'email']);
	$electro = $electro + $resultat['rate'];
	
}
echo $rock;
echo $rap;
echo $variete;
echo $electro;

$stmt = $pdo->query('SELECT WHERE author = ? IN (SELECT rate FROM note WHERE email = ?)');
$i = 0;
$eminem = 0;

while($i < 10)
{
	$resultat = $requete->fetch('eminem', 'email');
	$eminem = $eminem + $resultat['note'];
	$resultat = $requete->fetch('moby_hotel', 'email');
	$moby_hotel = $moby_hotel + $resultat['note'];
	$resultat = $requete->fetch('tryo', 'email');
	$tryo = $tryo + $resultat['note'];
	$resultat = $requete->fetch('ACDC', 'email');
	$ACDC = $ACDC + $resultat['note'];
	$i = $i + 1;
}

$music = array (
    "nom"  => array(1 => "Little Lover", 2 => "L hymne de nos campagnes", 3 => "rap god", 4 => "lift me up"),
    "genre" => array(1 => "rock", 2 => "variete", 3 => "rap", 4 => "electro"),
    "author"   => array(1 => "ACDC", 2 => "tryo", 3 => "eminem", 4 => "moby hotel"),
    "points" => array(1 => 0, 2 => 0, 3 => 0, 4 => 0)
);

$i = 1;
while ($i < 4) {
	if($music[2][$i] == "rock")
		$music[4][$i] =+ $rock;
	if($music[2][$i] == "rap")
		$music[4][$i] =+ $rap;
	if($music[2][$i] == "variete")
		$music[4][$i] =+ $variete;
	if($music[2][$i] == "electro")
		$music[4][$i] += $electro;
	$i++;
}
$i = 1;
while ($i < 4) {
	if($music[3][$i] == "ACDC")
		$music[4][$i] =+ $ACDC;
	if($music[3][$i] == "eminem")
		$music[4][$i] =+ $eminem;
	if($music[3][$i] == "tryo")
		$music[4][$i] =+ $tryo;
	if($music[3][$i] == "moby hotel")
		$music[4][$i] += $moby_hotel;
	$i++;
}
$i = 1;


while($i > 4)
{
	$date1 = new DateTime("2007-03-24");
	$date2 = new DateTime("2009-06-26");
	$interval = $date1->diff($date2);
	$i++;
}



// $stmt = $pdo->query('SELECT music_URL FROM music WHERE music_id = ?');

//$choice = $stmt->execute([1]);

//echo $choice;

var_dump($ACDC);
var_dump($eminem);
var_dump($tryo);
var_dump($moby_hotel);



*/














?>