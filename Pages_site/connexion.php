<?php
session_start();
$user_db='root';
$password_db='';
$servername='127.0.0.1';
$dbname='station_les_rousses';

include '..\functions.php';

if ($_POST['email']!="" && $_POST['mdp']!="") {
	$email=$_POST['email'];
	$mdp=$_POST['mdp'];
	try{
		$cnx=Connection ($servername,$user_db, $password_db, $dbname);
	 	Connexion_user($cnx,$email,$mdp);
	}
	catch(PDOException $event) {
		echo "Erreur : ".$event -> getMessage()."<br/>";
		die();
	}
}else{
	echo "Champ(s) renseigné(s) vide(s).";
}
?>