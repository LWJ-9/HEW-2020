-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        8.0.19 - MySQL Community Server - GPL
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 hew 的数据库结构
CREATE DATABASE IF NOT EXISTS `hew` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hew`;

-- 导出  表 hew.comments 结构
CREATE TABLE IF NOT EXISTS `comments` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `uid` int NOT NULL,
  `content` text NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cid`),
  KEY `uid` (`uid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 正在导出表  hew.comments 的数据：~58 rows (大约)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`cid`, `pid`, `uid`, `content`, `post_time`, `edit_time`) VALUES
	(3, 13, 5, '🤣🤣🤣🤣🤣', '2020-02-26 12:54:33', '2020-02-26 12:54:33'),
	(10, 10, 5, '3423', '2020-02-26 15:06:40', '2020-02-26 15:06:40'),
	(11, 6, 5, '55555', '2020-02-26 15:06:45', '2020-02-26 15:06:45'),
	(12, 13, 1, '43535435', '2020-02-26 15:15:14', '2020-02-26 15:15:14'),
	(14, 10, 1, '2223', '2020-02-26 15:15:34', '2020-02-26 15:15:34'),
	(15, 10, 1, '2223', '2020-02-26 15:17:39', '2020-02-26 15:17:39'),
	(23, 11, 1, '312314444', '2020-02-26 15:23:14', '2020-02-26 15:23:14'),
	(24, 11, 1, '312314444', '2020-02-26 15:24:24', '2020-02-26 15:24:24'),
	(25, 13, 1, '3423423424532563', '2020-02-26 15:25:51', '2020-02-26 15:25:51'),
	(26, 13, 1, '😂😂😂😂😂😂😂😂😂😂😂😂', '2020-02-26 15:26:21', '2020-02-26 15:26:21'),
	(27, 13, 1, '😂😂😂😂😂😂😂😂😂😂😂😂', '2020-02-26 15:26:54', '2020-02-26 15:26:54'),
	(28, 13, 1, '❤❤❤❤❤😒😒😒😒🤦‍♂️🎶🌹🎉🤳😁🐱‍👤🐱‍🏍', '2020-02-26 15:27:10', '2020-02-26 15:27:10'),
	(29, 2, 1, '4241324555', '2020-02-26 15:27:22', '2020-02-26 15:27:22'),
	(30, 14, 2, '0000fade', '2020-02-26 15:56:42', '2020-02-26 15:56:42'),
	(32, 6, 2, '213123', '2020-02-26 15:59:10', '2020-02-26 15:59:10'),
	(33, 6, 2, '213123', '2020-02-26 15:59:32', '2020-02-26 15:59:32'),
	(34, 6, 2, '213123', '2020-02-26 16:03:09', '2020-02-26 16:03:09'),
	(35, 6, 2, '213123', '2020-02-26 16:03:29', '2020-02-26 16:03:29'),
	(36, 13, 2, '0000fade', '2020-02-26 16:03:58', '2020-02-26 16:03:58'),
	(37, 14, 8, '5555fade', '2020-02-26 16:04:59', '2020-02-26 16:04:59'),
	(38, 6, 8, '5555fade', '2020-02-26 16:05:07', '2020-02-26 16:05:07'),
	(39, 6, 8, '5555fade', '2020-02-26 16:06:21', '2020-02-26 16:06:21'),
	(40, 6, 8, '5555fade', '2020-02-26 16:14:48', '2020-02-26 16:14:48'),
	(42, 14, 5, '3333fade', '2020-02-26 17:33:47', '2020-02-26 17:33:47'),
	(43, 2, 7, '4444fade', '2020-02-28 14:18:49', '2020-02-28 14:18:49'),
	(44, 10, 7, '4444fade', '2020-02-28 16:53:43', '2020-02-28 16:53:43'),
	(45, 15, 1, '123', '2020-02-29 19:38:10', '2020-02-29 19:38:10'),
	(46, 15, 1, '123', '2020-02-29 19:38:14', '2020-02-29 19:38:14'),
	(47, 15, 1, '', '2020-02-29 19:38:37', '2020-02-29 19:38:37'),
	(48, 15, 1, '', '2020-02-29 19:42:45', '2020-02-29 19:42:45'),
	(49, 15, 1, '1231', '2020-02-29 19:52:26', '2020-02-29 19:52:26'),
	(50, 15, 1, '1231', '2020-02-29 19:53:53', '2020-02-29 19:53:53'),
	(51, 7, 1, '231233333333333333', '2020-02-29 22:32:39', '2020-02-29 22:32:39'),
	(52, 7, 1, '1', '2020-02-29 22:39:45', '2020-02-29 22:39:45'),
	(53, 7, 1, '1', '2020-02-29 22:39:48', '2020-02-29 22:39:48'),
	(54, 7, 1, '1', '2020-02-29 22:39:51', '2020-02-29 22:39:51'),
	(55, 7, 1, '1', '2020-02-29 22:42:46', '2020-02-29 22:42:46'),
	(56, 7, 1, '1', '2020-02-29 22:43:07', '2020-02-29 22:43:07'),
	(57, 7, 1, '1', '2020-02-29 22:45:10', '2020-02-29 22:45:10'),
	(60, 10, 7, 'aaaa', '2020-03-04 10:20:26', '2020-03-04 10:20:26'),
	(61, 19, 1, 'good! ', '2020-03-04 14:19:24', '2020-03-04 14:19:24'),
	(62, 15, 1, 'not bad', '2020-03-04 14:21:43', '2020-03-04 14:21:43'),
	(63, 19, 8, '😍😍😍😍😍😍', '2020-03-04 14:38:51', '2020-03-04 14:38:51'),
	(64, 21, 8, '😁😁😁', '2020-03-04 14:39:08', '2020-03-04 14:39:08'),
	(65, 8, 11, 'dgfff🤣🤣🤣🤣', '2020-03-04 14:44:53', '2020-03-04 14:44:53'),
	(66, 22, 11, '😂😂', '2020-03-04 14:45:06', '2020-03-04 14:45:06'),
	(68, 21, 1, 'good!', '2020-03-04 16:00:47', '2020-03-04 16:00:47'),
	(69, 21, 1, '😂😂😂😂', '2020-03-04 16:01:01', '2020-03-04 16:01:01'),
	(71, 23, 11, '😍😍😍😍😍😍😍😍😍', '2020-03-04 16:42:47', '2020-03-04 16:42:47'),
	(72, 23, 8, '😘😘😘', '2020-03-04 16:43:18', '2020-03-04 16:43:18'),
	(73, 23, 8, 'good!', '2020-03-04 16:43:28', '2020-03-04 16:43:28'),
	(74, 28, 12, 'i love you!!😍😍😍😍', '2020-03-06 10:14:25', '2020-03-06 10:14:25'),
	(75, 29, 12, '222', '2020-03-06 10:16:38', '2020-03-06 10:16:38'),
	(76, 26, 12, '222', '2020-03-06 10:16:44', '2020-03-06 10:16:44'),
	(77, 28, 12, 'ddd', '2020-03-06 10:19:02', '2020-03-06 10:19:02'),
	(78, 26, 1, '444', '2020-03-06 10:20:36', '2020-03-06 10:20:36'),
	(79, 33, 1, '🎉🎉🎉', '2020-03-06 10:25:05', '2020-03-06 10:25:05'),
	(80, 32, 1, '😃😃😃', '2020-03-06 10:25:29', '2020-03-06 10:25:29');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- 导出  表 hew.followed 结构
CREATE TABLE IF NOT EXISTS `followed` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `followed_uid` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `followed_uid` (`followed_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 正在导出表  hew.followed 的数据：~42 rows (大约)
/*!40000 ALTER TABLE `followed` DISABLE KEYS */;
INSERT INTO `followed` (`id`, `uid`, `followed_uid`) VALUES
	(12, 5, 6),
	(18, 6, 2),
	(23, 5, 2),
	(29, 7, 1),
	(33, 5, 1),
	(34, 7, 2),
	(38, 7, 8),
	(39, 7, 3),
	(40, 7, 5),
	(46, 11, 1),
	(48, 11, 11),
	(49, 11, 10),
	(50, 11, 2),
	(51, 11, 3),
	(52, 11, 4),
	(53, 11, 5),
	(55, 11, 6),
	(60, 7, 7),
	(61, 7, 6),
	(64, 10, 6),
	(65, 1, 12),
	(66, 1, 2),
	(67, 1, 4),
	(68, 1, 5),
	(69, 1, 6),
	(70, 1, 7),
	(71, 1, 8),
	(72, 1, 11),
	(73, 5, 12),
	(74, 12, 1),
	(75, 12, 3),
	(76, 12, 2),
	(77, 12, 4),
	(78, 12, 5),
	(79, 12, 6),
	(80, 12, 8),
	(81, 12, 7),
	(82, 12, 10),
	(83, 12, 11),
	(84, 2, 5),
	(86, 2, 8),
	(88, 2, 12);
/*!40000 ALTER TABLE `followed` ENABLE KEYS */;

-- 导出  表 hew.posts 结构
CREATE TABLE IF NOT EXISTS `posts` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `status` int DEFAULT '1',
  `media` text NOT NULL,
  `text` text NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 正在导出表  hew.posts 的数据：~31 rows (大约)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`pid`, `uid`, `status`, `media`, `text`, `post_time`, `edit_time`) VALUES
	(1, 1, 1, '202002190154352016-05-03 (2).png', '2455', '2020-02-19 10:54:35', '2020-02-19 10:54:35'),
	(2, 1, 1, '202002190156362016-06-21.png', '43214321', '2020-02-19 10:56:36', '2020-02-27 11:09:44'),
	(3, 1, 0, '', '5646543646456', '2020-02-19 11:05:25', '2020-03-04 14:35:48'),
	(4, 1, 1, '202002190213202016-07-09 (2).png', '', '2020-02-19 11:13:20', '2020-02-19 11:13:20'),
	(5, 1, 0, '', '<div style="background= red; height=50px;"></div>', '2020-02-19 11:14:41', '2020-03-04 14:25:16'),
	(6, 2, 1, '202002190320162017-02-07 (3).png', '9999', '2020-02-19 12:20:16', '2020-02-19 12:51:47'),
	(7, 1, 0, '202002190443072016-05-03 (2).png', '', '2020-02-19 13:43:07', '2020-03-04 13:48:53'),
	(8, 1, 1, '202002190546312016-05-03 (2).png', '', '2020-02-19 14:46:31', '2020-02-27 11:09:37'),
	(9, 1, 1, '202002190644232016-05-03 (2).png', '46575757567657567', '2020-02-19 15:44:23', '2020-02-27 11:09:35'),
	(10, 1, 1, '202002190844232016-09-30.png', 'game images', '2020-02-19 17:44:23', '2020-02-19 17:44:23'),
	(11, 4, 1, '20200221050805as-ssd-bench Crucial_CT256M550 2018.4.8 19-13-40.png', 'SSD SPEEDTESTした', '2020-02-21 14:08:05', '2020-02-21 14:23:31'),
	(12, 4, 1, '20200221054527男女思维不同.jpg', 'wawawa', '2020-02-21 14:45:27', '2020-02-21 14:45:27'),
	(13, 1, 0, '', '<span style="background= red;"></span>', '2020-02-21 15:09:07', '2020-03-04 14:25:09'),
	(14, 2, 1, '20200226065358LI-W8APAD - WIN_20150301_145123.JPG', 'zheshi 0000fade', '2020-02-26 15:53:58', '2020-02-27 11:09:25'),
	(15, 7, 0, '', '555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859555555555555555555555555555555555555555555555555553222222222222222222222222222222222222222222222222222222185478194578357832758235073850738295748502375482307485955555555555555555555555555555555555555555555555555322222222222222222222222222222222222222222222222222222218547819457835783275823507385073829574850237548230748595555555555555555555555555555555555555555555555555532222222222222222222222222222222222222222222222222222221854781945783578327582350738507382957485023754823074859', '2020-02-28 17:00:44', '2020-03-04 14:24:27'),
	(16, 5, 1, '20200302134817-2020-02-26.png', 'preview', '2020-03-02 22:48:17', '2020-03-02 22:48:17'),
	(17, 7, 1, '20200303155945-男女思维不同.jpg', '12312', '2020-03-04 00:59:45', '2020-03-04 00:59:45'),
	(18, 1, 0, '', 'dsasdxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', '2020-03-04 13:53:09', '2020-03-04 14:25:05'),
	(19, 5, 1, '20200304050606-88183129_846114165894850_470706961061044277_n.jfif', '', '2020-03-04 14:06:06', '2020-03-04 14:06:06'),
	(20, 4, 1, '20200304052624-6efc710a1d5a.jfif', '', '2020-03-04 14:26:24', '2020-03-04 14:26:24'),
	(21, 10, 1, '20200304053414-2020-02-19 (2).png', '', '2020-03-04 14:34:14', '2020-03-04 14:34:14'),
	(22, 11, 0, '20200304054356-forpst.jfif', '', '2020-03-04 14:43:56', '2020-03-04 14:46:01'),
	(23, 6, 1, '20200304072234-some-bis-biswas-scenery-wallpaper.jpg', '', '2020-03-04 16:22:34', '2020-03-04 16:22:34'),
	(26, 12, 1, '20200305135943-ik.jpg', 'kawaii', '2020-03-05 22:59:43', '2020-03-05 22:59:43'),
	(27, 2, 1, '20200305140300-.jpg', '', '2020-03-05 23:03:00', '2020-03-05 23:03:00'),
	(28, 1, 1, '20200306010517-33.jpg', '', '2020-03-06 10:05:17', '2020-03-06 10:05:17'),
	(29, 2, 1, '20200306010545-55.jpg', '', '2020-03-06 10:05:45', '2020-03-06 10:05:45'),
	(30, 7, 1, '20200306010604-222.jpg', '', '2020-03-06 10:06:04', '2020-03-06 10:06:04'),
	(31, 8, 1, '20200306010622-hua,.jpg', '', '2020-03-06 10:06:22', '2020-03-06 10:06:22'),
	(32, 6, 1, '20200306010635-long.jpg', '', '2020-03-06 10:06:35', '2020-03-06 10:06:35'),
	(33, 11, 1, '20200306010707-tm.jpg', '', '2020-03-06 10:07:07', '2020-03-06 10:07:07');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- 导出  表 hew.thumbup 结构
