/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : forum

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-09-09 19:20:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('12', 'Hatter: \'but you could.', 'Blanditiis ea exercitationem nisi.');
INSERT INTO `categories` VALUES ('13', 'Alice\'s side as she.', 'In impedit voluptatem magni aspernatur.');
INSERT INTO `categories` VALUES ('14', 'Gryphon replied very.', 'Labore dolorem quos quod et.');
INSERT INTO `categories` VALUES ('15', 'WHAT?\' thought Alice to.', 'Ipsam id sunt sed distinctio.');
INSERT INTO `categories` VALUES ('16', 'Duchess sneezed.', 'Temporibus eos hic sit qui aliquam assumenda quas.');
INSERT INTO `categories` VALUES ('17', 'Caterpillar\'s making.', 'Deleniti illo saepe autem dolores.');
INSERT INTO `categories` VALUES ('18', 'Don\'t let me hear the.', 'Et dolorum provident beatae aperiam sunt sed id deserunt.');
INSERT INTO `categories` VALUES ('19', 'Mock Turtle to the.', 'Nam unde repellat qui consequuntur aliquam hic.');
INSERT INTO `categories` VALUES ('20', 'Alice in a day did you.', 'Commodi soluta porro rem voluptatum.');
INSERT INTO `categories` VALUES ('21', 'Alice joined the.', 'Est id et molestiae ad provident.');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `global` tinyint(1) NOT NULL DEFAULT '0',
  `section` smallint(5) unsigned DEFAULT NULL,
  `style` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `IX_Relationship4` (`section`),
  CONSTRAINT `Relationship4` FOREIGN KEY (`section`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Default', '0', '0', null, null);

-- ----------------------------
-- Table structure for `messages`
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(11) unsigned NOT NULL,
  `to` int(11) unsigned NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `parent` int(11) unsigned DEFAULT NULL,
  `fread` tinyint(1) NOT NULL DEFAULT '0',
  `tread` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`from`,`to`,`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `from` (`from`),
  UNIQUE KEY `to` (`to`),
  KEY `IX_Relationship10` (`parent`),
  CONSTRAINT `Relationship10` FOREIGN KEY (`parent`) REFERENCES `messages` (`id`),
  CONSTRAINT `Relationship5` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  CONSTRAINT `Relationship7` FOREIGN KEY (`to`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_polish_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_polish_ci NOT NULL,
  `content` text COLLATE utf8mb4_polish_ci NOT NULL,
  `url` varchar(190) COLLATE utf8mb4_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of pages
-- ----------------------------

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` int(11) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `content` text COLLATE utf8mb4_polish_ci NOT NULL,
  `topic` smallint(5) unsigned NOT NULL,
  `first` tinyint(1) NOT NULL,
  PRIMARY KEY (`author`,`id`,`topic`),
  UNIQUE KEY `id` (`id`),
  KEY `Relationship12` (`topic`),
  CONSTRAINT `Relationship11` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
  CONSTRAINT `Relationship12` FOREIGN KEY (`topic`) REFERENCES `topics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('11', '14', '2018-09-03 18:23:41', 'Duchess said to the door. \'Call the first day,\' said the King, \'that only makes the world she was terribly frightened all the things between whiles.\' \'Then you should say what you would have called him Tortoise because he was in a whisper.) \'That would be only rustling in the wind, and the Hatter went on, very much confused, \'I don\'t know what a long and a large flower-pot that stood near..', '11', '1');
INSERT INTO `posts` VALUES ('21', '14', '0000-00-00 00:00:00', 'Test post', '11', '0');
INSERT INTO `posts` VALUES ('12', '15', '2018-09-03 18:23:44', 'Alice; \'all I know all the time when I learn music.\' \'Ah! that accounts for it,\' said the King, and the Mock Turtle, \'they--you\'ve seen them, of course?\' \'Yes,\' said Alice, \'we learned French and music.\' \'And washing?\' said the cook. The King and the poor child, \'for I can\'t get out again. The rabbit-hole went straight on like a sky-rocket!\' \'So you think you might catch a bad cold if she.', '12', '1');
INSERT INTO `posts` VALUES ('13', '16', '2018-09-03 18:23:45', 'Queen, and Alice called after it; and while she remembered having seen in her lessons in the pool as it could go, and broke off a head could be no chance of her going, though she looked down, was an old Turtle--we used to say.\' \'So he did, so he did,\' said the Dodo managed it.) First it marked out a history of the day; and this was of very little use without my shoulders. Oh, how I wish I.', '13', '1');
INSERT INTO `posts` VALUES ('14', '17', '2018-09-03 18:23:46', 'Dormouse, not choosing to notice this last word with such a tiny little thing!\' said Alice, timidly; \'some of the baby?\' said the Hatter. \'I told you that.\' \'If I\'d been the whiting,\' said the Mouse. \'Of course,\' the Dodo suddenly called out \'The race is over!\' and they all spoke at once, with a knife, it usually bleeds; and she trembled till she had never done such a very truthful child;.', '14', '1');
INSERT INTO `posts` VALUES ('15', '18', '2018-09-03 18:23:46', 'Alice, she went on. \'I do,\' Alice hastily replied; \'at least--at least I know is, it would be a Caucus-race.\' \'What IS the use of a feather flock together.\"\' \'Only mustard isn\'t a letter, written by the end of the Shark, But, when the White Rabbit, \'but it doesn\'t matter a bit,\' she thought it over a little while, however, she again heard a little hot tea upon its nose. The Dormouse slowly.', '15', '1');
INSERT INTO `posts` VALUES ('16', '19', '2018-09-03 18:23:46', 'So you see, Miss, this here ought to go after that savage Queen: so she bore it as far as they all crowded round her, calling out in a trembling voice to a farmer, you know, and he went on at last, more calmly, though still sobbing a little scream of laughter. \'Oh, hush!\' the Rabbit in a deep, hollow tone: \'sit down, both of you, and must know better\'; and this Alice would not join the.', '16', '1');
INSERT INTO `posts` VALUES ('17', '20', '2018-09-03 18:23:47', 'They all returned from him to you, Though they were nice grand words to say.) Presently she began thinking over other children she knew, who might do something better with the other: the Duchess sneezed occasionally; and as he spoke, and the whole party at once took up the little crocodile Improve his shining tail, And pour the waters of the lefthand bit. * * * * * * \'What a funny watch!\'.', '17', '1');
INSERT INTO `posts` VALUES ('18', '21', '2018-09-03 18:23:47', 'Dodo, pointing to the door. \'Call the next moment she appeared on the glass table and the White Rabbit, who said in a voice outside, and stopped to listen. The Fish-Footman began by taking the little golden key and hurried upstairs, in great fear lest she should meet the real Mary Ann, and be turned out of its little eyes, but it puzzled her a good deal until she had not as yet had any.', '18', '1');
INSERT INTO `posts` VALUES ('19', '22', '2018-09-03 18:23:48', 'Has lasted the rest of my life.\' \'You are old,\' said the Caterpillar took the hookah out of its right paw round, \'lives a March Hare. Alice sighed wearily. \'I think you could see it trot away quietly into the air, mixed up with the clock. For instance, if you don\'t like them!\' When the pie was all very well to say anything. \'Why,\' said the Hatter, \'or you\'ll be telling me next that you.', '19', '1');
INSERT INTO `posts` VALUES ('20', '23', '2018-09-03 18:23:48', 'THE KING AND QUEEN OF HEARTS. Alice was only the pepper that had fallen into a tidy little room with a table in the world she was talking. Alice could bear: she got used to it as well as if his heart would break. She pitied him deeply. \'What is it?\' \'Why,\' said the Caterpillar. \'Well, I shan\'t go, at any rate,\' said Alice: \'--where\'s the Duchess?\' \'Hush! Hush!\' said the Footman, \'and that.', '20', '1');

-- ----------------------------
-- Table structure for `ranks`
-- ----------------------------
DROP TABLE IF EXISTS `ranks`;
CREATE TABLE `ranks` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `stars` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `style` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of ranks
-- ----------------------------
INSERT INTO `ranks` VALUES ('1', 'Default', '0', null);

-- ----------------------------
-- Table structure for `reputations`
-- ----------------------------
DROP TABLE IF EXISTS `reputations`;
CREATE TABLE `reputations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL,
  PRIMARY KEY (`post`,`from`,`id`),
  UNIQUE KEY `id` (`id`),
  KEY `Relationship24` (`from`),
  CONSTRAINT `Relationship23` FOREIGN KEY (`post`) REFERENCES `posts` (`id`),
  CONSTRAINT `Relationship24` FOREIGN KEY (`from`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of reputations
-- ----------------------------

-- ----------------------------
-- Table structure for `sections`
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `category` smallint(5) unsigned NOT NULL,
  `parent` smallint(5) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `url` varchar(150) COLLATE utf8mb4_polish_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT 'default.jpg',
  PRIMARY KEY (`id`,`category`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `url` (`url`),
  KEY `IX_Relationship11` (`parent`),
  KEY `Category` (`category`),
  CONSTRAINT `Category` FOREIGN KEY (`category`) REFERENCES `categories` (`id`),
  CONSTRAINT `sections` FOREIGN KEY (`parent`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of sections
-- ----------------------------
INSERT INTO `sections` VALUES ('12', 'But at any rate.', 'Et nulla sunt in nostrum.', '12', null, '1', '15b8d7c307854b', 'default.jpg');
INSERT INTO `sections` VALUES ('13', 'However, I\'ve got.', 'Eum fugit omnis illum aut.', '13', null, '1', '15b8d7c31045f1', 'default.jpg');
INSERT INTO `sections` VALUES ('14', 'Pigeon; \'but I.', 'Corporis aut error et nihil.', '14', null, '1', '15b8d7c31bb3e4', 'default.jpg');
INSERT INTO `sections` VALUES ('15', 'They all sat down.', 'Et et consequatur et nemo.', '15', null, '1', '15b8d7c323b137', 'default.jpg');
INSERT INTO `sections` VALUES ('16', 'DON\'T know,\' said.', 'Quod cum expedita nostrum.', '16', null, '1', '15b8d7c32a8b39', 'default.jpg');
INSERT INTO `sections` VALUES ('17', 'I know. Silence.', 'Et incidunt quis itaque aut.', '17', null, '1', '15b8d7c3318e89', 'default.jpg');
INSERT INTO `sections` VALUES ('18', 'King, \'and don\'t.', 'At dolorem placeat nesciunt.', '18', null, '1', '15b8d7c33a8b72', 'default.jpg');
INSERT INTO `sections` VALUES ('19', 'Majesty,\' the.', 'Qui mollitia at in rerum et.', '19', null, '1', '15b8d7c3414489', 'default.jpg');
INSERT INTO `sections` VALUES ('20', 'Alice, \'shall I.', 'Sapiente et ut nobis odit.', '20', null, '1', '15b8d7c3492446', 'default.jpg');
INSERT INTO `sections` VALUES ('21', 'For anything.', 'Omnis amet est eos.', '21', null, '1', '15b8d7c351ecbc', 'default.jpg');

-- ----------------------------
-- Table structure for `topics`
-- ----------------------------
DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_polish_ci NOT NULL,
  `section` smallint(5) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `url` varchar(150) COLLATE utf8mb4_polish_ci NOT NULL,
  `pin` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`,`section`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `Relationship3` (`section`),
  CONSTRAINT `Relationship3` FOREIGN KEY (`section`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of topics
-- ----------------------------
INSERT INTO `topics` VALUES ('11', 'Esse aliquam dolorem iusto atque dolor qui aut.', '12', '1', 'et-culpa-porro-labore-non-est-error-consectetur-qui', '0', '0', '2018-09-03');
INSERT INTO `topics` VALUES ('12', 'Beatae aperiam eos dolores soluta.', '13', '1', 'aperiam-maiores-aliquam-perferendis-recusandae-cupiditate-temporibus-nihil-consectetur', '0', '0', '2018-09-03');
INSERT INTO `topics` VALUES ('13', 'Sint ullam aspernatur ad necessitatibus totam esse.', '14', '1', 'nemo-id-doloremque-dolores-vitae-mollitia', '0', '0', '2018-09-03');
INSERT INTO `topics` VALUES ('14', 'Totam et unde nostrum.', '15', '1', 'quos-cumque-enim-ea-minus-in-impedit-voluptatem-quibusdam', '0', '0', '2018-09-03');
INSERT INTO `topics` VALUES ('15', 'Voluptatem unde ut hic.', '16', '1', 'eaque-saepe-vel-animi-alias-labore', '0', '0', '2018-09-03');
INSERT INTO `topics` VALUES ('16', 'Et ut blanditiis aut.', '17', '1', 'consequatur-in-aspernatur-accusamus-id-est-dolorem', '0', '0', '2018-09-03');
INSERT INTO `topics` VALUES ('17', 'Quibusdam in ullam et omnis ea.', '18', '1', 'et-id-culpa-commodi-et-doloremque-accusamus', '0', '0', '2018-09-03');
INSERT INTO `topics` VALUES ('18', 'Impedit aperiam praesentium dolorem.', '19', '1', 'non-saepe-cupiditate-placeat-quisquam-odio-blanditiis', '0', '0', '2018-09-03');
INSERT INTO `topics` VALUES ('19', 'Voluptatem possimus velit dolor ipsa laborum molestiae dolorem porro.', '20', '1', 'quae-est-est-amet-aliquam-saepe-rem', '0', '0', '2018-09-03');
INSERT INTO `topics` VALUES ('20', 'In sed optio sit perspiciatis.', '21', '1', 'quis-officia-quisquam-vero-optio-ipsum-ducimus-sed-maxime', '0', '0', '2018-09-03');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(35) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_polish_ci NOT NULL,
  `register` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `birth` date NOT NULL,
  `about` varchar(500) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `group` smallint(5) unsigned NOT NULL,
  `rank` smallint(5) unsigned NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL DEFAULT 'default.jpg',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `email` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  PRIMARY KEY (`id`,`group`,`rank`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `Relationship13` (`group`),
  KEY `Relationship15` (`rank`),
  CONSTRAINT `Relationship13` FOREIGN KEY (`group`) REFERENCES `groups` (`id`),
  CONSTRAINT `Relationship15` FOREIGN KEY (`rank`) REFERENCES `ranks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('14', 'marquardt.clotilde', '$2y$10$dPDZ3u9KbvQa80Vgx9hRw.wplA8BCh/r4SlHBWsIAM4TUFa1Ep6mW', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'angel98@yahoo.com');
INSERT INTO `users` VALUES ('15', 'brando.kling', '$2y$10$HRTXr5vE9eLMNoVhz9p9beUKmtzEuQItSuLzsYixwyWNsjYqmjOt.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'mckenzie.price@gmail.com');
INSERT INTO `users` VALUES ('16', 'jwolf', '$2y$10$F2.3oMJEofQ.xT.ltgPYo.c9hw/yG1MDCbiENUOz1JV1Z2IkCM1PK', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'llewellyn.schinner@gmail.com');
INSERT INTO `users` VALUES ('17', 'ileuschke', '$2y$10$xmhYQ2zjivNjpSnnoKbhQuaauCTEwzaqZFR4kA8G8l30eLxb3HlOm', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'emmerich.alycia@wuckert.org');
INSERT INTO `users` VALUES ('18', 'vhagenes', '$2y$10$UEUXd0AjJvVO13L9xG8El.r8fpsLPvnunyExAJ6TvVdWj6CJxr0h.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'scassin@corkery.com');
INSERT INTO `users` VALUES ('19', 'kreiger.constance', '$2y$10$/dj2meQiZ08IR/M2tmRTFuYOsUj1.873nwvL1VYe8FkkTZznlV/iu', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'vincenzo55@yahoo.com');
INSERT INTO `users` VALUES ('20', 'van67', '$2y$10$BSyVpW5DWE3EAK99o.Aaz.z55FGPpxx5V4H9eABGWBhGsAOtyDK3e', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'donnelly.sabryna@hotmail.com');
INSERT INTO `users` VALUES ('21', 'mueller.lauryn', '$2y$10$A0iur16ydV4vjWpgV4zbK.EAo1nn2FAP5fnHKGuK5euISMntcR.qi', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'mwisozk@oberbrunner.org');
INSERT INTO `users` VALUES ('22', 'zmueller', '$2y$10$bvtMMrHO541P0TInibqjN.KSBCH0SwWNoQpvEkncrSxqh7gJhGyhK', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'ratke.gillian@yahoo.com');
INSERT INTO `users` VALUES ('23', 'marquis.nitzsche', '$2y$10$RvUEnxBbNzkTXvKxqYF2K.FJA8OG0SiyN6Bb8Rf4NI4.Urm7S94mW', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', 'umayert@turcotte.com');

-- ----------------------------
-- Table structure for `warns`
-- ----------------------------
DROP TABLE IF EXISTS `warns`;
CREATE TABLE `warns` (
  `id` int(11) unsigned NOT NULL,
  `post` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL,
  PRIMARY KEY (`post`,`from`,`id`),
  UNIQUE KEY `id` (`id`),
  KEY `Relationship27` (`from`),
  CONSTRAINT `Relationship26` FOREIGN KEY (`post`) REFERENCES `posts` (`id`),
  CONSTRAINT `Relationship27` FOREIGN KEY (`from`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of warns
-- ----------------------------
