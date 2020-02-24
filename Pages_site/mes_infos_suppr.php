<?php
session_start();
include '..\functions.php';

if ($_POST['suppr_reserv']!="") {
	try{
		$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);
		suppr_reservation($cnx, $_SESSION['id_user'], $_POST['suppr_reserv']);
	}
	catch(PDOException $event) {
		echo "Erreur : ".$event -> getMessage()."<br/>";
		die();
	}
}
header('Location: ./Mes_infos.php');
?>