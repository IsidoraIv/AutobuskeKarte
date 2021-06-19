-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2021 at 11:12 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buskarte`
--

-- --------------------------------------------------------

--
-- Table structure for table `autobuskastanica`
--

CREATE TABLE `autobuskastanica` (
  `id` int(11) NOT NULL,
  `naziv` varchar(40) NOT NULL,
  `grad` varchar(40) NOT NULL,
  `drzava` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `autobuskastanica`
--

INSERT INTO `autobuskastanica` (`id`, `naziv`, `grad`, `drzava`) VALUES
(1, 'Autobuska stanica 1', 'Cacak', 'Srbija'),
(2, 'BAS', 'Beograd', 'Srbija'),
(13, 'Stanica1', 'Kraljevo', 'Srbija'),
(14, 'Stanica2', 'Kragujevac', 'Srbija'),
(15, 'Stanica3', 'Loznica', 'Srbija'),
(16, 'Stanica4', 'Negotin', 'Srbija'),
(17, 'Stanica5', 'Nis', 'Srbija'),
(21, 'Stanica10', 'Atenica', 'Srbija');

-- --------------------------------------------------------

--
-- Table structure for table `linija`
--

CREATE TABLE `linija` (
  `id` int(11) NOT NULL,
  `autoprevoznik` varchar(30) NOT NULL,
  `polazak_at` int(11) NOT NULL,
  `dolazak_at` int(11) DEFAULT NULL,
  `pocetna_destinacija` int(11) NOT NULL,
  `krajnja_destinacija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `linija`
--

INSERT INTO `linija` (`id`, `autoprevoznik`, `polazak_at`, `dolazak_at`, `pocetna_destinacija`, `krajnja_destinacija`) VALUES
(48, 'Lasta', 1611515520, 1611519120, 1, 13),
(50, 'Lasta', 1611519120, 1611564540, 15, 14),
(54, 'Lasta', 1611481440, 1611564540, 2, 14),
(55, 'Lasta', 1611481440, 1611519120, 2, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autobuskastanica`
--
ALTER TABLE `autobuskastanica`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `linija`
--
ALTER TABLE `linija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `let_ibfk_1` (`pocetna_destinacija`),
  ADD KEY `let_ibfk_2` (`krajnja_destinacija`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autobuskastanica`
--
ALTER TABLE `autobuskastanica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `linija`
--
ALTER TABLE `linija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `linija`
--
ALTER TABLE `linija`
  ADD CONSTRAINT `linija_ibfk_1` FOREIGN KEY (`pocetna_destinacija`) REFERENCES `autobuskastanica` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `linija_ibfk_2` FOREIGN KEY (`krajnja_destinacija`) REFERENCES `autobuskastanica` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
