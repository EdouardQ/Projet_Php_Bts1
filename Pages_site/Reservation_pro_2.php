<?php
session_start();
include '..\functions.php';
setlocale(LC_TIME, "fr_FR");

if (!empty($_POST['nb_personnes'])){
	if (strtotime($_POST['date_debut_sejour']) < strtotime($_POST['date_fin_sejour'])){
		$_SESSION['nb_personnes']=$_POST['nb_personnes'];
		$_SESSION['nb_adulte']=$_SESSION['nb_personnes'];
		$_SESSION['nb_enfant']=0;
		$_SESSION['restauration']=$_POST['restauration'];
		$_SESSION['date_debut_sejour']=$_POST['date_debut_sejour'];
		$_SESSION['date_fin_sejour']=$_POST['date_fin_sejour'];
	}else{
		$_SESSION['erreur_date']=1;
		header('Location: ./Reservation_pro.php');
	}	
}else{
	$_SESSION['champ_vide']=1;
	header('Location: ./Reservation_pro.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Rousses - Reservation pro suite</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./design.css" media="all">
</head>
<body>
	<header>
		<?php
		if (isset($_SESSION['id_user'])){
			echo "<div id='hello'>Bonjour ".$_SESSION['nom']." ".$_SESSION['prenom']." | <a href='.\deconnexion.php' id='deco'>déconnexion</a></div>";
		}
		?>
		<div id="banner">
		<a href=".\accueil.php"><img id="logo" src="..\images\Logo-les-rousses.png" alt="Logo Les Rousses" title="Accueil"></a>
		<img id="background_header" src="..\images\jura_banner.jpg" alt="Le jura" title="Le jura"></div>
		<h1>Village Les Rousses</h1>
		<nav><ul>
			<li><a href=".\Accueil.php">Accueil</a></li>
			<li>Reservation
			<ul>
				<li><a href=".\reservation_vac.php">Vacances</a></li>
				<li><a href=".\reservation_pro.php">Professionelle</a></li>
				</ul></li>
			<li><a href=".\Mon_compte.php">Mon compte</a></li>
		</ul></nav>
	</header>
	<main>
		<div class="info"><h3>Information :</h3>Le materiel audio et video pourra être demandé à <a href=".\Courage.php" target="blank" id="meme">l'accueil</a>.<br>Les reservations professionnelles ne sont pas disponible en période de vacances scolaires.</div>
		<form method="post" action="Reservation_pro_validation.php" autocomplete="off">
			<fieldset id="cadre">
				<legend><h3>Reservation professionnelle suite</h3></legend>
				<div class="center">
					<?php
					echo "<h3>Veuillez choisir votre configuration des logements pour votre réservation <br>du ".utf8_encode(strftime("%A %d %B %G", strtotime($_SESSION['date_debut_sejour'])))." au ".utf8_encode(strftime("%A %d %B %G", strtotime($_SESSION['date_fin_sejour'])))." pour ".$_SESSION['nb_personnes']." personne(s)</h3>";
					
					try{
						$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);

						$pdoreq=verif_date_hors_vac ($cnx, $_SESSION['date_debut_sejour'], $_SESSION['date_fin_sejour']);

						foreach ($pdoreq as $value) {
							$verif_date_hors_vac=$value[0];
						}

						if ($verif_date_hors_vac!=0) {
							$_SESSION['erreur_date']=1;
							header('Location: ./Reservation_pro.php');
						}

						$table_nb_logements=[];
						$table_type=['2 chambre a 2 lits', '1 chambre a 1 lit double','1 chambre a 3 lits','1 chambre a 4 lits','1 chambre mobilite reduite'];
						$table_valeur=['2c2l','1c1ld','1c3l','1c4l','1cmr'];
						
						$pdoreq=affiche_nb_logements_libres_par_type($cnx, $_SESSION['date_debut_sejour'], $_SESSION['date_debut_sejour']);

						foreach ($pdoreq as $value) {
							$pdoreq_temp[]=$value[1];
						}
						$table_nb_logements=array_count_values($pdoreq_temp);

						$i=0;
						foreach ($table_nb_logements as $key => $value){ 
							echo "$key : <input type='number' name='$table_valeur[$i]' max='$value' min='0' placeholder='0' style=' width : 30px'>";
							$i++;
							if($i==2){
								echo "<br><br>";
							}else{
								echo "<span class='form'></span>";
							} 
						}
					}
					catch(PDOException $event) {
						echo "Erreur : ".$event -> getMessage()."<br/>";
						die();
					}
					?>
				</div><br>
				<div class="center"><input type="submit" name="suite" value="Suite">
      			<input type="reset" name="Reinitialiser" value="Reinitialiser"></div>
			</fieldset>
		</form>
		<?php
			$_SESSION['champ_vide']=champ_vide($_SESSION['champ_vide']);
		?>
	</main>
	<footer>
		<p>Bourgogne Franche-Comté Tourisme - Montagnes du Jura - Parc naturel régional du Haut-Jura - Jura Tourisme - Léman sans frontière<br>Village plaisir</p>
	</footer>
</body>
</html>