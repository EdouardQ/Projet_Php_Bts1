<?php
session_start();
include '..\functions.php';
setlocale(LC_TIME, "fr_FR");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Rousses - Mes infos</title>
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
		<fieldset id="mes_infos">
			<div class="center">
			<?php
				try{
					$cnx=Connection ($_SESSION['servername'],$_SESSION['user_db'], $_SESSION['password_db'], $_SESSION['dbname']);

					$pdoreq=affiche_sejours ($cnx, $_SESSION['id_user']);
					$tab_historique=[];
					foreach ($pdoreq as $value) {
						$tab_historique[]=$value[0]; //id_sejour
						$tab_historique[]=utf8_encode(strftime('%A %d %B %G', strtotime($value[1]))); //date_debut
						$tab_historique[]=utf8_encode(strftime('%A %d %B %G', strtotime($value[2]))); //date_fin
						$tab_historique[]=$value[3]; //nb_logement
						$tab_historique[]=$value[4]; //nb_adultes
						$tab_historique[]=$value[5]; //nb_enfants
						$tab_historique[]=$value[6]; //nb_pension
						$tab_historique[]=$value[7]; //nb_demi_pension
					}

					$tab_parametres_sejour=['Num réservation', 'Date du début de la réservation', 'Date de fin de la réservation', 'Nombre de logements réservés', 'Nombre d\'adulte(s)', 'Nombre d\'enfant(s)', 'Nombre de pension complètes', 'Nombre de demi-pension'];

					echo "<table id='tab_validation'><tr>";
					for ($i=0; $i < count($tab_parametres_sejour); $i++) { 
						echo "<td><b>".$tab_parametres_sejour[$i]."</b></td>";
					}
					echo "</tr><tr>";
					for ($i=0; $i < count($tab_historique); $i++) { 
						if (fmod($i, 8)==0) {
							echo "<tr>";
						}	
						echo "<td>".$tab_historique[$i]."</td>";
						if (fmod($i+1, 8)==0) {
							echo "</tr>";
						}
					}

					echo "</table>";


				}
				catch(PDOException $event) {
					echo "Erreur : ".$event -> getMessage()."<br/>";
					die();
				}


			?>
		</div>

		</fieldset>
</main>
<footer>
	<p>Bourgogne Franche-Comté Tourisme - Montagnes du Jura - Parc naturel régional du Haut-Jura - Jura Tourisme - Léman sans frontière<br>Village plaisir</p>
</footer>
</body>
</html>