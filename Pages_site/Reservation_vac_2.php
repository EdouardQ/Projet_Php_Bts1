<?php
session_start();
include '..\functions.php';
$_SESSION['nb_adulte']=$_POST['nb_adulte'];
$_SESSION['nb_enfant']=$_POST['nb_enfant'];
$_SESSION['restauration']=$_POST['restauration'];
$_SESSION['date_vacances']=$_POST['date_vacances'];
$_SESSION['nb_semaine']=$_POST['nb_semaine'];
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
		<form method="post" action="reservation_vac_3.php">
			<fieldset id="cadre">
				<legend><h3>Reservation de vacances</h3></legend>
				<p class="form">
					Date de début : <select name="date_debut_sejour">
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
				</select></p>
				<input id="valider" type="submit" name="valider" value="valider">
      			<input type="reset" name="reinitialiser" value="reinitialiser">
			</fieldset>
		</form>
	</main>
</body>
</html>