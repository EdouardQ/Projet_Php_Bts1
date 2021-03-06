<?php
session_start();
setlocale(LC_TIME, "fr_FR");
include '.\functions.php';
if ($_SESSION['champ_vide']==1 || $_SESSION['logement_excessif']!=1) {
}
elseif (isset($_POST['date_debut_sejour']) && isset($_POST['date_fin_sejour']) && strtotime($_POST['date_debut_sejour']) < strtotime($_POST['date_fin_sejour'])){
	$_SESSION['date_debut_sejour']=$_POST['date_debut_sejour'];
	$_SESSION['date_fin_sejour']=$_POST['date_fin_sejour'];
}else{
	$_SESSION['erreur_date']=1;
	header('Location: ./Reservation_vac_2.php');
}
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
		<div><h3>Information :</h3>Les reservations se font du samedi au samedi pendant les vacances scolaires</div>
		<form method="post" action="Reservation_vac_validation.php">
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
						
						$pdoreq=affiche_nb_logements_libres_par_type($cnx, $_SESSION['date_debut_sejour'], $_SESSION['date_fin_sejour']);

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
				<div class="center"><input type="submit" name="suite" value="Suite"></div>
			</fieldset>
			<?php
				$_SESSION['champ_vide']=champ_vide($_SESSION['champ_vide']);
				if (isset($_SESSION['logement_excessif']) && $_SESSION['logement_excessif']!=1){
					echo $_SESSION['logement_excessif'];
				}
			?>
			<p id="PS"> Vous pourrez modifier les informations liées à votre réservation de séjour après cette page</p>
		</form>
	</main>
	<footer>
	<p>Bourgogne Franche-Comté Tourisme - Montagnes du Jura - Parc naturel régional du Haut-Jura - Jura Tourisme - Léman sans frontière<br>Village plaisir</p>
	</footer>
</body>
</html>