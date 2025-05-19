CREATE TABLE rezervacijos_busena (
  code varchar(10) NOT NULL PRIMARY KEY,
  name varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO rezervacijos_busena (code, name) VALUES
('pending', 'laukiama'),
('confirmed', 'patvirtinta'),
('cancelled', 'atšaukta');

CREATE TABLE gidas (
  vardas varchar(100) NOT NULL,
  pavarde varchar(100) NOT NULL,
  telefono_nr varchar(50) NOT NULL,
  el_pastas varchar(100) NOT NULL PRIMARY KEY,
  kalbos varchar(200) NOT NULL,
  patirtis_metais int(3) DEFAULT NULL,
  kaina float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO gidas (vardas, pavarde, telefono_nr, el_pastas, kalbos, patirtis_metais, kaina) VALUES
('Zita', 'Bitininkė', '123123123', 'zita.bitininke@gmail.com', 'rusų, prancuzų, lietuvių', NULL, 120),
('Lukas', 'Lukošaitis', '123123123', 'lukas.lukosaitis@gmail.com', 'rusu, lenku, lietuvių, anglų.', 5, 170),
('Austėja', 'Žemaitė', '111111111', 'austeja@email.com', 'lietuvių, anglų', 3, 150),
('Tomas', 'Kalnietis', '111111112', 'tomas@email.com', 'lenkų, rusų', 6, 160),
('Dalia', 'Petrauskienė', '111111113', 'dalia@email.com', 'vokiečių, anglų', 10, 180),
('Mantas', 'Jankauskas', '111111114', 'mantas.jankaustas@gmail.com', 'prancūzų, ispanų', 2, 120),
('Eglė', 'Šulcaitė', '111111115', 'egle@email.com', 'lietuvių, italų', 4, 140),
('Rimantas', 'Zdanavičius', '111111116', 'rimas.zdanavicius@gmail.com', 'lietuvių, rusų', 7, 160),
('Inga', 'Blažienė', '111111117', 'inga@email.com', 'anglų, vokiečių', 5, 150),
('Gediminas', 'Simaitis', '111111118', 'gedas@email.com', 'lenkų, prancūzų', 8, 175),
('Agnė', 'Jakštaitė', '111111119', 'agne@email.com', 'lietuvių, anglų, rusų', 6, 165),
('Lina', 'Petravičiūtė', '111111120', 'lina@email.com', 'vokiečių, ispanų', 9, 170),
('Vilius', 'Masiulis', '111111121', 'vmasiulis@email.com', 'prancūzų, lietuvių', 3, 135),
('Jurgita', 'Kazlauskienė', '111111122', 'jurgita@email.com', 'anglų', 1, 110),
('Justinas', 'Žilinskas', '111111123', 'justinas@email.com', 'lietuvių, vokiečių', 4, 145),
('Simona', 'Navickaitė', '111111124', 'simona.navickite@gmail.com', 'rusų, anglų', 2, 130),
('Karolis', 'Stankevičius', '111111125', 'karolis@email.com', 'ispanų, lietuvių', 5, 160),
('Greta', 'Milerytė', '111111126', 'greta@email.com', 'italų, lietuvių', 6, 155),
('Monika', 'Sabaliauskaitė', '111111127', 'monika@email.com', 'anglų, prancūzų', 7, 165),
('Artūras', 'Valaitis', '111111128', 'arturas@email.com', 'lenkų, rusų', 3, 140);

CREATE TABLE kelione (
  keliones_id varchar(50) NOT NULL PRIMARY KEY,
  pavadinimas varchar(200) NOT NULL,
  aprasymas varchar(1000) NOT NULL,
  organizatorius varchar(200) NOT NULL,
  pradzios_data date NOT NULL,
  pabaigos_data date NOT NULL,
  vietu_skaicius int(15) NOT NULL,
  kaina float NOT NULL,
  fk_Gidas varchar(100) NOT NULL,
  FOREIGN KEY (fk_Gidas) REFERENCES gidas (el_pastas)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO kelione (keliones_id, pavadinimas, aprasymas, organizatorius, pradzios_data, pabaigos_data, vietu_skaicius, kaina, fk_Gidas) VALUES
('CZ1231232222', 'Nuostabūs Čekijos istoriniai pamiklai', 'Aplankysime Čekijos istoriją nurodančius objektus.', 'GintarinėsUogos', '2025-03-23', '2025-03-29', 2, 750, 'zita.bitininke@gmail.com'),
('FR123123111', 'Nuostabūs Prancūzijos vaizdai', 'Kliausime po nuostabų kraštovaizdį. Ši kelionė išliks jūsų atmintyje ilgam.', 'Novaturas', '2025-03-16', '2025-03-22', 4, 620, 'arturas@email.com'),
('IT2025041501', 'Romos senovės stebuklai', 'Aplankysime Koliziejų, Panteoną ir dar daug istorinių vietų.', 'KelioniųNamai', '2025-04-15', '2025-04-21', 5, 800, 'egle@email.com'),
('ES2025041802', 'Saulėtoji Ispanija', 'Kelionė po Barseloną ir Madridą su ispaniškomis fiestomis.', 'BalticTours', '2025-04-18', '2025-04-25', 6, 720, 'mantas.jankaustas@gmail.com'),
('PL2025042003', 'Krokuvos atradimai', 'Pasivaikščiojimai po senamiestį ir Vavelio pilį.', 'EkoTravel', '2025-04-20', '2025-04-26', 3, 600, 'tomas@email.com'),
('FR2025042204', 'Paryžiaus magija', 'Eifelio bokštas, Luvras ir pasivaikščiojimai prie Senos.', 'KeliaukimKartu', '2025-04-22', '2025-04-28', 4, 850, 'simona.navickite@gmail.com'),
('DE2025042505', 'Vokietijos pilys ir miestai', 'Vokietijos kultūros ir architektūros pažinimas.', 'Alpės ir Draugai', '2025-04-25', '2025-05-01', 6, 780, 'dalia@email.com'),
('LT2025042806', 'Dzūkijos lobiai', 'Kelionė po gražiausius Lietuvos kampelius.', 'LietuvaKelia', '2025-04-28', '2025-05-02', 10, 400, 'agne@email.com'),
('UK2025050107', 'Londonas ir aplink', 'Ekskursijos po Big Beną, Tauerio tiltą ir daugiau.', 'SkrydžiaiLT', '2025-05-01', '2025-05-06', 5, 830, 'inga@email.com'),
('FR2025050308', 'Provanse žydintys levandų laukai', 'Ramus pabėgimas į gamtą.', 'KelioniųPasaulis', '2025-05-03', '2025-05-10', 4, 880, 'lukas.lukosaitis@gmail.com'),
('CZ2025050609', 'Bohemijos gamta ir pilys', 'Gamta ir istorija širdyje Europos.', 'AtraskPasaulį', '2025-05-06', '2025-05-12', 3, 690, 'rimas.zdanavicius@gmail.com'),
('IT2025050810', 'Venecija ir jos kanalai', 'Gondolos, karnavalas ir menas.', 'ViaEuropa', '2025-05-08', '2025-05-14', 5, 820, 'greta@email.com'),
('HU2025051011', 'Budapešto perlai', 'Terminės vonios, Donava ir architektūra.', 'LTTravel', '2025-05-10', '2025-05-16', 4, 750, 'justinas@email.com'),
('FR2025051212', 'Luaros slėnio pilys', 'Elegantiška kelionė po istorines vietoves.', 'KelioniuTakas', '2025-05-12', '2025-05-18', 4, 890, 'monika@email.com'),
('LT2025051313', 'Kuršių nerijos grožis', 'Smėlio kopos ir marių ramybė.', 'LietuvaTaveMyli', '2025-05-13', '2025-05-16', 8, 350, 'vmasiulis@email.com'),
('PL2025051414', 'Varšuvos senamiestis', 'Muziejai ir Lenkijos kultūra.', 'SavaitgalioKelionės', '2025-05-14', '2025-05-18', 5, 580, 'gedas@email.com'),
('DE2025051615', 'Berlyno muziejų salos turas', 'Vokietijos kultūros lobiai.', 'Novaturas', '2025-05-16', '2025-05-21', 4, 770, 'justinas@email.com'),
('IT2025051716', 'Florencija ir renesansas', 'Italų menas ir skoniai.', 'PasaulioStebuklai', '2025-05-17', '2025-05-24', 5, 860, 'greta@email.com'),
('LT2025051817', 'Aukštaitijos nacionalinis parkas', 'Gamta, žygiai ir ežerai.', 'ŽygiaiIrKelionės', '2025-05-18', '2025-05-22', 6, 420, 'austeja@email.com'),
('ES2025051918', 'Andalūzijos karštis', 'Sevilija, Granada ir flamenko ritmai.', 'IspanijaTau', '2025-05-19', '2025-05-26', 4, 780, 'karolis@email.com'),
('FR2025052119', 'Bordo vyno kelias', 'Degustacijos ir gastronomija.', 'VynoKultūra', '2025-05-21', '2025-05-27', 3, 900, 'simona.navickite@gmail.com'),
('CZ2025052220', 'Prahos širdis', 'Tiltai, bokštai ir alaus kultūra.', 'KeliaujamLT', '2025-05-22', '2025-05-28', 4, 710, 'zita.bitininke@gmail.com');

CREATE TABLE klientas (
  vardas varchar(100) NOT NULL,
  pavarde varchar(100) NOT NULL,
  el_pastas varchar(100) NOT NULL PRIMARY KEY,
  telefono_nr varchar(50) NOT NULL,
  adresas varchar(500) DEFAULT NULL,
  registracijos_data date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO klientas (vardas, pavarde, el_pastas, telefono_nr, adresas, registracijos_data) VALUES
('jonas', 'jonaitis', 'jonas.jonaitis@gmail.com', '12345677', NULL, '2025-03-02'),
('petras', 'petraitis', 'petras.petraitis@gmail.com', '12345678', 'petro g. 4, kaunas', '2025-03-01'),
('Agnė', 'Bendoraitytė', 'agne.b@example.com', '12345001', 'Alytaus g. 5', '2025-03-05'),
('Dovydas', 'Grigas', 'dovydas.g@example.com', '12345002', 'Vilniaus g. 17', '2025-03-06'),
('Ieva', 'Petrulytė', 'ieva.p@example.com', '12345003', NULL, '2025-03-07'),
('Karolis', 'Vaitkus', 'karolis.v@example.com', '12345004', 'Klaipėdos g. 11', '2025-03-08'),
('Greta', 'Milašauskaitė', 'greta.m@example.com', '12345005', 'Kauno g. 3', '2025-03-09'),
('Simona', 'Kudirkaitė', 'simona.k@example.com', '12345006', NULL, '2025-03-10'),
('Julius', 'Šimkus', 'julius.s@example.com', '12345007', 'Šiaulių g. 7', '2025-03-11'),
('Laura', 'Tamošiūnaitė', 'laura.t@example.com', '12345008', 'Panevėžio g. 8', '2025-03-12'),
('Mantas', 'Paulauskas', 'mantas.p@example.com', '12345009', NULL, '2025-03-13'),
('Inga', 'Kairytė', 'inga.k@example.com', '12345010', 'Kauno g. 1', '2025-03-14'),
('Paulius', 'Dambrauskas', 'paulius.d@example.com', '12345011', 'Vilniaus g. 8', '2025-03-15'),
('Justina', 'Zabielaitė', 'justina.z@example.com', '12345012', NULL, '2025-03-16'),
('Diana', 'Gintaraitė', 'diana.g@example.com', '12345013', 'Alytaus g. 2', '2025-03-17'),
('Edgaras', 'Jurgis', 'edgaras.j@example.com', '12345014', 'Laisvės al. 99', '2025-03-18'),
('Vitalija', 'Radzevičienė', 'vitalija.r@example.com', '12345015', NULL, '2025-03-19'),
('Dominykas', 'Šulskis', 'dominykas.s@example.com', '12345016', 'Jonavos g. 10', '2025-03-20'),
('Ugnė', 'Mažeikaitė', 'ugne.m@example.com', '12345017', 'Šiaulių g. 15', '2025-03-21'),
('Ernesta', 'Kuzmickaitė', 'ernesta.k@example.com', '12345018', NULL, '2025-03-22');

CREATE TABLE skrydis (
  skrydzio_nr varchar(50) NOT NULL PRIMARY KEY,
  aviakompanija varchar(200) NOT NULL,
  isvykimo_vieta varchar(200) NOT NULL,
  isvykimo_data date NOT NULL,
  atvykimo_vieta varchar(200) NOT NULL,
  atvykimo_data date NOT NULL,
  kaina float NOT NULL,
  fk_Kelione varchar(50) NOT NULL,
  FOREIGN KEY (fk_Kelione) REFERENCES kelione (keliones_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO skrydis (skrydzio_nr, aviakompanija, isvykimo_vieta, isvykimo_data, atvykimo_vieta, atvykimo_data, kaina, fk_Kelione) VALUES
('FR2165432121654', 'Raynieras', 'Kaunas', '2025-03-23', 'Paryžius', '2025-03-23', 20, 'FR123123111'),
('IT001', 'Lituanica Air', 'Vilnius', '2025-04-15', 'Roma', '2025-04-15', 85, 'IT2025041501'),
('ES002', 'Air Ispanija', 'Vilnius', '2025-04-18', 'Barselona', '2025-04-18', 90, 'ES2025041802'),
('PL003', 'LOT Polish Airlines', 'Kaunas', '2025-04-20', 'Krokuva', '2025-04-20', 75, 'PL2025042003'),
('FR004', 'Raynieras', 'Kaunas', '2025-04-22', 'Paryžius', '2025-04-22', 60, 'FR2025042204'),
('DE005', 'Lufthansa', 'Vilnius', '2025-04-25', 'Miunchenas', '2025-04-25', 95, 'DE2025042505'),
('LT006', 'Keliautojų sparnai', 'Kaunas', '2025-04-28', 'Druskininkai', '2025-04-28', 20, 'LT2025042806'),
('UK007', 'British Airways', 'Vilnius', '2025-05-01', 'Londonas', '2025-05-01', 110, 'UK2025050107'),
('FR008', 'Air France', 'Vilnius', '2025-05-03', 'Marselis', '2025-05-03', 105, 'FR2025050308'),
('CZ009', 'Čekijos linijos', 'Vilnius', '2025-05-06', 'Praha', '2025-05-06', 70, 'CZ2025050609'),
('IT010', 'Italija Skraidina', 'Kaunas', '2025-05-08', 'Venecija', '2025-05-08', 95, 'IT2025050810'),
('HU011', 'WizzAir', 'Vilnius', '2025-05-10', 'Budapeštas', '2025-05-10', 80, 'HU2025051011'),
('FR012', 'Air France', 'Vilnius', '2025-05-12', 'Tours', '2025-05-12', 100, 'FR2025051212'),
('LT013', 'Keliautojų sparnai', 'Vilnius', '2025-05-13', 'Nida', '2025-05-13', 25, 'LT2025051313'),
('PL014', 'LOT Polish Airlines', 'Kaunas', '2025-05-14', 'Varšuva', '2025-05-14', 70, 'PL2025051414'),
('DE015', 'Lufthansa', 'Vilnius', '2025-05-16', 'Berlynas', '2025-05-16', 90, 'DE2025051615'),
('IT016', 'Air Italia', 'Vilnius', '2025-05-17', 'Florencija', '2025-05-17', 110, 'IT2025051716'),
('LT017', 'LT Sky', 'Kaunas', '2025-05-18', 'Utena', '2025-05-18', 20, 'LT2025051817'),
('ES018', 'Iberia', 'Vilnius', '2025-05-19', 'Sevilija', '2025-05-19', 95, 'ES2025051918'),
('FR019', 'Vyno oro linijos', 'Kaunas', '2025-05-21', 'Bordo', '2025-05-21', 100, 'FR2025052119'),
('CZ020', 'Čekijos linijos', 'Kaunas', '2025-05-22', 'Praha', '2025-05-22', 70, 'CZ2025052220');

CREATE TABLE transporto_tipas (
  code varchar(10) NOT NULL PRIMARY KEY,
  name varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO transporto_tipas (code, name) VALUES
('bus', 'autobusas'),
('car', 'automobilis'),
('train', 'traukinys');

CREATE TABLE transportas (
  numeris varchar(50) NOT NULL PRIMARY KEY,
  pavadinimas varchar(200) DEFAULT NULL,
  kaina float NOT NULL,
  tipas varchar(10) NOT NULL,
  fk_Kelione varchar(50) NOT NULL,
  FOREIGN KEY (fk_Kelione) REFERENCES kelione (keliones_id) ON DELETE CASCADE,
  FOREIGN KEY (tipas) REFERENCES transporto_tipas (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO transportas (numeris, pavadinimas, kaina, tipas, fk_Kelione) VALUES
('223322', 'senas Kautros autobusas', 20, 'bus', 'CZ1231232222'),
('TR10001', 'Modernus Eurolines autobusas', 25, 'bus', 'FR123123111'),
('TR10002', 'Privatus Mercedes automobilis', 45, 'car', 'IT2025041501'),
('TR10003', 'Renfe ekspresas', 30, 'train', 'ES2025041802'),
('TR10004', 'PKS autobusas', 18, 'bus', 'PL2025042003'),
('TR10005', 'Paryžiaus metro bilietas', 10, 'train', 'FR2025042204'),
('TR10006', 'Touring autokaravanas', 35, 'bus', 'DE2025042505'),
('TR10007', 'LT kaimo keliais mikroautobusas', 15, 'bus', 'LT2025042806'),
('TR10008', 'London City autobusas', 28, 'bus', 'UK2025050107'),
('TR10009', 'Regioninis traukinys į Provanse', 22, 'train', 'FR2025050308'),
('TR10010', 'Privatus automobilis Čekijai', 40, 'car', 'CZ2025050609'),
('TR10011', 'Venecijos vandens autobusas', 12, 'bus', 'IT2025050810'),
('TR10012', 'Budapešto metro', 9, 'train', 'HU2025051011'),
('TR10013', 'Luaros turizmo autobusas', 26, 'bus', 'FR2025051212'),
('TR10014', 'Kuršių nerijos žaliasis autobusas', 14, 'bus', 'LT2025051313'),
('TR10015', 'Varšuvos miesto traukinys', 11, 'train', 'PL2025051414'),
('TR10016', 'Berlyno turistinis autobusas', 20, 'bus', 'DE2025051615'),
('TR10017', 'Florencijos miesto automobilis', 38, 'car', 'IT2025051716'),
('TR10018', 'Aukštaitijos nacionalinio parko autobusas', 16, 'bus', 'LT2025051817'),
('TR10019', 'Ispanijos regioninis traukinys', 29, 'train', 'ES2025051918'),
('TR10020', 'Bordo vyno regiono mikroautobusas', 32, 'bus', 'FR2025052119');

CREATE TABLE viesbutis (
  id int(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  pavadinimas varchar(200) NOT NULL,
  adresas varchar(500) NOT NULL,
  aprasymas varchar(1000) DEFAULT NULL,
  kaina float NOT NULL,
  reitingas int(11) NOT NULL,
  fk_Kelione varchar(50) NOT NULL,
  FOREIGN KEY (fk_Kelione) REFERENCES kelione (keliones_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO viesbutis (pavadinimas, adresas, aprasymas, kaina, reitingas, fk_Kelione) VALUES
('Armagedonas', 'Keistuolių gatvė 22, lenkija', 'Neįpatingas, prastas viešbutis', 20, 3, 'CZ1231232222'),
('Kanklės', 'kanklių g. 6, Čekija', NULL, 20, 4, 'CZ1231232222'),
('Francūzų', 'france street 55, Paris', NULL, 35, 5, 'FR123123111'),
('Roma Lux', 'Via Appia 123, Roma', 'Prabangus viešbutis netoli Koliziejaus', 120, 5, 'IT2025041501'),
('Iberia Fiesta', 'Calle Sol 45, Madrid', 'Modernus viešbutis su terasa', 95, 4, 'ES2025041802'),
('Krakow Classic', 'Pilies g. 12, Krokuva', 'Autentiška atmosfera', 70, 4, 'PL2025042003'),
('Senos Krantas', 'Quai de la Seine 99, Paris', 'Vaizdas į upę ir Luvrą', 150, 5, 'FR2025042204'),
('Berlyno Rūmai', 'Museumstraße 1, Berlin', 'Netoli muziejų salos', 110, 5, 'DE2025042505'),
('Dzūkų Namai', 'Miško takas 8, Merkinė', 'Tradicinė lietuviška trobelė', 45, 3, 'LT2025042806'),
('London Stay', 'Tower Road 33, London', 'Netoli Tauerio tilto', 130, 4, 'UK2025050107'),
('Levandų Kvapas', 'Route des Lavandes 21, Provence', 'Rami vieta gamtos apsuptyje', 85, 5, 'FR2025050308'),
('Bohemijos Ramybė', 'Zamecka 17, Čekija', 'Istorinis viešbutis su sodu', 70, 4, 'CZ2025050609'),
('Venecijos Perla', 'Canal Grande 4, Venezia', 'Gondolų uostas prie pat viešbučio', 140, 5, 'IT2025050810'),
('Budapešto SPA', 'Thermal Street 3, Budapest', 'Su terminiu baseinu', 100, 5, 'HU2025051011'),
('Château Loire', 'Rue du Château 77, Loire', 'Pilies tipo viešbutis', 160, 5, 'FR2025051212'),
('Marių Vėjas', 'Naglių g. 20, Nida', 'Vaizdas į marias', 60, 4, 'LT2025051313'),
('Varšuvos Senamiestis', 'Starówka 15, Warsaw', 'Klasikinis Lenkijos interjeras', 75, 4, 'PL2025051414'),
('Berlin Mitte Inn', 'Hauptstraße 88, Berlin', 'Netoli istorinių vietų', 95, 4, 'DE2025051615'),
('Florencijos Šviesa', 'Piazza della Repubblica 5, Florence', 'Renesanso dvasia', 125, 5, 'IT2025051716'),
('Žvejo Sodyba', 'Miško g. 3, Utena', 'Ežero pakrantėje', 50, 4, 'LT2025051817'),
('Andalūzijos Rytai', 'Calle Flamenco 10, Seville', 'Tradicinis ispaniškas dizainas', 90, 5, 'ES2025051918'),
('Bordo Vyninė', 'Rue des Vins 8, Bordeaux', 'Su vyno degustacijomis', 140, 5, 'FR2025052119'),
('Prahos Vaizdai', 'Karlovo náměstí 7, Praha', 'Panoraminiai langai į senamiestį', 85, 4, 'CZ2025052220');

CREATE TABLE rezervacija (
  rezervacijos_id varchar(50) NOT NULL PRIMARY KEY,
  rezervacijos_data date NOT NULL,
  busena varchar(10) NOT NULL,
  fk_Klientas varchar(100) NOT NULL,
  fk_Kelione varchar(50) NOT NULL,
  FOREIGN KEY (fk_Kelione) REFERENCES kelione (keliones_id),
  FOREIGN KEY (fk_Klientas) REFERENCES klientas (el_pastas),
  FOREIGN KEY (busena) REFERENCES rezervacijos_busena (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO rezervacija (rezervacijos_id, rezervacijos_data, busena, fk_Klientas, fk_Kelione) VALUES
('rez123456788', '2025-03-03', 'confirmed', 'ernesta.k@example.com', 'CZ1231232222'),
('rez123456789', '2025-03-01', 'pending', 'edgaras.j@example.com', 'CZ1231232222'),
('rez123456790', '2025-03-04', 'confirmed', 'jonas.jonaitis@gmail.com', 'FR123123111'),
('rez123456791', '2025-03-05', 'confirmed', 'agne.b@example.com', 'IT2025041501'),
('rez123456792', '2025-03-06', 'pending', 'dovydas.g@example.com', 'ES2025041802'),
('rez123456793', '2025-03-07', 'confirmed', 'ieva.p@example.com', 'PL2025042003'),
('rez123456794', '2025-03-08', 'cancelled', 'karolis.v@example.com', 'FR2025042204'),
('rez123456795', '2025-03-09', 'confirmed', 'greta.m@example.com', 'DE2025042505'),
('rez123456796', '2025-03-10', 'pending', 'simona.k@example.com', 'LT2025042806'),
('rez123456797', '2025-03-11', 'confirmed', 'julius.s@example.com', 'UK2025050107'),
('rez123456798', '2025-03-12', 'confirmed', 'laura.t@example.com', 'FR2025050308'),
('rez123456799', '2025-03-13', 'cancelled', 'mantas.p@example.com', 'CZ2025050609'),
('rez123456800', '2025-03-14', 'pending', 'inga.k@example.com', 'IT2025050810'),
('rez123456801', '2025-03-15', 'confirmed', 'paulius.d@example.com', 'HU2025051011'),
('rez123456802', '2025-03-16', 'pending', 'justina.z@example.com', 'FR2025051212'),
('rez123456803', '2025-03-17', 'confirmed', 'diana.g@example.com', 'LT2025051313'),
('rez123456804', '2025-03-18', 'confirmed', 'edgaras.j@example.com', 'PL2025051414'),
('rez123456805', '2025-03-19', 'cancelled', 'vitalija.r@example.com', 'DE2025051615'),
('rez123456806', '2025-03-20', 'confirmed', 'dominykas.s@example.com', 'IT2025051716'),
('rez123456807', '2025-03-21', 'confirmed', 'ugne.m@example.com', 'LT2025051817'),
('rez123456808', '2025-03-22', 'pending', 'ernesta.k@example.com', 'ES2025051918'),
('rez123456809', '2025-03-23', 'confirmed', 'petras.petraitis@gmail.com', 'FR2025052119');

CREATE TABLE mokejimo_budas (
  code varchar(20) NOT NULL PRIMARY KEY,
  name varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO mokejimo_budas (code, name) VALUES
('card', 'kredito koretelė'),
('bank', 'banko pavedimas'),
('cash', 'grynieji');

CREATE TABLE mokejimas (
  id int(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  suma float NOT NULL,
  mokėjimo_data date NOT NULL,
  mokejimo_budas varchar(20) NOT NULL,
  fk_Rezervacija varchar(50) NOT NULL,
  FOREIGN KEY (fk_Rezervacija) REFERENCES rezervacija (rezervacijos_id),
  FOREIGN KEY (mokejimo_budas) REFERENCES mokejimo_budas (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO mokejimas (suma, mokėjimo_data, mokejimo_budas, fk_Rezervacija) VALUES
(900, '2025-03-01', 'cash', 'rez123456789'),
(800, '2025-03-04', 'card', 'rez123456788'),
(1000, '2025-03-03', 'bank', 'rez123456788'),
(620, '2025-03-05', 'card', 'rez123456790'),
(750, '2025-03-05', 'cash', 'rez123456791'),
(720, '2025-03-06', 'card', 'rez123456792'),
(600, '2025-03-07', 'bank', 'rez123456793'),
(850, '2025-03-08', 'cash', 'rez123456794'),
(780, '2025-03-09', 'card', 'rez123456795'),
(400, '2025-03-10', 'cash', 'rez123456796'),
(830, '2025-03-11', 'bank', 'rez123456797'),
(880, '2025-03-12', 'cash', 'rez123456798'),
(690, '2025-03-13', 'card', 'rez123456799'),
(820, '2025-03-14', 'bank', 'rez123456800'),
(750, '2025-03-15', 'cash', 'rez123456801'),
(890, '2025-03-16', 'card', 'rez123456802'),
(350, '2025-03-17', 'cash', 'rez123456803'),
(580, '2025-03-18', 'bank', 'rez123456804'),
(770, '2025-03-19', 'card', 'rez123456805'),
(860, '2025-03-20', 'cash', 'rez123456806'),
(420, '2025-03-21', 'bank', 'rez123456807'),
(780, '2025-03-22', 'card', 'rez123456808');

CREATE TABLE draudimas (
  draudimo_id varchar(20) NOT NULL PRIMARY KEY,
  pavadinimas varchar(100) NOT NULL,
  aprasymas varchar(1000) DEFAULT NULL,
  kaina float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO draudimas (draudimo_id, pavadinimas, aprasymas, kaina) VALUES
('life', 'gyvybė', 'gyvybės draudimas', 12),
('health', 'traumos', 'traumų draudimas', 45),
('bag', 'bagažas', 'bagažo draudimas', 31),
('fly', 'skrydis', 'skrydžio vėlavimo draudimas', 53),
('civil', 'atsakomybė', 'civilinės atsakomybės draudimas', 77),
('trip', 'kelionė', 'bendras kelionės draudimas', 65),
('sport', 'sportas', 'sporto veiklų draudimas', 38),
('cancel', 'atšaukimas', 'kelionės atšaukimo draudimas', 42),
('accident', 'nelaimės', 'nelaimingų atsitikimų draudimas', 55),
('covid', 'covid-19', 'covid-19 rizikų draudimas', 33),
('snow', 'sniegas', 'žiemos sporto draudimas', 47),
('lost', 'dingimas', 'dingusio bagažo draudimas', 36),
('car', 'automobilis', 'nuomoto automobilio draudimas', 90),
('delay', 'vėlavimas', 'transporto vėlavimo draudimas', 27),
('doc', 'dokumentai', 'prarastų dokumentų draudimas', 49),
('pet', 'gyvūnai', 'kelionių su gyvūnais draudimas', 40),
('tech', 'technika', 'elektronikos įrangos draudimas', 58),
('rescue', 'gelbėjimas', 'gelbėjimo išlaidų draudimas', 66),
('climb', 'kopimas', 'kalnų kopimo draudimas', 72),
('extreme', 'ekstremalus', 'ekstremalių sportų draudimas', 85),
('weather', 'oras', 'blogų oro sąlygų draudimas', 44),
('visa', 'viza', 'vizos atsisakymo draudimas', 39),
('family', 'šeima', 'šeimos kelionės draudimas', 59),
('premium', 'aukščiausias', 'visapusiškas kelionės draudimas', 97),
('basic', 'pagrindinis', 'pagrindinių rizikų draudimas', 25);

CREATE TABLE draudimo_polisas (
  id int(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  numeris varchar(50) NOT NULL,
  fk_Draudimas varchar(20) NOT NULL,
  fk_Rezervacija varchar(50) NOT NULL,
  FOREIGN KEY (fk_Rezervacija) REFERENCES rezervacija (rezervacijos_id) ON DELETE CASCADE,
  FOREIGN KEY (fk_Draudimas) REFERENCES draudimas (draudimo_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

INSERT INTO draudimo_polisas (numeris, fk_Draudimas, fk_Rezervacija) VALUES
('L7645334', 'life', 'rez123456789'),
('F2345245', 'fly', 'rez123456788'),
('D8723641', 'trip', 'rez123456790'),
('B5642378', 'cancel', 'rez123456791'),
('P2384723', 'bag', 'rez123456792'),
('S9841237', 'health', 'rez123456793'),
('V2384123', 'car', 'rez123456794'),
('G8347123', 'sport', 'rez123456795'),
('M9238472', 'accident', 'rez123456796'),
('X1029384', 'pet', 'rez123456797'),
('Z9238472', 'rescue', 'rez123456798'),
('C2384712', 'extreme', 'rez123456799'),
('T4839201', 'snow', 'rez123456800'),
('W1928374', 'basic', 'rez123456801'),
('E1123581', 'covid', 'rez123456802'),
('N0192837', 'delay', 'rez123456803'),
('Q1239871', 'tech', 'rez123456804'),
('H9988776', 'weather', 'rez123456805'),
('Y8877665', 'climb', 'rez123456806'),
('K7766554', 'doc', 'rez123456807'),
('A6655443', 'family', 'rez123456808'),
('J5544332', 'premium', 'rez123456809');
