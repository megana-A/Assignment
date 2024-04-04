-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 07:35 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(100) NOT NULL,
  `author_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(1, 'Harper Lea'),
(2, 'George Orwell'),
(3, 'J.R.R.Tolkien'),
(4, 'J.K.Rowling'),
(5, 'F.Scott Fitzgerald');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ISBN` varchar(100) NOT NULL,
  `book_id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `published_year` int(11) NOT NULL,
  `category_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `Availability` varchar(100) NOT NULL,
  `total_qty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `book_id`, `title`, `published_year`, `category_id`, `quantity`, `Availability`, `total_qty`) VALUES
('978-0061120084', 1, 'To kill a Mockingbird', 1960, 1, 4, 'Available', 5),
('978-0142437209', 2, '1984', 1949, 1, 9, 'Available', 10),
('978-0544003415', 3, 'The Hobbit', 1937, 2, 5, 'Not Available', 7),
('978-0439358071', 4, 'Harry potter and the Goblet', 2000, 3, 6, 'Available', 8),
('978-0062315007', 5, 'The Great Gatsby', 1925, 1, 3, 'Available', 6);

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

CREATE TABLE `book_authors` (
  `author_id` int(100) NOT NULL,
  `book_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_authors`
--

INSERT INTO `book_authors` (`author_id`, `book_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `borrower_id` int(11) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `borrower_age` int(100) NOT NULL,
  `borrower_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`borrower_id`, `borrower_name`, `borrower_age`, `borrower_address`) VALUES
(100, 'Megana Ariyarathna', 22, 'Negombo'),
(101, 'Kavishka Maduranga', 22, 'Mahabage'),
(102, 'Chathura Theekshana', 14, 'Negombo'),
(103, 'Navodya Divyanjalee', 21, 'Katana'),
(104, 'Sameera Jayakody', 21, 'Marawila'),
(105, 'Thrilani silva', 46, 'Minuwangoda');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_history`
--

CREATE TABLE `borrowing_history` (
  `borrowing_id` int(100) NOT NULL,
  `book_id` int(100) NOT NULL,
  `borrower_id` int(100) NOT NULL,
  `borrower_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowing_history`
--

INSERT INTO `borrowing_history` (`borrowing_id`, `book_id`, `borrower_id`, `borrower_date`, `return_date`) VALUES
(1, 1, 101, '2024-04-01', '2024-04-15'),
(2, 2, 102, '2024-04-02', '2024-04-09'),
(3, 3, 103, '2024-04-03', '2024-04-16'),
(4, 4, 105, '2024-04-04', '2024-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_name` varchar(100) NOT NULL,
  `category_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_name`, `category_id`) VALUES
('Fiction', 1),
('Fantasy', 2),
('Mystery', 3),
('Scientific', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', '$2y$10$a7azgPLN3QO44dm8c3Tk.eLiKIVYSKsrUAalYij5Q//StguFaJA9W'),
('admin', '$2y$10$7NATUA4IK4IUQRrKQ6xCeelGbBe0MXWrsDVLM/S5lnBigMqQdaMjO'),
('admin', '$2y$10$j3tYpNdTWb00IE7de72phetXfN/.cuO0aGTmmFVHaJoU4sBPp0Mbm'),
('admin', '$2y$10$J747wXdhAAK8SzAYIXFmwecrDVU6C4Se8uTm1V7cRFCNN4Db5bFmG'),
('admin', '$2y$10$mkB7f9Cw8IkUcpzOZUjADOaR0WwxOnfcM2HaR6752S3TEIQ59VKCS'),
('qwe', '$2y$10$Tja1GiCIP3uG4M75MNIHh.B4sqQHc1WgZrNy6VpqCyoyCl8OHrZa.'),
('qwe', '$2y$10$JOcYsw35VgzeRL3pciEB0eMRkmz70oU8sb1Bg74l92Mqfas.w2PAm'),
('admin', '$2y$10$HDurtwvQdOJVn/s/szM1y.8bTNRzi2oZX1cyFh8P9.eQ/vU0yxnBq'),
('admin', '$2y$10$BR1jEFJH1rvuSdw.RwaHVehXNxfw/78dIvwlldojh4u5mGJ5XTOA2'),
('admin', '$2y$10$S0O.Gjta1a4Y1qxrsuJ6A.0KKjKFlsSHKeV2HUMHPztp6.dDmoYra'),
('hii', '$2y$10$nvAYh3Y.WkHlsiiOJyoXJO/NwKtm5OEEH1.oxQPvwvPPGHDi60r7a'),
('Kavindu', '$2y$10$UCdGmQ4Wlymp9q5gRcuceOtSE8J53RX/COA1xVuMYFBPbLLVwEuly'),
('adminlib', '$2y$10$5ZxMQwr4lOUq7xPSgt39DuVpMi8OvBc.xtOm6w0B6/Bk.jAqU6dKi'),
('adminlib', '$2y$10$zQA6kPwt2nXzfmocJYKRDewNoA5oOO2X5NLFuSkU0GDti/aeQwV1W'),
('navodya', '$2y$10$.FP9g/yy8JgAjzeYRrsr6uohyRyPyXwwBMLQy1OwavRBrPk2JplT.'),
('', '$2y$10$k0c6sJb7X5i3RZ/acawaCu7AnVa0s9ZmCLCfLYRFp/zY3Ra3uphca'),
('', '$2y$10$3hln/7yKjrfNKa/63r8BlOqNxCR5Ss9mBcfFeq9y1y1XkmI66fCTq'),
('admin_library', '$2y$10$4yeJtO1.A0DywZaSA8EQ1OEjmxB7K8c727tQ9QZDesRaK6LS50tly'),
('admin_library', '$2y$10$WC2ggigZsOCSMYaGcC8F4eDwggN3FtzYhZC/XVv1sjthm0eI.GljG'),
('library', '$2y$10$12acn.4jzKoh5O5TEDKaIefVbEhWPIEJnSo5/MOUN5lgBtc4tI0pe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD KEY `author_id` (`author_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD KEY `borrower_id` (`borrower_id`);

--
-- Indexes for table `borrowing_history`
--
ALTER TABLE `borrowing_history`
  ADD PRIMARY KEY (`borrowing_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `borrower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `borrowing_history`
--
ALTER TABLE `borrowing_history`
  MODIFY `borrowing_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `book_authors_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `book_authors_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `borrowing_history`
--
ALTER TABLE `borrowing_history`
  ADD CONSTRAINT `borrowing_history_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
