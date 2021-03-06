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
  `email_checkNum` int(11) NULL,
  `user_grade` nvarchar(30) null,
  `user_profileImg` nvarchar(30) null,
  PRIMARY KEY (`idx`)
);
--
-- Dumping data for table `userinfo`
--
-- INSERT INTO `userinfo`(email, password, nickname, adultcheck) VALUES ('wjh0970@naver.com', '111111','teamleader',1);

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
-- Table structure for table `good_data`
--
CREATE TABLE `good_data` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `click_user` varchar(20) NOT NULL,
  `placename` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content_idx` varchar(20) NOT NULL,
  `good` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `bbs_comm`
--
CREATE TABLE `bbs_comm` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `bbs_idx` int(11) NULL,
  `placename` varchar(50) NULL,
  `title` varchar(50) NULL,
  `comm_author` varchar(20) NULL,
  `comm_content` varchar(1000) NULL,
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `bbs_comm_comm`
--
CREATE TABLE `bbs_comm_comm` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `bbs_idx` int(11) NULL,
  `placename` varchar(50) NULL,
  `title` varchar(50) NULL,
  `comm_idx` varchar(1000) NULL,
  `comm_author` varchar(20) NULL,
  `comm_content` varchar(1000) NULL,
  `comm_comm_author` varchar(20) NULL,
  `comm_comm_content` varchar(1000) NULL,
  PRIMARY KEY (`idx`)
);

--
-- Table structure for table `faq_main`
--
CREATE TABLE `faq_main` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `placename` varchar(20)NOT NULL COMMENT '장소',
  `author` varchar(20) NOT NULL COMMENT '게시글 작성자',
  `title` varchar(50) NOT NULL COMMENT '제목',
  `content` varchar(1000) NOT NULL COMMENT '내용',
  `regdate` DATETIME NOT NULL COMMENT '글 쓴 시간',
  `qna` int(11) NULL COMMENT 'qna',
  `bbs_comm` int(1) NULL COMMENT '게시글 댓글',
  `good` int(11) NULL COMMENT '추천 수',
  `notice` int(11) NOT NULL COMMENT '공지',
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `faq_good_data`
--
CREATE TABLE `faq_good_data` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `click_user` varchar(20) NOT NULL,
  `placename` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content_idx` varchar(20) NOT NULL,
  `good` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `faq_comm`
--
CREATE TABLE `faq_comm` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `bbs_idx` int(11) NULL,
  `placename` varchar(50) NULL,
  `title` varchar(50) NULL,
  `comm_author` varchar(20) NULL,
  `comm_content` varchar(1000) NULL,
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `faq_comm_comm`
--
CREATE TABLE `faq_comm_comm` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `bbs_idx` int(11) NULL,
  `placename` varchar(50) NULL,
  `title` varchar(50) NULL,
  `comm_idx` varchar(1000) NULL,
  `comm_author` varchar(20) NULL,
  `comm_content` varchar(1000) NULL,
  `comm_comm_author` varchar(20) NULL,
  `comm_comm_content` varchar(1000) NULL,
  PRIMARY KEY (`idx`)
);

--
-- Table structure for table `sa_info`
--
CREATE TABLE `sa_info` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `placename` varchar(30) NULL,
  `road_address` varchar(30) NULL,
  `address` varchar(30) NOT NULL,
  `lat` float(53) NOT NULL,
  `lng` float(53) NOT NULL,
  `placeImg` varchar(30) NULL,
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `friends`
--
CREATE TABLE `friends` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NULL,
  `friendname` varchar(30) NULL,
  `get` int(11) NULL,
  `send` int(11) NULL,
  `friend` int(11) NULL,
  PRIMARY KEY (`idx`)
);
--
-- Table structure for table `friends`
--
CREATE TABLE `chatlog` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `send_username` varchar(30) NULL,
  `get_username` varchar(30) NULL,
  `msg`varchar(1000) NULL,
  PRIMARY KEY (`idx`)
);





