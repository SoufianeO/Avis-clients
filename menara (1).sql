-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2018 at 09:26 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menara`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_root` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `prenom`, `email`, `password`, `is_root`) VALUES
(1, 'ounida', 'soufiane', 'soufiane@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(2, 'ahmane', 'hamza', 'hamza@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(3, 'Chebraoui', 'Rabii', 'rabii@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(4, 'Attar', 'Zakaria', 'zakaria@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES
(15, 'Ait Kechkech', 'Rachid', '0811339922', 'ahmed@gmail.com'),
(16, 'SAMIR', 'Chadi', '061234568', 'chadi@gmail.com'),
(18, 'CHAKIR', 'Taha', '0614514542', 'taha@gmail.com'),
(19, 'ounida', 'soufiane', '0680854913', 'soufianeounida17@gmail.com'),
(20, 'ounida', 'soufiane', '0680854913', 'soufianeounida17@gmail.com'),
(21, 'ounida', 'soufiane', '0680854913', 'soufianeounida17@gmail.com'),
(22, 'ounida', 'soufiane', '0680854913', 'soufianeounida17@gmail.com'),
(23, 'babado', 'karim', '0622437085', 'hamza@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `clients_questionnaires`
--

CREATE TABLE `clients_questionnaires` (
  `id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date_reponse` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients_questionnaires`
--

INSERT INTO `clients_questionnaires` (`id`, `questionnaire_id`, `client_id`, `date_reponse`) VALUES
(8, 46, 15, '2018-10-08 06:33:05'),
(9, 46, 16, '2018-10-08 06:33:42'),
(11, 46, 18, '2018-10-08 07:05:31'),
(12, 47, 19, '2018-10-08 14:05:35'),
(13, 47, 20, '2018-10-08 14:50:03'),
(14, 47, 21, '2018-10-08 14:50:49'),
(15, 47, 22, '2018-10-08 15:05:12'),
(16, 48, 23, '2018-10-12 20:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `qsts_statistiques`
--

CREATE TABLE `qsts_statistiques` (
  `id` int(11) NOT NULL,
  `mot_cle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(1) NOT NULL,
  `reponses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsts_statistiques`
--

INSERT INTO `qsts_statistiques` (`id`, `mot_cle`, `type`, `reponses`) VALUES
(1, 'Produit prÃ©fÃ©rÃ©', 2, '[\"ciment\",\"grafitte\",\"platre\"]'),
(2, 'Langages prÃ©fÃ©rÃ©', 3, '[\"PHP\",\"C++\",\"Java\"]'),
(3, 'top city', 2, '[\"marrakech\",\"rabat\",\"casa\"]'),
(4, 'ecole preferee', 2, '[\"ensa\",\"fst\",\"fssm\"]');

-- --------------------------------------------------------

--
-- Table structure for table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questionnaires`
--

INSERT INTO `questionnaires` (`id`, `titre`, `date_creation`, `date_modification`) VALUES
(46, 'QUESTIONNAIRE 1', '2018-10-07 16:49:35', '2018-10-07 16:49:35'),
(47, 'hada', '2018-10-08 14:04:49', '2018-10-08 14:04:49'),
(48, 'question22', '2018-10-12 20:18:06', '2018-10-12 20:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponses` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `qsts_statistiques_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `type`, `question`, `reponses`, `questionnaire_id`, `qsts_statistiques_id`) VALUES
(29, 2, 'pays??', '[\"maroc\",\"tunisie\"]', 46, NULL),
(30, 3, 'Quel est votre langage prÃ©fÃ©rÃ©?', '[\"PHP\",\"C++\",\"Java\"]', 46, 2),
(31, 2, 'Quel est votre produit prÃ©fÃ©rÃ©?', '[\"ciment\",\"grafitte\",\"platre\"]', 46, 1),
(32, 1, 'tu fais quoi?', NULL, 47, NULL),
(33, 2, '', '[\"marrakech\",\"rabat\",\"casa\"]', 47, 3),
(34, 4, 'marakech', NULL, 47, NULL),
(35, 1, 'votre equipe prÃ©fÃ©rÃ©e', NULL, 48, NULL),
(36, 2, 'ecole preferee', '[\"ensa\",\"fst\",\"fssm\"]', 48, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reponses`
--

CREATE TABLE `reponses` (
  `id` int(11) NOT NULL,
  `reponse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `clients_questionnaires_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reponses`
--

INSERT INTO `reponses` (`id`, `reponse`, `question_id`, `client_id`, `clients_questionnaires_id`) VALUES
(33, 'maroc', 29, 15, 8),
(34, '[\"PHP\",\"Java\"]', 30, 15, 8),
(35, 'ciment', 31, 15, 8),
(36, 'tunisie', 29, 16, 9),
(37, '[\"C++\",\"Java\"]', 30, 16, 9),
(38, 'platre', 31, 16, 9),
(42, 'maroc', 29, 18, 11),
(43, '[\"C++\",\"Java\"]', 30, 18, 11),
(44, 'platre', 31, 18, 11),
(45, 'je programme', 32, 19, 12),
(46, 'marrakech', 33, 19, 12),
(47, '4', 34, 19, 12),
(48, 'je programme', 32, 20, 13),
(49, 'rabat', 33, 20, 13),
(50, '5', 34, 20, 13),
(51, 'je programme', 32, 21, 14),
(52, 'marrakech', 33, 21, 14),
(53, '5', 34, 21, 14),
(54, 'surfer', 32, 22, 15),
(55, 'casa', 33, 22, 15),
(56, '5', 34, 22, 15),
(57, 'RCA', 35, 23, 16),
(58, 'ensa', 36, 23, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_questionnaires`
--
ALTER TABLE `clients_questionnaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `qsts_statistiques`
--
ALTER TABLE `qsts_statistiques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`),
  ADD KEY `qsts_statistiques_id` (`qsts_statistiques_id`);

--
-- Indexes for table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `clients_questionnaires_id` (`clients_questionnaires_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `clients_questionnaires`
--
ALTER TABLE `clients_questionnaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `qsts_statistiques`
--
ALTER TABLE `qsts_statistiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients_questionnaires`
--
ALTER TABLE `clients_questionnaires`
  ADD CONSTRAINT `clients_questionnaires_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaires` (`id`),
  ADD CONSTRAINT `clients_questionnaires_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaires` (`id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`qsts_statistiques_id`) REFERENCES `qsts_statistiques` (`id`);

--
-- Constraints for table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `reponses_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `reponses_ibfk_3` FOREIGN KEY (`clients_questionnaires_id`) REFERENCES `clients_questionnaires` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
