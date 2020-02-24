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

$insert_vacances=["
insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('toussaint 2019', 1, STR_TO_DATE('19,10,2019','%d,%m,%Y'), STR_TO_DATE('26,10,2019','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('toussaint 2019', 2, STR_TO_DATE('26,10,2019','%d,%m,%Y'), STR_TO_DATE('2,11,2019','%d,%m,%Y'))",

"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('noel 2019', 1, STR_TO_DATE('21,12,2019','%d,%m,%Y'), STR_TO_DATE('28,12,2019','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('noel 2019', 2, STR_TO_DATE('28,12,2019','%d,%m,%Y'), STR_TO_DATE('4,1,2020','%d,%m,%Y'))",

"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('hiver 2020', 1, STR_TO_DATE('8,2,2020','%d,%m,%Y'), STR_TO_DATE('15,2,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('hiver 2020', 2, STR_TO_DATE('15,2,2020','%d,%m,%Y'), STR_TO_DATE('22,2,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('hiver 2020', 3, STR_TO_DATE('22,2,2020','%d,%m,%Y'), STR_TO_DATE('29,2,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('hiver 2020', 4, STR_TO_DATE('29,2,2020','%d,%m,%Y'), STR_TO_DATE('7,3,2020','%d,%m,%Y'))",


"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('printemps 2020', 1, STR_TO_DATE('4,4,2020','%d,%m,%Y'), STR_TO_DATE('11,4,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('printemps 2020', 2, STR_TO_DATE('11,4,2020','%d,%m,%Y'), STR_TO_DATE('18,4,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('printemps 2020', 3, STR_TO_DATE('18,4,2020','%d,%m,%Y'), STR_TO_DATE('25,4,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('printemps 2020', 4, STR_TO_DATE('25,4,2020','%d,%m,%Y'), STR_TO_DATE('2,5,2020','%d,%m,%Y'))",


"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2020', 1, STR_TO_DATE('4,7,2020','%d,%m,%Y'), STR_TO_DATE('11,7,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2020', 2, STR_TO_DATE('11,7,2020','%d,%m,%Y'), STR_TO_DATE('18,7,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2020', 3, STR_TO_DATE('18,7,2020','%d,%m,%Y'), STR_TO_DATE('25,7,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2020', 4, STR_TO_DATE('25,7,2020','%d,%m,%Y'), STR_TO_DATE('1,8,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2020', 5, STR_TO_DATE('1,8,2020','%d,%m,%Y'), STR_TO_DATE('8,8,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2020', 6, STR_TO_DATE('8,8,2020','%d,%m,%Y'), STR_TO_DATE('15,8,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2020', 7, STR_TO_DATE('15,8,2020','%d,%m,%Y'), STR_TO_DATE('22,8,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2020', 8, STR_TO_DATE('22,8,2020','%d,%m,%Y'), STR_TO_DATE('29,8,2020','%d,%m,%Y'))",


"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('toussaint 2020', 1, STR_TO_DATE('17,10,2020','%d,%m,%Y'), STR_TO_DATE('24,10,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('toussaint 2020', 2, STR_TO_DATE('24,10,2020','%d,%m,%Y'), STR_TO_DATE('31,10,2020','%d,%m,%Y'))",

"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('noel 2020', 1, STR_TO_DATE('19,12,2020','%d,%m,%Y'), STR_TO_DATE('26,12,2020','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('noel 2020', 2, STR_TO_DATE('26,12,2020','%d,%m,%Y'), STR_TO_DATE('2,1,2021','%d,%m,%Y'))",

"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('hiver 2021', 1, STR_TO_DATE('6,2,2021','%d,%m,%Y'), STR_TO_DATE('13,2,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('hiver 2021', 2, STR_TO_DATE('13,2,2021','%d,%m,%Y'), STR_TO_DATE('20,2,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('hiver 2021', 3, STR_TO_DATE('20,2,2021','%d,%m,%Y'), STR_TO_DATE('27,2,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('hiver 2021', 4, STR_TO_DATE('27,2,2021','%d,%m,%Y'), STR_TO_DATE('6,3,2021','%d,%m,%Y'))",

"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('printemps 2021', 1, STR_TO_DATE('10,4,2021','%d,%m,%Y'), STR_TO_DATE('17,4,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('printemps 2021', 2, STR_TO_DATE('17,4,2021','%d,%m,%Y'), STR_TO_DATE('24,4,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('printemps 2021', 3, STR_TO_DATE('24,4,2021','%d,%m,%Y'), STR_TO_DATE('1,5,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('printemps 2021', 4, STR_TO_DATE('1,5,2021','%d,%m,%Y'), STR_TO_DATE('8,5,2021','%d,%m,%Y'))",

"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2021', 1, STR_TO_DATE('3,7,2021','%d,%m,%Y'), STR_TO_DATE('10,7,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2021', 2, STR_TO_DATE('17,7,2021','%d,%m,%Y'), STR_TO_DATE('24,7,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2021', 3, STR_TO_DATE('24,7,2021','%d,%m,%Y'), STR_TO_DATE('31,7,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2021', 4, STR_TO_DATE('31,7,2021','%d,%m,%Y'), STR_TO_DATE('28,8,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2021', 5, STR_TO_DATE('3,7,2021','%d,%m,%Y'), STR_TO_DATE('7,8,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2021', 6, STR_TO_DATE('7,8,2021','%d,%m,%Y'), STR_TO_DATE('14,8,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2021', 7, STR_TO_DATE('14,8,2021','%d,%m,%Y'), STR_TO_DATE('21,8,2021','%d,%m,%Y'))",
"insert into date_vacances (nom,nb_semaine,date_debut,date_fin) values ('ete 2021', 8, STR_TO_DATE('21,8,2021','%d,%m,%Y'), STR_TO_DATE('28,8,2021','%d,%m,%Y'))"
];

try{
	$cnx=Connection ($servername,$user_db, $password_db, $dbname);
	$verif_id_logement=max_id($cnx,'id_logement','logement');
	$verif_id_salle=max_id($cnx,'id_salle','salle');
	$verif_id_date_vac=max_id($cnx,'id_vacances','date_vacances');
	if ($verif_id_logement!=0 && $verif_id_salle!=0 && $verif_id_date_vac!=0){
		truncate($cnx,'logement');
		truncate($cnx,'salle');
		truncate($cnx,'date_vacances');
		echo "Truncate done<br>";
	}
	for ($i=0; $i < count($to_insert); $i++) { 
		for ($y=0; $y < $to_insert[$i][1]; $y++) { 
			insert_into($cnx,$to_insert[$i][0]);
		}
	}
	for ($i=0; $i < count($insert_vacances); $i++) { 
		insert_into($cnx,$insert_vacances[$i]);
	}
	echo 'Insert Into done';
}
catch(PDOException $event) {
	echo "Erreur : ".$event -> getMessage()."<br/>";
	die();
}
?>