CREATE DATABASE `SA`;
--
-- Table structure for table `userinfo`
--
 
 
CREATE TABLE `userinfo` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `adultcheck` bit NOT NULL,
  PRIMARY KEY (`idx`)
);
 
--
-- Dumping data for table `userinfo`
--
 
INSERT INTO `userinfo`(email, password, nickname, adultcheck) VALUES ('wjh0970@naver.com', '111111','teamleader',1);
