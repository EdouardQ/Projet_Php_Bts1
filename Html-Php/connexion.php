<?php
$user_db='root';
$password_db='';
$servername='127.0.0.1';
$dbname='station_les_rousses';

if (isset($_POST['email']) && isset($_POST['mdp'])) {
	$email=$_POST['email'];
	$mdp=$_POST['mdp'];
	try{
		$cnx = new PDO("mysql:host=$servername;dbname=$dbname",$user_db,$password_db);
	 	$cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	 	$sql="SELECT id_user, nom, prenom FROM utilisateur WHERE email='$email' and mdp='$mdp'";
	 	$pdoreq=$cnx->query($sql);
	 	$pdoreq -> setFetchMode(PDO::FETCH_BOTH);
	 	foreach ($pdoreq as $var) {
	 		$id_user_pdo=$var[0];
	 		$nom_pdo=$var[1];
	 		$prenom_pdo=$var[2];
	 	}
	 	if (isset($id_user_pdo)){
			session_start();
			$_SESSION['id_user'] =$id_user_pdo;
			$_SESSION['nom'] = $nom_pdo;
			$_SESSION['prenom'] = $prenom_pdo;
			header('Location: ./Mes_infos.php');
			exit;
		}else{
			echo "Login incorrect";
		}
	}
	catch(PDOException $event) {
		echo "Erreur : ".$event -> getMessage()."<br/>";
		die();
	}
}
?>