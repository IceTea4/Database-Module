-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 04:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icetealab1`
--

-- --------------------------------------------------------

--
-- Table structure for table `apmokėjimo_būsena`
--

CREATE TABLE `apmokėjimo_būsena` (
  `id` int(50) NOT NULL,
  `name` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `apmokėjimo_būsena`
--

INSERT INTO `apmokėjimo_būsena` (`id`, `name`) VALUES
(1, 'laukiama'),
(2, 'apmokėta'),
(3, 'neapmokėta');

-- --------------------------------------------------------

--
-- Table structure for table `atsiliepimas`
--

CREATE TABLE `atsiliepimas` (
  `id` int(50) NOT NULL,
  `komentaras` varchar(1000) DEFAULT NULL,
  `data` date NOT NULL,
  `įvertinimas` int(11) NOT NULL,
  `fk_Klientas` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `atsiliepimas`
--

INSERT INTO `atsiliepimas` (`id`, `komentaras`, `data`, `įvertinimas`, `fk_Klientas`) VALUES
(1, NULL, '2025-03-08', 5, 123456789),
(2, 'nelabai patiko, aptarnavimas prastas, bendravimas nemalonus, kelione buvo sudetinga ir varginanti', '2025-03-09', 2, 123456788);

-- --------------------------------------------------------

--
-- Table structure for table `būsenos`
--

CREATE TABLE `būsenos` (
  `id` int(50) NOT NULL,
  `name` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `būsenos`
--

INSERT INTO `būsenos` (`id`, `name`) VALUES
(1, 'laukiama'),
(2, 'patvirtinta'),
(3, 'atšaukta');

-- --------------------------------------------------------

--
-- Table structure for table `kelionių_vadovas`
--

CREATE TABLE `kelionių_vadovas` (
  `asmens_kodas` int(15) NOT NULL,
  `vardas` varchar(500) NOT NULL,
  `pavardė` varchar(700) NOT NULL,
  `telefono_nr` int(15) NOT NULL,
  `el_paštas` varchar(1000) DEFAULT NULL,
  `kalbos` varchar(500) NOT NULL,
  `patirtis_metais` int(3) DEFAULT NULL,
  `kaina` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `kelionių_vadovas`
--

INSERT INTO `kelionių_vadovas` (`asmens_kodas`, `vardas`, `pavardė`, `telefono_nr`, `el_paštas`, `kalbos`, `patirtis_metais`, `kaina`) VALUES
(1234566666, 'Zita', 'Bitininkė', 123123123, NULL, 'rusų, prancuzų, lietuvių', NULL, 120),
(1234567777, 'Lukas', 'Lukošaitis', 123123123, 'lukas.lukosaitis@gmail.com', 'rusu, lenku, lietuvių, anglų.', 5, 170);

-- --------------------------------------------------------

--
-- Table structure for table `kelionė`
--

CREATE TABLE `kelionė` (
  `kelionės_id` varchar(50) NOT NULL,
  `pavadinimas` varchar(500) NOT NULL,
  `aprašymas` varchar(1000) NOT NULL,
  `organizatorius` varchar(255) NOT NULL,
  `pradžios_data` date NOT NULL,
  `pabaigos_data` date NOT NULL,
  `vietų_skaičius` int(15) NOT NULL,
  `kaina` float NOT NULL,
  `fk_Rezervacija` varchar(50) NOT NULL,
  `fk_Kelionių_vadovas` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `kelionė`
--

INSERT INTO `kelionė` (`kelionės_id`, `pavadinimas`, `aprašymas`, `organizatorius`, `pradžios_data`, `pabaigos_data`, `vietų_skaičius`, `kaina`, `fk_Rezervacija`, `fk_Kelionių_vadovas`) VALUES
('CZ1231232222', 'Nuostabūs Čekijos istoriniai pamiklai', 'Aplankysime Čekijos istoriją nurodančius objektus.', 'GintarinėsUogos', '2025-03-23', '2025-03-29', 35, 750, 'rez123456788', 1234567777),
('FR123123111', 'Nuostabūs Prancūzijos vaizdai', 'Kliausime po nuostabų kraštovaizdį. Ši kelionė išliks jūsų atmintyje ilgam.', 'Novaturas', '2025-03-16', '2025-03-22', 20, 620, 'rez123456789', 1234566666);

-- --------------------------------------------------------

--
-- Table structure for table `klientas`
--

CREATE TABLE `klientas` (
  `asmens_kodas` int(15) NOT NULL,
  `vardas` varchar(500) NOT NULL,
  `pavardė` varchar(700) NOT NULL,
  `el_paštas` varchar(1000) NOT NULL,
  `telefono_nr` int(15) NOT NULL,
  `adresas` varchar(1000) DEFAULT NULL,
  `registracijos_data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `klientas`
