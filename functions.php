<?php
function Connection ($servername,$user, $password, $dbname){
	$cnx = new PDO("mysql:host=$servername;dbname=$dbname",$user,$password);
 	$cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 	return $cnx;
 }
function Connexion_user ($cnx, $email, $mdp){
	$sql="SELECT id_user, nom, prenom FROM utilisateur WHERE email='$email' and mdp=sha1('$mdp')";
 	$pdoreq=$cnx->query($sql);
 	$pdoreq -> setFetchMode(PDO::FETCH_BOTH);
 	foreach ($pdoreq as $var) {
 		$id_user_pdo=$var[0];
 		$nom_pdo=$var[1];
 		$prenom_pdo=$var[2];
 	}
 	if (isset($id_user_pdo)){
		$_SESSION['id_user'] =$id_user_pdo;
		$_SESSION['nom'] = $nom_pdo;
		$_SESSION['prenom'] = $prenom_pdo;
		header('Location: ./Accueil.php');
		exit;
	}else{
		echo "Login incorrect";
	}
}

function max_id($cnx,$id,$table){
	$sql="SELECT MAX($id) FROM $table";
	$pdoreq=$cnx->query($sql);
 	$pdoreq -> setFetchMode(PDO::FETCH_BOTH);
 	foreach ($pdoreq as $var) {
 		$max_id_logement=$var[0];
 	}
 	return $max_id_logement;
}

function insert_into($cnx, $sql){
	$cnx->exec($sql);
}

function truncate($cnx,$table){
	$sql="SET FOREIGN_KEY_CHECKS = 0;TRUNCATE TABLE $table;SET FOREIGN_KEY_CHECKS = 1";
	$cnx->exec($sql);
}

function test_email($cnx, $email){
	$test=1;
	$sql="SELECT id_user FROM utilisateur WHERE email='$email'";
	$pdoreq=$cnx->query($sql);
 	$pdoreq -> setFetchMode(PDO::FETCH_BOTH);
 	foreach ($pdoreq as $var) {
 		if (isset($var[0])){
 			$test=0;
 		}
 	}
 	return $test;
}

function creer_compte($cnx, $nom, $prenom, $email, $mdp, $telephone, $entreprise){
	$sql="INSERT INTO utilisateur (nom, prenom, email, mdp, telephone, entreprise) VALUES ('$nom', '$prenom', '$email', sha1('$mdp'), '$telephone', '$entreprise')";
	$cnx->exec($sql);
}

function affiche_vacances($cnx){
	$sql="SELECT nom FROM date_vacances where date_debut>=now()";
	$pdoreq=$cnx->query($sql);
	return $pdoreq;
}

function affiche_date_vacances($cnx, $vacances, $nb_semaine){

	$sql="SELECT";
}
?>