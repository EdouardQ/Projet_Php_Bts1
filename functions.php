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

function champ_vide($bool_champ_vide){
	if ($bool_champ_vide==1){
			echo "<p id='champ_vide'>Champ(s) vide(s)</p>";
		}
		$bool_champ_vide=0;
		return $bool_champ_vide;
}

function creer_compte($cnx, $nom, $prenom, $email, $mdp, $telephone, $entreprise){
	$sql="INSERT INTO utilisateur (nom, prenom, email, mdp, telephone, entreprise) VALUES ('$nom', '$prenom', '$email', sha1('$mdp'), '$telephone', '$entreprise')";
	$cnx->exec($sql);
}

function affiche_vacances($cnx){
	$sql="SELECT DISTINCT nom FROM date_vacances WHERE nb_semaine=1 AND date_debut>=now()";
	$pdoreq=$cnx->query($sql);
	return $pdoreq;
}

function affiche_date_vacances($cnx, $vacances){
	$sql="SELECT date_debut, date_fin FROM date_vacances WHERE nom='$vacances'";
	$pdoreq=$cnx->query($sql);
	return $pdoreq;
}

function affiche_nb_logements_libres_par_type($cnx, $date_debut, $date_fin){
	/*Ici nous sommes obligé d'écrire une telle requête à cause d'un problème rencontré qui nous empêche d'utiliser deux boucles foreach dans une même page php sans raison apparente.*/
	$sql="SELECT(SELECT count(logement.id_logement) from logement where type='2 chambres a 2 lits' and logement.id_logement in (SELECT logement.id_logement from logement WHERE logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour BETWEEN $date_debut AND $date_fin)) 
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_fin_sejour BETWEEN $date_debut AND $date_fin))
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour < $date_debut AND reservation_sejour.date_fin_sejour > $date_fin))))
,    
(SELECT count(logement.id_logement) from logement where type='1 chambre a 1 lit double' and logement.id_logement in (SELECT logement.id_logement from logement WHERE logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour BETWEEN $date_debut AND $date_fin)) 
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_fin_sejour BETWEEN $date_debut AND $date_fin))
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour < $date_debut AND reservation_sejour.date_fin_sejour > $date_fin))))
,    
(SELECT count(logement.id_logement) from logement where type='1 chambre a 3 lits' and logement.id_logement in (SELECT logement.id_logement from logement WHERE logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour BETWEEN $date_debut AND $date_fin)) 
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_fin_sejour BETWEEN $date_debut AND $date_fin))
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour < $date_debut AND reservation_sejour.date_fin_sejour > $date_fin))))
,    
(SELECT count(logement.id_logement) from logement where type='1 chambre a 4 lits' and logement.id_logement in (SELECT logement.id_logement from logement WHERE logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour BETWEEN $date_debut AND $date_fin)) 
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_fin_sejour BETWEEN $date_debut AND $date_fin))
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour < $date_debut AND reservation_sejour.date_fin_sejour > $date_fin))))
,
(SELECT count(logement.id_logement) from logement where type='1 chambre pour personne a mobilite reduite
' and logement.id_logement in (SELECT logement.id_logement from logement WHERE logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour BETWEEN $date_debut AND $date_fin)) 
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_fin_sejour BETWEEN $date_debut AND $date_fin))
and logement.id_logement not in (
SELECT logement_attribue.id_logement from logement_attribue inner join reservation_sejour on logement_attribue.id_sejour in (
SELECT reservation_sejour.id_sejour from reservation_sejour where reservation_sejour.date_debut_sejour < $date_debut AND reservation_sejour.date_fin_sejour > $date_fin))))"; 
$pdoreq=$cnx->query($sql);
return $pdoreq;
}


function verif_reservation_excessive($nb_personnes, $nb_2c2l, $nb_1c1ld, $nb_1c3l, $nb_1c4l, $nb_1cmr){
	$places_reservees_min=$nb_2c2l*2+$nb_1c1ld*1+$nb_1c3l*2+$nb_1c4l*2+$nb_1cmr;
	$places_reservees_max=$nb_2c2l*4+$nb_1c1ld*2+$nb_1c3l*3+$nb_1c4l*4+$nb_1cmr;
	if ($nb_personnes<$places_reservees_min){
		return "<p id='logement_excessif'>Trop de logements ont été selectionné.</p>";
	}
	if ($nb_personnes>$places_reservees_max){
		return "<p id='logement_excessif'>Il n'y a pas assez de logements selectionnés pour le nombre de personnes.</p>";
	}
	return 1;
}

function validation_reserv($cnx, $nb_adulte, $nb_enfant, $restauration, $date_debut_sejour, $date_fin_sejour, $nb_2c2l, $nb_1c1ld, $nb_1c3l, $nb_1c4l, $nb_1cmr){



}
?>