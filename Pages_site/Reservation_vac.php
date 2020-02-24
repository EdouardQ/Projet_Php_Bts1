<?php
session_start();
if (!isset($_SESSION['id_user'])){
		header('Location: .\Mon_compte.php');
	}
include '.\functions.php';
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
				<li><a href=".\Reservation_vac.php">Vacances</a></li>
				<li><a href=".\Reservation_pro.php">Professionelle</a></li>
				</ul></li>
			<li><a href=".\Mon_compte.php">Mon compte</a></li>
		</ul></nav>
	</header>
	<main>
		<div class="info"><h3>Information :</h3>Les reservations se font du samedi au samedi pendant les vacances scolaires</div>
		<form method="post" action="Reservation_vac_2.php" autocomplete="off">
			<fieldset id="cadre">
				<legend><h3>Reservation de vacances</h3></legend>
				<div class="center">Nombre d'adulte(s) : <input type="number" name="nb_adulte" min=0 style=" width : 40px">
				<span class="form">Nombre d'enfant(s) : <input type="number" name="nb_enfant" min=0 style=" width : 40px"></span>
				<span class="form">Restauration : <select name="restauration">
				 	<option value="aucune">Aucune</option>
				 	<option value="demi_pension">demi-pension</option>
				 	<option value="pension_complete">pension complète</option>
				 </select></span>
				<span class="form">Vacances : <select name="nom_vacances">
					<?php
					try{
						$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);
						$pdoreq=affiche_vacances($cnx);

						foreach ($pdoreq as $vacances) {
							echo "<option value='$vacances[0]'>$vacances[0]</option>";
						}
					}
					catch(PDOException $event) {
						echo "Erreur : ".$event -> getMessage()."<br/>";
						die();
					}
					?>
				</select></span></div><br>
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