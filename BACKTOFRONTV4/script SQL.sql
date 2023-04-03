drop database if exists db_testv4;

create database if not exists db_testv4;

use db_testv4;

create table 
    t_role (
        id_role bigint AUTO_INCREMENT PRIMARY KEY ,
        libelle varchar(15) NOT NULL
    );
create table
    t_genre (
        id_genre bigint AUTO_INCREMENT  PRIMARY KEY ,
        libelle varchar(8) NOT NULL
    );

create table
    t_personne (
        id_personne bigint  AUTO_INCREMENT PRIMARY KEY,
        prenom VARCHAR(50) NOT NULL,
        nom VARCHAR(50) NOT NULL,
        mail VARCHAR(50) NOT NULL,
        age SMALLINT NOT NULL,
        username VARCHAR (50) NOT NULL ,
        password VARCHAR(50) NOT NULL ,
        id_genre bigINT NOT NULL,
        id_role bigINT NOT NULL,
        FOREIGN KEY (id_genre) REFERENCES t_genre(id_genre),
        FOREIGN KEY (id_role) REFERENCES t_role(id_role)
    ); 

INSERT INTO t_genre (libelle) VALUE ("Masculin");
INSERT INTO t_genre (libelle) VALUE ("Feminin");

INSERT INTO t_role (libelle) VALUE ("Administrateur");
INSERT INTO t_role (libelle) VALUE ("Utilisateur");
