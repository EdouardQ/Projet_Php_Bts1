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
			echo "<p id='erreur_form'>Champ(s) vide(s)</p>";
		}
		$bool_champ_vide=0;
		return $bool_champ_vide;
}

function erreur_date($bool_erreur_date){
	if ($bool_erreur_date==1){
			echo "<p id='erreur_form'>Erreur date</p>";
		}
		$bool_erreur_date=0;
		return $bool_erreur_date;
}

function verif_mdp ($bool_mdp_diff){
	if ($bool_mdp_diff==1){
			echo "<p id='erreur_form'>Mots de passe différents</p>";
		}
		$bool_mdp_diff=0;
		return $bool_mdp_diff;
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

	$sql="SELECT logement.id_logement, logement.type FROM logement WHERE logement.id_logement NOT IN (SELECT logement_attribue.id_logement FROM logement_attribue INNER JOIN reservation_sejour ON logement_attribue.id_sejour=reservation_sejour.id_sejour WHERE (reservation_sejour.date_debut_sejour BETWEEN '$date_debut' AND '$date_fin') OR (reservation_sejour.date_fin_sejour BETWEEN '$date_debut' AND '$date_fin') OR (reservation_sejour.date_debut_sejour < '$date_debut' AND reservation_sejour.date_fin_sejour > '$date_fin'))";

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
		return "<p id='logement_excessif'>Il n'y a pas assez de logements selectionnés pour le nombre de personnes, ou il n'y plus assez de logement à cette période.</p>";
	}
	return 1;
}

