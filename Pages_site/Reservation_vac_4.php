<?php
session_start();
include '..\functions.php';
if ($_POST['2 chambre a 2 lits']!="" || $_POST['1 chambre a 1 lit double']!="" || $_POST['1 chambre a 3 lits']!="" || $_POST['1 chambre a 4 lits']!="" || $_POST['1 chambre mobilite reduite']!=""){
	$_SESSION['2 chambre a 2 lits']=$_POST['2 chambre a 2 lits'];
	$_SESSION['1 chambre a 1 lit double']=$_POST['1 chambre a 1 lit double'];
	$_SESSION['1 chambre a 3 lits']=$_POST['1 chambre a 3 lits'];
	$_SESSION['1 chambre a 4 lits']=$_POST['1 chambre a 4 lits'];
	$_SESSION['1 chambre mobilite reduite']=$_POST['1 chambre mobilite reduite'];
}else{
	$_SESSION['champ_vide']=1;
	header('Location: ./Reservation_vac_3.php');
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
				<li><a href=".\Reservation_vac.php">Vacances</a></li>
				<li><a href=".\Reservation_pro.php">Professionelle</a></li>
				</ul></li>
			<li><a href=".\Mon_compte.php">Mon compte</a></li>
		</ul></nav>
	</header>
	<main>
		<div><h3>Information :</h3>Les reservations se font du samedi au samedi pendant les vacances scolaires</div>
		<form method="post" action="Reservation_vac_3.php">
			<fieldset id="cadre">
				<legend><h3>Reservation de vacances</h3></legend>
					<?php
					setlocale(LC_TIME, "fr_FR");
					try{
						$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);
						$pdoreq=affiche_date_vacances($cnx,$_SESSION['nom_vacances']);
						/*J'utilise ici une boucle foreach pour classer toutes
						les informations que je souhaite utiliser dans un tableau pour ensuite les extraire 
						avec 2 bouble for car l'utilisation de 2 boucles foreach dans une meme page ne fonctionne pas
						et annule les actions de la seconde boucle foreach.*/
						$table_date=[];
						foreach ($pdoreq as $vacances_date) { //$vacances_date[0] = debut / $vacances_date[1] = fin
							$table_date[]=$vacances_date[0];
							$table_date[]=$vacances_date[1];
						}
						echo "<div class='center'>Date de début : <select name='date_debut_sejour'>";
						for ($i=0; $i < count($table_date); $i+=2) { 
							echo "<option value='$table_date[$i]'>".utf8_encode(strftime("%A %d %B %G", strtotime($table_date[$i])))."</option>";
						}
						echo "</select><span class='form'>Date de fin : <select name='date_fin_sejour'>";
						for ($i=1; $i < count($table_date); $i+=2) { 
							echo "<option value='$table_date[$i]'>".utf8_encode(strftime("%A %d %B %G", strtotime($table_date[$i])))."</option>";
						}
						echo "</select></div>";
					}
					catch(PDOException $event) {
						echo "Erreur : ".$event -> getMessage()."<br/>";
						die();
					}
					?>
				<br><div class="center"><input id="valider" type="submit" name="valider" value="Valider"></div>
			</fieldset>
		</form>
	</main>
	<footer>
	<p>Bourgogne Franche-Comté Tourisme - Montagnes du Jura - Parc naturel régional du Haut-Jura - Jura Tourisme - Léman sans frontière<br>Village plaisir</p>
	</footer>
</body>
</html>