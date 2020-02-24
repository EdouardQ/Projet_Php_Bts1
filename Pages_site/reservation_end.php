<?php
session_start();
include '.\functions.php';

if (isset($_POST['modifier'])) {
	unset($_SESSION['nb_adulte']);
	unset($_SESSION['nb_enfant']);
	unset($_SESSION['nb_personnes']);
	unset($_SESSION['restauration']);
	unset($_SESSION['date_debut_sejour']);
	unset($_SESSION['date_fin_sejour']);
	unset($_SESSION['2c2l']);
	unset($_SESSION['1c1ld']);
	unset($_SESSION['1c3l']);
	unset($_SESSION['1c4l']);
	unset($_SESSION['1cmr']);
	header('Location: ./Reservation_vac.php');
}else{

	try{
		$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);
		validation_reserv($cnx, $_SESSION['id_user'], $_SESSION['nb_adulte'], $_SESSION['nb_enfant'], $_SESSION['nb_personnes'], $_SESSION['restauration'], $_SESSION['date_debut_sejour'], $_SESSION['date_fin_sejour'], $_SESSION['2c2l'], $_SESSION['1c1ld'], $_SESSION['1c3l'], $_SESSION['1c4l'], $_SESSION['1cmr']);

		$_SESSION['reservation_faite']=1;
		header('Location: ./Accueil.php');

	}
	catch(PDOException $event) {
		echo "Erreur : ".$event -> getMessage()."<br/>";
		die();
	}
}
?>