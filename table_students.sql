-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 07:16 AM
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
-- Database: `qlsv_nguyenvanloi`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_students`
--

CREATE TABLE `table_students` (
  `id` int(50) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `gender` int(10) NOT NULL,
  `hometown` varchar(250) NOT NULL,
  `level` int(11) NOT NULL,
  `groups` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_students`
--

INSERT INTO `table_students` (`id`, `fullname`, `dob`, `gender`, `hometown`, `level`, `groups`) VALUES
(1, 'Nguyễn Văn Lợi', '2005-09-07', 1, 'Hà Nam', 3, 9),
(2, 'Nguyễn Văn Bằng', '2005-09-07', 1, 'Hà Nam', 2, 9),
(3, 'Nguyễn Viết Khôi', '2005-09-07', 1, 'Hà Nam', 2, 9),
(4, 'Nguyễn Hữu Huy', '2005-09-07', 1, 'Hà Nam', 2, 9),
(5, 'Giáp Ngọc Duy Anh', '2005-09-07', 1, 'Hà Nam', 2, 9),
(6, 'Trương Minh Sơn', '2005-09-07', 1, 'Hà Nam', 2, 9),
(7, 'Nguyễn Ngọc Phước', '2005-09-07', 1, 'Hà Nam', 2, 9),
(0, 'Nguyễn Văn A', '2024-12-13', 0, 'Hòa Bình', 0, 9),
(0, 'snh s', '2024-12-12', 0, 'Hòa Bình', 0, 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
