CREATE DATABASE station_les_rousses character set UTF8 collate utf8_bin;
USE station_les_rousses;

CREATE TABLE Utilisateur (id_user INT AUTO_INCREMENT NOT NULL, email VARCHAR(50), nom VARCHAR(30), prenom VARCHAR(30), mdp VARCHAR(200) NOT NULL, entreprise VARCHAR(30), telephone char(13), PRIMARY KEY (id_user)) ENGINE=InnoDB;
CREATE TABLE Sejour (id_sejour INT AUTO_INCREMENT NOT NULL, nb_logement INTEGER, nb_adulte INT, nb_enfant INT, nb_enfant_bas_age INT, nb_pension INT, nb_demi_pension INT, PRIMARY KEY (id_sejour)) ENGINE=InnoDB;
CREATE TABLE Logement (id_logement INT AUTO_INCREMENT NOT NULL, capacite_max INT, type VARCHAR(50), PRIMARY KEY (id_logement)) ENGINE=InnoDB;
CREATE TABLE Materiel (id_materiel INT AUTO_INCREMENT NOT NULL, nom_materiel VARCHAR(35), PRIMARY KEY (id_materiel)) ENGINE=InnoDB;
CREATE TABLE Salle (id_salle INT AUTO_INCREMENT NOT NULL, nom_salle VARCHAR(35), place_dispo_salle INTEGER, PRIMARY KEY (id_salle)) ENGINE=InnoDB;
CREATE TABLE Paiment (id_paiment INT AUTO_INCREMENT NOT NULL, accompte FLOAT, solde FLOAT, mode_paiment VARCHAR(10), id_user INT, PRIMARY KEY (id_paiment)) ENGINE=InnoDB;
CREATE TABLE Reservation_sejour (id_user INT NOT NULL, id_sejour INT NOT NULL, date_debut_sejour DATE, date_fin_sejour DATE, PRIMARY KEY (id_user,  id_sejour)) ENGINE=InnoDB;
CREATE TABLE Reservation_materiel (id_user INT NOT NULL, id_materiel INT NOT NULL, date_debut_reservation_materiel DATE, date_fin_reservation_materiel DATE, PRIMARY KEY (id_user, id_materiel)) ENGINE=InnoDB;
CREATE TABLE Reservation_salle (id_user INT NOT NULL, id_salle INT NOT NULL, date_debut_reservation_salle DATE, date_fin_reservation_salle DATE, PRIMARY KEY (id_user, id_salle)) ENGINE=InnoDB;
CREATE TABLE Logement_attribue (id_sejour INT NOT NULL, id_logement INT NOT NULL, PRIMARY KEY (id_sejour,  id_logement)) ENGINE=InnoDB;

ALTER TABLE Paiment ADD CONSTRAINT FK_Paiment_id_user FOREIGN KEY (id_user) REFERENCES Utilisateur (id_user);
ALTER TABLE Reservation_sejour ADD CONSTRAINT FK_Reservation_sejour_id_user FOREIGN KEY (id_user) REFERENCES Utilisateur (id_user);
ALTER TABLE Reservation_sejour ADD CONSTRAINT FK_Reservation_sejour_id_sejour FOREIGN KEY (id_sejour) REFERENCES Sejour (id_sejour);
ALTER TABLE Reservation_materiel ADD CONSTRAINT FK_Reservation_materiel_id_user FOREIGN KEY (id_user) REFERENCES Utilisateur (id_user);
ALTER TABLE Reservation_materiel ADD CONSTRAINT FK_Reservation_materiel_id_materiel FOREIGN KEY (id_materiel) REFERENCES Materiel (id_materiel);
ALTER TABLE Reservation_salle ADD CONSTRAINT FK_Reservation_salle_id_user FOREIGN KEY (id_user) REFERENCES Utilisateur (id_user);
ALTER TABLE Reservation_salle ADD CONSTRAINT FK_Reservation_salle_id_salle FOREIGN KEY (id_salle) REFERENCES Salle (id_salle);
ALTER TABLE Logement_attribue ADD CONSTRAINT FK_Logement_attribue_id_sejour FOREIGN KEY (id_sejour) REFERENCES Sejour (id_sejour);
ALTER TABLE Logement_attribue ADD CONSTRAINT FK_Logement_attribue_id_logement FOREIGN KEY (id_logement) REFERENCES Logement (id_logement); 