function validation_reserv($cnx, $id_user, $nb_adulte, $nb_enfant, $nb_personnes, $restauration, $date_debut_sejour, $date_fin_sejour, $nb_2c2l, $nb_1c1ld, $nb_1c3l, $nb_1c4l, $nb_1cmr){

	$nb_logement=$nb_2c2l+$nb_1c1ld+$nb_1c3l+$nb_1c4l+$nb_1cmr;

	if ($restauration=="aucune") {
		$nb_pension=0;
		$nb_demi_pension=0;
	}elseif ($restauration=="demi_pension") {
		$nb_pension=0;
		$nb_demi_pension=$nb_personnes;
	}else{
		$nb_pension=$nb_personnes;
		$nb_demi_pension=0;
	}

	$sql="INSERT INTO sejour (nb_logement,nb_adulte, nb_enfant, nb_enfant_bas_age, nb_pension, nb_demi_pension) VALUES ($nb_logement, $nb_adulte, $nb_enfant, $nb_enfant, $nb_pension, $nb_demi_pension)";
	$cnx->exec($sql);

	$sql="SELECT MAX(id_sejour) FROM sejour";
	$pdoreq=$cnx->query($sql);

	foreach ($pdoreq as $value) {
		$id_sejour=$value[0];
	}

	$sql="INSERT INTO reservation_sejour (id_sejour, id_user, date_debut_sejour, date_fin_sejour) VALUES ($id_sejour, $id_user, '$date_debut_sejour', '$date_fin_sejour')";
	$cnx->exec($sql);

	if ($nb_2c2l>0) {
		for ($i=0; $i < $nb_2c2l; $i++) { 
			$sql="SELECT MIN(logement.id_logement) FROM logement WHERE logement.id_logement NOT IN (SELECT logement_attribue.id_logement FROM logement_attribue INNER JOIN reservation_sejour ON logement_attribue.id_sejour=reservation_sejour.id_sejour WHERE (reservation_sejour.date_debut_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_fin_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_debut_sejour < '$date_debut_sejour' AND reservation_sejour.date_fin_sejour > '$date_fin_sejour') AND logement.type ='2 chambres a 2 lits')";

			$pdoreq=$cnx->query($sql);

			foreach ($pdoreq as $value) {
				$id_logement=$value[0];
			}

			$sql="INSERT INTO logement_attribue (id_sejour, id_logement) VALUES ($id_sejour,$id_logement)";
			$cnx->exec($sql);
		}
	}

	if ($nb_1c1ld>0) {
		for ($i=0; $i < $nb_1c1ld; $i++) { 
			$sql="SELECT MIN(logement.id_logement) FROM logement WHERE logement.id_logement NOT IN (SELECT logement_attribue.id_logement FROM logement_attribue INNER JOIN reservation_sejour ON logement_attribue.id_sejour=reservation_sejour.id_sejour WHERE (reservation_sejour.date_debut_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_fin_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_debut_sejour < '$date_debut_sejour' AND reservation_sejour.date_fin_sejour > '$date_fin_sejour') AND logement.type ='1 chambre a 1 lit double')";

			$pdoreq=$cnx->query($sql);

			foreach ($pdoreq as $value) {
				$id_logement=$value[0];
			}

			$sql="INSERT INTO logement_attribue (id_sejour, id_logement) VALUES ($id_sejour,$id_logement)";
			$cnx->exec($sql);
		}
	}

	if ($nb_1c3l>0) {
		for ($i=0; $i < $nb_1c3l; $i++) { 
			$sql="SELECT MIN(logement.id_logement) FROM logement WHERE logement.id_logement NOT IN (SELECT logement_attribue.id_logement FROM logement_attribue INNER JOIN reservation_sejour ON logement_attribue.id_sejour=reservation_sejour.id_sejour WHERE (reservation_sejour.date_debut_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_fin_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_debut_sejour < '$date_debut_sejour' AND reservation_sejour.date_fin_sejour > '$date_fin_sejour') AND logement.type ='1 chambre a 3 lits')";


			$pdoreq=$cnx->query($sql);

			foreach ($pdoreq as $value) {
				$id_logement=$value[0];
			}

			$sql="INSERT INTO logement_attribue (id_sejour, id_logement) VALUES ($id_sejour,$id_logement)";
			$cnx->exec($sql);
		}
	}

	if ($nb_1c4l>0) {
		for ($i=0; $i < $nb_1c4l; $i++) { 
			$sql="SELECT MIN(logement.id_logement) FROM logement WHERE logement.id_logement NOT IN (SELECT logement_attribue.id_logement FROM logement_attribue INNER JOIN reservation_sejour ON logement_attribue.id_sejour=reservation_sejour.id_sejour WHERE (reservation_sejour.date_debut_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_fin_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_debut_sejour < '$date_debut_sejour' AND reservation_sejour.date_fin_sejour > '$date_fin_sejour') AND logement.type ='1 chambre a 4 lits')";


			$pdoreq=$cnx->query($sql);

			foreach ($pdoreq as $value) {
				$id_logement=$value[0];
			}

			$sql="INSERT INTO logement_attribue (id_sejour, id_logement) VALUES ($id_sejour,$id_logement)";
			$cnx->exec($sql);
		}
	}

	if ($nb_1cmr>0) {
		for ($i=0; $i < $nb_1cmr; $i++) { 
			$sql="SELECT MIN(logement.id_logement) FROM logement WHERE logement.id_logement NOT IN (SELECT logement_attribue.id_logement FROM logement_attribue INNER JOIN reservation_sejour ON logement_attribue.id_sejour=reservation_sejour.id_sejour WHERE (reservation_sejour.date_debut_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_fin_sejour BETWEEN '$date_debut_sejour' AND '$date_fin_sejour') OR (reservation_sejour.date_debut_sejour < '$date_debut_sejour' AND reservation_sejour.date_fin_sejour > '$date_fin_sejour') AND logement.type ='1 chambre pour personne a mobilite reduite')";


			$pdoreq=$cnx->query($sql);

			foreach ($pdoreq as $value) {
				$id_logement=$value[0];
			}

			$sql="INSERT INTO logement_attribue (id_sejour, id_logement) VALUES ($id_sejour,$id_logement)";
			$cnx->exec($sql);
		}
	}
}

function affiche_sejours ($cnx, $id_user){
	$sql="SELECT sejour.id_sejour, reservation_sejour.date_debut_sejour, reservation_sejour.date_fin_sejour, sejour.nb_logement, sejour.nb_adulte, sejour.nb_enfant, sejour.nb_pension, sejour.nb_demi_pension FROM sejour INNER JOIN reservation_sejour ON reservation_sejour.id_sejour=sejour.id_sejour WHERE  reservation_sejour.id_user='$id_user'";

	$pdoreq=$cnx->query($sql);
	return $pdoreq;
}

function suppr_reservation ($cnx, $id_user, $id_sejour){
	$sql="DELETE FROM reservation_sejour WHERE id_user='$id_user' AND id_sejour='$id_sejour'"; 
	$cnx->exec($sql);

	$sql="DELETE FROM logement_attribue WHERE id_sejour='$id_sejour'";
	$cnx->exec($sql);

	$sql="DELETE FROM sejour WHERE id_sejour='$id_sejour'";
	$cnx->exec($sql);
}
?>