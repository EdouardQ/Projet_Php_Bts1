<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Rousses - Reservation_pro</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./design.css" media="all">
</head>
<body>
	<header>
		<?php
		if (isset($_SESSION['id_user'])){
			echo '<div id=\'hello\'>Bonjour '.$_SESSION['nom'].' '.$_SESSION['prenom'].' | <a href=".\deconnexion.php">déconnexion</a></div>';
		}
		?>
		<div id="fusion">
		<a href=".\accueil.php"><img id="logo" class="superpose" src="..\images\Logo-les-rousses.png" alt="Logo Les Rousses" title="Accueil"></a>
		<img id="background_header" class="superpose" src="..\images\jura.jpg" alt="Le jura" title="Le jura" id="fusion"></div>
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
		<div><h3>Information :</h3>Les materiels audio et video pourront être demandé à l'accueil.<br>Les reservations professionnelles ne sont pas disponible en période de vacances scolaires.</div>
		<form method="post" action="...........">
			<fieldset>
				<legend><h3>Reservation professionelle</h3></legend>
				<p class="form">Nombre de personnes : <input type="number" name="nombre_pers">
				<span class="form">Type de chambre :</span><select>
				 	<option value="......">.......</option>
				 </select>
				<span class="form">Restauration :</span><select>
				 	<option selected="selected" value="......">Aucune</option>
				 	<option value="......">demi-pension</option>
				 	<option value="......">pension complète</option>
				 </select></p>
				<p class="form">Date de début : <input type="date" name="date_debut_sejour">
					<span class="form">Date de fin :</span><input type="date" name="date_fin_sejour">
					<span class="form">Type de salle :</span><select>
				 	<option value="......">.......</option>
				 </select></p>
				 <img id="conf" src="..\images\salle.jpg"><br>
				<input id="valider" type="submit" name="valider" value="valider">
      			<input type="reset" name="reinitialiser" value="reinitialiser">
			</fieldset>
		</form>
	</main>
</body>
</html>