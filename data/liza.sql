-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2013 at 12:30 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gamesite`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `genres`(IN `year` VARCHAR(10), IN `month` VARCHAR(10))
BEGIN

SET @@sql_mode:=TRADITIONAL;

SET @s = 'SELECT  COUNT(  * ) AS Count,genre FROM game';
  
if year='' then 
	set year=YEAR(CURRENT_DATE);
end if;

if month='' then 
	set month=MONTH(CURRENT_DATE);
end if;
SET @s=CONCAT(@s," where YEAR(  `date_created` )='",year,"'and MONTH(`date_created`)='",month,"'");
SET @s=CONCAT(@s,' GROUP BY genre');

SET @s1:= CONCAT("select name,count from genre g  join (",@s,") s on g.id=s.genre order by count desc limit 3");   

PREPARE stmt1 FROM @s1; 
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `max_tags`()
begin

select * from (
	SELECT * 
	FROM (

		SELECT COUNT( * ) AS number, tag_id
			FROM   `news_tag` 
			GROUP BY tag_id
		)sc
	ORDER BY number DESC 
	LIMIT 3
	) s
	left join tag  t on s.tag_id=t.id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `most_popular_genre`()
begin
	select * from 	
	(select c as games_count, genre from
	(SELECT count(*) as c, genre from game
	group by genre) s
        order by c desc
        limit 1) s1
	 left join genre g on s1.genre=g.id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tags`(IN `year` VARCHAR(10), IN `month` VARCHAR(10))
BEGIN

SET @@sql_mode:=TRADITIONAL;

SET @s = 'SELECT  COUNT(  * ) AS Count,tag_id FROM news_tag nt left join news n on n.id=nt.news_id';
  
if year='' then 
	set year=YEAR(CURRENT_DATE);
end if;

if month='' then 
	set month=MONTH(CURRENT_DATE);
end if;
SET @s=CONCAT(@s," where YEAR(  `date_created` )='",year,"'and MONTH(`date_created`)='",month,"'");
SET @s=CONCAT(@s,' GROUP BY tag_id');

SET @s1:= CONCAT("select name,count from tag t  join (",@s,") s on t.id=s.tag_id order by count desc limit 3");   

