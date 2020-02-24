<?php
session_start();
include '.\functions.php';
$verif_champ_vide=1;
setlocale(LC_TIME, "fr_FR");

if (!empty($_POST['2c2l'])){
	$_SESSION['2c2l']=$_POST['2c2l'];
	$verif_champ_vide=0;
}else{
	$_SESSION['2c2l']=0;
}
if (!empty($_POST['1c1ld'])){
	$_SESSION['1c1ld']=$_POST['1c1ld'];
	$verif_champ_vide=0;
}else{
	$_SESSION['1c1ld']=0;
}
if (!empty($_POST['1c3l'])){
	$_SESSION['1c3l']=$_POST['1c3l'];
	$verif_champ_vide=0;
}else{
	$_SESSION['1c3l']=0;
}
if (!empty($_POST['1c4l'])){
	$_SESSION['1c4l']=$_POST['1c4l'];
	$verif_champ_vide=0;
}else{
	$_SESSION['1c4l']=0;
}
if (!empty($_POST['1cmr'])){
	$_SESSION['1cmr']=$_POST['1cmr'];
	$verif_champ_vide=0;
}else{
	$_SESSION['1cmr']=0;
}
if ($verif_champ_vide==1){
	$_SESSION['champ_vide']=1;
	header('Location: ./Reservation_vac_3.php');
}

$_SESSION['logement_excessif']=verif_reservation_excessive($_SESSION['nb_personnes'],$_SESSION['2c2l'], $_SESSION['1c1ld'], $_SESSION['1c3l'], $_SESSION['1c4l'], $_SESSION['1cmr']);
if ($_SESSION['logement_excessif']!=1){
	header('Location: ./Reservation_vac_3.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Rousses - Reservation pro validation</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./design.css" media="all">
</head>
<body>
	<header>
		<?php
		if (!empty($_SESSION['id_user'])){
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
		<div class="info"><h3>Information :</h3>Le materiel audio et video pourra être demandé à <a href=".\Courage.php" target="blank" id="meme">l'accueil</a>.<br>Les reservations professionnelles ne sont pas disponible en période de vacances scolaires.</div>
		<fieldset id="cadre">
			<legend><h3>Validation reservation professionnelle</h3></legend>
			<div class="center">
			<?php
				echo "<p><b>Date du début du séjour : </b>".utf8_encode(strftime('%A %d %B %G', strtotime($_SESSION['date_debut_sejour'])))."<span class='form'></span><b>Date de fin du séjour : </b>".utf8_encode(strftime('%A %d %B %G', strtotime($_SESSION['date_fin_sejour'])))."</p>";

				echo "<p>Pour ".$_SESSION['nb_personnes']." personnes ";

				if ($_SESSION['restauration']=="aucune") {
					echo "sans pension, ";
				}elseif ($_SESSION['restauration']=="demi_pension") {
					echo "avec demi-pension, ";
				}else{
					echo "avec pension complète, ";
				}

				echo "répartis dans 	:<br><table id='tab_validation'><tr>";

				$table_type=['logement avec 2 chambre a 2 lits', 'logement avec 1 chambre a 1 lit double','logement avec 1 chambre a 3 lits','logement avec 1 chambre a 4 lits','logement avec 1 chambre mobilite reduite'];
				for ($i=0; $i < count($table_type); $i++) { 
					echo "<td><b>".$table_type[$i]."</b></td>";
				}
				echo "</tr><tr><td>".$_SESSION['2c2l']."</td><td>".$_SESSION['1c1ld']."</td><td>".$_SESSION['1c3l']."</td><td>".$_SESSION['1c4l']."</td><td>".$_SESSION['1cmr']."</td></tr></table>";
			?>
			</div>
		</fieldset>
		<form method="post" action="reservation_end.php">
			<br>
			<div class="center">
				<input type="submit" name="valider" value="Valider">
				<input type="submit" name="modifier" value="Modifier">
			</div>
		</form>
	</main>
	<footer>
	<p>Bourgogne Franche-Comté Tourisme - Montagnes du Jura - Parc naturel régional du Haut-Jura - Jura Tourisme - Léman sans frontière<br>Village plaisir</p>
	</footer>
</body>
</html>