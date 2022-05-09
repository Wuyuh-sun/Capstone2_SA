--
-- DATABASE name = SA
--
CREATE DATABASE `dbsgk8218` default character set UTF8;
-- 
-- database selected
--
use `dbsgk8218`;
-- 
-- Table structure for table `userinfo`
--
CREATE TABLE `userinfo` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nickname` NVARCHAR(20) NOT NULL,
  `adultcheck` bit NOT NULL,
  `email_checkNum` int(11) NULL,
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `bbs_main`
--
CREATE TABLE `bbs_main` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `placename` varchar(20)NOT NULL COMMENT '장소',
  `author` varchar(20) NOT NULL COMMENT '게시글 작성자',
  `title` varchar(50) NOT NULL COMMENT '제목',
  `content` varchar(1000) NOT NULL COMMENT '내용',
  `regdate` DATETIME NOT NULL COMMENT '글 쓴 시간',
  `img_file` varchar(20) NULL COMMENT '이미지 파일명',
  `bbs_comm` int(1) NULL COMMENT '게시글 댓글',
  `good` int(11) NULL COMMENT '추천 수',
  `notice` int(11) NOT NULL COMMENT '공지',
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `bbs_comm`
--
CREATE TABLE `bbs_comm` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  
  `comm` varchar(100) NOT NULL,
  `author` varchar(20) NOT NULL,
  `class` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `groupNum` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
);








--
-- Dumping data for table `userinfo`
--
-- INSERT INTO `userinfo`(email, password, nickname, adultcheck) VALUES ('wjh0970@naver.com', '111111','teamleader',1);
