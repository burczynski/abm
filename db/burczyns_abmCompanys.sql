-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2017 at 03:19 PM
-- Server version: 5.5.54-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `burczyns_abmCompanys`
--

-- --------------------------------------------------------

--
-- Table structure for table `companys`
--

CREATE TABLE IF NOT EXISTS `companys` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `company_Cuit_number` varchar(13) NOT NULL,
  `company_status_id` int(11) NOT NULL,
  `company_total_employees` int(11) NOT NULL,
  PRIMARY KEY (`company_id`),
  KEY `company_status_id` (`company_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companys`
--

INSERT INTO `companys` (`company_id`, `company_name`, `company_Cuit_number`, `company_status_id`, `company_total_employees`) VALUES
(1, 'FENNOMA S.A.', '30-71233029-1', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `companysEmployees`
--

CREATE TABLE IF NOT EXISTS `companysEmployees` (
  `company_employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_employee_name` varchar(20) NOT NULL,
  `company_employee_lastName` varchar(20) NOT NULL,
  `company_employee_dni` int(8) NOT NULL,
  `company_employye_status_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`company_employee_id`),
  KEY `company_employye_status_id` (`company_employye_status_id`,`company_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companysEmployees`
--

INSERT INTO `companysEmployees` (`company_employee_id`, `company_employee_name`, `company_employee_lastName`, `company_employee_dni`, `company_employye_status_id`, `company_id`) VALUES
(1, 'Ricardo', 'Burczynski', 32601241, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `companysEmployeesStatus`
--

CREATE TABLE IF NOT EXISTS `companysEmployeesStatus` (
  `company_employee_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_employee_status_name` varchar(20) NOT NULL,
  PRIMARY KEY (`company_employee_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `companysEmployeesStatus`
--

INSERT INTO `companysEmployeesStatus` (`company_employee_status_id`, `company_employee_status_name`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Suspendido');

-- --------------------------------------------------------

--
-- Table structure for table `companysStatus`
--

CREATE TABLE IF NOT EXISTS `companysStatus` (
  `company_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_status_name` varchar(40) NOT NULL,
  PRIMARY KEY (`company_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `companysStatus`
--

INSERT INTO `companysStatus` (`company_status_id`, `company_status_name`) VALUES
(1, 'Activa'),
(2, 'Inactiva');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_user` varchar(40) NOT NULL,
  `user_pass` varchar(40) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_permission_id` int(11) NOT NULL,
  `user_status_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_role_id` (`user_role_id`,`user_permission_id`),
  KEY `user_permission_id` (`user_permission_id`),
  KEY `user_status_id` (`user_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_user`, `user_pass`, `user_role_id`, `user_permission_id`, `user_status_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 3, 1),
(2, 'Ricardo', 'f816917819e4a12665a989fbdc62bf5b', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usersPermissions`
--

CREATE TABLE IF NOT EXISTS `usersPermissions` (
  `user_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_permission_name` varchar(35) NOT NULL,
  PRIMARY KEY (`user_permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usersPermissions`
--

INSERT INTO `usersPermissions` (`user_permission_id`, `user_permission_name`) VALUES
(1, 'SoloLectura'),
(2, 'LecturaYEscritura'),
(3, 'LecturaEscrituraYEjecucion');

-- --------------------------------------------------------

--
-- Table structure for table `usersRoles`
--

CREATE TABLE IF NOT EXISTS `usersRoles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(35) NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usersRoles`
--

INSERT INTO `usersRoles` (`user_role_id`, `user_role_name`) VALUES
(1, 'AdminUser'),
(2, 'NormalUser');

-- --------------------------------------------------------

--
-- Table structure for table `usersStatus`
--

CREATE TABLE IF NOT EXISTS `usersStatus` (
  `user_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_status_name` varchar(40) NOT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `usersStatus`
--

INSERT INTO `usersStatus` (`user_status_id`, `user_status_name`) VALUES
(1, 'Activo');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companys`
--
ALTER TABLE `companys`
  ADD CONSTRAINT `companys_ibfk_1` FOREIGN KEY (`company_status_id`) REFERENCES `companysStatus` (`company_status_id`);

--
-- Constraints for table `companysEmployees`
--
ALTER TABLE `companysEmployees`
  ADD CONSTRAINT `companysEmployees_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companys` (`company_id`),
  ADD CONSTRAINT `companysEmployees_ibfk_1` FOREIGN KEY (`company_employye_status_id`) REFERENCES `companysEmployeesStatus` (`company_employee_status_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`user_status_id`) REFERENCES `usersStatus` (`user_status_id`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `usersRoles` (`user_role_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`user_permission_id`) REFERENCES `usersPermissions` (`user_permission_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
