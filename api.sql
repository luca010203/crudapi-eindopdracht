-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 nov 2020 om 12:09
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `naam` varchar(256) CHARACTER SET utf8 NOT NULL,
  `beschrijving` text CHARACTER SET utf8 NOT NULL,
  `toegevoegd_op` datetime NOT NULL,
  `gewijzigd_op` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `naam` varchar(32) NOT NULL,
  `beschrijving` text NOT NULL,
  `prijs` decimal(10,0) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `toegevoegd_op` datetime NOT NULL,
  `gewijzigd_op` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `naam`, `beschrijving`, `prijs`, `categorie_id`, `toegevoegd_op`, `gewijzigd_op`) VALUES
(4, 'Luca', 'godmode', '9999999999', 6, '2020-10-15 22:45:00', '2020-10-15 20:45:00'),
(5, 'test', 'test@test.com', '10475', 1, '2020-10-15 22:45:00', '2020-10-15 20:45:00'),
(6, 'extra', 'uh@fma.com', '102', 1, '2020-10-15 22:45:00', '2020-10-15 20:45:00'),
(7, 'peaky', 'peaky@blinders.com', '506', 4, '2020-10-15 22:45:00', '2020-10-15 20:45:00'),
(8, 'walter', 'walter@white.com', '60555', 4, '2020-10-15 22:45:00', '2020-10-15 20:45:00'),
(9, '', '', '0', 0, '2020-10-15 22:42:00', '2020-10-15 20:42:00'),
(10, 'extra', 'fm@fam', '444', 0, '2020-10-15 22:43:00', '2020-10-15 20:43:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'Luca', '$2y$10$An41zBipwMi9pV7z3Wj9NOdH5XwEc9sSf58No394CDOBrbgQItZWS', '2020-11-13 12:05:15');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
