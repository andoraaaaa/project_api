-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2024 at 03:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int NOT NULL,
  `key_value` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `key_value`, `is_active`) VALUES
(1, '1234567890abcdef', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `release_year` int DEFAULT NULL,
  `genre1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `genre2` varchar(50) DEFAULT NULL,
  `genre3` varchar(50) DEFAULT NULL,
  `views` int DEFAULT NULL,
  `total_like` int DEFAULT NULL,
  `total_dislike` int DEFAULT NULL,
  `video_filename` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `release_year`, `genre1`, `genre2`, `genre3`, `views`, `total_like`, `total_dislike`, `video_filename`, `image_url`) VALUES
(1, 'Drive to survive', 'Description for movie 1', 2023, 'Action', NULL, NULL, 45123573, 2000000, 12312, 'dts.mp4', 'https://i.ytimg.com/vi/WoFpyFL8E7s/maxresdefault.jpg'),
(2, 'Captain of the world', 'Description for movie 2', 2022, 'Comedy', NULL, NULL, 15000000, 1200000, 50000, 'default.mp4', 'https://occ-0-8407-114.1.nflxso.net/dnm/api/v6/E8vDc_W8CLv7-yMQu8KMEC7Rrr8/AAAABZISXiV9msagMHcXqUKqcBf84RSEkVxJpEr-UcC8i0h5r6_cia7GUlUu1jYwVLSqi71k11RxD9nGXrnFCBfunFWf0G0WjVOng_hZ.jpg?r=ef9'),
(3, 'Marvel Rivals', 'Movie about marvel rivals', 2024, 'Gaming', NULL, NULL, 2000000, 50000, 1235, 'default.mp4', 'https://cdn2.unrealengine.com/01-1920x1080-1920x1080-88255a697e4f.jpg'),
(4, 'Avengers: Endgame', 'Superhero team battles against Thanos.', 2019, 'Action', 'Adventure', 'Sci-Fi', 15000000, 1200000, 50000, 'default.mp4', 'https://ichef.bbci.co.uk/ace/ws/640/cpsprodpb/BF0D/production/_106090984_2e39b218-c369-452e-b5be-d2476f9d8728.jpg.webp'),
(5, 'Spider-Man: No Way Home', 'Peter Parker faces multiverse villains.', 2021, 'Action', 'Adventure', 'Fantasy', 20000000, 1500000, 30000, 'default.mp4', 'https://images.thedirect.com/media/article_full/spider-man-no-way-home-art-collection.jpg'),
(6, 'Inception', 'A thief enters dreams to plant an idea.', 2010, 'Sci-Fi', 'Thriller', 'Action', 18000000, 1400000, 40000, 'default.mp4', 'https://m.media-amazon.com/images/S/pv-target-images/e826ebbcc692b4d19059d24125cf23699067ab621c979612fd0ca11ab42a65cb._SX1080_FMjpg_.jpg'),
(7, 'Titanic', 'A romantic tragedy on the ill-fated ship.', 1997, 'Drama', 'Romance', 'History', 25000000, 1700000, 20000, 'default.mp4', 'https://cdn.theatlantic.com/thumbor/dX7IYqY5OaoJa_4YFvOOVUrGXuo=/1x81:4095x2384/1600x900/media/img/mt/2023/02/MCDTITA_FE014/original.jpg'),
(8, 'The Dark Knight', 'Batman battles Joker in Gotham City.', 2008, 'Action', 'Crime', 'Drama', 22000000, 1600000, 25000, 'default.mp4', 'https://theconsultingdetectivesblog.com/wp-content/uploads/2014/06/the-dark-knight-original.jpg'),
(9, 'Interstellar', 'Astronauts search for a new home for humanity.', 2014, 'Sci-Fi', 'Drama', 'Adventure', 19000000, 1300000, 35000, 'default.mp4', 'https://www.hdwallpapers.in/walls/interstellar_movie-wide.jpg'),
(10, 'Frozen', 'Two sisters face magical adventures in Arendelle.', 2013, 'Animation', 'Fantasy', 'Adventure', 12000000, 800000, 10000, 'default.mp4', 'https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/BFFC561B156453B0B7F4A76E05313E4E1D7F910A3287A61D77FA85C3D5F4847B/scale?width=1200&aspectRatio=1.78&format=webp'),
(11, 'The Lion King', 'Simba\'s journey to become king of the Pride Lands.', 1994, 'Animation', 'Drama', 'Adventure', 14000000, 900000, 15000, 'default.mp4', 'https://cdn.antaranews.com/cache/1200x800/2021/02/12/LionKingThe2019_DUT_1920x1080.jpg'),
(12, 'Harry Potter and the Sorcerer\'s Stone', 'A young wizard discovers his magical heritage.', 2001, 'Fantasy', 'Adventure', 'Family', 21000000, 1800000, 25000, 'default.mp4', 'https://static1.srcdn.com/wordpress/wp-content/uploads/2019/10/Harry-Potter-Stone-header.jpg'),
(13, 'The Matrix', 'A hacker discovers the truth about reality.', 1999, 'Sci-Fi', 'Action', 'Thriller', 16000000, 1200000, 30000, 'default.mp4', 'https://popcult.blog/wp-content/uploads/2021/12/matrix-banner.png'),
(14, 'Avatar', 'A marine on an alien planet fights to protect its people.', 2009, 'Sci-Fi', 'Adventure', 'Action', 22000000, 1800000, 40000, 'default.mp4', 'https://m.media-amazon.com/images/S/pv-target-images/16627900db04b76fae3b64266ca161511422059cd24062fb5d900971003a0b70._SX1080_FMjpg_.jpg'),
(15, 'Guardians of the Galaxy', 'A group of misfits team up to save the galaxy.', 2014, 'Action', 'Comedy', 'Sci-Fi', 15000000, 1300000, 25000, 'default.mp4', 'https://idseducation.com/wp-content/uploads/2023/05/Film-The-Guardians-of-The-Galaxy-Vol.-3.jpg'),
(16, 'Jurassic Park', 'Dinosaurs run wild in a failed theme park.', 1993, 'Adventure', 'Sci-Fi', 'Thriller', 20000000, 1400000, 35000, 'default.mp4', 'https://i.ytimg.com/vi/O-Gu4piWSfI/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLBOR0NOgggzw56eK948PetDLOOHQA'),
(17, 'Shrek', 'An ogre goes on an adventure to rescue a princess.', 2001, 'Animation', 'Comedy', 'Adventure', 18000000, 1600000, 15000, 'default.mp4', 'https://m.media-amazon.com/images/S/pv-target-images/dbf6812f59e5080cf420f1056bfceb66f7d6a43a8df19ace503ea70596afc0ff.jpg'),
(18, 'The Godfather', 'The story of a powerful Italian-American crime family.', 1972, 'Crime', 'Drama', 'Classic', 17000000, 2000000, 5000, 'default.mp4', 'https://d26xc2l5xmkpuu.cloudfront.net/_imager/f821025910a85c3953bbd573bef50c16/GettyImages-525589292_922dfff8e83ae78f0cda992a828b38ec.jpg'),
(19, 'The Avengers', 'Earth’s mightiest heroes unite to stop Loki.', 2012, 'Action', 'Adventure', 'Sci-Fi', 24000000, 1900000, 30000, 'default.mp4', 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p3/75/2024/04/21/Sinopsis-The-Avengers-2012-2754177323.jpg'),
(20, 'Coco', 'A boy travels to the Land of the Dead to find his family.', 2017, 'Animation', 'Fantasy', 'Family', 12000000, 1100000, 10000, 'default.mp4', 'https://hips.hearstapps.com/hmg-prod/images/coco-pixar-movie-1520004766.jpg?crop=0.888888888888889xw:1xh;center,top&resize=1200:*'),
(21, 'Deadpool', 'A wisecracking mercenary seeks revenge.', 2016, 'Action', 'Comedy', 'Superhero', 14000000, 1500000, 25000, 'default.mp4', 'https://static1.cbrimages.com/wordpress/wp-content/uploads/2022/06/Deadpool-3.jpg'),
(22, 'The Hobbit', 'A hobbit embarks on a journey with dwarves.', 2012, 'Fantasy', 'Adventure', 'Drama', 13000000, 1100000, 20000, 'default.mp4', 'https://i0.wp.com/princetonbuffer.princeton.edu/wp-content/uploads/sites/185/2015/02/The-Hobbit.jpg?fit=1200%2C675&ssl=1'),
(23, 'Up', 'An old man flies his house to South America.', 2009, 'Animation', 'Adventure', 'Comedy', 11000000, 900000, 5000, 'default.mp4', 'https://lumiere-a.akamaihd.net/v1/images/h_up_19753_7e04bba2.jpeg?region=0,0,2048,878'),
(24, 'Toy Story', 'Toys come to life when humans aren’t around.', 1995, 'Animation', 'Family', 'Adventure', 14000000, 1000000, 8000, 'default.mp4', 'https://asset.kompas.com/crops/FXu4sMkPL_1UmCCs5l61QhOuais=/119x0:1808x1126/1200x800/data/photo/2020/04/15/5e9717f6e09df.jpg'),
(25, 'Finding Nemo', 'A clownfish searches for his lost son.', 2003, 'Animation', 'Adventure', 'Family', 15000000, 1200000, 10000, 'default.mp4', 'https://www.brightwalldarkroom.com/wp-content/uploads/2024/07/finding-nemo.jpg'),
(26, 'The Hunger Games', 'A girl fights in a deadly survival competition.', 2012, 'Action', 'Adventure', 'Drama', 17000000, 1300000, 20000, 'default.mp4', 'https://tanukicorner.com/wp-content/uploads/2024/02/hunger-games_0-1-3446fdcd85b6417badf1ba65d905aa6e.jpg'),
(27, 'Frozen II', 'Elsa and Anna explore the source of Elsa’s powers.', 2019, 'Animation', 'Fantasy', 'Adventure', 14000000, 1100000, 12000, 'default.mp4', 'https://images.bisnis.com/posts/2020/08/08/1276733/frozen-ii.jpg'),
(28, 'The Incredibles', 'A family of superheroes balances life and saving the world.', 2004, 'Animation', 'Action', 'Adventure', 16000000, 1300000, 15000, 'default.mp4', 'https://i.guim.co.uk/img/media/6aea54cfe4512a04ebf3cca1181281f59bffe1c5/593_0_2420_1454/master/2420.jpg?width=1200&quality=85&auto=format&fit=max&s=fbc44d749ba72c320bc0fb83aa733e4f'),
(29, 'Black Panther', 'A king protects his technologically advanced nation.', 2018, 'Action', 'Adventure', 'Sci-Fi', 19000000, 1700000, 25000, 'default.mp4', 'https://i.ytimg.com/vi/R99wb2NTNag/maxresdefault.jpg'),
(30, 'Iron Man', 'A billionaire builds a suit to fight crime.', 2008, 'Action', 'Sci-Fi', 'Adventure', 15000000, 1400000, 20000, 'default.mp4', 'https://www.shutterstock.com/shutterstock/photos/2511107635/display_1500/stock-photo-iron-man-in-an-explosive-action-pose-with-a-busy-sketched-background-2511107635.jpg'),
(31, 'Wonder Woman', 'An Amazonian warrior joins the world war to stop Ares.', 2017, 'Action', 'Adventure', 'Fantasy', 14000000, 1200000, 18000, 'default.mp4', 'https://cdn.sortiraparis.com/images/80/40234/211727-wonder-woman-avec-gal-gadot-photos-du-tournage.jpg'),
(32, 'Moana', 'A girl sets sail to save her island.', 2016, 'Animation', 'Adventure', 'Fantasy', 13000000, 1100000, 8000, 'default.mp4', 'https://lumiere-a.akamaihd.net/v1/images/pp_moana2_herobanner_mobile_3113-1_b2ec5c0c.jpeg?region=0,0,640,480'),
(33, 'The LEGO Movie', 'An ordinary LEGO piece discovers he is the chosen one.', 2014, 'Animation', 'Comedy', 'Adventure', 12000000, 1000000, 9000, 'default.mp4', 'https://images.squarespace-cdn.com/content/v1/5e387eca8235c42f2e4dbe6c/1613784355750-SEZ59RX18G5Y5HHD74CF/lego-imdb.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_value` (`key_value`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
