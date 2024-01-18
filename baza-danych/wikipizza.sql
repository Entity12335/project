-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Sty 2024, 08:32
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wikipizza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artykuły`
--

CREATE TABLE `artykuły` (
  `IDart` int(11) NOT NULL,
  `Tytuł` text COLLATE utf8_polish_ci NOT NULL,
  `Opis` mediumtext COLLATE utf8_polish_ci NOT NULL,
  `Hasz` text COLLATE utf8_polish_ci NOT NULL,
  `Składniki` longtext COLLATE utf8_polish_ci NOT NULL,
  `Przepis` longtext COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hasz`
--

CREATE TABLE `hasz` (
  `Hasz` char(255) COLLATE utf8_polish_ci NOT NULL,
  `Count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Login` text COLLATE utf8_polish_ci NOT NULL,
  `Hasło` text COLLATE utf8_polish_ci NOT NULL,
  `Email` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `Login`, `Hasło`, `Email`) VALUES
(1, 'TESTER', '$2y$10$FCMLiPGOlQybHTxteJkeR.CkkPZ64ouXM8E/QPsy65H7STA3BWQk2', 'Bozy.dar@gmail.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `artykuły`
--
ALTER TABLE `artykuły`
  ADD PRIMARY KEY (`IDart`);

--
-- Indeksy dla tabeli `hasz`
--
ALTER TABLE `hasz`
  ADD PRIMARY KEY (`Hasz`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `artykuły`
--
ALTER TABLE `artykuły`
  MODIFY `IDart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
