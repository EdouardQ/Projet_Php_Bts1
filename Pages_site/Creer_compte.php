<?php
session_start();
include '.\functions.php';
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
	<form method="post" action=".\creation_compte.php" autocomplete="on">
		<fieldset class="conn">
			<legend>Création de compte</legend>
			<div class="center">
			<p><span class="form">Nom : <input type="text" name="nom" style="width : 120px"></span><span class="form">Prénom : <input type="text" name="prenom" style="width : 120px"></span><span class="form">e-mail : <input type="email" name="email" style="width : 170px"></span><p> Mot de passe : <input type="password" name="mdp"><span class="form"> Confirmation du mot de passe : <input type="password" name="mdp_conf"></span></p>
			<p><span class="form">Numéro de téléphone : <input type="tel" name="telephone" minlength="10"></span><span class="form">Entreprise : <input type="text" name="entreprise"></span></p></div>
			<div class="center"><input type="submit" name="Envoyer" id="envoyer_creer_compte">
		<input type="reset" name="Effacer" id="effacer"></div>
		</fieldset>
	</form>
	<?php
		$_SESSION['champ_vide']=champ_vide($_SESSION['champ_vide']);
		$_SESSION['mdp_diff']=verif_mdp($_SESSION['mdp_diff']);
		if ($_SESSION['email_existant']==1){
			echo "<p id='erreur_form'>L'adresse e-mail renseignée existe déjà.</p>";
			$_SESSION['email_existant']=0;
		}
	?>
</main>
<footer>
		<p>Bourgogne Franche-Comté Tourisme - Montagnes du Jura - Parc naturel régional du Haut-Jura - Jura Tourisme - Léman sans frontière<br>Village plaisir</p>
	</footer>
</body>
</html>