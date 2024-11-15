-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 01:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citizens`
--

-- --------------------------------------------------------

--
-- Table structure for table `canceled`
--

CREATE TABLE `canceled` (
  `id` int(11) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `poster` binary(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_events`
--

CREATE TABLE `cancelled_events` (
  `id` int(11) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `tickets_bought` int(11) NOT NULL DEFAULT 0,
  `poster` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cancelled_events`
--

INSERT INTO `cancelled_events` (`id`, `event`, `date`, `time`, `venue`, `seats`, `price`, `description`, `tickets_bought`, `poster`) VALUES
(30, 'Spirit filled', '2024-09-03', '14:00:00', 'citizens', 350, 6000, 'Join us for a powerful evening of prayer as we come together to lift up our hearts and voices to God. This event will be a time of reflection, worship, and intercession as we seek God\'s guidance, strength, and blessings for ourselves, our community, and our world. Whether you are new to prayer or a seasoned prayer warrior, all are welcome to join us in this sacred time of connection with the divine. Let us come together in unity and faith, believing that our prayers have the power to bring about transformation and healing in our lives and in the world around us.', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `tickets_bought` int(11) NOT NULL DEFAULT 0,
  `poster` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event`, `date`, `time`, `venue`, `seats`, `price`, `description`, `tickets_bought`, `poster`) VALUES
