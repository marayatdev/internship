-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 05:29 AM
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
-- Database: `internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(0, 'Apple', '356a192b7913b04c54574d18c28d46e6395428ab');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `av` varchar(255) NOT NULL,
  `name` varchar(500) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `s_intern` varchar(255) NOT NULL,
  `e_intern` varchar(255) NOT NULL,
  `f_amount` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `request` varchar(255) NOT NULL,
  `n_company` varchar(255) NOT NULL,
  `mentor` varchar(255) NOT NULL,
  `department` varchar(500) NOT NULL,
  `c_tel` varchar(500) NOT NULL,
  `address` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `style` varchar(255) NOT NULL,
  `residence` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `myDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `username`, `prefix`, `av`, `name`, `branch`, `tel`, `year`, `s_intern`, `e_intern`, `f_amount`, `f_name`, `request`, `n_company`, `mentor`, `department`, `c_tel`, `address`, `position`, `style`, `residence`, `note`, `dateTime`, `myDate`) VALUES
(25, '63131000', 'นาย', 'อว 8619(พบ)/398', 'yanha kawasaki', 'สาขาวิชาเทคโนโลยีดิจิทัลเพื่อธุรกิจ', '0649894868', '2566', '2024-01-09', '2024-01-19', '1', '1', '1', 'ธนาคารกสิกรไทย จำกัด เป็นธนาคารในประเทศไทย', 'Mr.Jonh Wick', 'software engineer ', '0649894868', 'Bangkok', 'Dev', 'Onsite', 'เช่าหอพัก', '', '2024-01-15 14:35:19', '2024-01-16'),
(30, 'Jengs', 'นาย', ' ', 'กุ่ย ลุยทุ่งนา', 'สาขาวิชาเทคโนโลยีดิจิทัลเพื่อการออกแบบแอปพลิเคชั่น', '0649894868', '2567', '2024-01-13', '2024-02-17', '1', '1', '1', 'บริษัท เจริญโภคภัณฑ์อาหาร จำกัด (มหาชน) (CPF)', 'Mr.Jonh Wick', 'software engineer ', '0649894868', 'Bangkok', 'Dev', 'Online', 'เช่าหอพัก', ' ', '2024-01-15 06:32:43', '2024-01-11'),
(31, 'test', 'นาย', '', 'ชวลิต มารยาท', 'สาขาวิชาเทคโนโลยีดิจิทัลเพื่อธุรกิจ', '0649894868', '2567', '2024-01-26', '2024-02-01', '1', '        1', '1', 'ธนาคารกสิกรไทย จำกัด เป็นธนาคารในประเทศไทย', 'Mr.Jonh Wick', 'software engineer ', '0649894868', 'Bangkok', 'Dev', 'Online', 'เช่าหอพัก', '', '2024-01-15 14:10:46', '2024-01-13'),
(33, '631310030', 'นาย', 'อว 8619(พบ)/398', 'Tony Satrk', 'สาขาวิชาเทคโนโลยีดิจิทัลเพื่อการออกแบบอนิเมชั่น', '0649894868', '2566', '2024-02-01', '2024-02-03', '1', '1', '1', 'ธนาคารกสิกรไทย จำกัด เป็นธนาคารในประเทศไทย', 'Mr.Jonh Wick', 'software engineer ', '0649894868', 'Bangkok', 'Dev', 'Online และ Onsite', 'เช่าหอพัก', '', '2024-01-14 14:41:04', '2024-01-15'),
(35, '631310025', 'นาย', '', 'ชวลิต มารยาท', 'สาขาวิชาเทคโนโลยีดิจิทัลเพื่อธุรกิจ', '0649894868', '2567', '2024-03-17', '2024-04-06', '1', '1.', '1', 'ธนาคารกสิกรไทย จำกัด เป็นธนาคารในประเทศไทย', 'Mr.Jonh Wick', 'software engineer ', '0649894868', 'Central Wo', 'Dev', 'Onsite', 'เช่าหอพัก', '', '2024-03-17 06:30:49', '2024-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `status`, `role`) VALUES
('0000', 'helloworld@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', ''),
('000000000', '0@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', ''),
('63131000', 'test02@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'success', ''),
('6313100000', 'hi@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', ''),
('631310024', 'HelloTest@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', ''),
('631310025', 'test@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', 'pending', ''),
('631310030', 'hi@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', 'success', ''),
('636300007', 'bam@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', ''),
('admin', 'admin@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', 'admin'),
('Jengs', 'chawalit_marayat@hotmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'success', ''),
('test', 'marayat.dev@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'success', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
