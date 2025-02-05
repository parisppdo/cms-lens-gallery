-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 01:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms-lens-gallery`
--
CREATE DATABASE IF NOT EXISTS `cms-lens-gallery` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cms-lens-gallery`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(87, 126, 'Bill', 'bill@mail.com', 'Really like the capture!', 'approved', '2025-01-22'),
(88, 124, 'Hank', 'hank@mail.com', 'Nice use of the out of focus!', 'approved', '2025-01-22'),
(89, 121, 'Anna', 'anna@mail.com', 'Very nice!', 'approved', '2025-01-22'),
(90, 121, 'John', 'john@mail.com', 'Cool photo!', 'approved', '2025-01-22'),
(91, 105, 'Rosa', 'rosa@mail.com', 'Cool bokeh, I like the star wars vibe!', 'approved', '2025-01-22'),
(92, 115, 'Dani', 'dani@mail.com', 'What a view!', 'unapproved', '2025-01-22'),
(93, 104, 'Brenda', 'brenda@mail.com', 'Really like the vibe!', 'unapproved', '2025-01-22'),
(94, 126, 'Tony', 'tony@mail.com', 'Love the vibe!', 'unapproved', '2025-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `lenses`
--

DROP TABLE IF EXISTS `lenses`;
CREATE TABLE `lenses` (
  `lens_id` int(3) NOT NULL,
  `lens_name` varchar(255) NOT NULL,
  `lens_status` varchar(255) DEFAULT 'unapproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lenses`
--

INSERT INTO `lenses` (`lens_id`, `lens_name`, `lens_status`) VALUES
(17, 'Helios 44-2', 'approved'),
(18, 'Canon FD 135mm', 'approved'),
(19, 'SMC-Pentax-M 50mm', 'approved'),
(20, 'Mir 1b 2.8/37', 'approved'),
(21, 'Domiplan 2.8/50', 'approved'),
(22, 'Venus Laowa 65mm Macro', 'approved'),
(23, 'Mir 10a 3.5/28', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_lens_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_lens_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(104, 23, 'Bike at night', 'Paris', '2025-01-21', 'CHP00058.jpg', '<p>This is a night photo using the well known russian lens. It was one of the first photos I took after I got it!</p>', 'nightphotography', 2, 'published', 7),
(105, 17, 'Stormtrooper trip', 'Paris', '2025-01-22', 'CHP00653.jpg', '<p>This was taken during a trip from Athens to Thessaloniki. My friend was driving and I was experimenting with the camera.</p><p><b>Good times</b>.</p>', 'starwars,trip,bokeh,nightphotography', 1, 'published', 8),
(106, 17, 'Moog Electronics', 'Paris', '2025-01-22', 'CHP00290.jpg', '<p>This was taken during a rehearsal in Athens. Saw the vintage stuff and didn\'t miss the chance to capture the moment!</p>', 'music,keyboards,effects', 0, 'published', 1),
(107, 17, 'Road lights', 'Paris', '2025-01-22', 'CHP00627.jpg', '<p>This was during a trip. While I was next to the driver\'s seat, I didn\'t miss the chance to take advantage of the lights for a beautiful bokeh.</p>', 'trip,bokeh', 0, 'published', 0),
(108, 18, 'Concert Guitar Closeup', 'Paris', '2025-01-22', 'CHP00804.jpg', '<p>This is&nbsp; a photo of my friend Babis, who was playing live. I found a great opportunity to test my telephoto lens during those conditions. Light sources were dim, but I think the result was fine!</p>', 'music,guitar,live', 0, 'published', 0),
(109, 17, 'Walk on the field', 'Paris', '2025-01-22', 'CHP00835.jpg', '<p>My friend Dimitris is on this photo. He took me for a walk on the mountain, at the village where he lives. I took my camera of course. I took this photo of him during a break from our walk. There were many breaks. I surely couldn\'t keep up with his pace easily!</p>', 'nature', 0, 'published', 0),
(110, 19, 'Mark the dog', 'Paris', '2025-01-22', 'CHP00843.jpg', '<p>This is a photo of my friends dog, called \"Mark\". He was running towards me, but I managet to take this snap!</p>', 'dog,animal,nature', 0, 'published', 8),
(111, 17, 'Nighttime in Athens', 'Paris', '2025-01-22', 'CHP01163.jpg', '<p>I really like the film look on this one. Taken during a stroll in Athens at night!</p>', 'nightphotography', 0, 'published', 1),
(112, 20, 'Port of Kos', 'Paris', '2025-01-22', 'CHP01247.jpg', '<p>This was taken while waiting at the port of Kos. We took the ship to go to Patmos. Very sunny day. I really like the vintage look of the car here.</p>', 'sea,ship', 0, 'published', 11),
(113, 23, 'Island Alley', 'Paris', '2025-01-22', 'CHP01251.jpg', '<p>This was taken while walking the alleys of Patmos island.</p><p>Very beautiful place in Dodecanese.</p>', 'summer,island,tourism', 0, 'published', 1),
(114, 17, 'Cat Yawn ', 'Paris', '2025-01-22', 'CHP01731.jpg', '<p>This was a very interesting snap right at the moment!</p>', 'cat,animal', 0, 'draft', 1),
(115, 19, 'Ship Sea', 'Paris', '2025-01-22', 'CHP06336.jpg', '<p>This was taken while being on the boat from Kefallonia to Lefkada in the summer. I really like the vintage look of it</p>', 'sea,summer,trip', 1, 'published', 3),
(116, 19, 'View of the port', 'Paris', '2025-01-22', 'CHP06420.jpg', '<p>This is a picture of the port of Thessaloniki. Taken from a cruise ship that was at the port. Very rare occasion to be there and view this sight!</p>', 'ship,sea', 0, 'published', 0),
(117, 17, 'Electricity', 'Paris', '2025-01-22', 'CHP08410.jpg', '<p>This was a random photo I took during a stroll</p>', 'streetphotography', 0, 'draft', 0),
(118, 20, 'Field and sun', 'Paris', '2025-01-22', 'CHP08886.jpg', '<p>I really like the flare on this one. <u>This lens has a very unique flare</u>. Also dig the vintage look because of the loose focus!</p>', 'sun,nature,lens.flare', 0, 'published', 0),
(119, 17, 'Peaceful Waters', 'Paris', '2025-01-22', 'CHP08905.jpg', '<p><br></p>', 'landscape', 0, 'draft', 0),
(120, 17, 'Gibson SG', 'Paris', '2025-01-22', 'CHP09163.jpg', '<p>The colour render here is so smooth. Also the bokeh turned out to show really nice!</p>', 'music,guitar', 0, 'published', 0),
(121, 17, 'Chair on sunset', 'Paris', '2025-01-22', 'CHP09178.jpg', '<p>This is a very peaceful photo due to the colours. The sunset reflects very nice on that red...</p>', 'colours', 2, 'published', 5),
(122, 17, 'Girl on the hill', 'Paris', '2025-01-22', 'CHP09348.jpg', '<p>This is a picture of my friend. It was taken after a long walk/climb on Lailias mountain. The view was worth it!!</p>', 'landscape,view,girl', 0, 'published', 0),
(123, 17, 'Statues in the park', 'Paris', '2025-01-22', 'CHP09518.jpg', '<p>This was taken in Breda, Netherlands. Very interesting statues in a park. I think the way the lens renders the colours is very unique!</p>', 'statue', 0, 'draft', 0),
(124, 17, 'Clock behind leaves', 'Paris', '2025-01-22', 'CHP09814.jpg', '<p>I really like this composition!</p><p>Photo was taken in Antwerp, Belgium.</p>', 'street.photography', 1, 'published', 5),
(125, 17, 'Angel Exterminador', 'Tim', '2025-01-22', 'DSC03823.jpg', '<p>Interesting poster in tiki bar, Athens.</p>', 'movies,cinema,poster,indoors', 0, 'published', 0),
(126, 18, 'Life on lake', 'Paris', '2025-01-22', 'DSC01366.jpg', '<p>Really cool moment here! The picture was taken in Thermi, Thessaloniki.</p>', 'nature,animals', 2, 'published', 8),
(127, 18, 'Running into moon', 'Paris', '2025-01-23', 'DSC01548.jpg', '<p>This was taken after many attempts. Played with the slower shutter speed to achieve this result...</p>', 'night.photography,slow.shutter', 0, 'draft', 0),
(128, 22, 'Ladybugs', 'Tim', '2025-01-23', 'DSC04573.jpg', '<p>This was taken with a macro lens on Lailias mountain. People really like ladybugs, so why not?</p>', 'macro,nature,insect', 0, 'draft', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT 'user',
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(54, 'paris', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 'Paris', 'Papadopoulos', 'paris@mail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(55, 'bill', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 'Bill', 'Davids', 'bill@mail.com', '', 'user', '$2y$10$iusesomecrazystrings22'),
(56, 'tim', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 'Tim', 'Jones', 'tim@mail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

DROP TABLE IF EXISTS `users_online`;
CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `last_activity_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `last_activity_time`) VALUES
(1, 'ttsnmt9mpoa2q4oamn9r94gl13', 1726394748),
(2, 'l6pq71cj1dbd0jb7cenh1gouev', 1726391005),
(3, 'b3o3lou6qin65kvsqqg8r8dg5t', 1726410633),
(11, '6k4al6s23j0u28t5u3dgn9bvlm', 1737902505),
(12, 'in76q75dp81nk9489rg3khlhgt', 1735374396),
(13, 'lf519umjpps98bqtk8827u6m34', 1735173991),
(14, '66n09ko53tv426b86v2virc9ru', 1735236016),
(15, 'eeufrioglojst2d7qrscejnt57', 1735246072),
(16, 'qa286lbe24vfi66miqh1lde90s', 1735251605),
(17, 'qktbvk3h6sqauhs6g3ihuq7il7', 1735312975);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `lenses`
--
ALTER TABLE `lenses`
  ADD PRIMARY KEY (`lens_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `lenses`
--
ALTER TABLE `lenses`
  MODIFY `lens_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
