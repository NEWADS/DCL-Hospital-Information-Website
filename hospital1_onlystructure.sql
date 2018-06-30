-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-05-13 10:36:43
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital1`
--

-- --------------------------------------------------------

--
-- 表的结构 `hospital_1`
--

CREATE TABLE `hospital_1` (
  `ID` int(11) NOT NULL,
  `Username` char(20) DEFAULT NULL,
  `Patient_Name` char(20) NOT NULL,
  `Age` int(11) NOT NULL,
  `birthplace` varchar(10) NOT NULL,
  `job` varchar(10) NOT NULL,
  `MarAge` int(11) NOT NULL,
  `company` varchar(11) NOT NULL,
  `address` varchar(20) NOT NULL,
  `phone` int(11) NOT NULL,
  `Menarchedate` date NOT NULL COMMENT '初潮日期',
  `menstrualcycle` int(11) NOT NULL COMMENT '月经周期',
  `duedate` date NOT NULL COMMENT '预产期',
  `borntime` int(2) NOT NULL COMMENT '生产次数',
  `pregnenttime` int(2) NOT NULL COMMENT '怀孕次数',
  `LMP` date DEFAULT '1970-01-01' COMMENT '末次月经',
  `PMH` text CHARACTER SET gb2312 COMMENT '既往史',
  `PC` text CHARACTER SET gb2312 COMMENT '主诉',
  `condi` text CHARACTER SET gb2312 COMMENT '此次妊娠情况',
  `operationhistory` varchar(50) NOT NULL COMMENT '手术史',
  `doctorname` int(2) NOT NULL DEFAULT '1' COMMENT '医生',
  `referral` int(1) NOT NULL DEFAULT '0' COMMENT '转诊情况',
  `post` int(1) NOT NULL DEFAULT '0',
  `Password` char(20) NOT NULL DEFAULT '123456',
  `Email` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hospital_1`
--
ALTER TABLE `hospital_1`
  ADD PRIMARY KEY (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