--

INSERT INTO `klientas` (`asmens_kodas`, `vardas`, `pavardė`, `el_paštas`, `telefono_nr`, `adresas`, `registracijos_data`) VALUES
(123456788, 'jonas', 'jonaitis', 'jonas.jonaitis@gmail.com', 12345677, NULL, '2025-03-02'),
(123456789, 'petras', 'petraitis', 'petras.petraitis@gmail.com', 12345678, 'petro g. 4, kaunas', '2025-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `mokėjimas`
--

CREATE TABLE `mokėjimas` (
  `id` int(50) NOT NULL,
  `suma` float NOT NULL,
  `mokėjimo_data` date NOT NULL,
  `mokėjimo_būdas` int(11) NOT NULL,
  `būsena` int(11) NOT NULL,
  `fk_Rezervacija` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `mokėjimas`
--

INSERT INTO `mokėjimas` (`id`, `suma`, `mokėjimo_data`, `mokėjimo_būdas`, `būsena`, `fk_Rezervacija`) VALUES
(1, 900, '2025-03-01', 2, 1, 'rez123456789'),
(2, 800, '2025-03-04', 3, 2, 'rez123456788');

-- --------------------------------------------------------

--
-- Table structure for table `mokėjimo_būdai`
--

CREATE TABLE `mokėjimo_būdai` (
  `id` int(50) NOT NULL,
  `name` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `mokėjimo_būdai`
--

INSERT INTO `mokėjimo_būdai` (`id`, `name`) VALUES
(1, 'kredito_koretelė'),
(2, 'banko_pavedimas'),
(3, 'paypal');

-- --------------------------------------------------------

--
-- Table structure for table `nuolaidos`
--

CREATE TABLE `nuolaidos` (
  `id` int(50) NOT NULL,
  `pavadinimas` varchar(500) NOT NULL,
  `aprašymas` varchar(1000) DEFAULT NULL,
  `nuolaidos_proc` float NOT NULL,
  `galiojimo_pradžia` date NOT NULL,
  `galiojimo_pabaiga` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `nuolaidos`
--

INSERT INTO `nuolaidos` (`id`, `pavadinimas`, `aprašymas`, `nuolaidos_proc`, `galiojimo_pradžia`, `galiojimo_pabaiga`) VALUES
(1, 'antrojo kliento prisiregistravusio nuolaida', NULL, 20, '2025-03-01', '2025-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `rezervacijos_id` varchar(50) NOT NULL,
  `rezervacijos_data` date NOT NULL,
  `kaina` float NOT NULL,
  `būsena` int(11) NOT NULL,
  `fk_Klientas` int(15) NOT NULL,
  `fk_Nuolaidos` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`rezervacijos_id`, `rezervacijos_data`, `kaina`, `būsena`, `fk_Klientas`, `fk_Nuolaidos`) VALUES
('rez123456788', '2025-03-03', 1000, 2, 123456788, 1),
('rez123456789', '2025-03-01', 900, 1, 123456789, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skrydis`
--

CREATE TABLE `skrydis` (
  `skrydžio_nr` varchar(50) NOT NULL,
  `aviakompanija` varchar(500) NOT NULL,
  `išvykimo_vieta` varchar(300) NOT NULL,
  `išvykimo_data` date NOT NULL,
  `atvykimo_vieta` varchar(300) NOT NULL,
  `atvykimo_data` date NOT NULL,
  `kaina` float NOT NULL,
  `fk_Kelionė` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `skrydis`
--

INSERT INTO `skrydis` (`skrydžio_nr`, `aviakompanija`, `išvykimo_vieta`, `išvykimo_data`, `atvykimo_vieta`, `atvykimo_data`, `kaina`, `fk_Kelionė`) VALUES
('FR2165432121654', 'Raynieras', 'Kaunas', '2025-03-23', 'Paryžius', '2025-03-23', 20, 'FR123123111');

-- --------------------------------------------------------

--
-- Table structure for table `transportas`
--

CREATE TABLE `transportas` (
  `id` int(50) NOT NULL,
  `maršrutas` varchar(1000) DEFAULT NULL,
  `kaina` float NOT NULL,
  `tipas` int(11) NOT NULL,
  `fk_Kelionė` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `transportas`
--

INSERT INTO `transportas` (`id`, `maršrutas`, `kaina`, `tipas`, `fk_Kelionė`) VALUES
(1, 'senas, nusidėvėjęs kautros autobusas', 20, 1, 'CZ1231232222');

-- --------------------------------------------------------

--
-- Table structure for table `transporto_tipas`
--

CREATE TABLE `transporto_tipas` (
  `id` int(50) NOT NULL,
  `name` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `transporto_tipas`
--

INSERT INTO `transporto_tipas` (`id`, `name`) VALUES
(1, 'autobusas'),
(2, 'automobilis'),
(3, 'traukinys');

-- --------------------------------------------------------

--
-- Table structure for table `viešbutis`
--

CREATE TABLE `viešbutis` (
  `id` int(50) NOT NULL,
  `pavadinimas` varchar(500) NOT NULL,
  `adresas` varchar(1000) NOT NULL,
  `aprašymas` varchar(1000) DEFAULT NULL,
  `kaina_ūž_naktį` float NOT NULL,
  `žvaigždutės` int(11) NOT NULL,
  `fk_Kelionė` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `viešbutis`
--

INSERT INTO `viešbutis` (`id`, `pavadinimas`, `adresas`, `aprašymas`, `kaina_ūž_naktį`, `žvaigždutės`, `fk_Kelionė`) VALUES
(1, 'Armagedonas', 'Keistuolių gatvė 22, lenkija', 'Neįpatingas, prastas viešbutis', 20, 3, 'CZ1231232222'),
(2, 'Kanklės', 'kanklių g. 6, Čekija', NULL, 20, 4, 'CZ1231232222'),
(3, 'Francūzų', 'france street 55, Paris', NULL, 35, 5, 'FR123123111');

-- --------------------------------------------------------

--
-- Table structure for table `įvertinimai`
--

CREATE TABLE `įvertinimai` (
  `id` int(50) NOT NULL,
  `name` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `įvertinimai`
--

INSERT INTO `įvertinimai` (`id`, `name`) VALUES
(1, '1star'),
(2, '2star'),
(3, '3star'),
(4, '4star'),
(5, '5star');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apmokėjimo_būsena`
--
ALTER TABLE `apmokėjimo_būsena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atsiliepimas`
--
ALTER TABLE `atsiliepimas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `įvertinimas` (`įvertinimas`),
  ADD KEY `fkc_Klientas` (`fk_Klientas`);

--
-- Indexes for table `būsenos`
--
ALTER TABLE `būsenos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelionių_vadovas`
--
ALTER TABLE `kelionių_vadovas`
  ADD PRIMARY KEY (`asmens_kodas`);

--
-- Indexes for table `kelionė`
--
ALTER TABLE `kelionė`
  ADD PRIMARY KEY (`kelionės_id`),
  ADD KEY `fkc_Rezervacija` (`fk_Rezervacija`),
  ADD KEY `fkc_Kelionių_vadovas` (`fk_Kelionių_vadovas`);

--
-- Indexes for table `klientas`
--
ALTER TABLE `klientas`
  ADD PRIMARY KEY (`asmens_kodas`);

--
-- Indexes for table `mokėjimas`
--
ALTER TABLE `mokėjimas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mokėjimo_būdas` (`mokėjimo_būdas`),
  ADD KEY `būsena` (`būsena`),
  ADD KEY `fkc_Rezervac` (`fk_Rezervacija`);

--
-- Indexes for table `mokėjimo_būdai`
--
ALTER TABLE `mokėjimo_būdai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuolaidos`
--
ALTER TABLE `nuolaidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`rezervacijos_id`),
  ADD KEY `būsena` (`būsena`),
  ADD KEY `fkc_Klient` (`fk_Klientas`),
  ADD KEY `fkc_Nuolaidos` (`fk_Nuolaidos`);

--
-- Indexes for table `skrydis`
--
ALTER TABLE `skrydis`
  ADD PRIMARY KEY (`skrydžio_nr`),
  ADD KEY `fkc_Kelionė` (`fk_Kelionė`);

--
-- Indexes for table `transportas`
--
ALTER TABLE `transportas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipas` (`tipas`),
  ADD KEY `fkc_Kelion` (`fk_Kelionė`);

--
-- Indexes for table `transporto_tipas`
--
ALTER TABLE `transporto_tipas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `viešbutis`
--
ALTER TABLE `viešbutis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `žvaigždutės` (`žvaigždutės`),
  ADD KEY `fkc_Kelio` (`fk_Kelionė`);

--
-- Indexes for table `įvertinimai`
--
ALTER TABLE `įvertinimai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apmokėjimo_būsena`
--
ALTER TABLE `apmokėjimo_būsena`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `atsiliepimas`
--
ALTER TABLE `atsiliepimas`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `būsenos`
--
ALTER TABLE `būsenos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mokėjimas`
--
ALTER TABLE `mokėjimas`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mokėjimo_būdai`
--
ALTER TABLE `mokėjimo_būdai`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nuolaidos`
--
ALTER TABLE `nuolaidos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transportas`
--
ALTER TABLE `transportas`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transporto_tipas`
--
ALTER TABLE `transporto_tipas`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `viešbutis`
--
ALTER TABLE `viešbutis`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `įvertinimai`
--
ALTER TABLE `įvertinimai`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atsiliepimas`
--
ALTER TABLE `atsiliepimas`
  ADD CONSTRAINT `atsiliepimas_ibfk_1` FOREIGN KEY (`įvertinimas`) REFERENCES `įvertinimai` (`id`),
  ADD CONSTRAINT `fkc_Klientas` FOREIGN KEY (`fk_Klientas`) REFERENCES `klientas` (`asmens_kodas`);

--
-- Constraints for table `kelionė`
--
ALTER TABLE `kelionė`
  ADD CONSTRAINT `fkc_Kelionių_vadovas` FOREIGN KEY (`fk_Kelionių_vadovas`) REFERENCES `kelionių_vadovas` (`asmens_kodas`),
  ADD CONSTRAINT `fkc_Rezervacija` FOREIGN KEY (`fk_Rezervacija`) REFERENCES `rezervacija` (`rezervacijos_id`);

--
-- Constraints for table `mokėjimas`
--
ALTER TABLE `mokėjimas`
  ADD CONSTRAINT `fkc_Rezervac` FOREIGN KEY (`fk_Rezervacija`) REFERENCES `rezervacija` (`rezervacijos_id`),
  ADD CONSTRAINT `mokėjimas_ibfk_1` FOREIGN KEY (`mokėjimo_būdas`) REFERENCES `mokėjimo_būdai` (`id`),
  ADD CONSTRAINT `mokėjimas_ibfk_2` FOREIGN KEY (`būsena`) REFERENCES `apmokėjimo_būsena` (`id`);

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fkc_Klient` FOREIGN KEY (`fk_Klientas`) REFERENCES `klientas` (`asmens_kodas`),
  ADD CONSTRAINT `fkc_Nuolaidos` FOREIGN KEY (`fk_Nuolaidos`) REFERENCES `nuolaidos` (`id`),
  ADD CONSTRAINT `rezervacija_ibfk_1` FOREIGN KEY (`būsena`) REFERENCES `būsenos` (`id`);

--
-- Constraints for table `skrydis`
--
ALTER TABLE `skrydis`
  ADD CONSTRAINT `fkc_Kelionė` FOREIGN KEY (`fk_Kelionė`) REFERENCES `kelionė` (`kelionės_id`);

--
-- Constraints for table `transportas`
--
ALTER TABLE `transportas`
  ADD CONSTRAINT `fkc_Kelion` FOREIGN KEY (`fk_Kelionė`) REFERENCES `kelionė` (`kelionės_id`),
  ADD CONSTRAINT `transportas_ibfk_1` FOREIGN KEY (`tipas`) REFERENCES `transporto_tipas` (`id`);

--
-- Constraints for table `viešbutis`
--
ALTER TABLE `viešbutis`
  ADD CONSTRAINT `fkc_Kelio` FOREIGN KEY (`fk_Kelionė`) REFERENCES `kelionė` (`kelionės_id`),
  ADD CONSTRAINT `viešbutis_ibfk_1` FOREIGN KEY (`žvaigždutės`) REFERENCES `įvertinimai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