(28, 'Art Gala', '2024-03-28', '09:45:00', 'citizens', 300, 3500, 'Join us for a night of creativity and talent at the Art Gala hosted by Malawi\'s very own young artist. The event will showcase a variety of artworks including paintings, sculptures, and mixed media pieces created by local artists. Enjoy live music, delicious food, and the opportunity to purchase unique pieces to support the thriving art community in Malawi. Don\'t miss this exciting celebration of art and culture!', 0, 0x6c616e64696e67706167652d62616e6e6572322e6a7067),
(29, 'Night Of Player', '2024-04-16', '22:52:00', 'citizens', 500, 5000, 'Night of player description', 2, 0x6368757263682d7072617965722d6e696768742d666c7965722d696e7669746174696f6e2d64657369676e2d74656d706c6174652d36323332356666363364373565323065333831663563616463646136376163645f73637265656e2e6a7067),
(31, 'Noelle Macdonald', '2024-09-14', '01:31:00', 'citizens', 63, 673, 'An eating contest is a competitive event in which participants compete to see who can consume the most food in a specific amount of time. These contests can range from eating hot dogs and pies to spicy foods and other challenging dishes. Contestants often have to eat quickly and strategically to outperform their opponents and win the competition. Eating contests can be entertaining to watch and can draw large crowds of spectators. Participants may train and prepare for these events by practicing their eating techniques and expanding their stomach capacity. Overall, eating contests are a fun and exciting way for food enthusiasts to showcase their skills and test their limits.', 0, 0x6865616c7468792d656174696e672d666c7965722d64657369676e2d74656d706c6174652d66313037343365323937616232313834313966323731633861396362646438395f73637265656e2e6a7067),
(32, 'Maso Awards', '2024-07-23', '00:55:00', 'citizens', 35, 766, 'Maso Music awardsThe Maso Music awards ceremony will be held on December 15th at the prestigious Grand Theatre. Get ready for a night of glitz, glamour, and of course, incredible performances from some of the biggest names in the industry. Stay tuned for more updates on the nominees and special guests that will be gracing the red carpet. It\'s sure to be a night to remember!', 0, 0x6f6172322e6a7067),
(33, 'Football match', '2024-06-14', '15:15:00', 'citizens', 2000, 10000, 'football between Bullets and Silver stikersThe match was intense from the start, with both teams showing off their skills on the field. The Bullets took an early lead with a goal in the first half, but the Silver Stikers quickly equalized before halftime. The second half saw both teams pushing hard for the win, with chances on both ends of the pitch. In the end, the Bullets managed to secure a late goal, clinching the victory in a thrilling 2-1 match.', 0, 0x31343430323233342e6a7067),
(34, 'Football match', '2024-03-28', '16:30:00', 'citizens', 3500, 13000, 'Malawi vs NigeriaNigeria emerged victorious with a 2-0 win over Malawi in a thrilling match that showcased their skill and determination. The Nigerian team displayed excellent teamwork and strategy, securing their place in the next round of the competition. Despite a valiant effort from Malawi, they were unable to break through Nigeria\'s solid defense. Nigeria\'s goals came from well-executed plays that left the Malawian defense scrambling to keep up. Overall, it was a well-deserved win for Nigeria, who now look forward to their next challenge in the tournament.', 1, 0x63316530366636363632613961636230396463636432636535666637623562362e6a7067),
(35, 'Business Insight', '2025-11-28', '07:11:00', 'citizens', 66, 0, 'Business lecture with guest lectureThe guest lecturer began by sharing real-life examples of successful business strategies implemented by companies in various industries. She emphasized the importance of adaptability and innovation in today\'s rapidly changing business landscape. The audience was engaged and inspired by her insights, and many took notes eagerly. As the lecture continued, she delved into the topic of digital marketing and the power of social media in reaching and engaging with customers. The guest lecturer\'s expertise and passion for the subject shone through, leaving a lasting impact on the audience.', 0, 0x3432313835343539375f3735313534313935303334323630355f343039323439363130333333303334303537345f6e2e6a7067),
(36, 'Test', '2025-09-17', '19:04:00', 'citizens', 41, 381, 'This is s test entry.', 0, NULL),
(38, 'Business Insight', '2025-11-28', '07:11:00', 'citizens', 66, 0, 'Business lecture with guest lectureThe guest lecturer began by sharing real-life examples of successful business strategies implemented by companies in various industries. She emphasized the importance of adaptability and innovation in today\'s rapidly changing business landscape. The audience was engaged and inspired by her insights, and many took notes eagerly. As the lecture continued, she delved into the topic of digital marketing and the power of social media in reaching and engaging with customers. The guest lecturer\'s expertise and passion for the subject shone through, leaving a lasting impact on the audience.', 0, NULL),
(39, 'Test 1', '2024-09-24', '14:16:00', 'citizens', 22, 0, 'Illum consequatur ', 0, 0x64656661756c745f696d6167652e706e67),
(40, 'Test 2', '2025-06-08', '14:02:00', 'citizens', 42, 92, 'Debitis ab veniam q', 0, 0x64656661756c745f696d6167652e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `stakeholder_cancelled_stake`
--

CREATE TABLE `stakeholder_cancelled_stake` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `tickets_bought` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stakeholder_cancelled_stake`
--

INSERT INTO `stakeholder_cancelled_stake` (`id`, `name`, `event`, `date`, `time`, `venue`, `seats`, `price`, `description`, `tickets_bought`) VALUES
(28, 'stakeholder', 'Spirit filled', '2024-09-03', '14:00:00', 'citizens', 350, 6000, 'Join us for a powerful evening of prayer as we come together to lift up our hearts and voices to God. This event will be a time of reflection, worship, and intercession as we seek God\'s guidance, strength, and blessings for ourselves, our community, and our world. Whether you are new to prayer or a seasoned prayer warrior, all are welcome to join us in this sacred time of connection with the divine. Let us come together in unity and faith, believing that our prayers have the power to bring about transformation and healing in our lives and in the world around us.', 0),
(29, 'stakeholder1', 'Spirit filled', '2024-09-03', '14:00:00', 'citizens', 350, 6000, 'Join us for a powerful evening of prayer as we come together to lift up our hearts and voices to God. This event will be a time of reflection, worship, and intercession as we seek God\'s guidance, strength, and blessings for ourselves, our community, and our world. Whether you are new to prayer or a seasoned prayer warrior, all are welcome to join us in this sacred time of connection with the divine. Let us come together in unity and faith, believing that our prayers have the power to bring about transformation and healing in our lives and in the world around us.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stakeholder_stake`
--

CREATE TABLE `stakeholder_stake` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stakeholder_stake`
--

INSERT INTO `stakeholder_stake` (`id`, `name`, `event`) VALUES
(25, 'stakeholder', 'Art Gala'),
(26, 'stakeholder', 'Night Of Player'),
(28, 'stakeholder', 'Noelle Macdonald'),
(29, 'stakeholder', 'Maso Awards'),
(30, 'stakeholder', 'Football match'),
(32, 'stakeholder1', 'Art Gala'),
(33, 'stakeholder1', 'Night Of Player');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `ticket_number` varchar(50) NOT NULL,
  `ticket_code` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `ticket_status` varchar(50) NOT NULL DEFAULT 'open',
  `payment_method` varchar(50) NOT NULL,
  `reference_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_number`, `ticket_code`, `event`, `date`, `ticket_status`, `payment_method`, `reference_code`) VALUES
(48, 'Ticket_1', '4474-3712-5300-3867 ', 'Spirit filled', '2024-09-03', 'open', 'Airtel Money', '36U6TR67'),
(49, 'Ticket_2', '6305-5448-7700-8879 ', 'Spirit filled', '2024-09-03', 'open', 'Tnm Mpamba', '6y6y36y56u'),
(50, 'Ticket_1', '8266-8188-8055-2308 ', 'Night Of Player', '2024-04-16', 'open', 'Airtel Money', '90P790'),
(51, 'Ticket_2', '3727-9393-1124-4076 ', 'Night Of Player', '2024-04-16', 'open', 'Airtel Money', '9P68P'),
(52, 'Ticket_1', '2804-1153-1472-9657 ', 'Football match', '2024-03-28', 'open', 'Airtel Money', '90P790060');

-- --------------------------------------------------------

--
-- Table structure for table `try`
--

CREATE TABLE `try` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `try`
--

INSERT INTO `try` (`id`, `name`, `age`) VALUES
(1, 'tunant', 21);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin', 'admin'),
(3, 'steward@gmail.com', 'steward', 'steward', 'steward'),
(4, 'stakeholder@gmail.com', 'stakeholder', 'stakeholder', 'stakeholder'),
(5, 'stakeholder1@gmail.com', 'stakeholder1', 'stakeholder1', 'stakeholder'),
(6, 'stakeholder2@gmail.com', 'stakeholder2', 'stakeholder2', 'stakeholder');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canceled`
--
ALTER TABLE `canceled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancelled_events`
--
ALTER TABLE `cancelled_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stakeholder_cancelled_stake`
--
ALTER TABLE `stakeholder_cancelled_stake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stakeholder_stake`
--
ALTER TABLE `stakeholder_stake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `try`
--
ALTER TABLE `try`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canceled`
--
ALTER TABLE `canceled`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cancelled_events`
--
ALTER TABLE `cancelled_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `stakeholder_cancelled_stake`
--
ALTER TABLE `stakeholder_cancelled_stake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `stakeholder_stake`
--
ALTER TABLE `stakeholder_stake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `try`
--
ALTER TABLE `try`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
