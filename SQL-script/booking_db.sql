-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2016 at 07:33 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Booking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Booking`
--

CREATE TABLE `Booking` (
  `ticket_no` int(11) NOT NULL,
  `row_no` char(3) NOT NULL,
  `date_time` datetime NOT NULL,
  `Customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cus_Id` int(11) NOT NULL,
  `order_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Booking`
--

INSERT INTO `Booking` (`ticket_no`, `row_no`, `date_time`, `Customer_name`, `address`, `cus_Id`, `order_Id`) VALUES
(1, 'A01', '2016-04-01 12:00:00', 'Ted Baker', '', 0, 0),
(2, 'A02', '2016-04-01 18:00:00', 'Ted Baker', '', 0, 0),
(3, 'A03', '2016-04-02 12:00:00', 'Ted Baker', '', 0, 0),
(4, 'A04', '2016-04-02 18:00:00', 'Ted Baker', '', 0, 0),
(5, 'A05', '2016-04-01 15:00:00', 'Ted Baker', '', 0, 0),
(6, 'A06', '2016-04-01 21:00:00', 'Ted Baker', '', 0, 0),
(7, 'A07', '2016-04-02 15:00:00', 'Ted Baker', '', 0, 0),
(8, 'A08', '2016-04-02 21:00:00', 'Ted Baker', '', 0, 0),
(9, 'A09', '2016-04-03 15:00:00', 'Ted Baker', '', 0, 0),
(10, 'A10', '2016-04-03 21:00:00', 'Ted Baker', '', 0, 0),
(11, 'A11', '2016-04-04 15:00:00', 'Ted Baker', '', 0, 0),
(12, 'A12', '2016-04-04 21:00:00', 'Ted Baker', '', 0, 0),
(13, 'A13', '2016-04-01 12:00:00', 'Mary Brown', '', 0, 0),
(14, 'A14', '2016-04-01 18:00:00', 'Mary Brown', '', 0, 0),
(15, 'A15', '2016-04-02 12:00:00', 'Mary Brown', '', 0, 0),
(16, 'A16', '2016-04-02 18:00:00', 'Mary Brown', '', 0, 0),
(17, 'A17', '2016-04-01 15:00:00', 'Mary Brown', '', 0, 0),
(18, 'A18', '2016-04-01 21:00:00', 'Mary Brown', '', 0, 0),
(19, 'A19', '2016-04-02 15:00:00', 'Mary Brown', '', 0, 0),
(20, 'A20', '2016-04-02 21:00:00', 'Mary Brown', '', 0, 0),
(21, 'B01', '2016-04-03 15:00:00', 'Mary Brown', '', 0, 0),
(22, 'B02', '2016-04-03 21:00:00', 'Mary Brown', '', 0, 0),
(23, 'B03', '2016-04-04 15:00:00', 'Mary Brown', '', 0, 0),
(24, 'B04', '2016-04-04 21:00:00', 'Mary Brown', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `cus_Id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `address` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`cus_Id`, `name`, `address`, `email`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `logon`
--

