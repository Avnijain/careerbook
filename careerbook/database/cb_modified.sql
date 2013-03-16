-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2013 at 05:40 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `careerbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `name` char(35) COLLATE utf8_unicode_ci NOT NULL COMMENT 'CITY NAME',
  `state_id` int(11) unsigned NOT NULL COMMENT 'THIS WILL BE STATE ID OF STATE TABLE',
  PRIMARY KEY (`id`),
  KEY `FK_state_id_to_id` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_details`
--

CREATE TABLE IF NOT EXISTS `group_details` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'group id act as primary key',
  `title` bigint(11) unsigned NOT NULL COMMENT 'title of the group',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'description of the group',
  `group_image` blob COMMENT 'group image',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'user id of group creator',
  `created_on` datetime NOT NULL COMMENT 'creation time of group',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'last updation time by user',
  `status` enum('A','D') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'status of group whether active or not',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='keeps records of group details' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_discussions`
--

CREATE TABLE IF NOT EXISTS `group_discussions` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'group discussion id act as primary key',
  `group_id` bigint(11) unsigned NOT NULL COMMENT 'group id of group',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'description of topic',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'user id of group creator',
  `created_on` datetime NOT NULL COMMENT 'creation time of group',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'last updation time by user',
  PRIMARY KEY (`id`),
  KEY `fk_group_id` (`group_id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='keeps records of user group discussions' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_discussion_comments`
--

CREATE TABLE IF NOT EXISTS `group_discussion_comments` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'group comment id act as primary key',
  `discussion_id` bigint(11) unsigned NOT NULL COMMENT 'discussion id of group',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'description of comment',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'user id of group creator',
  `created_on` datetime NOT NULL COMMENT 'creation time of group',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'last updation time by user',
  PRIMARY KEY (`id`),
  KEY `fk_discussion_id` (`discussion_id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='keeps records of user comment in a group discussion' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_log`
--

CREATE TABLE IF NOT EXISTS `group_log` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'log id act as primary key',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'user id',
  `user_ip_address` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user ip address',
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'log time of user activity',
  `group_id` bigint(11) unsigned NOT NULL COMMENT 'group id on which activity perform',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='keeps logs of group activity' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE IF NOT EXISTS `group_members` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary id',
  `group_id` bigint(11) unsigned NOT NULL COMMENT 'group id of group',
  `member_id` bigint(11) unsigned NOT NULL COMMENT 'member user id',
  PRIMARY KEY (`id`),
  KEY `fk_group_id` (`group_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='keeps records of group members' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messaging`
--

CREATE TABLE IF NOT EXISTS `messaging` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'messaging id act as primary key',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'description of messaging',
  `user_from` bigint(11) unsigned NOT NULL COMMENT 'user id of sender',
  `user_to` bigint(11) unsigned NOT NULL COMMENT 'user id of reciever',
  `messaging_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'messaging time',
  PRIMARY KEY (`id`),
  KEY `user_to` (`user_to`),
  KEY `user_from` (`user_from`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `name` char(35) COLLATE utf8_unicode_ci NOT NULL COMMENT 'STATE NAME',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'career book uers id',
  `first_name` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user first name ',
  `middle_name` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user middle name',
  `last_name` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user last name',
  `date_of_birth` datetime NOT NULL COMMENT 'user date of birth',
  `email_primary` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user valid primary  email id',
  `email_secondary` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user valid  secondary email id',
  `phone_no` bigint(20) DEFAULT NULL COMMENT 'user phone number',
  `gender` enum('male','female') NOT NULL COMMENT 'user gender',
  `password` text NOT NULL COMMENT 'user encrypted password',
  `status` enum('A','D','I') NOT NULL DEFAULT 'A' COMMENT 'user status A for Active D for Deleted and I for Inactive ',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'last updation time of user',
  `created_on` datetime NOT NULL COMMENT 'account creation time of user',
  `updated_by` bigint(11) unsigned DEFAULT NULL COMMENT 'userid who update this account',
  `created_by` bigint(11) unsigned DEFAULT NULL COMMENT 'userid who create this account',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `email_primary`, `email_secondary`, `phone_no`, `gender`, `password`, `status`, `updated_on`, `created_on`, `updated_by`, `created_by`) VALUES
