-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 11:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoratings`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id` int(15) NOT NULL,
  `pubAvis` varchar(255) NOT NULL,
  `titreAvis` varchar(30) NOT NULL,
  `dateAvis` date NOT NULL,
  `id_restau` int(12) NOT NULL,
  `iduser` int(12) NOT NULL,
  `nbvue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id`, `pubAvis`, `titreAvis`, `dateAvis`, `id_restau`, `iduser`, `nbvue`) VALUES
(167, 'eds', 'r', '2023-11-22', 3, 1, 6),
(168, 'eds', 'r', '2023-11-22', 3, 1, 6),
(169, 'eds', 'r', '2023-11-22', 3, 1, 6),
(170, 'eds', 'zed', '2023-11-24', 6, 1, 5),
(171, 'eds\"es', 'zed', '2023-11-24', 3, 44, 0),
(173, 'eds\"es', 'rap', '2023-11-24', 3, 33, 0),
(174, 'eds', 'fr', '2023-11-24', 3, 1, 5),
(175, 'eds', 'fr', '2023-11-24', 3, 1, 0),
(176, 'eds', 'fr', '2023-11-24', 3, 1, 2),
(177, 'J\'ai récemment visité le restaurant Le Délice. L\'ambiance était chaleureuse et accueillante. Le service était excellent, le personnel était très attentionné. J\'ai commandé le plat de pâtes et c\'était délicieux. Les saveurs étaient bien équilibrées et les', 'zed', '2023-11-24', 3, 1, 0),
(178, 'uj', 'ytgh', '2023-11-24', 3, 1, 5),
(179, 'J\'ai récemment visité le restaurant Le Délice. L\'ambianreuse et accueillante. Le service était excellent, le personnel était très attentionné. J\'ai commandé le plat de pâtes et c\'était délicieux. Les saveurs étaient bien équilibrées et les', 's', '2023-11-25', 6, 53, 0),
(180, 'zer', 'efc', '2023-11-28', 3, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `id_resto` (`id_restau`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_restau`) REFERENCES `restaurant` (`id_restau`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
