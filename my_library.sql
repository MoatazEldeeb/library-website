-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 09:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `borrowed_by` int(11) NOT NULL,
  `borrowDate` varchar(255) NOT NULL,
  `returnDate` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `category`, `description`, `cover`, `borrowed_by`, `borrowDate`, `returnDate`, `created_at`) VALUES
(1, 'A Song Of Ice And Fire', 'George R R Martin', 'Fantasy, Medieval', 'A Song of Ice and Fire is set primarily in the fictional Seven Kingdoms of Westeros, a large, South American-sized continent with an ancient history stretching back some twelve thousand years. A detailed history reveals how seven kingdoms came to dominate this continent, and then how these seven nations were united as one by Aegon the Conqueror, of House Targaryen.', 'images/asongoficeandfire.jpg', 5, '2022-06-20', '2022-06-27', '2022-03-22 17:00:21'),
(2, 'Rich Dad Poor Dad', 'Robert Kiyosaki', 'Business', 'Rich Dad Poor Dad is a 1997 book written by Robert T. Kiyosaki and Sharon Lechter. It advocates the importance of financial literacy, financial independence and building wealth through investing in assets, real estate investing, starting and owning businesses, as well as increasing one\'s financial intelligence.', 'https://images-na.ssl-images-amazon.com/images/I/51u8ZRDCVoL._SX330_BO1,204,203,200_.jpg', 0, '2022-05-15', '2022-05-22', '2022-03-23 11:38:20'),
(33, 'The Alchemist', 'Paulo Coelho', 'Novel', 'The Alchemist is the magical story of Santiago, an Andalusian shepherd boy who yearns to travel in search of a worldly treasure as extravagant as any ever found. From his home in Spain he journeys to the markets of Tangiers and across the Egyptian desert to a fateful encounter with the alchemist.', 'https://booksy.lk/wp-content/uploads/2022/01/The-Alchemist-1.jpeg', 0, '20220512', '20220519', '2022-03-23 19:18:30'),
(34, '12 Rules for Life', 'Jordan Peterson', 'Self-help', '12 Rules For Life is a stern, story-based, and entertaining self-help manual for young people that lays out a set of simple principles that can help us become more disciplined, behave better, act with integrity, and balance our lives while enjoying them as much as we can.', 'https://diwanegypt.com/wp-content/uploads/2020/08/9780141988511.jpg', 0, '2022-05-15', '2022-05-22', '2022-05-12 11:05:25'),
(35, 'The Lord of the Rings', 'J. R. R. Tolkien', 'Fantasy', 'The Lord of the Rings is an epic high-fantasy novel by English author and scholar J. R. R. Tolkien. Set in Middle-earth, intended to be Earth at some distant time in the past, the story began as a sequel to Tolkien\'s 1937 children\'s book The Hobbit, but eventually developed into a much larger work.', 'https://images-na.ssl-images-amazon.com/images/I/81zqkBcTTCL.jpg', 0, '', '', '2022-06-20 18:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `firstName`, `lastName`, `email`, `pass`, `isAdmin`) VALUES
(1, 'Moataz', 'Eldeeb', 'moatazdx1@gmail.com', '11111111', 1),
(4, 'Ahmed', 'Mohamed', 'ahmed123@gmail.com', '22222222', 0),
(5, 'Mohamed', 'fathy', 'mohamed123@gmail.com', '77777777', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