CREATE TABLE IF NOT EXISTS `thumbup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `uid` int NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 正在导出表  hew.thumbup 的数据：~56 rows (大约)
/*!40000 ALTER TABLE `thumbup` DISABLE KEYS */;
INSERT INTO `thumbup` (`id`, `pid`, `uid`, `add_time`) VALUES
	(1, 13, 3, '2020-03-03 00:04:04'),
	(2, 13, 1, '2020-03-03 00:04:04'),
	(3, 14, 1, '2020-03-03 00:04:05'),
	(6, 15, 1, '2020-03-03 00:17:49'),
	(8, 16, 1, '2020-03-03 01:43:11'),
	(26, 5, 7, '2020-03-03 15:39:32'),
	(28, 2, 7, '2020-03-03 15:50:54'),
	(29, 3, 7, '2020-03-03 15:51:07'),
	(30, 4, 7, '2020-03-03 15:51:08'),
	(32, 4, 2, '2020-03-03 16:30:17'),
	(33, 13, 2, '2020-03-03 16:59:23'),
	(34, 10, 7, '2020-03-04 00:54:32'),
	(37, 14, 4, '2020-03-04 12:35:27'),
	(38, 9, 4, '2020-03-04 12:40:07'),
	(39, 8, 4, '2020-03-04 12:54:04'),
	(41, 10, 4, '2020-03-04 12:54:45'),
	(42, 13, 4, '2020-03-04 13:47:49'),
	(43, 19, 5, '2020-03-04 14:07:18'),
	(44, 18, 5, '2020-03-04 14:07:21'),
	(45, 16, 5, '2020-03-04 14:07:24'),
	(46, 18, 1, '2020-03-04 14:14:30'),
	(47, 17, 1, '2020-03-04 14:17:17'),
	(50, 19, 1, '2020-03-04 14:38:05'),
	(51, 10, 1, '2020-03-04 14:38:11'),
	(52, 9, 1, '2020-03-04 14:38:14'),
	(53, 19, 8, '2020-03-04 14:38:38'),
	(54, 8, 11, '2020-03-04 14:44:36'),
	(57, 20, 11, '2020-03-04 14:47:41'),
	(60, 21, 11, '2020-03-04 14:52:44'),
	(61, 21, 1, '2020-03-04 16:04:08'),
	(62, 23, 6, '2020-03-04 16:40:35'),
	(64, 23, 11, '2020-03-04 16:42:23'),
	(65, 23, 8, '2020-03-04 16:44:03'),
	(66, 23, 10, '2020-03-04 16:50:16'),
	(67, 33, 1, '2020-03-06 10:08:20'),
	(68, 32, 1, '2020-03-06 10:08:22'),
	(69, 31, 1, '2020-03-06 10:08:23'),
	(70, 30, 1, '2020-03-06 10:08:24'),
	(71, 29, 1, '2020-03-06 10:08:26'),
	(72, 28, 1, '2020-03-06 10:08:28'),
	(73, 27, 1, '2020-03-06 10:08:30'),
	(74, 23, 1, '2020-03-06 10:08:35'),
	(75, 32, 5, '2020-03-06 10:08:44'),
	(76, 29, 5, '2020-03-06 10:08:52'),
	(77, 28, 5, '2020-03-06 10:08:54'),
	(78, 27, 5, '2020-03-06 10:08:58'),
	(79, 23, 5, '2020-03-06 10:09:17'),
	(80, 26, 12, '2020-03-06 10:13:15'),
	(81, 33, 12, '2020-03-06 10:14:03'),
	(82, 32, 12, '2020-03-06 10:14:05'),
	(83, 31, 12, '2020-03-06 10:14:07'),
	(84, 30, 12, '2020-03-06 10:14:09'),
	(85, 29, 12, '2020-03-06 10:14:11'),
	(86, 28, 12, '2020-03-06 10:14:14'),
	(87, 23, 12, '2020-03-06 10:14:36'),
	(88, 21, 12, '2020-03-06 10:15:20');
/*!40000 ALTER TABLE `thumbup` ENABLE KEYS */;

-- 导出  表 hew.users 结构
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '123.jpg',
  `self_intro` varchar(255) DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 正在导出表  hew.users 的数据：~11 rows (大约)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`uid`, `name`, `password`, `picture`, `self_intro`, `add_time`, `update_time`) VALUES
	(1, '1', '356a192b7913b04c54574d18c28d46e6395428ab', '\'1.jpg', '天気がいいから、散歩にしましょう', '2020-02-14 02:20:52', '2020-03-01 15:57:32'),
	(2, '0000', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'default.png', NULL, '2020-02-18 12:44:24', '2020-02-21 17:10:19'),
	(3, '1223', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'default.png', NULL, '2020-02-18 13:05:23', '2020-02-21 17:10:20'),
	(4, '2222', 'fea7f657f56a2a448da7d4b535ee5e279caf3d9a', 'default.png', NULL, '2020-03-04 12:03:32', '2020-03-04 12:29:22'),
	(5, '3333', 'f56d6351aa71cff0debea014d13525e42036187a', '20200225023542你的色图我一眼都不会看.jpg', NULL, '2020-02-25 11:35:42', '2020-02-25 11:35:42'),
	(6, '6666', '4c1b52409cf6be3896cf163fa17b32e4da293f2e', 'default.png', NULL, '2020-02-26 09:47:06', '2020-03-04 10:21:56'),
	(7, '4444', '92f2fd99879b0c2466ab8648afb63c49032379c1', 'default.png', NULL, '2020-02-26 10:14:31', '2020-02-26 10:14:31'),
	(8, '5555', 'ab874467a7d1ff5fc71a4ade87dc0e098b458aae', 'default.png', NULL, '2020-02-26 10:31:56', '2020-02-26 10:31:56'),
	(10, '1212', '618dcdfb0cd9ae4481164961c4796dd8e3930c8d', '20200304053326icon2.jpg', NULL, '2020-03-04 14:33:26', '2020-03-04 14:33:26'),
	(11, '1414', 'fbce66f99c809283638f344ecb3d50674ea64189', '20200304054317icon1.jfif', NULL, '2020-03-04 14:43:17', '2020-03-04 14:43:17'),
	(12, 'いっけい', '178f71645d8d762522ede90115f4f50f1e19d62b', '20200305135156ike.gif', NULL, '2020-03-05 22:51:56', '2020-03-05 22:51:56');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;