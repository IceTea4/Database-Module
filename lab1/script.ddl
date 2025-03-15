#@(#) script.ddl

DROP TABLE IF EXISTS Viešbutis;
DROP TABLE IF EXISTS Transportas;
DROP TABLE IF EXISTS Skrydis;
DROP TABLE IF EXISTS Mokėjimas;
DROP TABLE IF EXISTS Kelionė;
DROP TABLE IF EXISTS Rezervacija;
DROP TABLE IF EXISTS Atsiliepimas;
DROP TABLE IF EXISTS transporto_tipas;
DROP TABLE IF EXISTS mokėjimo_būdai;
DROP TABLE IF EXISTS įvertinimai;
DROP TABLE IF EXISTS būsenos;
DROP TABLE IF EXISTS apmokėjimo_būsena;
DROP TABLE IF EXISTS Nuolaidos;
DROP TABLE IF EXISTS Klientas;
DROP TABLE IF EXISTS Kelionių_vadovas;
CREATE TABLE Kelionių_vadovas
(
	asmens_kodas integer (15) NOT NULL,
	vardas varchar NOT NULL,
	pavardė varchar NOT NULL,
	telefono_nr integer (15) NOT NULL,
	el_paštas varchar NULL,
	kalbos varchar NOT NULL,
	patirtis_metais integer (3) NULL,
	kaina float NOT NULL,
	PRIMARY KEY(asmens_kodas)
);

CREATE TABLE Klientas
(
	asmens_kodas integer (15) NOT NULL,
	vardas varchar NOT NULL,
	pavardė varchar NOT NULL,
	el_paštas varchar NOT NULL,
	telefono_nr integer (15) NOT NULL,
	adresas varchar NULL,
	registracijos_data date NOT NULL,
	PRIMARY KEY(asmens_kodas)
);

