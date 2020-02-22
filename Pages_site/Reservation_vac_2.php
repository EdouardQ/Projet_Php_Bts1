<?php
session_start();
include '..\functions.php';
if ($_POST['nb_adulte']!="" && $_POST['nb_enfant']!=""){
	$_SESSION['nb_adulte']=$_POST['nb_adulte'];
	$_SESSION['nb_enfant']=$_POST['nb_enfant'];
	$_SESSION['restauration']=$_POST['restauration'];
	$_SESSION['nom_vacances']=$_POST['nom_vacances'];
}else{
	$_SESSION['champ_vide']=1;
	header('Location: ./Reservation_vac.php');
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
					<?php
					setlocale(LC_TIME, "fr_FR");
					try{
						$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);
						$pdoreq=affiche_date_vacances($cnx,$_SESSION['nom_vacances']);

						$table_date=[];
						foreach ($pdoreq as $vacances_date) { //$vacances_date[0] = debut / $vacances_date[1] = fin
							$table_date[]=$vacances_date[0];
							$table_date[]=$vacances_date[1];
						}
						echo "Date de début : <select name='date_debut_sejour'>";
						for ($i=0; $i < count($table_date); $i+=2) { 
							echo "<option value='$table_date[$i]'>".strftime("%A %d %B %G", strtotime($table_date[$i]))."</option>";
						}
						echo "</select><span class='form'>Date de fin : <select name='date_fin_sejour'>";
						for ($i=1; $i < count($table_date); $i+=2) { 
							echo "<option value='$table_date[$i]'>".strftime("%A %d %B %G", strtotime($table_date[$i]))."</option>";
						}
						echo "</select>";
					}
					catch(PDOException $event) {
						echo "Erreur : ".$event -> getMessage()."<br/>";
						die();
					}
					?>
				</p>
				<input id="valider" type="submit" name="valider" value="Valider">
			</fieldset>
		</form>
	</main>
</body>
</html>