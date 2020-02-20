<?php
session_start();
?>
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
	 	foreach ($variable as $key) {
	 		$type_chambre_pdo=
	 	}
	}
	catch(PDOException $event) {
		echo "Erreur : ".$event -> getMessage()."<br/>";
		die();
	}
}