CREATE TABLE `logon` (
  `email` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `cus_Id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logon`
--

INSERT INTO `logon` (`email`, `username`, `pwd`, `cus_Id`) VALUES 
('me@me.com', 'mememem', 'c22cb5926a1e9a967d76d1816b62433e', 67);

-- --------------------------------------------------------

--
-- Table structure for table `newBooking`
--

CREATE TABLE `newBooking` (
  `ticket_no` int(11) NOT NULL,
  `row_no` char(3) NOT NULL,
  `date_time` datetime NOT NULL,
  `Customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `area_name` char(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nwBooking`
--

CREATE TABLE `nwBooking` (
  `ticket_no` int(11) NOT NULL,
  `row_no` char(3) NOT NULL,
  `date_time` datetime NOT NULL,
  `Customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cus_Id` int(11) NOT NULL,
  `order_Id` int(11) NOT NULL,
  `area_name` char(12) NOT NULL,
  `title` varchar(32) NOT NULL,
  `price` decimal(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_Id` int(11) NOT NULL,
  `cus_Id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `trans_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_Id`, `cus_Id`, `email`, `trans_date`) VALUES
(108, 74, 'dfgdfgdg@sdfsd.com', '2016-10-20'),

-- --------------------------------------------------------

--
-- Table structure for table `Performance`
--

CREATE TABLE `Performance` (
  `date_time` datetime NOT NULL,
  `title` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Performance`
--

INSERT INTO `Performance` (`date_time`, `title`) VALUES
('2016-04-01 12:00:00', 'M.S. Dhoni - The Untold S'),
('2016-04-01 18:00:00', 'M.S. Dhoni - The Untold S'),
('2016-04-02 12:00:00', 'M.S. Dhoni - The Untold S'),
('2016-04-02 18:00:00', 'M.S. Dhoni - The Untold S'),
('2016-04-01 15:00:00', 'The Girl On The Train'),
('2016-04-01 21:00:00', 'The Girl On The Train'),
('2016-04-02 15:00:00', 'The Girl On The Train'),
('2016-04-02 21:00:00', 'The Girl On The Train'),
('2016-04-03 15:00:00', 'Storks'),
('2016-04-03 21:00:00', 'Storks'),
('2016-04-04 15:00:00', 'Storks'),
('2016-04-04 21:00:00', 'Storks'),
('2016-05-01 12:00:00', 'Inferno');

-- --------------------------------------------------------

--
-- Table structure for table `Production`
--

CREATE TABLE `Production` (
  `title` varchar(25) NOT NULL,
  `basicPrice` decimal(5,2) NOT NULL,
  `embedcode` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Production`
--

INSERT INTO `Production` (`title`, `basicPrice`, `embedcode`) VALUES
('M.S. Dhoni - The Untold S', '1.00', 'https://www.youtube.com/embed/6L6XqWoS8tw?rel=0&showinfo=0'),
('The Girl On The Train', '1.50', 'https://www.youtube.com/embed/y5yk-HGqKmM?rel=0&showinfo=0'),
('Storks', '2.00', 'https://www.youtube.com/embed/5yl2wb1-6SQ?rel=0&showinfo=0'),
('Inferno', '1.00', 'https://www.youtube.com/embed/RH2BD49sEZI?rel=0&showinfo=0');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `row_no` char(3) NOT NULL,
  `area_name` char(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`row_no`, `area_name`) VALUES
('A01', 'R City'),
('A02', 'R City'),
('A03', 'R City'),
('A04', 'R City'),
('A05', 'R City'),
('A06', 'R City'),
('A07', 'R City'),
('A08', 'R City'),
('A09', 'R City'),
('A10', 'R City'),
('A11', 'R City'),
('A12', 'R City'),
('A13', 'R City'),
('A14', 'R City'),
('A15', 'R City'),
('A16', 'R City'),
('A17', 'R City'),
('A18', 'R City'),
('A19', 'R City'),
('A20', 'R City'),
('B01', 'R City'),
('B02', 'R City'),
('B03', 'R City'),
('B04', 'R City'),
('B05', 'R City'),
('B06', 'R City'),
('B07', 'R City'),
('B08', 'R City'),
('B09', 'R City'),
('B10', 'R City'),
('B11', 'R City'),
('B12', 'R City'),
('B13', 'R City'),
('B14', 'R City'),
('B15', 'R City'),
('B16', 'R City'),
('B17', 'R City'),
('B18', 'R City'),
('B19', 'R City'),
('B20', 'R City'),
('C01', 'R City'),
('C02', 'R City'),
('C03', 'R City'),
('C04', 'R City'),
('C05', 'R City'),
('C06', 'R City'),
('C07', 'R City'),
('C08', 'R City'),
('C09', 'R City'),
('C10', 'R City'),
('C11', 'R City'),
('C12', 'R City'),
('C13', 'R City'),
('C14', 'R City'),
('C15', 'R City'),
('C16', 'R City'),
('C17', 'R City'),
('C18', 'R City'),
('C19', 'R City'),
('C20', 'R City'),
('D01', 'R City'),
('D02', 'R City'),
('D03', 'R City'),
('D04', 'R City'),
('D05', 'R City'),
('D06', 'R City'),
('D07', 'R City'),
('D08', 'R City'),
('D09', 'R City'),
('D10', 'R City'),
('D11', 'R City'),
('D12', 'R City'),
('D13', 'R City'),
('D14', 'R City'),
('D15', 'R City'),
('D16', 'R City'),
('D17', 'R City'),
('D18', 'R City'),
('D19', 'R City'),
('D20', 'R City'),
('E01', 'R City'),
('E02', 'R City'),
('E03', 'R City'),
('E04', 'R City'),
('E05', 'R City'),
('E06', 'R City'),
('E07', 'R City'),
('E08', 'R City'),
('E09', 'R City'),
('E10', 'R City'),
('E11', 'R City'),
('E12', 'R City'),
('E13', 'R City'),
('E14', 'R City'),
('E15', 'R City'),
('E16', 'R City'),
('E17', 'R City'),
('E18', 'R City'),
('E19', 'R City'),
('E20', 'R City'),
('F01', 'R City'),
('F02', 'R City'),
('F03', 'R City'),
('F04', 'R City'),
('F05', 'R City'),
('F06', 'R City'),
('F07', 'R City'),
('F08', 'R City'),
('F09', 'R City'),
('F10', 'R City'),
('F11', 'R City'),
('F12', 'R City'),
('F13', 'R City'),
('F14', 'R City'),
('F15', 'R City'),
('F16', 'R City'),
('F17', 'R City'),
('F18', 'R City'),
('F19', 'R City'),
('F20', 'R City'),
('G01', 'R City'),
('G02', 'R City'),
('G03', 'R City'),
('G04', 'R City'),
('G05', 'R City'),
('G06', 'R City'),
('G07', 'R City'),
('G08', 'R City'),
('G09', 'R City'),
('G10', 'R City'),
('G11', 'R City'),
('G12', 'R City'),
('G13', 'R City'),
('G14', 'R City'),
('G15', 'R City'),
('G16', 'R City'),
('G17', 'R City'),
('G18', 'R City'),
('G19', 'R City'),
('G20', 'R City'),
('H01', 'R City'),
('H02', 'R City'),
('H03', 'R City'),
('H04', 'R City'),
('H05', 'R City'),
('H06', 'R City'),
('H07', 'R City'),
('H08', 'R City'),
('H09', 'R City'),
('H10', 'R City'),
('H11', 'R City'),
('H12', 'R City'),
('H13', 'R City'),
('H14', 'R City'),
('H15', 'R City'),
('H16', 'R City'),
('H17', 'R City'),
('H18', 'R City'),
('H19', 'R City'),
('H20', 'R City'),
('I01', 'R City'),
('I02', 'R City'),
('I03', 'R City'),
('I04', 'R City'),
('I05', 'R City'),
('I06', 'R City'),
('I07', 'R City'),
('I08', 'R City'),
('I09', 'R City'),
('I10', 'R City'),
('I11', 'R City'),
('I12', 'R City'),
('I13', 'R City'),
('I14', 'R City'),
('I15', 'R City'),
('I16', 'R City'),
('I17', 'R City'),
('I18', 'R City'),
('I19', 'R City'),
('I20', 'R City'),
('J01', 'R City'),
('J02', 'R City'),
('J03', 'R City'),
('J04', 'R City'),
('J05', 'R City'),
('J06', 'R City'),
('J07', 'R City'),
('J08', 'R City'),
('J09', 'R City'),
('J10', 'R City'),
('J11', 'R City'),
('J12', 'R City'),
('J13', 'R City'),
('J14', 'R City'),
('J15', 'R City'),
('J16', 'R City'),
('J17', 'R City'),
('J18', 'R City'),
('J19', 'R City'),
('J20', 'R City'),
('K01', 'PVR Kurla'),
('K02', 'PVR Kurla'),
('K03', 'PVR Kurla'),
('K04', 'PVR Kurla'),
('K05', 'PVR Kurla'),
('K06', 'PVR Kurla'),
('K07', 'PVR Kurla'),
('K08', 'PVR Kurla'),
('K09', 'PVR Kurla'),
('K10', 'PVR Kurla'),
('K11', 'PVR Kurla'),
('K12', 'PVR Kurla'),
('K13', 'PVR Kurla'),
('K14', 'PVR Kurla'),
('K15', 'PVR Kurla'),
('K16', 'PVR Kurla'),
('K17', 'PVR Kurla'),
('K18', 'PVR Kurla'),
('K19', 'PVR Kurla'),
('K20', 'PVR Kurla'),
('L01', 'PVR Kurla'),
('L02', 'PVR Kurla'),
('L03', 'PVR Kurla'),
('L04', 'PVR Kurla'),
('L05', 'PVR Kurla'),
('L06', 'PVR Kurla'),
('L07', 'PVR Kurla'),
('L08', 'PVR Kurla'),
('L09', 'PVR Kurla'),
('L10', 'PVR Kurla'),
('L11', 'PVR Kurla'),
('L12', 'PVR Kurla'),
('L13', 'PVR Kurla'),
('L14', 'PVR Kurla'),
('L15', 'PVR Kurla'),
('L16', 'PVR Kurla'),
('L17', 'PVR Kurla'),
('L18', 'PVR Kurla'),
('L19', 'PVR Kurla'),
('L20', 'PVR Kurla'),
('M01', 'PVR Kurla'),
('M02', 'PVR Kurla'),
('M03', 'PVR Kurla'),
('M04', 'PVR Kurla'),
('M05', 'PVR Kurla'),
('M06', 'PVR Kurla'),
('M07', 'PVR Kurla'),
('M08', 'PVR Kurla'),
('M09', 'PVR Kurla'),
('M10', 'PVR Kurla'),
('M11', 'PVR Kurla'),
('M12', 'PVR Kurla'),
('M13', 'PVR Kurla'),
('M14', 'PVR Kurla'),
('M15', 'PVR Kurla'),
('M16', 'PVR Kurla'),
('M17', 'PVR Kurla'),
('M18', 'PVR Kurla'),
('M19', 'PVR Kurla'),
('M20', 'PVR Kurla'),
('N01', 'PVR Kurla'),
('N02', 'PVR Kurla'),
('N03', 'PVR Kurla'),
('N04', 'PVR Kurla'),
('N05', 'PVR Kurla'),
('N06', 'PVR Kurla'),
('N07', 'PVR Kurla'),
('N08', 'PVR Kurla'),
('N09', 'PVR Kurla'),
('N10', 'PVR Kurla'),
('N11', 'PVR Kurla'),
('N12', 'PVR Kurla'),
('N13', 'PVR Kurla'),
('N14', 'PVR Kurla'),
('N15', 'PVR Kurla'),
('N16', 'PVR Kurla'),
('N17', 'PVR Kurla'),
('N18', 'PVR Kurla'),
('N19', 'PVR Kurla'),
('N20', 'PVR Kurla'),
('O01', 'PVR Kurla'),
('O02', 'PVR Kurla'),
('O03', 'PVR Kurla'),
('O04', 'PVR Kurla'),
('O05', 'PVR Kurla'),
('O06', 'PVR Kurla'),
('O07', 'PVR Kurla'),
('O08', 'PVR Kurla'),
('O09', 'PVR Kurla'),
('O10', 'PVR Kurla'),
('O11', 'PVR Kurla'),
('O12', 'PVR Kurla'),
('O13', 'PVR Kurla'),
('O14', 'PVR Kurla'),
('O15', 'PVR Kurla'),
('O16', 'PVR Kurla'),
('O17', 'PVR Kurla'),
('O18', 'PVR Kurla'),
('O19', 'PVR Kurla'),
('O20', 'PVR Kurla'),
('P01', 'PVR Kurla'),
('P02', 'PVR Kurla'),
('P03', 'PVR Kurla'),
('P04', 'PVR Kurla'),
('P05', 'PVR Kurla'),
('P06', 'PVR Kurla'),
('P07', 'PVR Kurla'),
('P08', 'PVR Kurla'),
('P09', 'PVR Kurla'),
('P10', 'PVR Kurla'),
('P11', 'PVR Kurla'),
('P12', 'PVR Kurla'),
('P13', 'PVR Kurla'),
('P14', 'PVR Kurla'),
('P15', 'PVR Kurla'),
('P16', 'PVR Kurla'),
('P17', 'PVR Kurla'),
('P18', 'PVR Kurla'),
('P19', 'PVR Kurla'),
('P20', 'PVR Kurla'),
('Q01', 'PVR Kurla'),
('Q02', 'PVR Kurla'),
('Q03', 'PVR Kurla'),
('Q04', 'PVR Kurla'),
('Q05', 'PVR Kurla'),
('Q06', 'PVR Kurla'),
('Q07', 'PVR Kurla'),
('Q08', 'PVR Kurla'),
('Q09', 'PVR Kurla'),
('Q10', 'PVR Kurla'),
('Q11', 'PVR Kurla'),
('Q12', 'PVR Kurla'),
('Q13', 'PVR Kurla'),
('Q14', 'PVR Kurla'),
('Q15', 'PVR Kurla'),
('Q16', 'PVR Kurla'),
('Q17', 'PVR Kurla'),
('Q18', 'PVR Kurla'),
('Q19', 'PVR Kurla'),
('Q20', 'PVR Kurla'),
('R01', 'PVR Kurla'),
('R02', 'PVR Kurla'),
('R03', 'PVR Kurla'),
('R04', 'PVR Kurla'),
('R05', 'PVR Kurla'),
('R06', 'PVR Kurla'),
('R07', 'PVR Kurla'),
('R08', 'PVR Kurla'),
('R09', 'PVR Kurla'),
('R10', 'PVR Kurla'),
('R11', 'PVR Kurla'),
('R12', 'PVR Kurla'),
('R13', 'PVR Kurla'),
('R14', 'PVR Kurla'),
('R15', 'PVR Kurla'),
('R16', 'PVR Kurla'),
('R17', 'PVR Kurla'),
('R18', 'PVR Kurla'),
('R19', 'PVR Kurla'),
('R20', 'PVR Kurla'),
('S01', 'PVR Kurla'),
('S02', 'PVR Kurla'),
('S03', 'PVR Kurla'),
('S04', 'PVR Kurla'),
('S05', 'PVR Kurla'),
('S06', 'PVR Kurla'),
('S07', 'PVR Kurla'),
('S08', 'PVR Kurla'),
('S09', 'PVR Kurla'),
('S10', 'PVR Kurla'),
('S11', 'PVR Kurla'),
('S12', 'PVR Kurla'),
('S13', 'PVR Kurla'),
('S14', 'PVR Kurla'),
('S15', 'PVR Kurla'),
('S16', 'PVR Kurla'),
('S17', 'PVR Kurla'),
('S18', 'PVR Kurla'),
('S19', 'PVR Kurla'),
('S20', 'PVR Kurla'),
('T01', 'PVR Kurla'),
('T02', 'PVR Kurla'),
('T03', 'PVR Kurla'),
('T04', 'PVR Kurla'),
('T05', 'PVR Kurla'),
('T06', 'PVR Kurla'),
('T07', 'PVR Kurla'),
('T08', 'PVR Kurla'),
('T09', 'PVR Kurla'),
('T10', 'PVR Kurla'),
('T11', 'PVR Kurla'),
('T12', 'PVR Kurla'),
('T13', 'PVR Kurla'),
('T14', 'PVR Kurla'),
('T15', 'PVR Kurla'),
('T16', 'PVR Kurla'),
('T17', 'PVR Kurla'),
('T18', 'PVR Kurla'),
('T19', 'PVR Kurla'),
('T20', 'PVR Kurla'),
('U01', 'PVR Sion'),
('U02', 'PVR Sion'),
('U03', 'PVR Sion'),
('U04', 'PVR Sion'),
('U05', 'PVR Sion'),
('U06', 'PVR Sion'),
('U07', 'PVR Sion'),
('U08', 'PVR Sion'),
('U09', 'PVR Sion'),
('U10', 'PVR Sion'),
('U11', 'PVR Sion'),
('U12', 'PVR Sion'),
('U13', 'PVR Sion'),
('U14', 'PVR Sion'),
('U15', 'PVR Sion'),
('U16', 'PVR Sion'),
('U17', 'PVR Sion'),
('U18', 'PVR Sion'),
('U19', 'PVR Sion'),
('U20', 'PVR Sion'),
('V01', 'PVR Sion'),
('V02', 'PVR Sion'),
('V03', 'PVR Sion'),
('V04', 'PVR Sion'),
('V05', 'PVR Sion'),
('V06', 'PVR Sion'),
('V07', 'PVR Sion'),
('V08', 'PVR Sion'),
('V09', 'PVR Sion'),
('V10', 'PVR Sion'),
('V11', 'PVR Sion'),
('V12', 'PVR Sion'),
('V13', 'PVR Sion'),
('V14', 'PVR Sion'),
('V15', 'PVR Sion'),
('V16', 'PVR Sion'),
('V17', 'PVR Sion'),
('V18', 'PVR Sion'),
('V19', 'PVR Sion'),
('V20', 'PVR Sion'),
('W01', 'PVR Sion'),
('W02', 'PVR Sion'),
('W03', 'PVR Sion'),
('W04', 'PVR Sion'),
('W05', 'PVR Sion'),
('W06', 'PVR Sion'),
('W07', 'PVR Sion'),
('W08', 'PVR Sion'),
('W09', 'PVR Sion'),
('W10', 'PVR Sion'),
('W11', 'PVR Sion'),
('W12', 'PVR Sion'),
('W13', 'PVR Sion'),
('W14', 'PVR Sion'),
('W15', 'PVR Sion'),
('W16', 'PVR Sion'),
('W17', 'PVR Sion'),
('W18', 'PVR Sion'),
('W19', 'PVR Sion'),
('W20', 'PVR Sion'),
('X01', 'PVR Sion'),
('X02', 'PVR Sion'),
('X03', 'PVR Sion'),
('X04', 'PVR Sion'),
('X05', 'PVR Sion'),
('X06', 'PVR Sion'),
('X07', 'PVR Sion'),
('X08', 'PVR Sion'),
('X09', 'PVR Sion'),
('X10', 'PVR Sion'),
('X11', 'PVR Sion'),
('X12', 'PVR Sion'),
('X13', 'PVR Sion'),
('X14', 'PVR Sion'),
('X15', 'PVR Sion'),
('X16', 'PVR Sion'),
('X17', 'PVR Sion'),
('X18', 'PVR Sion'),
('X19', 'PVR Sion'),
('X20', 'PVR Sion'),
('Y01', 'PVR Sion'),
('Y02', 'PVR Sion'),
('Y03', 'PVR Sion'),
('Y04', 'PVR Sion'),
('Y05', 'PVR Sion'),
('Y06', 'PVR Sion'),
('Y07', 'PVR Sion'),
('Y08', 'PVR Sion'),
('Y09', 'PVR Sion'),
('Y10', 'PVR Sion'),
('Y11', 'PVR Sion'),
('Y12', 'PVR Sion'),
('Y13', 'PVR Sion'),
('Y14', 'PVR Sion'),
('Y15', 'PVR Sion'),
('Y16', 'PVR Sion'),
('Y17', 'PVR Sion'),
('Y18', 'PVR Sion'),
('Y19', 'PVR Sion'),
('Y20', 'PVR Sion'),
('Z01', 'IMAX Wadala'),
('Z02', 'IMAX Wadala'),
('Z03', 'IMAX Wadala'),
('Z04', 'IMAX Wadala'),
('Z05', 'R ODean'),
('Z06', 'R ODean'),
('Z07', 'R ODean'),
('Z08', 'R ODean'),
('Z09', 'Matunga Cine'),
('Z10', 'Matunga Cine'),
('Z11', 'Matunga Cine'),
('Z12', 'Matunga Cine'),
('Z13', 'Matunga Cine'),
('Z14', 'Matunga Cine'),
('Z15', 'PVR Tilak Na'),
('Z16', 'PVR Tilak Na'),
('Z17', 'PVR Tilak Na'),
('Z18', 'PVR Tilak Na'),
('Z19', 'PVR Tilak Na'),
('Z20', 'PVR Tilak Na');

-- --------------------------------------------------------

--
-- Table structure for table `tarea`
--

CREATE TABLE `tarea` (
  `name` char(12) NOT NULL,
  `price_multiplier` float NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarea`
--

INSERT INTO `tarea` (`name`, `price_multiplier`) VALUES
('IMAX Wadala', 1),
('R ODean', 1.5),
('Matunga Cine', 2),
('PVR Tilak Na', 2.5),
('PVR Sion', 3),
('INOX Neelyog', 3.5),
('R City', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tempBooking`
--

CREATE TABLE `tempBooking` (
  `ticket_no` int(11) NOT NULL DEFAULT '0',
  `row_no` char(3) NOT NULL,
  `date_time` datetime NOT NULL,
  `Customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Booking`
--
ALTER TABLE `Booking`
  ADD PRIMARY KEY (`ticket_no`),
  ADD UNIQUE KEY `row_no` (`row_no`,`date_time`),
  ADD KEY `date_time` (`date_time`),
  ADD KEY `order_Id` (`order_Id`),
  ADD KEY `cus_Id` (`cus_Id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`cus_Id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `logon`
--
ALTER TABLE `logon`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `cus_Id` (`cus_Id`),
  ADD KEY `email` (`email`),
  ADD KEY `username_2` (`username`);

--
-- Indexes for table `newBooking`
--
ALTER TABLE `newBooking`
  ADD PRIMARY KEY (`ticket_no`),
  ADD UNIQUE KEY `row_no` (`row_no`,`date_time`),
  ADD KEY `date_time` (`date_time`);

--
-- Indexes for table `nwBooking`
--
ALTER TABLE `nwBooking`
  ADD PRIMARY KEY (`ticket_no`),
  ADD UNIQUE KEY `row_no` (`row_no`,`date_time`),
  ADD KEY `date_time` (`date_time`),
  ADD KEY `cus_Id` (`cus_Id`),
  ADD KEY `order_Id` (`order_Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_Id`),
  ADD KEY `cus_Id` (`cus_Id`);

--
-- Indexes for table `Performance`
--
ALTER TABLE `Performance`
  ADD PRIMARY KEY (`date_time`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `Production`
--
ALTER TABLE `Production`
  ADD PRIMARY KEY (`title`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`row_no`),
  ADD KEY `area_name` (`area_name`);

--
-- Indexes for table `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Booking`
--
ALTER TABLE `Booking`
  MODIFY `ticket_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `cus_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `newBooking`
--
ALTER TABLE `newBooking`
  MODIFY `ticket_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `nwBooking`
--
ALTER TABLE `nwBooking`
  MODIFY `ticket_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=573;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