PREPARE stmt1 FROM @s1; 
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '1', NULL, NULL),
('admin', '5', NULL, 'N;'),
('member', '5', NULL, 'N;'),
('member', '7', NULL, NULL),
('user', '7', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, '', NULL, 'N;'),
('member', 2, '', NULL, 'N;'),
('user', 2, '', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `owner_name` varchar(50) NOT NULL,
  `owner_id` int(12) NOT NULL,
  `comment_id` int(12) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(12) DEFAULT NULL,
  `creator_id` int(12) DEFAULT NULL,
  `user_name` varchar(128) DEFAULT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `comment_text` text,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `owner_name` (`owner_name`,`owner_id`),
  KEY `fk55342` (`creator_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`owner_name`, `owner_id`, `comment_id`, `parent_comment_id`, `creator_id`, `user_name`, `user_email`, `comment_text`, `create_time`, `update_time`, `status`) VALUES
('News', 1, 1, 0, NULL, 'fsdf', 'asdfa@fsdf.ru', 'fsdfsdfsdf', 1380393731, NULL, 0),
('News', 1, 2, 1, NULL, 'sdg', 'sdg@sfsd.ru', 'sdgsd', 1380393833, NULL, 0),
('News', 1, 3, 2, NULL, 'asdf', 'asdf@sdf.ru', 'fadfsa', 1380393872, NULL, 0),
('News', 1, 4, 0, 4, NULL, NULL, 'sdfg', 1380403016, NULL, 0),
('News', 1, 5, 0, 7, NULL, NULL, 'asdfa', 1380813734, NULL, 0),
('News', 17, 6, 0, 1, NULL, NULL, 'hkhkhj', 1380819133, NULL, 0),
('News', 17, 7, 0, 1, NULL, NULL, 'hfghdgh', 1380819139, NULL, 0),
('News', 17, 8, 6, 1, NULL, NULL, 'dfghdfgh', 1380819143, NULL, 0),
('News', 17, 9, 8, 1, NULL, NULL, 'dfghdfgh', 1380819147, NULL, 0),
('News', 17, 10, 8, 1, NULL, NULL, 'dfghdfg', 1380819151, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE IF NOT EXISTS `developer` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text,
  `publisher` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`id`, `name`, `description`, `publisher`) VALUES
(1, 'Ubisoft Monreal', '', 0),
(2, 'Cd project red', 'coool', 0);

-- --------------------------------------------------------

--
-- Table structure for table `emailcontent`
--

CREATE TABLE IF NOT EXISTS `emailcontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `emailcontent`
--

INSERT INTO `emailcontent` (`id`, `news_id`) VALUES
(1, 3),
(2, 4),
(3, 5),
(4, 6),
(5, 7),
(6, 8),
(7, 9),
(8, 10),
(9, 11),
(10, 12),
(11, 13),
(12, 14),
(13, 15),
(14, 16),
(15, 17),
(16, 18),
(17, 19);

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE IF NOT EXISTS `feed` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `author` int(12) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk65675` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `content`, `author`, `date_created`) VALUES
(1, 'rewrwfe', 7, NULL),
(2, 'aaaaaaaa', 7, NULL),
(3, 'aaaaaaaa', 7, NULL),
(4, 'qwerqw\n        ', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feed_history`
--

CREATE TABLE IF NOT EXISTS `feed_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(100) NOT NULL,
  `author` int(12) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `feed_history`
--

INSERT INTO `feed_history` (`id`, `content`, `author`, `date_created`) VALUES
(4, 'test 54353  3212334\n        ', 7, NULL),
(5, 'wertwert', 7, NULL),
(10, 'sdfgdsdfg', 7, NULL),
(11, 'qwerqw\n        ', 7, NULL),
(12, 'aaaaaaaa', 7, NULL),
(13, 'aaaaaaaa', 7, NULL),
(14, 'rewrwfe', 7, NULL);

--
-- Triggers `feed_history`
--
DROP TRIGGER IF EXISTS `feed_trg`;
DELIMITER //
CREATE TRIGGER `feed_trg` AFTER INSERT ON `feed_history`
 FOR EACH ROW BEGIN

	update `feed` set `id`=`id`+1 order by `id` desc;
   
   insert into `feed` (id,content,author)
   values(1,NEW.content,NEW.author);
   
   delete from `feed` where `id`>=5;
   
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `genre` int(12) NOT NULL,
  `release` varchar(128) DEFAULT NULL,
  `developer` int(12) NOT NULL,
  `description` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `genre` (`genre`),
  KEY `developer` (`developer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `name`, `genre`, `release`, `developer`, `description`, `date_created`) VALUES
(1, 'Far Cry 3', 2, '0000-00-00', 1, '', '0000-00-00 00:00:00'),
(2, 'Assassins creed 3', 1, '', 1, '', '0000-00-00 00:00:00'),
(3, 'CYberpunk', 2, 'when its done', 2, 'ccccoooolll', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`, `description`) VALUES
(1, 'Action', ''),
(2, 'RPG', '');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `author` int(12) NOT NULL,
  `game` int(12) DEFAULT NULL,
  `developer` int(12) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk1` (`developer`),
  KEY `fk1343` (`game`),
  KEY `fk25434` (`developer`),
  KEY `fk4234` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `author`, `game`, `developer`, `type`, `date_created`) VALUES
(1, 'First new', 'Contents of first new', 1, NULL, NULL, 0, '0000-00-00 00:00:00'),
(2, 'Second news', 'asdfa', 1, NULL, NULL, 0, '0000-00-00 00:00:00'),
(3, 'Trololo', 'fsdfasdfaf', 1, NULL, NULL, 0, '2013-09-29 10:55:16'),
(4, 'Trololo', 'fsdfsdfsd', 1, NULL, NULL, 0, '2013-09-29 11:56:55'),
(6, 'title', 'fsdfs', 1, NULL, NULL, 0, '2013-09-29 12:07:17'),
(7, 'выап', 'ывап', 1, NULL, NULL, 0, '2013-09-29 12:21:39'),
(8, 'выап', 'ывап', 1, NULL, NULL, 0, '2013-09-29 12:23:04'),
(9, 'выап', 'ывап', 1, NULL, NULL, 0, '2013-09-29 12:24:18'),
(10, 'выап', 'ывап', 1, NULL, NULL, 0, '2013-09-29 12:24:30'),
(11, 'Far Cry 3', 'Far Cry 3Far Cry 3Far Cry 3Far Cry 3Far Cry 3Far Cry 3Far Cry 3', 1, NULL, NULL, 0, '2013-09-29 13:25:08'),
(12, 'Far Cry 3', 'Far Cry 3Far Cry 3Far Cry 3Far Cry 3Far Cry 3Far Cry 3Far Cry 3', 1, NULL, NULL, 0, '2013-09-29 13:44:24'),
(13, 'Test', 'testset', 1, NULL, NULL, 0, '2013-10-03 15:39:33'),
(14, 'olololo', 'fsdfa', 1, 1, 1, 0, '2013-10-03 15:41:48'),
(15, 'sexsexsex', 'sexsexsexsexsexsex', 1, 2, NULL, 0, '2013-10-03 16:13:17'),
(16, 'sdf', 'sadf', 1, NULL, NULL, 0, '2013-10-03 16:14:16'),
(17, 'sdf', 'sadf', 1, NULL, NULL, 2, '2013-10-03 16:17:26'),
(18, 'tssad', 'fasdfas', 1, 2, NULL, 2, '2013-10-03 16:44:53'),
(19, 'Trololo', 'fgsdfg\r\nsdfgsdfgsdfg\r\nsdfgsfgd\r\n***\r\nfdasdf\r\nasdf\r\ndaf\r\nsadfadfadfadfsadf', 1, NULL, NULL, 0, '2013-10-03 20:06:43');

--
-- Triggers `news`
--
DROP TRIGGER IF EXISTS `emailcontent_news`;
DELIMITER //
CREATE TRIGGER `emailcontent_news` AFTER INSERT ON `news`
 FOR EACH ROW BEGIN
   INSERT INTO `emailcontent` Set news_id = NEW.id;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `news_tag`
--

CREATE TABLE IF NOT EXISTS `news_tag` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `tag_id` int(12) NOT NULL,
  `news_id` int(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk1` (`news_id`),
  KEY `fk2` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `news_tag`
--

INSERT INTO `news_tag` (`id`, `tag_id`, `news_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(6, 1, 10),
(7, 2, 10),
(8, 3, 10),
(9, 4, 10),
(10, 1, 11),
(11, 2, 11),
(12, 3, 11),
(13, 4, 11),
(14, 1, 12),
(15, 2, 12),
(16, 3, 12),
(17, 4, 12),
(18, 5, 13),
(19, 5, 14),
(20, 6, 15);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'хуй'),
(2, 'пизда'),
(3, 'джигурда'),
(4, 'ололо'),
(5, 'jGurda'),
(6, 'sex');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1380397089),
('m110805_153437_installYiiUser', 1380397259);

