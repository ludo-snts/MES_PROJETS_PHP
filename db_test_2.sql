mysql -h localhost -u root


DROP DATABASE IF EXISTS db_test_2;
CREATE DATABASE IF NOT EXISTS db_test_2;
USE db_test_2;

DROP TABLE IF EXISTS t_genre;
CREATE TABLE IF NOT EXISTS t_genre (
  id INT AUTO_INCREMENT PRIMARY KEY,
  libelle varchar(2) NOT NULL
);

DROP TABLE IF EXISTS t_role;
CREATE TABLE IF NOT EXISTS t_role (
  id INT AUTO_INCREMENT PRIMARY KEY,
  libelle varchar(3) NOT NULL
);

DROP TABLE IF EXISTS t_personne;
CREATE TABLE T_PERSONNE (
id BIGINT AUTO_INCREMENT PRIMARY KEY,
idgenre INT NOT NULL,
idrole INT NOT NULL,
nom VARCHAR(50) NOT NULL,
prenom VARCHAR(50) NOT NULL,
mail VARCHAR(50) NOT NULL,
age SMALLINT NOT NULL,
username VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
FOREIGN KEY (idgenre) REFERENCES t_genre(id),
FOREIGN KEY (idrole) REFERENCES t_role(id)
);

INSERT INTO t_genre (id, libelle) VALUES
(1, 'ho'),
(2, 'fe'),
(3, 'au');

-- SELECT * FROM t_genre;

INSERT INTO t_role (id, libelle) VALUES
(1, 'adm'),
(2, 'usr');

-- SELECT * FROM t_role;

INSERT INTO t_personne (id, idgenre, idrole, nom, prenom, mail, age, username, password) VALUES
(1, 2, 2, 'nom1', 'prenom1', 'mail@mail1', 1, 'user1', 'user1'),
(2, 1, 2, 'nom2', 'prenom2', 'mail@mail2', 2, 'user2', 'user2'),
(3, 3, 2, 'nom3', 'prenom3', 'mail@mail3', 3, 'user3', 'user3'),
(4, 1, 2, 'nom4', 'prenom4', 'mail@mail4', 4, 'user4', 'user4'),
(5, 1, 1, 'admin', 'admin', 'mail@admin', 99, 'admin', 'admin');

-- SELECT * FROM t_personne;

DROP VIEW IF EXISTS v_personne;
CREATE VIEW v_personne AS
SELECT T_PERSONNE.id,T_PERSONNE.idgenre,T_PERSONNE.idrole,T_PERSONNE.nom,T_PERSONNE.prenom,T_PERSONNE.mail,T_PERSONNE.age,T_PERSONNE.username,T_PERSONNE.password,T_GENRE.libelle AS Genre_libelle,T_ROLE.libelle AS Role_libelle
FROM T_PERSONNE, T_GENRE, T_ROLE
WHERE T_PERSONNE.idgenre = T_GENRE.id
AND T_PERSONNE.idrole = T_ROLE.id;

-- SELECT * FROM v_personne;

