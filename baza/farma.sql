-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2015 at 06:44 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `farma`
--
CREATE DATABASE IF NOT EXISTS `farma` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `farma`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(3, 'farma', 'farmafarma');

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` (
  `idnovost` int(20) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(20) NOT NULL,
  `tekst` varchar(45) NOT NULL,
  PRIMARY KEY (`idnovost`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`idnovost`, `naslov`, `tekst`) VALUES
(1, 'Neki naslov', 'Neki tekst');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE IF NOT EXISTS `proizvodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` date NOT NULL,
  `naziv1` varchar(254) NOT NULL,
  `naziv2` varchar(254) NOT NULL,
  `slika` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `date_added`, `naziv1`, `naziv2`, `slika`) VALUES
(33, '2014-11-23', 'MLADI', 'PILICI', ''),
(39, '2014-12-21', 'JAJA', 'PREPELICE', ''),
(48, '2014-12-24', 'MLADI', 'KUNICI', ''),
(53, '2014-12-24', 'MLADE', 'PREPELICE', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `userlevel` enum('a','b','c','d') NOT NULL DEFAULT 'a',
  `avatar` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `signup` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `notescheck` datetime NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gender`, `website`, `country`, `userlevel`, `avatar`, `ip`, `signup`, `lastlogin`, `notescheck`, `activated`) VALUES
(1, 'njnmn', 'nm,nmmn@gmail.com', 'm1l17d$2q941e1n1v1q9$1$OB1.9a5.$rgqFZgzEgcAfkT58TpTpA/fnm9y1$3mvg11$a$$a1l', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 10:11:21', '2014-12-25 10:11:21', '2014-12-25 10:11:21', '0'),
(2, 'Andreja', 'andreja.stanojkovic@gmail.com', '6a$8$cg1y6$jbk9b$80v$1$Xm/.Ui..$YA5m8f1C3MZ7luKo07Dgk08ji7yqp7$kqz$muy1w11', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 10:13:02', '2014-12-25 10:13:02', '2014-12-25 10:13:02', '0'),
(3, 'andrejaa', 'asddas@gasd.com', '1zh42v$1i101118r$ax1$1$/s1.aG4.$u7F2CtAWcwqJx1zl8szG1.8pha8zusq1u0lb$$37d$', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 10:57:38', '2014-12-25 10:57:38', '2014-12-25 10:57:38', '0'),
(4, 'nasdsadlk', 'sadnlnasd', 'urcfb1vy$1$i$m$1rdmx$1$5J0.o31.$54AE9GQIT.9tPbHF7c1120rli$$ob$kf$$6rzc$1dz', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 11:05:29', '2014-12-25 11:05:29', '2014-12-25 11:05:29', '0'),
(5, 'dfsjk', 'jdsjkdsf', 'iotc19co181$$eh1331m$1$ZY/.uf0.$ppjEBIDK6n..5U0ipwfQv0xwa2$5i1raz$1b1u8fz0', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 11:06:05', '2014-12-25 11:06:05', '2014-12-25 11:06:05', '0'),
(6, 'sdfkh', 'asjlkdasd', 'p3of6mqsyl11j$$h114$$1$ht0.We0.$YcPPFXxJL8.3tYud/ElDl1fkc11avv11f$$8dzfsnl', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 11:07:21', '2014-12-25 11:07:21', '2014-12-25 11:07:21', '0'),
(7, 'kjsad', 'sadlkj', 'ju1j$bpyk190q1v11on$$1$ab/.bg2.$F72JI1Dx7QlNIoxdZqv0X10$1yzlfpgz1k$c1cv$p7', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 11:36:37', '2014-12-25 11:36:37', '2014-12-25 11:36:37', '0'),
(8, 'sdkljf', 'fsdjlk', '$3e1$110752ky1q$n$gk$1$OL1.9c..$vyu3M4Ci0LS8gv0Y71LDf0m11avdclqb7$1yl$$1l1', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 11:37:16', '2014-12-25 11:37:16', '2014-12-25 11:37:16', '0'),
(9, 'anan', 'anan', '9oh$$zc1$1fysr1pk8ob$1$BI1.0n1.$Qzxe.guEDO1eA2r5GinDb1eewq1ee71u116618wipx', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 11:38:52', '2014-12-25 11:38:52', '2014-12-25 11:38:52', '0'),
(10, 'annn', 'asd', 'p1x$t9209da$69kt56$9$1$ru3.YM2.$KS4H.xwLpZ3pPtEHzY4bz11$rwm4oqa1o$p1m104$1', 'f', NULL, '', 'a', NULL, '1', '2014-12-25 11:41:04', '2014-12-25 11:41:04', '2014-12-25 11:41:04', '0'),
(11, 'sds', 'ads', '0b11$1s1r1aigk1vb6pa$1$rN3.Y92.$vvg9ETeuVf4ITS9vI5ivc11$$$s1scx$$are1fpfj1', 'm', NULL, '', 'a', NULL, '1', '2014-12-25 11:49:00', '2014-12-25 11:49:00', '2014-12-25 11:49:00', '0'),
(12, 'andrejaand', 'an@gmail.com', 'l0jxc$700$z2ot$4r1gj$1$4I/.5T5.$tHmiQWJ8oH9qsrVFmchdM1j$s03of6mqsyl11j$$h1', '', NULL, '', 'a', NULL, '1', '2014-12-25 12:28:23', '2014-12-25 12:28:23', '2014-12-25 12:28:23', '0'),
(13, 'andrejaasd', 'andreja.stanasdojkovic@gmail.comasd', '$752ky1q$n$gkm11avdc$1$rL/.Yl2.$20f/siA/Ad1QI1SV9qYDA0lqb7$1yl$$1l1r1x$t92', 'm', NULL, '', 'a', NULL, '1', '2014-12-26 14:46:12', '2014-12-26 14:46:12', '2014-12-26 14:46:12', '0');

-- --------------------------------------------------------

--
-- Table structure for table `vrsta`
--

CREATE TABLE IF NOT EXISTS `vrsta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vrsta` varchar(255) NOT NULL,
  `cena` varchar(255) NOT NULL,
  `detalji` varchar(255) NOT NULL,
  `date_added` date NOT NULL,
  `zivotinja` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `vrsta`
--

INSERT INTO `vrsta` (`id`, `vrsta`, `cena`, `detalji`, `date_added`, `zivotinja`) VALUES
(61, 'SA ROSTILJA', '1000', 'SDFSFDSDFSSDSD DSFDSfds dsf', '2014-12-23', 33),
(62, 'nkads', 'jnfsanj', 'nj', '2014-12-23', 33),
(63, 'jk', 'j', 'jk', '2014-12-24', 33),
(64, 'dfgfd', 'dfg', 'dfg', '2014-12-26', 48);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
