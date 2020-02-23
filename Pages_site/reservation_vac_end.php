<?php
session_start();
include '..\functions.php';

if (isset($_POST['modifier'])) {
	header('Location: ./Reservation_vac.php');
}

try{
	$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);





}
catch(PDOException $event) {
	echo "Erreur : ".$event -> getMessage()."<br/>";
	die();
}
?>