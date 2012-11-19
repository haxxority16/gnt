-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `imagedb`
--
CREATE DATABASE `imagedb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `imagedb`;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL,
  `image` longblob NOT NULL,
  `type` varchar(32) NOT NULL,
  `size` varchar(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

