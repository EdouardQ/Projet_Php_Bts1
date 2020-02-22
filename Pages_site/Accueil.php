<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Rousses - Accueil</title>
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
		<h2>Hébergement et restauration</h2>
		<ul class="pre"><div class="soust">Hébergements disponibles sur le site :</div>
			<li>40 logements : entrée, douche et wc, 2 chambres à 2 lits avec coin toilette et balcon.</li>
			<li>15 chambres doubles : entrée, douche et wc, 1 lit double</li>
			<li>8 chambres de 3 lits séparés par une cloison mobile avec coin toilette, wc, douche.</li>
			<li>12 chambres de 4 lits séparés par une cloison mobile avec douche, wc et balcon.</li>
			<li>1 logement adapté pour les personnes à mobilité réduite.</li>
		</ul>
		<p class="texte">Le ménage des appartements est à la charge des occupants. Il est possible de prendre à l'arrivée un
		forfait "ménage fin de séjour".<br>
		Le restaurant accueille les vacanciers en pension complète ou demi-pension toute l'année.<br>
		Possibilité de pique-nique. Repas adaptés pour les bébés.<br>
		Pour les colloques, les horaires du restaurant peuvent être adaptés, apéritifs d'accueil et pauses
		peuvent également être organisés.</p>
		<h2>Le matériel de la station</h2>
		<ul class="pre"><div class="soust">Le matériel informatique en libre service et internet:</div>
			<li>3 ordinateurs PC (Windows 10, Office), et une imprimante laser</li>
			<li>7 points d'accès pour réseau sans fil Wi-Fi, pour connexion à Internet</li>
		</ul>
		<ul class="pre"><div class="soust">Les salles de colloques:</div>
			<li>Une salle de conférence de 196 places avec tablettes écritoires, sonorisée et équipée d'un
			vidéo-projecteur pour grand écran.</li>
			<li>Une salle de commission de 45 à 50 places, avec tablettes écritoires et tableau blanc.</li>
			<li>Deux salles de commission : 25 et 10 places avec tables, chaises et tableaux blancs.</li>
			<li>Autres espaces de rencontres informelles, confortablement aménagés.</li>
			<li>Un lieu d'accueil spacieux.</li>
			<li>Un lieu d'exposition spacieux et clair.</li>
		</ul>
		<ul class="pre"><div class="soust">Le matériel audio/vidéo:</div>
			<li>3 vidéoprojecteurs compatibles avec ordinateur PC ou Mac. Le centre fournit un ordinateur
			portable de prêt si nécessaire.</li>
			<li>Un système de diffusion d'informations est installé sur 3 écrans 42" dans les espaces de
			circulation.</li>
			<li>Deux lecteurs DVD</li>
			<li>Des rétroprojecteurs</li>
			<li>Une flèche lumineuse laser</li>
			<li>Un télécopieur</li>
			<li>Un photocopieur à code d'accès</li>
			<li>2 micros baladeur et un micro-cravate sans fil</li>
			<li>Autres matériels : paper board, panneaux d'exposition</li>
		</ul>
		<h2>Les animations</h2>
		<p class="texte">En toute saison, le centre dispose : d'une bibliothèque adultes et enfants, de télévisions, d'un piano,
		d'une table de ping-pong, et d'une salle de fitness.</p>
		<p class="texte">Selon les semaines, peuvent être organisés, des soirées dansantes, des spectacles assurés par des
		intervenants extérieurs (chansons, danses folkloriques, théâtre, magie, cirque, diaporama,
		expositions), du cinéma, des concerts ...</p>
		<p class="texte">Pendant les vacances scolaires, des activités manuelles (arts plastiques...) ou des ateliers (danses,
		musique, remise en forme, théâtre...) sont organisés.</p>
		<p class="texte">En été, le centre dispose d'un terrain de sport (basket ball, volley, handball...) et d'un parc de VTT
		que peuvent louer les participants.</p>
		<p class="texte">En hiver, location de matériel (ski, raquette, chaussures de randonnée) avec un partenaire.</p>
		<p class="texte">Pour les participants aux colloques, le centre peut proposer des randonnées encadrées par des
		professionnels.</p>
	</main>
	<footer>
		<p>Bourgogne Franche-Comté Tourisme - Montagnes du Jura - Parc naturel régional du Haut-Jura - Jura Tourisme - Léman sans frontière<br>Village plaisir</p>
	</footer>
</body>
</html>