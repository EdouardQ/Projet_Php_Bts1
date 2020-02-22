<?php
session_start();
include '..\functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Rousses - Créer mon compte</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./design.css" media="all">
</head>
<body>
	<header>
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
	<p><h3>Information :</h3>Veuillez rentrer vos informations personnelles :</p>
	<form method="post" id="creation_compte" action=".\creation_compte.php" autocomplete="on">
		<fieldset>
			<p>Nom : <input type="text" name="nom"> Prénom : <input type="text" name="prenom"></p>
			<p>e-mail : <input type="email" name="email"> Mot de passe : <input type="password" name="mdp"></p>
			<p>Numéro de téléphone : <input type="tel" name="telephone" minlength="10"> Entreprise : <input type="text" name="entreprise"></p>
		</fieldset>
		<input type="submit" name="Envoyer" id="envoyer_creer_compte">
		<input type="reset" name="Effacer" id="effacer">
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