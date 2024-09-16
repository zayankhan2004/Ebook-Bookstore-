-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 01:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(50) NOT NULL,
  `userpassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `userpassword`) VALUES
('admin', 'xyz@123#');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `coverImageUrl` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,2) DEFAULT NULL,
  `categories` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `coverImageUrl`, `created_at`, `price`, `categories`) VALUES
(61, 'Expected Goals', 'Rory Smith', 'Expected Goals charts his remarkable journey into the heart of the modern game and reveals how clubs across the world, from Liverpool to Leipzig and Brentford to Bayern Munich, began to see how data could help them unearth new players, define radical tactics and plot their path to glory.', 'uploads/9780008484071-313x487.jpg', '2024-05-14 19:18:40', 42.00, 'Biography'),
(64, 'Mark Colvin Light And Shadows', 'Tony Jones', 'Light and Shadow is the incredible story of a father waging a secret war against communism during the Cold War, while his son comes of age as a journalist and embarks on the risky career of a foreign correspondent.', 'uploads/9780522872590 1-313x487.jpg', '2024-05-14 19:35:44', 16.00, 'Crime Stories'),
(66, 'Queen Of Shadows', 'Sarah J. Maas', 'In Queen of Shadows by Sarah J. Maas, we find Aelin Galathynius, the once infamous assassin Celaena Sardothien, returning to Adarlan to seek vengeance against the people who wronged her. She is determined to reclaim her throne and free her people from the tyrannical rule of the King of Adarlan.', 'uploads/9781408858615-313x487.jpg', '2024-05-15 06:02:33', 12.00, 'Non Fictions'),
(67, 'Putting Out Of Your Mind', 'Dr. Rod Rotella', 'In Putting Out of Your Mind, Rotella offers entertaining and instructive insight into the key element of a winning game—great putting. He here reveals the unique mental approach that great putting requires and helps golfers of all levels master this essential skill.', 'uploads/9781416501992 1-313x487.jpg', '2024-05-15 06:08:07', 23.00, 'Poem And Folks'),
(68, 'Foot Prints', 'Anonymous', 'Footprints,\" also known as \"Footprints in the Sand,\" is a popular modern allegorical Christian poem. It describes a person who sees two pairs of footprints in the sand, one of which belonged to God and another to themselves. At some points the two pairs of footprints dwindle to one; it is explained that this is where God carried the protagonist.', 'uploads/9789350368565 1-313x487.jpg', '2024-05-15 06:11:48', 32.00, 'Non Fictions'),
(69, 'trhrj', 'ytjytj', 'djhmdthmd', 'uploads/97803853133155555-313x487.jpg', '2024-05-15 06:51:32', 35.00, 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `comment`, `created_at`) VALUES
(1, 'Zayan Ali Khan', 'first comment', '2024-04-19 13:17:17'),
(2, 'Mujtuba', 'Cdkjbhkjdbvjkbwkjvbjksbvkjwbkvkjsbvjkbsd', '2024-04-19 19:43:15'),
(3, 'Zayan Ali Khan', 'ckvgbfkjvbkjvbjkbvbjkrvbkjbkjvb', '2024-04-19 19:53:07'),
(4, 'Zayan Ali Khan', 'gtdhryujerur6u', '2024-05-13 11:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `essay_entries`
--

CREATE TABLE `essay_entries` (
  `entry_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `essay_content` text DEFAULT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_finalized` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `essay_entries`
--

INSERT INTO `essay_entries` (`entry_id`, `user_id`, `essay_content`, `submission_time`, `is_finalized`) VALUES
(1, NULL, 'vfbsrhndgjtyjytjrtykj', '2024-05-15 11:41:30', 1),
(2, NULL, 'dfhbtrjyejyj', '2024-05-15 11:42:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `free_books`
--

CREATE TABLE `free_books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `coverImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`) VALUES
(1, 'kzayaan7@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT 'default_profile_picture.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_picture`) VALUES
(10, 'Zayan', 'kzayan284@gmail.com', '$2y$10$5FRRiVMHQwSQuGyzLc60lOAKeEZf6.nmMdvxYTMgEBiSWompfa.la', 'uploads/IMG_6986.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essay_entries`
--
ALTER TABLE `essay_entries`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `free_books`
--
ALTER TABLE `free_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `essay_entries`
--
ALTER TABLE `essay_entries`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `free_books`
--
ALTER TABLE `free_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
