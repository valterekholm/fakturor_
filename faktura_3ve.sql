-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 05:32 PM
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
-- Database: `faktura_3ve`
--

-- --------------------------------------------------------

--
-- Table structure for table `bet_villkor`
--

CREATE TABLE `bet_villkor` (
  `id` int(11) NOT NULL,
  `namn` varchar(100) NOT NULL,
  `antal_dagar_netto` int(11) NOT NULL DEFAULT 30,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faktura`
--

CREATE TABLE `faktura` (
  `id` int(11) NOT NULL,
  `nr` int(11) NOT NULL,
  `kund_nr` int(11) NOT NULL COMMENT 'ref',
  `datum` date NOT NULL,
  `bet_villkor` int(11) NOT NULL COMMENT 'betalnings villkor ref',
  `forfallo_datum` date NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `kommentarer` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakturapost_1`
--

CREATE TABLE `fakturapost_1` (
  `id` int(11) NOT NULL,
  `faktura_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `produkt` varchar(100) NOT NULL,
  `beskrivning` varchar(200) DEFAULT NULL,
  `antal` smallint(6) NOT NULL DEFAULT 1,
  `a_pris_kr` int(11) NOT NULL,
  `moms_procent` int(11) NOT NULL DEFAULT 25,
  `kommentarer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakturapost_2`
--

CREATE TABLE `fakturapost_2` (
  `id` int(11) NOT NULL,
  `faktura_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `synlig` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=dölj, annars > 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kund`
--

CREATE TABLE `kund` (
  `id` int(11) NOT NULL,
  `namn_foretag` varchar(100) NOT NULL,
  `gatuadress` varchar(100) NOT NULL,
  `postnummer` int(11) NOT NULL,
  `postort` varchar(80) NOT NULL,
  `namn_person` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mitt_foretag`
--

CREATE TABLE `mitt_foretag` (
  `id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `namn` varchar(90) NOT NULL,
  `adress_1` varchar(90) NOT NULL,
  `adress_2` varchar(90) NOT NULL,
  `adress_3` varchar(90) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `webbplats` varchar(90) NOT NULL,
  `epost` varchar(90) NOT NULL,
  `bic/swift` varchar(90) NOT NULL,
  `iban` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bet_villkor`
--
ALTER TABLE `bet_villkor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faktura`
--
ALTER TABLE `faktura`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unikt_fakturanummer` (`nr`);

--
-- Indexes for table `fakturapost_1`
--
ALTER TABLE `fakturapost_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakturapost_2`
--
ALTER TABLE `fakturapost_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kund`
--
ALTER TABLE `kund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitt_foretag`
--
ALTER TABLE `mitt_foretag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bet_villkor`
--
ALTER TABLE `bet_villkor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faktura`
--
ALTER TABLE `faktura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakturapost_1`
--
ALTER TABLE `fakturapost_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakturapost_2`
--
ALTER TABLE `fakturapost_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kund`
--
ALTER TABLE `kund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mitt_foretag`
--
ALTER TABLE `mitt_foretag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
