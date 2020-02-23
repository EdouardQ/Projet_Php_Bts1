<?php
session_start();
include '..\functions.php';
setlocale(LC_TIME, "fr_FR");

if (isset($_POST['nb_personnes']) && isset($_POST['date_debut_sejour']) && isset($_POST['date_fin_sejour'])){
	$_SESSION=['nb_personnes']=$_POST['nb_personnes'];
	$_SESSION=['restauration']=$_POST['restauration'];
	$_SESSION=['date_debut_sejour']=$_POST['date_debut_sejour'];
	$_SESSION=['date_fin_sejour']=$_POST['date_fin_sejour'];
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
		<form method="post" action="Reservation_pro_3.php" autocomplete="off">
			<fieldset id="cadre">
				<legend><h3>Reservation professionnelle</h3></legend>
				<div class="center">
					Nombre de personnes : <input type="number" name="nb_personnes" min=1 style=" width : 40px">
				<span class="form">Restauration : <select name="restauration">
				 	<option value="aucune">Aucune</option>
				 	<option value="demi_pension">demi-pension</option>
				 	<option value="pension_complete">pension complète</option>
				 </select></span><br><br>
				 <div class="centrer">
				 	Date de début : <input type="date" name="date_debut_sejour">
				 	<span class="form">Date de fin : <input type="date" name="date_fin_sejour"></span>
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