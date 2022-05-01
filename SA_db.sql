--
-- DATABASE name = SA
--
CREATE DATABASE `SA` default character set UTF8;
-- 
-- database selected
--
use `SA`;
-- 
-- Table structure for table `userinfo`
--
CREATE TABLE `userinfo` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nickname` NVARCHAR(20) NOT NULL,
  `adultcheck` bit NOT NULL,
  `email_checkNum` int(11) NULL
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `table_name`
--










--
-- Dumping data for table `userinfo`
--
-- INSERT INTO `userinfo`(email, password, nickname, adultcheck) VALUES ('wjh0970@naver.com', '111111','teamleader',1);
