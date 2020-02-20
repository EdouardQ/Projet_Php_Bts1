<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Rousses - Reservation_vac</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./design.css" media="all">
</head>
<body>
	<header>
		<?php
		$lien_deco='';
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
		<form method="post" action="...........">
			<fieldset>
				<legend><h3>Reservation de vacances</h3></legend>
				<p>Nombre de personnes : <input type="number" name="nombre_pers">
				Type de chambre : <select>
				 	<option value="......">.......</option>
				 </select>
				Restauration : <select>
				 	<option value="......">Aucune</option>
				 	<option value="......">demi-pension</option>
				 	<option value="......">pension complète</option>
				 </select></p>
				<p>Date de début : <input type="date" name="date_debut_sejour">
					Date de fin : <input type="date" name="date_fin_sejour"></p>
				<input type="submit" name="valider" value="valider">
      			<input type="reset" name="reinitialiser" value="reinitialiser">
			</fieldset>
		</form>
	</main>
</body>
</html>