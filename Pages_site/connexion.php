<?php
$user_db='root';
$password_db='';
$servername='127.0.0.1';
$dbname='station_les_rousses';

include '..\functions.php';

if (isset($_POST['email']) && isset($_POST['mdp'])) {
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
}
?>