(1, 'Administrator', NULL, NULL, '2013-03-01 00:00:00', 'admin@admin.com', NULL, 12345, 'male', '7d793037a0760186574b0282f2f435', 'A', '2013-03-01 18:26:59', '2013-03-01 00:00:00', NULL, NULL),
(14, 'Mohit', 'K', 'Singh', '1988-09-20 00:00:00', 'lookforward007@gmail.com', NULL, 8375959679, 'male', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2013-03-02 07:37:55', '2013-03-02 07:37:55', NULL, NULL),
(17, 'Rahul', NULL, 'Kumar', '1988-09-20 00:00:00', 'timetorock1001@gmail.com', NULL, 8375959679, 'male', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2013-03-03 18:07:36', '2013-03-03 06:07:36', NULL, NULL),
(18, 'rahul', NULL, 'singh', '1988-09-20 00:00:00', 'rahul@osscube.com', NULL, 8375959679, 'male', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2013-03-04 04:09:15', '2013-03-04 09:39:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_academic_info`
--

CREATE TABLE IF NOT EXISTS `user_academic_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `board_10` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '10TH STANDARD BOARD',
  `school_10` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '10TH STANDARF SCHOOL',
  `percentage_GPA_10` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE IN 10TH STANDARD',
  `board_12` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '12TH STANDARD BOARD',
  `school_12` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '12TH STANDARF SCHOOL',
  `percentage_12` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE IN 12TH STANDARD',
  `graduation_degree` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'GRADUATION DEGREE',
  `graduation_specialization` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'GRADUATION SPECIALIZATION',
  `graduation_college` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'GRADUATION COLLEGE',
  `graduation_percentage` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE IN GRADUATION STANDARD',
  `post_graduation_degree` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'POST GRADUATION DEGREE',
  `post_graduation_specialization` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'POST GRADUATION SPECIALIZATION',
  `post_graduation_college` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'POST GRADUATION COLLEGE',
  `post_graduation_percentage` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE IN POST GRADUATION STANDARD',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_achievements`
--

CREATE TABLE IF NOT EXISTS `user_achievements` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `achievement` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'USER ACHIEVEMENT',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_discussion`
--

CREATE TABLE IF NOT EXISTS `user_discussion` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `group_id` bigint(11) unsigned DEFAULT NULL COMMENT 'THIS WILL BE LINKED TO ID OF GROUP TABLE',
  `topic_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'DESCRIPTION OF TOPIC',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'USER ID WHO CREATED DISCUSSION',
  `created_on` datetime NOT NULL COMMENT 'discussion creation time',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'last updation time by user',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_discussion_comments`
--

CREATE TABLE IF NOT EXISTS `user_discussion_comments` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `discussion_id` bigint(11) unsigned DEFAULT NULL COMMENT 'THIS WILL BE LINKED TO ID OF DISCUSSION TABLE',
  `comment_discusn_form` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'COMMENT ON Discussion',
  `created_by` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `created_on` datetime NOT NULL COMMENT 'discussion creation time',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'last updation time by user',
  PRIMARY KEY (`id`),
  KEY `FK_discussion_id_to_id` (`discussion_id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_other_academic_info`
--

CREATE TABLE IF NOT EXISTS `user_other_academic_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `degree` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'DEGREE',
  `specialization` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SPECIALIZATION',
  `college` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'COLLEGE',
  `percentage` int(3) unsigned zerofill DEFAULT NULL COMMENT 'PERCENTAGE',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_personal_info`
--

CREATE TABLE IF NOT EXISTS `user_personal_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'USER HOME ADDRESS',
  `city_id` int(11) unsigned NOT NULL COMMENT 'THIS WILL BE CITY ID OF CITY TABLE',
  `profile_image` mediumblob COMMENT 'USER IMAGE',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'updation time of the user',
  PRIMARY KEY (`id`),
  KEY `FK_city_id_to_id` (`city_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_previous_job_info`
--

CREATE TABLE IF NOT EXISTS `user_previous_job_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `position` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'USER CURRENT JOB POSITION',
  `company` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'USER CURRENT COMPANY',
  `start_period` date DEFAULT NULL COMMENT 'USER OLD JOB START PERIOD',
  `end_period` date DEFAULT NULL COMMENT 'USER OLD JOB END PERIOD',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_professional_info`
--

CREATE TABLE IF NOT EXISTS `user_professional_info` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'THIS WILL BE AUTO GENERATED UNIQUE ID',
  `user_id` bigint(11) unsigned NOT NULL COMMENT 'THIS WILL BE USER ID OF USER TABLE',
  `skill_set` text COLLATE utf8_unicode_ci COMMENT 'USER SKILL SET',
  `current_position` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'USER CURRENT JOB POSITION',
  `current_company` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'USER CURRENT COMPANY',
  `start_period` date DEFAULT NULL COMMENT 'USER CURRENT JOB START PERIOD',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `FK_state_id_to_id` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`);

--
-- Constraints for table `group_discussions`
--
ALTER TABLE `group_discussions`
  ADD CONSTRAINT `group_discussions_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_discussion_comments`
--
ALTER TABLE `group_discussion_comments`
  ADD CONSTRAINT `group_discussion_comments_ibfk_1` FOREIGN KEY (`discussion_id`) REFERENCES `group_discussions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_log`
--
ALTER TABLE `group_log`
  ADD CONSTRAINT `group_log_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `group_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_log_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_academic_info`
--
ALTER TABLE `user_academic_info`
  ADD CONSTRAINT `user_academic_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_discussion`
--
ALTER TABLE `user_discussion`
  ADD CONSTRAINT `user_discussion_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_discussion_comments`
--
ALTER TABLE `user_discussion_comments`
  ADD CONSTRAINT `FK_discussion_id_to_id` FOREIGN KEY (`discussion_id`) REFERENCES `user_discussion` (`id`),
  ADD CONSTRAINT `user_discussion_comments_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_other_academic_info`
--
ALTER TABLE `user_other_academic_info`
  ADD CONSTRAINT `user_other_academic_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_personal_info`
--
ALTER TABLE `user_personal_info`
  ADD CONSTRAINT `FK_city_id_to_id` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `user_personal_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_previous_job_info`
--
ALTER TABLE `user_previous_job_info`
  ADD CONSTRAINT `user_previous_job_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_professional_info`
--
ALTER TABLE `user_professional_info`
  ADD CONSTRAINT `user_professional_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