CREATE TABLE Nuolaidos
(
	id integer (50) NOT NULL,
	pavadinimas varchar NOT NULL,
	aprašymas varchar NULL,
	nuolaidos_proc float NOT NULL,
	galiojimo_pradžia date NOT NULL,
	galiojimo_pabaiga date NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE apmokėjimo_būsena
(
	id integer (50) NOT NULL,
	name char (10) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO apmokėjimo_būsena(id, name) VALUES(1, 'laukiama');
INSERT INTO apmokėjimo_būsena(id, name) VALUES(2, 'apmokėta');
INSERT INTO apmokėjimo_būsena(id, name) VALUES(3, 'neapmokėta');

CREATE TABLE būsenos
(
	id integer (50) NOT NULL,
	name char (11) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO būsenos(id, name) VALUES(1, 'laukiama');
INSERT INTO būsenos(id, name) VALUES(2, 'patvirtinta');
INSERT INTO būsenos(id, name) VALUES(3, 'atšaukta');

CREATE TABLE įvertinimai
(
	id integer (50) NOT NULL,
	name char (5) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO įvertinimai(id, name) VALUES(1, '1star');
INSERT INTO įvertinimai(id, name) VALUES(2, '2star');
INSERT INTO įvertinimai(id, name) VALUES(3, '3star');
INSERT INTO įvertinimai(id, name) VALUES(4, '4star');
INSERT INTO įvertinimai(id, name) VALUES(5, '5star');

CREATE TABLE mokėjimo_būdai
(
	id integer (50) NOT NULL,
	name char (16) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO mokėjimo_būdai(id, name) VALUES(1, 'kredito_koretelė');
INSERT INTO mokėjimo_būdai(id, name) VALUES(2, 'banko_pavedimas');
INSERT INTO mokėjimo_būdai(id, name) VALUES(3, 'paypal');

CREATE TABLE transporto_tipas
(
	id integer (50) NOT NULL,
	name char (11) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO transporto_tipas(id, name) VALUES(1, 'autobusas');
INSERT INTO transporto_tipas(id, name) VALUES(2, 'automobilis');
INSERT INTO transporto_tipas(id, name) VALUES(3, 'traukinys');

CREATE TABLE Atsiliepimas
(
	id integer (50) NOT NULL,
	komentaras varchar NULL,
	data date NOT NULL,
	įvertinimas integer NOT NULL,
	fk_Klientas integer (15) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(įvertinimas) REFERENCES įvertinimai (id),
	CONSTRAINT fkc_Klientas FOREIGN KEY(fk_Klientas) REFERENCES Klientas (asmens_kodas)
);

CREATE TABLE Rezervacija
(
	rezervacijos_id varchar (50) NOT NULL,
	rezervacijos_data date NOT NULL,
	kaina float NOT NULL,
	būsena integer NOT NULL,
	fk_Klientas integer (15) NOT NULL,
	fk_Nuolaidos integer (50) NULL,
	PRIMARY KEY(rezervacijos_id),
	FOREIGN KEY(būsena) REFERENCES būsenos (id),
	CONSTRAINT fkc_Klientas FOREIGN KEY(fk_Klientas) REFERENCES Klientas (asmens_kodas),
	CONSTRAINT fkc_Nuolaidos FOREIGN KEY(fk_Nuolaidos) REFERENCES Nuolaidos (id)
);

CREATE TABLE Kelionė
(
	kelionės_id varchar (50) NOT NULL,
	pavadinimas varchar NOT NULL,
	aprašymas varchar NOT NULL,
	organizatorius varchar (255) NOT NULL,
	pradžios_data date NOT NULL,
	pabaigos_data date NOT NULL,
	vietų_skaičius integer (15) NOT NULL,
	kaina float NOT NULL,
	fk_Rezervacija varchar (50) NOT NULL,
	fk_Kelionių_vadovas integer (15) NOT NULL,
	PRIMARY KEY(kelionės_id),
	CONSTRAINT fkc_Rezervacija FOREIGN KEY(fk_Rezervacija) REFERENCES Rezervacija (rezervacijos_id),
	CONSTRAINT fkc_Kelionių vadovas FOREIGN KEY(fk_Kelionių_vadovas) REFERENCES Kelionių_vadovas (asmens_kodas)
);

CREATE TABLE Mokėjimas
(
	id integer (50) NOT NULL,
	suma float NOT NULL,
	mokėjimo_data date NOT NULL,
	mokėjimo_būdas integer NOT NULL,
	būsena integer NOT NULL,
	fk_Rezervacija varchar (50) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(mokėjimo_būdas) REFERENCES mokėjimo_būdai (id),
	FOREIGN KEY(būsena) REFERENCES apmokėjimo_būsena (id),
	CONSTRAINT fkc_Rezervacija FOREIGN KEY(fk_Rezervacija) REFERENCES Rezervacija (rezervacijos_id)
);

CREATE TABLE Skrydis
(
	skrydžio_nr varchar (50) NOT NULL,
	aviakompanija varchar NOT NULL,
	išvykimo_vieta varchar NOT NULL,
	išvykimo_data date NOT NULL,
	atvykimo_vieta varchar NOT NULL,
	atvykimo_data date NOT NULL,
	kaina float NOT NULL,
	fk_Kelionė varchar (50) NOT NULL,
	PRIMARY KEY(skrydžio_nr),
	CONSTRAINT fkc_Kelionė FOREIGN KEY(fk_Kelionė) REFERENCES Kelionė (kelionės_id)
);

CREATE TABLE Transportas
(
	id integer (50) NOT NULL,
	maršrutas varchar NULL,
	kaina float NOT NULL,
	tipas integer NOT NULL,
	fk_Kelionė varchar (50) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(tipas) REFERENCES transporto_tipas (id),
	CONSTRAINT fkc_Kelionė FOREIGN KEY(fk_Kelionė) REFERENCES Kelionė (kelionės_id)
);

CREATE TABLE Viešbutis
(
	id integer (50) NOT NULL,
	pavadinimas varchar NOT NULL,
	adresas varchar NOT NULL,
	aprašymas varchar NULL,
	kaina_ūž_naktį float NOT NULL,
	žvaigždutės integer NOT NULL,
	fk_Kelionė varchar (50) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(žvaigždutės) REFERENCES įvertinimai (id),
	CONSTRAINT fkc_Kelionė FOREIGN KEY(fk_Kelionė) REFERENCES Kelionė (kelionės_id)
);
