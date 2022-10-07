create database Stageprem;

use Stageprem;

create table Menu(
	id INTEGER NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50),
    lien VARCHAR(255),
    admin INTEGER DEFAULT 0,
	PRIMARY KEY(id)
);

INSERT INTO Menu(nom,lien,admin) VALUES("GLPI","yuio",0);
INSERT INTO Menu(nom,lien,admin) VALUES("Zappix","wxcvb",1);
INSERT INTO Menu(nom,lien,admin) VALUES("Mail","qsdfg",1);
INSERT INTO Menu(nom,lien,admin) VALUES("Meet","azerty",0);

create table Admin(
	id INTEGER NOT NULL AUTO_INCREMENT,
	login VARCHAR(50),
    pasword VARCHAR(255),
	PRIMARY KEY(id)
);
INSERT INTO Admin(login,pasword) VALUES("Admin",sha1("admin"));

create table Lien(
	id INTEGER NOT NULL AUTO_INCREMENT,
	lien VARCHAR(255),
	PRIMARY KEY(id)
);
