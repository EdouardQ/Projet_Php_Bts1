<?php
session_start();
$user_db='root';
$password_db='';
$servername='127.0.0.1';
$dbname='station_les_rousses';

include '..\functions.php';

if ($_POST['nom']!="" && $_POST['prenom']!="" && $_POST['email']!="" && $_POST['mdp']!="" && $_POST['telephone']!="" && $_POST['entreprise']!=""){
	$email=$_POST['email'];
	try{
		$cnx=Connection ($servername,$user_db, $password_db, $dbname);
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
