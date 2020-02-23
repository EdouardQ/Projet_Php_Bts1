<?php
session_start();
include '..\functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Rousses - Mon compte</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./design.css" media="all">
</head>
<body>
	<header>
		<?php
		$lien_deco='';
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
	<?php
	if (isset($_SESSION['id_user'])){
		header('Location: .\Mes_infos.php');
	}?>

	<form method="post" id="identification" action=".\connexion.php" autocomplete="off">
		<fieldset>
			<p>e-mail : <input type="email" name="email"></p>
			<p>Mot de passe : <input type="password" name="mdp"></p>
		</fieldset>
		<input type="submit" name="Connexion" id="connexion">
		<input type="reset" name="Effacer" id="effacer">
	</form>
	<?php
		$_SESSION['champ_vide']=champ_vide($_SESSION['champ_vide']);
	?>

	<a href=".\creer_compte.php">Créer un compte</a>
</main>
<footer>
		<p>Bourgogne Franche-Comté Tourisme - Montagnes du Jura - Parc naturel régional du Haut-Jura - Jura Tourisme - Léman sans frontière<br>Village plaisir</p>
	</footer>
</body>
</html>