-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2026 at 02:56 PM
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
-- Database: `artgallerydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `bio`) VALUES
(1, 'Vincent van Gogh', 'Dutch painter known for expressive works like Starry Night and many famous art know today'),
(2, 'Eiichiro Oda', 'Japanese manga artist, creator of One Piece, the greatest master piece'),
(3, 'Leonardo da Vinci', 'Renaissance artist and inventor, painted the Mona Lisa'),
(4, 'Gege Akutami', 'Japanese manga artist, creator of Jujutsu Kaisen'),
(5, 'Frida Kahlo', 'Mexican painter known for self portraits and emotional themes');

-- --------------------------------------------------------

--
-- Table structure for table `artworks`
--

CREATE TABLE `artworks` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL,
  `image_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artworks`
--

INSERT INTO `artworks` (`id`, `title`, `artist_id`, `price`, `available`, `image_url`) VALUES
(1, 'Starry Night', 1, 500.00, 0, 'https://wallpaper-house.com/data/out/12/wallpaper2you_533448.jpg'),
(2, 'Monkey D Luffy', 2, 300.00, 1, 'https://i.pinimg.com/originals/37/a3/b5/37a3b5d9cd20c1dc103c19f706cc2e61.jpg'),
(3, 'Mona Lisa', 3, 800.00, 0, 'https://cdn.britannica.com/87/2087-050-8B2A01CD/Mona-Lisa-oil-wood-panel-Leonardo-da.jpg'),
(4, 'Gojo Satoru', 4, 450.00, 1, 'https://i.pinimg.com/originals/64/b9/1b/64b91bb83db91c2cfe8a412dbf81e42d.jpg'),
(5, 'The Two Fridas', 5, 750.00, 1, 'https://uploads4.wikiart.org/images/magdalena-carmen-frieda-kahlo-y-calder%C3%B3n-de-rivera/the-two-fridas-1939.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `exhibitions`
--

CREATE TABLE `exhibitions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exhibitions`
--

INSERT INTO `exhibitions` (`id`, `name`, `date`) VALUES
(1, 'Modern and Anime Expo', '2026-04-01'),
(2, 'Classic Legends', '2026-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `exhibition_artworks`
--

CREATE TABLE `exhibition_artworks` (
  `exhibition_id` int(11) DEFAULT NULL,
  `artwork_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exhibition_artworks`
--

INSERT INTO `exhibition_artworks` (`exhibition_id`, `artwork_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 3),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `artwork_id` int(11) DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `sale_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `artwork_id`, `sale_price`, `sale_date`) VALUES
(1, 1, 550.00, '2026-03-21'),
(2, 3, 850.00, '2026-03-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artworks`
--
ALTER TABLE `artworks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `exhibitions`
--
ALTER TABLE `exhibitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exhibition_artworks`
--
ALTER TABLE `exhibition_artworks`
  ADD KEY `exhibition_id` (`exhibition_id`),
  ADD KEY `artwork_id` (`artwork_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artwork_id` (`artwork_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `artworks`
--
ALTER TABLE `artworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exhibitions`
--
ALTER TABLE `exhibitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artworks`
--
ALTER TABLE `artworks`
  ADD CONSTRAINT `artworks_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);

--
-- Constraints for table `exhibition_artworks`
--
ALTER TABLE `exhibition_artworks`
  ADD CONSTRAINT `exhibition_artworks_ibfk_1` FOREIGN KEY (`exhibition_id`) REFERENCES `exhibitions` (`id`),
  ADD CONSTRAINT `exhibition_artworks_ibfk_2` FOREIGN KEY (`artwork_id`) REFERENCES `artworks` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`artwork_id`) REFERENCES `artworks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
