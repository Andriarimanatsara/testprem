create database Stageprem;

use Stageprem;

create table Menu(
	id INTEGER NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50),
    lien VARCHAR(255),
    admin INTEGER DEFAULT 0,
	/*fichier VARCHAR(255),////*/
	PRIMARY KEY(id)
);

INSERT INTO Menu(nom,lien,admin) VALUES("GLPI","http://helpdesk.groupetaloumis.local/glpi/",0);
INSERT INTO Menu(nom,lien,admin) VALUES("Zabbix","http://192.168.0.12/zabbix/ ",1);
INSERT INTO Menu(nom,lien,admin) VALUES("Kelio","qsdfg",1);
INSERT INTO Menu(nom,lien,admin) VALUES("Meet","azerty",0);

create table Admin(
	id INTEGER NOT NULL AUTO_INCREMENT,
	login VARCHAR(50),
    pasword VARCHAR(255),
	description VARCHAR(50),
	PRIMARY KEY(id)
);
INSERT INTO Admin(login,pasword,description) VALUES("Admin",sha1("admin"),"admin");
INSERT INTO Admin(login,pasword,description) VALUES("Admin2",sha1("admin2"),"admin2");

/*////*/
create table Profil(
	id INTEGER NOT NULL AUTO_INCREMENT,
	nameProfile VARCHAR(255),
	PRIMARY KEY(id)
);

INSERT INTO Profil(nameProfile)VALUES("RH");
INSERT INTO Profil(nameProfile)VALUES("Tous");
/*////*/

/*////*/
create table Actualite(
	id INTEGER NOT NULL AUTO_INCREMENT,
	titre VARCHAR(255),
	article VARCHAR(255),
    fichier VARCHAR(255),
	destination INTEGER NOT NULL,
	statut INTEGER DEFAULT 0,
	PRIMARY KEY(id),
	FOREIGN KEY(destination) REFERENCES Profil(id)
);

INSERT INTO Actualite(titre,article,fichier,destination)VALUES("","","",);

select id,titre,article,fichier,destination,
	CASE
		WHEN destination=2 THEN 1
		ELSE 0
	END as voir
from Actualite ;

IF(destination>1, (select titre,article from Actualite), "NO") from Actualite;
/*////*/

/*SET @test1 = 1;SELECT * FROM Actualite WHERE destination=@test1;
CREATE FUNCTION testFunc ( valeur INT )
RETURNS SELECT * FROM Actualite
BEGIN
	valeur=1
   	IF valeur = 1
     	RETURN SELECT * FROM Actualite;
   	END IF 
	IF valeur = 0
		RETURN SELECT * FROM Actualite where id=1;
	END IF ;

END;


CREATE FUNCTION CalcIncome ( starting_value INT )
RETURNS INT
BEGIN

   DECLARE income INT;

   SET @income = 0;

   label1: WHILE @income <= 3000 DO
     SET @income = @income + starting_value
   END WHILE label1

   RETURN @income

END;*/