-- --------------------------------------------------------

--
-- Table structure for table `{{profiles_fields}}`
--

CREATE TABLE IF NOT EXISTS `{{profiles_fields}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `field_type` varchar(50) NOT NULL DEFAULT '',
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` text,
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` text,
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `{{profiles_fields}}`
--

INSERT INTO `{{profiles_fields}}` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'first_name', 'First Name', 'VARCHAR', 255, 3, 2, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'last_name', 'Last Name', 'VARCHAR', 255, 3, 2, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `{{profiles}}`
--

CREATE TABLE IF NOT EXISTS `{{profiles}}` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `{{profiles}}`
--

INSERT INTO `{{profiles}}` (`user_id`, `first_name`, `last_name`) VALUES
(1, 'Administrator', 'Admin'),
(2, 'asdf', 'sadf'),
(3, 'asdf', 'asdf'),
(4, 'asdf', 'sadf'),
(7, 'Member', 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `{{users}}`
--

CREATE TABLE IF NOT EXISTS `{{users}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username` (`username`),
  UNIQUE KEY `user_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `{{users}}`
--

INSERT INTO `{{users}}` (`id`, `username`, `password`, `email`, `activkey`, `createtime`, `lastvisit`, `superuser`, `status`, `create_at`, `lastvisit_at`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin@gamesite.ru', 'd1fcbc9e3f3762f084777d1bc9727998', 1380397259, 0, 1, 1, '0000-00-00 00:00:00', '2013-10-07 22:21:42'),
(2, 'user', '5f4dcc3b5aa765d61d8327deb882cf99', 'sadf@asd.ru', '486afafc1003040da8767c0f781ab0da', 0, 0, 0, 0, '2013-09-28 19:50:38', '0000-00-00 00:00:00'),
(3, 'Roman', '5f4dcc3b5aa765d61d8327deb882cf99', 'asd@asd.ru', '4362efaeaddd1669444d13d07202db6e', 0, 0, 0, 0, '2013-09-28 21:13:29', '0000-00-00 00:00:00'),
(4, 'lol', '696d29e0940a4957748fe3fc9efd22a3', 'asdf@asdf.ry', 'd4f49f8aba9ec8325cb60f82022b129a', 0, 0, 0, 1, '2013-09-28 21:15:24', '0000-00-00 00:00:00'),
(5, 'admin1', 'password', 'admin1@gamesite.ru', '', 0, 0, 0, 0, '2013-09-29 10:19:38', '0000-00-00 00:00:00'),
(7, 'memeber', '5f4dcc3b5aa765d61d8327deb882cf99', 'member@gamesite.ru', '1c341947a111860006710a918e77d932', 0, 0, 0, 1, '2013-10-03 14:28:14', '2013-10-07 19:55:55');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk55342` FOREIGN KEY (`creator_id`) REFERENCES `{{users}}` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feed`
--
ALTER TABLE `feed`
  ADD CONSTRAINT `fk65675` FOREIGN KEY (`author`) REFERENCES `{{users}}` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `developer` FOREIGN KEY (`developer`) REFERENCES `developer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `genre` FOREIGN KEY (`genre`) REFERENCES `genre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk4234` FOREIGN KEY (`author`) REFERENCES `{{users}}` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk1343` FOREIGN KEY (`game`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk25434` FOREIGN KEY (`developer`) REFERENCES `developer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_tag`
--
ALTER TABLE `news_tag`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `{{profiles}}`
--
ALTER TABLE `{{profiles}}`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `{{users}}` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
