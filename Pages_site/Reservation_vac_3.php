<?php
session_start();
include '..\functions.php';
if (!isset($_SESSION['date_debut_sejour']) && !isset($_SESSION['date_fin_sejour'])){
	$_SESSION['date_debut_sejour']=$_POST['date_debut_sejour'];
	$_SESSION['date_fin_sejour']=$_POST['date_fin_sejour'];
}
setlocale(LC_TIME, "fr_FR");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Rousses - Reservation_vac_suite</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./design.css" media="all">
</head>
<body>
	<header>
		<?php
		if (isset($_SESSION['id_user'])){
			echo "<div id='hello'>Bonjour ".$_SESSION['nom']." ".$_SESSION['prenom']." | <a href='.\deconnexion.php'>déconnexion</a></div>";
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
		<div><h3>Information :</h3>Les reservations se font du samedi au samedi pendant les vacances scolaires</div>
		<form method="post" action="Reservation_vac_4.php">
			<fieldset id="cadre">
				<legend><h3>Reservation de vacances</h3></legend>
				<div class='center'>
					<?php

					echo "<h3>Veuillez choisir votre configuration de logement(s) pour votre séjour du ".utf8_encode(strftime("%A %d %B %G", strtotime($_SESSION['date_debut_sejour'])))." au ".utf8_encode(strftime("%A %d %B %G", strtotime($_SESSION['date_fin_sejour'])))."<br> pour ".$_SESSION['nb_personnes']." personne(s)</h3>";
					
					try{
						$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);

						$table_nb_logements=[];
						$table_type=['2 chambre a 2 lits', '1 chambre a 1 lit double','1 chambre a 3 lits','1 chambre a 4 lits','1 chambre mobilite reduite'];
						$table_valeur=['2c2l','1c1ld','1c3l','1c4l','1cmr'];
						
						$pdoreq=affiche_nb_logements_libres_par_type($cnx, $_SESSION['date_debut_sejour'], $_SESSION['date_debut_sejour']);

						foreach ($pdoreq as $nb_logements => $value) {
							$table_nb_logements[]=$value[0];
							$table_nb_logements[]=$value[1];
							$table_nb_logements[]=$value[2];
							$table_nb_logements[]=$value[3];
							$table_nb_logements[]=$value[4];
						}
						
						for ($i=0; $i < count($table_nb_logements); $i++) { 
							echo "$table_type[$i] : <input type='number' name='$table_valeur[$i]' max='$table_nb_logements[$i]' min='0' placeholder='0' style=' width : 30px'>";
							if($i==2){
								echo "<br>";
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
				<div class="center"><input id="valider" type="submit" name="valider" value="Valider"></div>
			</fieldset>
			<?php
				$_SESSION['champ_vide']=champ_vide($_SESSION['champ_vide']);
			?>
			<p id="PS"> Vous pourrez modifier les informations liées à votre réservation de séjour après cette page</p>
		</form>
	</main>
	<footer>
	<p>Bourgogne Franche-Comté Tourisme - Montagnes du Jura - Parc naturel régional du Haut-Jura - Jura Tourisme - Léman sans frontière<br>Village plaisir</p>
	</footer>
</body>
</html>