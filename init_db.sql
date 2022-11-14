CREATE TABLE Partie(
	id_partie INT PRIMARY KEY AUTO_INCREMENT,
	nom_partie VARCHAR(20),
	description VARCHAR(50),
	nb_tours INT,
	remise_lettre BOOLEAN,
	date_creation DATETIME
);
	
CREATE TABLE Joueur(
	id_joueur INT PRIMARY KEY AUTO_INCREMENT,
	nom_joueur VARCHAR(15),
	id_partie INT,
	total INT,
	FOREIGN KEY (id_partie) REFERENCES Partie(id_partie)
);

CREATE TABLE Ligne(
	id_ligne INT PRIMARY KEY AUTO_INCREMENT,
	id_joueur INT,
	lettre VARCHAR(20),
	fille VARCHAR(20),
	garcon VARCHAR(20),
	ville VARCHAR(50),
	pays VARCHAR(50),
	animal VARCHAR(20),
	fruit VARCHAR(20),
	metier VARCHAR(20),
	s_fille INT,
	s_garcon INT,
	s_ville INT,
	s_pays INT,
	s_animal INT,
	s_fruit INT,
	s_metier INT,
	FOREIGN KEY (id_joueur) REFERENCES Joueur(id_joueur)
);

INSERT INTO Partie (nom_partie, description, nb_tours, remise_lettre, date_creation)
VALUES
	('p1', 'new1', 3, TRUE, '2018-09-24 22:21:20');

INSERT INTO Joueur (nom_joueur, id_partie, total)
VALUES
	('Rébecca', 1, 70),
	('Zac', 1, 75),
	('Marielle',1, 55);

INSERT INTO 
	Ligne(id_joueur, lettre, fille, garcon, ville, pays, animal, fruit, metier, s_fille, s_garcon, s_ville,
		s_pays, s_animal, s_fruit, s_metier)
VALUES
	(1, 'E', 'Ericka', 'Enock', 'Eaubonne', 'Egypte', 'Elan', '', 'Ecrivain', 0, 5, 0, 5, 5, 0, 0),
	(2, 'E', 'Emma', 'Edy', 'Eccles', 'Estonie', 'Ecureuil', '', 'Economiste', 5, 5, 5, 5, 5, 0, 5),
	(3, 'E', 'Ericka', 'Enrick', 'Eaubonne', 'Espagne', 'Eléphant', '', 'Editeur', 0, 5, 0, 5, 5, 0, 5),
	(1, 'A', 'Anne', 'Ali', 'Abidjan', 'Algérie', 'Ane', 'Ananas', 'Artisan', 5, 5, 5, 5, 5, 5, 5),
	(2, 'A', 'Anna', 'Amed', 'Ablon', '', 'Abeille', 'Amande', 'Acteur', 5, 5, 5, 0, 5, 5, 5),
	(3, 'A', 'Aïcha', 'Abou', '', 'Albanie', '', '', 'Acheteur', 5, 5, 0, 5, 0, 0, 5),
	(1, 'I', 'Irina', 'Irié', 'Ichy', 'Iran', '', '', '', 5, 5, 5, 5, 0, 0, 0),
	(2, 'I', 'Irine', '', 'Ignaux', '', '', '', 'Infirmier', 5, 0, 5, 0, 0, 0, 5),
	(3, 'I', '', '', '', 'Inde', 'Iguane', '', 'Informaticien', 0, 0, 0, 5, 5, 0, 5);
