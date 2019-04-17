-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Kwi 2019, 23:31
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kk`
--

CREATE TABLE `kk` (
  `ID` int(11) NOT NULL,
  `Pomiar` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `Data` date NOT NULL,
  `Imie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kk`
--

INSERT INTO `kk` (`ID`, `Pomiar`, `Data`, `Imie`) VALUES
(1, 'pozytywny', '2019-01-24', 4),
(2, 'negatywny', '2019-01-01', 2),
(3, '', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kp`
--

CREATE TABLE `kp` (
  `ID` int(11) NOT NULL,
  `Proces` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `Wymagane` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `Data` date NOT NULL,
  `Imie` int(11) DEFAULT NULL,
  `Uwagi` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kp`
--

INSERT INTO `kp` (`ID`, `Proces`, `Wymagane`, `Data`, `Imie`, `Uwagi`) VALUES
(1, 'Przygotowanie', 'Tak', '2019-04-04', 1, ''),
(2, 'Ciecie', 'Nie', '2019-04-11', 2, ''),
(3, 'Spawanie', 'Tak', '2018-10-03', 4, ''),
(4, 'Znakowanie', 'Tak', '2019-03-13', 5, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `npt`
--

CREATE TABLE `npt` (
  `ID` int(11) NOT NULL,
  `NPT` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `Rysunek` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `Identyfikator` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Imie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `npt`
--

INSERT INTO `npt` (`ID`, `NPT`, `Rysunek`, `Identyfikator`, `Data`, `Imie`) VALUES
(1, 'Drut', 'X1', 1510, '2019-04-07', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pc`
--

CREATE TABLE `pc` (
  `ID` int(11) NOT NULL,
  `Pracownicy` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `pc`
--

INSERT INTO `pc` (`ID`, `Pracownicy`) VALUES
(1, 'Jan Kowalski'),
(2, 'Krzysztof Nowak'),
(3, 'Maciej Sroka'),
(4, 'Mateusz Grabowski'),
(5, 'Jerzy Siedzik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pm`
--

CREATE TABLE `pm` (
  `ID` int(11) NOT NULL,
  `Nazwa` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `Ilosc` decimal(10,2) NOT NULL,
  `Gatunek` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `Numer` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `pm`
--

INSERT INTO `pm` (`ID`, `Nazwa`, `Ilosc`, `Gatunek`, `Numer`) VALUES
(1, 'Drut1', '6.86', 'S355J2', '10577'),
(2, 'Drut2', '6.63', 'SH5844', '571565'),
(3, 'Drut3', '38.00', 'ER8474', '53641'),
(4, 'Drut4', '77.58', 'MN5847', 'HO2569'),
(5, 'Drut5', '3.58', 'GH487', '4875');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kk`
--
ALTER TABLE `kk`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `pckk` (`Imie`);

--
-- Indeksy dla tabeli `kp`
--
ALTER TABLE `kp`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `pckp` (`Imie`);

--
-- Indeksy dla tabeli `npt`
--
ALTER TABLE `npt`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `pcnpt` (`Imie`);

--
-- Indeksy dla tabeli `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indeksy dla tabeli `pm`
--
ALTER TABLE `pm`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kk`
--
ALTER TABLE `kk`
  ADD CONSTRAINT `pckk` FOREIGN KEY (`Imie`) REFERENCES `pc` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `kp`
--
ALTER TABLE `kp`
  ADD CONSTRAINT `pckp` FOREIGN KEY (`Imie`) REFERENCES `pc` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `npt`
--
ALTER TABLE `npt`
  ADD CONSTRAINT `pcnpt` FOREIGN KEY (`Imie`) REFERENCES `pc` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
