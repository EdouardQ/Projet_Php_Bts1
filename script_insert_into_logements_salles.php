<?php
$user_db='root';
$password_db='';
$servername='127.0.0.1';
$dbname='station_les_rousses';

include '.\functions.php';

$to_insert=[ //[sql, nb iteration]
["INSERT INTO salle(nom_salle,place_dispo_salle)VALUES('Salle de conférence de 196 places',196)",1],
["INSERT INTO salle(nom_salle,place_dispo_salle)VALUES('Salle de commission de 50 places',50)",1],
["INSERT INTO salle(nom_salle,place_dispo_salle)VALUES('Salle de commission de 25 places',25)",1],
["INSERT INTO salle(nom_salle,place_dispo_salle)VALUES('Salle de commission de 10 places',10)",1],
["INSERT INTO Logement(capacite_max,type)VALUES(4,'2 chambres a 2 lits')",40],
["INSERT INTO Logement(capacite_max,type)VALUES(2,'1 chambre a 1 lit double')",15],
["INSERT INTO Logement(capacite_max,type)VALUES(3,'1 chambre a 3 lits')",8],
["INSERT INTO Logement(capacite_max,type)VALUES(4,'1 chambre a 4 lits')",12],
["INSERT INTO Logement(capacite_max,type)VALUES(1,'1 chambre pour personne a mobilite reduite')",1]
];

try{
	$cnx=Connection ($servername,$user_db, $password_db, $dbname);
	$verif_id_logement=max_id($cnx,'id_logement','Logement');
	$verif_id_salle=max_id($cnx,'id_salle','Salle');
	if ($verif_id_logement!=0 && $verif_id_salle!=0){
		truncate($cnx,'Logement');
		truncate($cnx,'Salle');
		echo "Truncate done<br>";
	}
	for ($i=0; $i < count($to_insert); $i++) { 
		for ($y=0; $y < $to_insert[$i][1]; $y++) { 
			insert_into($cnx,$to_insert[$i][0]);
		}
	}
	echo 'Insert Into done';
}
catch(PDOException $event) {
	echo "Erreur : ".$event -> getMessage()."<br/>";
	die();
}
?>