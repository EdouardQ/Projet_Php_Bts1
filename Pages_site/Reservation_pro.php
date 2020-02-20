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
		<div><h3>Information :</h3>Le materiel audio et video pourront être demandé à <a href=".\Courage.php" target="blank" id="meme">l'accueil</a>.<br>Les reservations professionnelles ne sont pas disponible en période de vacances scolaires.</div>
		<form method="post" action="...........">
			<fieldset id="cadre">
				<legend><h3>Reservation professionelle</h3></legend>
				<p class="form">Nombre de personnes : <input type="number" name="nombre_pers">
				<span class="form">Type de chambre :</span><select>
				 	<option value="2c2l">2 chambre a 2 lits</option>
				 	<option value="1c1ld">1 chambre a 1 lit double</option>
				 	<option value="1c3l">1 chambre a 3 lits</option>
				 	<option value="1c4l">1 chambre a 4 lits</option>
				 	<option value="1cmr">1 chambre mobilite reduite</option>
				 </select>
				<span class="form">Restauration :</span><select>
				 	<option selected="selected" value="aucune">Aucune</option>
				 	<option value="demi_pension">demi-pension</option>
				 	<option value="pension_complete">pension complète</option>
				 </select></p>
				<p class="form">Date de début : <input type="date" name="date_debut_sejour">
					<span class="form">Date de fin :</span><input type="date" name="date_fin_sejour">
					<span class="form">Type de salle :</span><select>
				 		<option value="sc196">Salle de conférence de 196 places</option>
				 		<option value="sc50">Salle de commission de 50 places</option>
				 		<option value="sc25">Salle de commission de 25 places</option>
				 		<option value="sc10">Salle de commission de 10 places</option>
				 </select></p>
				 <img id="conf" src="..\images\salle.jpg"><br>
				<input id="valider" type="submit" name="valider" value="valider">
      			<input type="reset" name="reinitialiser" value="reinitialiser">
			</fieldset>
		</form>
	</main>
</body>
</html>