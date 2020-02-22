<?php
session_start();
$_SESSION['user_db']='root';
$_SESSION['password_db']='';
$_SESSION['servername']='127.0.0.1';
$_SESSION['dbname']='station_les_rousses';

include '..\functions.php';

if ($_POST['nom']!="" && $_POST['prenom']!="" && $_POST['email']!="" && $_POST['mdp']!="" && $_POST['telephone']!="" && $_POST['entreprise']!=""){
	$email=$_POST['email'];
	try{
		$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);
		$test=test_email($cnx, $email);
		if ($test==0){
			echo "L'adresse e-mail renseignée existe déjà.<br>";
		}else{
			creer_compte ($cnx, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['telephone'], $_POST['entreprise']);
			Connexion_user ($cnx, $_POST['email'], $_POST['mdp']);
		}
	}
	catch(PDOException $event) {
	echo "Erreur : ".$event -> getMessage()."<br/>";
	die();
	}
}else{
	echo "Champ(s) renseigné(s) vide(s).";
}
?>
