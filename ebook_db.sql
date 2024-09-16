-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 11:53 AM
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
(70, 'New Book', 'New Author', 'hshjfhwrjrjghrjgke,rtre', 'uploads/9780593342534 1-313x487.jpg', '2024-05-17 16:55:57', 12.00, 'Romantic'),
(71, 'abc', 'abc', 'fvdfgbd', 'uploads/9781804440858 1-313x487.jpg', '2024-08-24 08:00:51', 12.00, 'Science Fictions'),
(72, 'new2', 'new', 'gfgdfdfdf', 'uploads/978014199555777-313x487.jpg', '2024-08-24 08:46:53', 22.00, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `book_id`, `quantity`, `created_at`) VALUES
(66, 1, 70, 1, '2024-08-24 07:54:53'),
(67, 1, 70, 1, '2024-08-24 08:21:26'),
(68, 1, 71, 1, '2024-08-24 08:45:08');

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
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Zayan Ali Khan', 'kzayaan7@gmail.com', 'sdsgesgsehgsd', '2024-05-17 09:54:22'),
(2, 'Hassan Raza', 'kzayan@gmail.com', 'wrgtwergwethg', '2024-05-17 09:55:19'),
(3, 'new', 'kzayaan7@gmail.com', 'k,dnlkehgkenglkegjrlktjgtrlkhg', '2024-06-05 11:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `free_books`
--

CREATE TABLE `free_books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `coverImage` varchar(255) DEFAULT NULL,
  `pdfFile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `free_books`
--

INSERT INTO `free_books` (`id`, `title`, `author`, `description`, `coverImage`, `pdfFile`) VALUES
(7, 'djkjefbwejk', 'njkrkjnrewvn', 'lknvjkevnjkrvrjvf', 'uploads/9780593342534 1-313x487.jpg', 'uploads/Blooming Patals pdf.pdf'),
(8, 'tjtrjrtjtrj', 'jytjjtyjtryjhrtyj', 'ytrhryhtyjtyj', 'uploads/9781780725901 1-313x487.jpg', 'uploads/Zayan Resume.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `flat` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `pin_code` varchar(50) DEFAULT NULL,
  `total_products` varchar(50) DEFAULT NULL,
  `total_price` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `name`, `email`, `method`, `flat`, `street`, `city`, `country`, `pin_code`, `total_products`, `total_price`, `status`, `title`, `author`, `price`, `book_id`) VALUES
(19, 'New order', 'kzayan283@gmail.com', 'cash_on_delivery', '112233', 'streat address', 'Karachi', 'Pakistan', '112233', '1', '32', 'Approved', 'Foot Prints', 'Anonymous', 32.00, 68),
(20, 'Soman Khan', 'sumaankhan112@gmail.com', 'cash_on_delivery', '112233', 'streat address', 'Karachi', 'Pakistan', '112233', '2', '64', 'Approved', 'Foot Prints', 'Anonymous', 32.00, 68),
(21, 'Zayan', 'kzayan283@gmail.com', 'cash_on_delivery', 'gtg45gtgg', 'rgegetg', 'karachi', 'pakistan', '231343', '5', NULL, 'Pending', '<br />\r\n<b>Warning</b>:  Undefined variable $title in <b>C:\\xampp\\htdocs\\dashboard\\ebook_eproject\\user\\checkout.php</b> on line <b>75</b><br />\r\n', '<br />\r\n<b>Warning</b>:  Undefined variable $author in <b>C:\\xampp\\htdocs\\dashboard\\ebook_eproject\\user\\checkout.php</b> on line <b>76</b><br />\r\n', 0.00, 0),
(24, 'Zayan', 'kzayan283@gmail.com', 'cash_on_delivery', 'gtg45gtgg', 'rgegetg', 'karachi', 'pakistan', '231343', '5', '111', 'Approved', '<br />\r\n<b>Warning</b>:  Undefined variable $title in <b>C:\\xampp\\htdocs\\dashboard\\ebook_eproject\\user\\checkout.php</b> on line <b>75</b><br />\r\n', '<br />\r\n<b>Warning</b>:  Undefined variable $author in <b>C:\\xampp\\htdocs\\dashboard\\ebook_eproject\\user\\checkout.php</b> on line <b>76</b><br />\r\n', 0.00, 0),
(25, 'Zayan', 'kzayan283@gmail.com', 'credit_card', 'gtg45gtgg', 'heyeye5', 'karachi', 'pakistan', '231343', '2', '64', 'Approved', '<br />\r\n<b>Warning</b>:  Undefined variable $title in <b>C:\\xampp\\htdocs\\dashboard\\ebook_eproject\\user\\checkout.php</b> on line <b>75</b><br />\r\n', '<br />\r\n<b>Warning</b>:  Undefined variable $author in <b>C:\\xampp\\htdocs\\dashboard\\ebook_eproject\\user\\checkout.php</b> on line <b>76</b><br />\r\n', 0.00, 0),
(26, 'Zayan', 'kzayan283@gmail.com', 'cash_on_delivery', 'gtg45gtgg', 'heyeye5', 'karachi', 'pakistan', '231343', '1', '12', 'Pending', 'N/A', 'N/A', 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `essay` text DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `name`, `email`, `start_time`, `end_time`, `essay`, `score`) VALUES
(3, 'Zayan', 'kzayaan7@gmail.com', '2024-08-24 03:31:59', '2024-08-24 03:49:16', 'Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.', 1037),
(4, 'umar', 'umar@gmail.com', '2024-08-24 03:31:59', '2024-08-24 03:49:53', 'Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.', 1074),
(5, 'maaz', 'admin@gmail.com', '2024-08-24 03:31:59', '2024-08-24 03:55:42', 'Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.Indians give special importance to their festivals. Special arrangements are made for the celebration of various festivals each year. Be it the villages or the big cities there is joy all around. All the places are decked up during the festival season. Some of the main Indian festivals include Diwali, Holi, Raksha Bandhan, Ganesh Chaturthi, Durga Puja, Dussehra, Pongal and Bhai Duj.\r\n\r\nPeople in our country love celebrating the festivals with their near and dear ones. Each Indian festival has its own unique way of celebration and people follow the tradition while celebrating the same. However, some things remain common for instance people decorate their houses with flowers and lights during the festivals and wear new clothes. They visit each other and exchange gifts. Special sweets are prepared at home to treat the guests.\r\n\r\nPeople of India also hold great regard for the National festivals of the country. Gandhi Jayanti, Independence Day and Republic Day are the three national festivals of our country. These festivals are a symbol of unity and progress. They remind us of our patriotic leaders who served the country selflessly. National festivals are celebrated with equal zeal. The entire atmosphere is filled with the feeling of patriotism during these festivals.\r\n\r\nAll in all, Indians celebrate both religious and National festivals with great enthusiasm. Children as well as elders look forward to the festive celebrations.', 1423),
(6, 'Amna', 'admin@gmail.com', '2024-08-24 09:03:44', '2024-08-24 09:12:51', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 547);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `subscribed_at`) VALUES
(1, 'kzayan283@gmail.com', '2024-08-24 02:14:43');

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
(17, 'murtaza', 'murtaza@gmail.com', '$2y$10$qy0yhLRPNJ8BUed/o0SL3uQ15.BR.6gaTC5L4EYWRqO/xh3f6MUcC', 'uploads/IMG_6986.jpg'),
(18, 'zayan', 'kzayan283@gmail.com', '$2y$10$S1AIu/yFjDc/ZfBUtk2lHO7D6NJA8LvWxDFmrZZgc3PBnJ9tLN7im', 'uploads/IMG_6986.jpg'),
(19, 'Ali', 'ali@gmail.com', '$2y$10$iuGIXuVc3WxaEID3oER4q.m6d2yLvQLeA/h1tssaVy.n17ibIAPO6', 'uploads/IMG_6986.jpg'),
(20, 'fahmeed', 'fehmeed@gmail.com', '$2y$10$jtBqlc7nRyuAdUVFvivhOOIuyMHvRoXyFzeOdMdGAiMkMzFb1GErm', 'uploads/IMG_6986.jpg'),
(21, 'wajahat', 'wajahat@gmail.com', '$2y$10$6hUXrN.HUDaQo7mNEZU3wOiN1j4XBc0y5.xUJn9675aQ/CKrgrIyS', 'uploads/IMG_6986.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cart_id_user_id` (`id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `free_books`
--
ALTER TABLE `free_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `free_books`
--
ALTER TABLE `free_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
