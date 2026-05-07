DROP TABLE IF EXISTS CONTACT;
DROP TABLE IF EXISTS CONTENIR;
DROP TABLE IF EXISTS PLAYLIST;
DROP TABLE IF EXISTS CHANSON;
DROP TABLE IF EXISTS UTILISATEUR;

-- =========================
-- TABLE UTILISATEUR
-- =========================
CREATE TABLE UTILISATEUR (
  idUser INT AUTO_INCREMENT PRIMARY KEY,
  login VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  plan VARCHAR(8) DEFAULT 'Standard'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- =========================
-- TABLE CHANSON
-- =========================
CREATE TABLE CHANSON (
  idC INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(255) NOT NULL,
  artiste VARCHAR(255) NOT NULL,
  annee INT,
  genre VARCHAR(100),
  fichier VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- =========================
-- TABLE PLAYLIST
-- =========================
CREATE TABLE PLAYLIST (
  idP INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(255) NOT NULL,
  idUser INT,
  FOREIGN KEY (idUser) REFERENCES UTILISATEUR(idUser)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- =========================
-- TABLE CONTENIR (relation playlist / chanson)
-- =========================
CREATE TABLE CONTENIR (
  idP INT,
  idC INT,
  PRIMARY KEY (idP, idC),
  FOREIGN KEY (idP) REFERENCES PLAYLIST(idP)
    ON DELETE CASCADE,
  FOREIGN KEY (idC) REFERENCES CHANSON(idC)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- =========================
-- TABLE CONTACT (contient le message de la page contact et toutes les coordonées de l'expéditeur)
-- =========================
CREATE TABLE CONTACT (
	idContact INT AUTO_INCREMENT PRIMARY KEY,
	nom VARCHAR(100) NOT NULL,
	email VARCHAR(150) NOT NULL,
	objet VARCHAR(200) NOT NULL,
	message TEXT NOT NULL,
	dateEnvoi DATETIME DEFAULT CURRENT_TIMESTAMP

);

-- =========================
-- RESET AUTO_INCREMENT
-- =========================
ALTER TABLE UTILISATEUR AUTO_INCREMENT = 1;
ALTER TABLE CHANSON AUTO_INCREMENT = 1;
ALTER TABLE PLAYLIST AUTO_INCREMENT = 1;
ALTER TABLE CONTACT AUTO_INCREMENT = 1;

-- =========================
-- UTILISATEURS PAR DEFAUT
-- =========================
INSERT INTO UTILISATEUR (login, password, plan) VALUES ('admin', 'admin', 'admin');
INSERT INTO UTILISATEUR (login, password, plan) VALUES ('kalak', 'kalak', 'Premium');
INSERT INTO UTILISATEUR (login, password, plan) VALUES ('jean', 'jean', 'Standard');