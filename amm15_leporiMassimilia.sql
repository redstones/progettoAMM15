-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Mag 08, 2016 alle 17:57
-- Versione del server: 5.5.44-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amm15_leporiMassimilia`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--
CREATE SCHEMA amm15_leporiMassimilia;

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomecategoria` varchar(30) DEFAULT NULL,
  `idcompetizione` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `competizioni_fk` (`idcompetizione`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`id`, `nomecategoria`, `idcompetizione`) VALUES
(1, 'Campionato Serie A', 1),
(2, 'Coppa Italia', 1),
(3, 'Supercoppa Italiana', 1),
(4, 'Uefa Champions League', 2),
(5, 'Coppa delle Coppe', 2),
(6, 'Supercoppa UEFA', 2),
(7, 'Coppa Intercontinentale', 2),
(8, 'Coppa del mondo per Club', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE IF NOT EXISTS `clienti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) DEFAULT NULL,
  `cognome` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `via` varchar(128) DEFAULT NULL,
  `numero_civico` int(128) DEFAULT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `clienti`
--

INSERT INTO `clienti` (`id`, `nome`, `cognome`, `email`, `via`, `numero_civico`, `citta`, `username`, `password`) VALUES
(1, 'davide', 'spano', 'spano@unica.it', 'ospedale', 52, 'Cagliari', 'davide', 'spano'),
(2, 'Pistorigheddu', 'Pistoriga', 'pistorigheddu@libero.it', 'giagianni', 31, 'aPampas', 'pistorigheddu', 'pistorigheddu');

-- --------------------------------------------------------

--
-- Struttura della tabella `competizioni`
--

CREATE TABLE IF NOT EXISTS `competizioni` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nomecompetizione` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `competizioni`
--

INSERT INTO `competizioni` (`id`, `nomecompetizione`) VALUES
(1, 'Competizioni Nazionali'),
(2, 'Competizioni Internazionali');

-- --------------------------------------------------------

--
-- Struttura della tabella `coppe`
--

CREATE TABLE IF NOT EXISTS `coppe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) DEFAULT NULL,
  `anno` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dump dei dati per la tabella `coppe`
--

INSERT INTO `coppe` (`id`, `idcategoria`, `anno`) VALUES
(1, 1, 1901),
(2, 1, 1906),
(3, 1, 1907),
(4, 1, 1951),
(5, 1, 1955),
(6, 1, 1957),
(7, 1, 1959),
(8, 1, 1962),
(9, 1, 1968),
(10, 1, 1979),
(11, 1, 1988),
(12, 1, 1992),
(13, 1, 1993),
(14, 1, 1994),
(15, 1, 1996),
(16, 1, 1999),
(17, 1, 2004),
(18, 1, 2011),
(19, 2, 1967),
(20, 2, 1972),
(21, 2, 1973),
(22, 2, 1977),
(23, 2, 2003),
(24, 3, 1988),
(25, 3, 1992),
(26, 3, 1993),
(27, 3, 1994),
(28, 3, 2004),
(29, 3, 2011),
(30, 4, 1963),
(31, 4, 1969),
(32, 4, 1989),
(33, 4, 1990),
(34, 4, 1994),
(36, 4, 2003),
(37, 4, 2007),
(41, 5, 1968),
(42, 5, 1973),
(43, 6, 1989),
(44, 6, 1990),
(45, 6, 1994),
(46, 6, 2003),
(47, 6, 2007),
(48, 7, 1969),
(49, 7, 1989),
(50, 7, 1990),
(51, 8, 2007);

-- --------------------------------------------------------

--
-- Struttura della tabella `gestori`
--

CREATE TABLE IF NOT EXISTS `gestori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) DEFAULT NULL,
  `cognome` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `via` varchar(128) DEFAULT NULL,
  `numero_civico` int(128) DEFAULT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `gestori`
--

INSERT INTO `gestori` (`id`, `nome`, `cognome`, `email`, `via`, `numero_civico`, `citta`, `username`, `password`) VALUES
(1, 'massimiliano', 'lepori', 'max@gmail.com', 'casamia', 28, 'miaCitta', 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
