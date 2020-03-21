-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Client: sql101.byetcluster.com
-- Généré le: Dim 19 Mai 2019 à 09:11
-- Version du serveur: 5.6.21-69.0
-- Version de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hkda_23446369_ecomm`
--

CREATE DATABASE myEcomm
-- --------------------------------------------------------

--
-- Structure de la table `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `idDiscount` int(11) NOT NULL AUTO_INCREMENT,
  `idProduct` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idDiscount`),
  UNIQUE KEY `idProduct` (`idProduct`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;


-- --------------------------------------------------------

--
-- Structure de la table `emailVerified`
--

CREATE TABLE IF NOT EXISTS `emailVerified` (
  `idEmailVerified` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idEmailVerified`),
  KEY `EmailVerified_Users` (`idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Contenu de la table `emailVerified`
--

INSERT INTO `emailVerified` (`idEmailVerified`, `idUser`, `token`, `created_at`, `deleted_at`) VALUES
(1, 1, 'LM3ZBFANE1S0RYTW5VPQO9DJUG6K2NXH4I78C5ca9ebed2b4f2', '2019-04-07 16:24:26', '2019-04-07');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `idFaq` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  `answer` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idFaq`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `faq`
--

INSERT INTO `faq` (`idFaq`, `question`, `answer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Question 1 ?', 'Answer 1', '2019-04-07 00:59:37', NULL, NULL),
(2, 'Question 2 ?', 'Answer 2', '2019-04-07 00:59:37', NULL, NULL),
(3, 'Question 3 ?', 'Answer 3', '2019-04-07 00:59:37', NULL, NULL),
(4, 'Question 4 ?', 'Answer 4', '2019-04-07 00:59:37', NULL, NULL),
(5, 'Question 5 ?', 'Answer 5', '2019-04-07 00:59:37', NULL, NULL),
(6, 'Question 6 ?', 'Answer 6', '2019-04-07 00:59:37', NULL, NULL),
(7, 'Question 7 ?', 'Answer 7', '2019-04-07 00:59:37', NULL, NULL),
(8, 'Question 8 ?', 'Answer 8', '2019-04-07 00:59:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `forgetPass`
--

CREATE TABLE IF NOT EXISTS `forgetPass` (
  `idForgetPass` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idForgetPass`),
  KEY `idUser` (`idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Contenu de la table `forgetPass`
--

INSERT INTO `forgetPass` (`idForgetPass`, `idUser`, `token`, `created_at`, `deleted_at`) VALUES
(1, 1, '0S13XQOE8JG2DF54MYBRZL9KUAHWI6TVP7CN5ca9ec1f13d60', '2019-04-07 16:25:25', '2019-04-07');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `idProduct` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idProduct`,`idUser`),
  KEY `idUser` (`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `myCart`
--

CREATE TABLE IF NOT EXISTS `myCart` (
  `idProduct` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idProduct`,`idUser`),
  KEY `idUser` (`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


-- --------------------------------------------------------

--
-- Structure de la table `newsLetter`
--

CREATE TABLE IF NOT EXISTS `newsLetter` (
  `idSubscribe` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idSubscribe`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Contenu de la table `newsLetter`
--

INSERT INTO `newsLetter` (`idSubscribe`, `email`, `created_at`, `deleted_at`) VALUES
(1, 'hahaha@hhh.com', '2019-04-08 02:48:44', NULL),
(2, 'aaa@aaa.com', '2019-04-08 14:56:21', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `idProduct` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idSize` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `season` varchar(30) DEFAULT NULL,
  `amount` int(5) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idProduct`),
  KEY `idUser` (`idUser`),
  KEY `idSize` (`idSize`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Structure de la table `productImg`
--

CREATE TABLE IF NOT EXISTS `productImg` (
  `idImg` int(11) NOT NULL AUTO_INCREMENT,
  `idProduct` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idImg`),
  KEY `idProduct` (`idProduct`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Structure de la table `productSize`
--

CREATE TABLE IF NOT EXISTS `productSize` (
  `idSize` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idSize`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=12 ;

--
-- Contenu de la table `productSize`
--

INSERT INTO `productSize` (`idSize`, `size`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'S', '2019-03-18 23:58:12', NULL, NULL),
(7, 'M', '2019-03-18 23:58:20', NULL, NULL),
(8, 'L', '2019-03-18 23:58:49', NULL, NULL),
(9, 'XL', '2019-03-18 23:58:58', NULL, NULL),
(10, 'XXL', '2019-03-18 23:59:04', NULL, NULL),
(11, 'XXXL', '2019-03-18 23:59:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `productTags`
--

CREATE TABLE IF NOT EXISTS `productTags` (
  `idTag` int(11) NOT NULL AUTO_INCREMENT,
  `idProduct` int(11) DEFAULT NULL,
  `tag` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idTag`),
  KEY `idProduct` (`idProduct`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Structure de la table `rate`
--

CREATE TABLE IF NOT EXISTS `rate` (
  `idProduct` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idProduct`,`idUser`),
  KEY `idUser` (`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `idReview` int(11) NOT NULL AUTO_INCREMENT,
  `idProduct` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `review` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idReview`),
  KEY `idProduct` (`idProduct`),
  KEY `idUser` (`idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `idSale` int(11) NOT NULL AUTO_INCREMENT,
  `idProduct` int(11) DEFAULT NULL,
  `idBuyer` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idSale`),
  KEY `idProduct` (`idProduct`),
  KEY `idBuyer` (`idBuyer`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `passwordUser` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `zipCode` int(7) DEFAULT NULL,
  `aboutMe` text,
  `avatar` varchar(255) DEFAULT NULL,
  `confirmedEmail` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`idUser`, `username`, `email`, `passwordUser`, `birthday`, `adresse`, `zipCode`, `aboutMe`, `avatar`, `confirmedEmail`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', '2016-11-30', 'admin', 4, 'admin', '2P4EUXKYFL1CO7ZIQMT9SH8GNB0J56AVDW3R5caa7ccda1da2.jpg', 1, '2019-04-08 02:42:21', NULL, NULL),
(2, 'ayoub', 'amzil.ayoob@gmail.com', '202cb962ac59075b964b07152d234b70', '2018-11-30', 'TEST', 123, '123', '', 0, '2019-04-08 06:01:50', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
