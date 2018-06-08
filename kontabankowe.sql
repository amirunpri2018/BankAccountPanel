-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 08 Cze 2018, 14:56
-- Wersja serwera: 10.1.31-MariaDB
-- Wersja PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bank`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontabankowe`
--

CREATE TABLE `kontabankowe` (
  `id` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `login` int(11) NOT NULL,
  `haslo` int(11) NOT NULL,
  `nrkonta` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `pieniadze` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kontabankowe`
--

INSERT INTO `kontabankowe` (`id`, `imie`, `nazwisko`, `login`, `haslo`, `nrkonta`, `pieniadze`) VALUES
(1, 'Adrian', 'Pietrzak', 1234, 1234, '987654321', 1000),
(2, 'Mateusz', 'Polaszek', 1235, 1235, '123456789', 1000);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kontabankowe`
--
ALTER TABLE `kontabankowe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kontabankowe`
--
ALTER TABLE `kontabankowe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
