<?php
session_start();
$_SESSION['user_db']='root';
$_SESSION['password_db']='';
$_SESSION['servername']='127.0.0.1';
$_SESSION['dbname']='station_les_rousses';

include '..\functions.php';

if ($_POST['email']!="" && $_POST['mdp']!="") {
	$email=$_POST['email'];
	$mdp=$_POST['mdp'];
	try{
		$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);
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