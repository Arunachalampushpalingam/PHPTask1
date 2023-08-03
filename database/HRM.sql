-- Adminer 4.8.1 MySQL 8.0.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `tbo_company`;
CREATE TABLE `tbo_company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbo_company` (`id`, `company_name`, `company_address`, `domain`, `country`, `state`, `city`, `created_at`, `updated_at`) VALUES
(1,	'sdfsd',	'sdfsdf',	'sdfsdf',	'sdfsdf',	'sdfsdf',	'sdfdsf',	'2023-08-03 12:45:50',	'2023-08-03 12:45:50'),
(2,	'werwe',	'werwer',	'wer',	'wer',	'wer',	'werwe',	'2023-08-03 12:45:50',	'2023-08-03 12:45:50');

DROP TABLE IF EXISTS `tbo_department`;
CREATE TABLE `tbo_department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `company_id` int NOT NULL,
  `created_by_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `tbo_department_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tbo_designation`;
CREATE TABLE `tbo_designation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(255) NOT NULL,
  `department_id` int NOT NULL,
  `company_id` int NOT NULL,
  `created_by_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `tbo_designation_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `tbo_department` (`id`),
  CONSTRAINT `tbo_designation_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tbo_employee`;
CREATE TABLE `tbo_employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emp_code` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `department` int NOT NULL,
  `designation` int NOT NULL,
  `joining_date` date NOT NULL,
  `last_date_of_employment` date NOT NULL,
  `salary` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `company_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `designation` (`designation`),
  KEY `company_id` (`company_id`),
  KEY `idx_department_designation` (`department`,`designation`),
  CONSTRAINT `tbo_employee_ibfk_1` FOREIGN KEY (`department`) REFERENCES `tbo_department` (`id`),
  CONSTRAINT `tbo_employee_ibfk_2` FOREIGN KEY (`designation`) REFERENCES `tbo_designation` (`id`),
  CONSTRAINT `tbo_employee_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tbo_employee_previous_experience`;
CREATE TABLE `tbo_employee_previous_experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `company_id` int NOT NULL,
  `job_title` int NOT NULL,
  `job_description` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `relieving_date` date NOT NULL,
  `achievements` text NOT NULL,
  `reference_name` varchar(255) NOT NULL,
  `reference_contact` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_employee_id` (`employee_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `tbo_employee_previous_experience_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbo_employee` (`id`),
  CONSTRAINT `tbo_employee_previous_experience_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tbo_employee_qualification`;
CREATE TABLE `tbo_employee_qualification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `company_id` int NOT NULL,
  `institution_name` varchar(255) NOT NULL,
  `percentage` int NOT NULL,
  `year_of_passing` year NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_employee_id` (`employee_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `tbo_employee_qualification_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbo_employee` (`id`),
  CONSTRAINT `tbo_employee_qualification_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tbo_jobcategory`;
CREATE TABLE `tbo_jobcategory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `job_level` int NOT NULL,
  `company_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_level` (`job_level`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `tbo_jobcategory_ibfk_1` FOREIGN KEY (`job_level`) REFERENCES `tbo_jobgrade` (`id`),
  CONSTRAINT `tbo_jobcategory_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tbo_jobgrade`;
CREATE TABLE `tbo_jobgrade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(255) NOT NULL,
  `grade_description` varchar(255) NOT NULL,
  `company_id` int NOT NULL,
  `created_by_id` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `tbo_jobgrade_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tbo_jobs`;
CREATE TABLE `tbo_jobs` (
  `id` int NOT NULL,
  `code` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `skillset` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `job_category` int NOT NULL,
  `job_subcategory` int NOT NULL,
  `company_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  KEY `job_subcategory` (`job_subcategory`),
  KEY `company_id` (`company_id`),
  KEY `idx_job_category_subcategory` (`job_category`,`job_subcategory`),
  CONSTRAINT `tbo_jobs_ibfk_1` FOREIGN KEY (`job_category`) REFERENCES `tbo_company` (`id`),
  CONSTRAINT `tbo_jobs_ibfk_2` FOREIGN KEY (`job_subcategory`) REFERENCES `tbo_company` (`id`),
  CONSTRAINT `tbo_jobs_ibfk_3` FOREIGN KEY (`job_category`) REFERENCES `tbo_jobcategory` (`id`),
  CONSTRAINT `tbo_jobs_ibfk_4` FOREIGN KEY (`job_subcategory`) REFERENCES `tbo_jobsubcategory` (`id`),
  CONSTRAINT `tbo_jobs_ibfk_5` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tbo_jobsubcategory`;
CREATE TABLE `tbo_jobsubcategory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(50) NOT NULL,
  `subcategory_desc` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `company_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `tbo_jobsubcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbo_jobcategory` (`id`),
  CONSTRAINT `tbo_jobsubcategory_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbo_jobcategory` (`id`),
  CONSTRAINT `tbo_jobsubcategory_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`),
  CONSTRAINT `tbo_jobsubcategory_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `tbo_jobcategory` (`id`),
  CONSTRAINT `tbo_jobsubcategory_ibfk_5` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tbo_resignation`;
CREATE TABLE `tbo_resignation` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL,
  `company_id` int NOT NULL,
  `reason_for_leaving` varchar(255) NOT NULL,
  `last_date_of_employment` date NOT NULL,
  `approval_date` date NOT NULL,
  `approved_by` int NOT NULL,
  `status` int NOT NULL,
  `reason_for_rejection` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  KEY `company_id` (`company_id`),
  KEY `approved_by` (`approved_by`),
  KEY `idx_employee_id_approved_by` (`employee_id`,`approved_by`),
  CONSTRAINT `tbo_resignation_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbo_employee` (`id`),
  CONSTRAINT `tbo_resignation_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `tbo_employee` (`id`),
  CONSTRAINT `tbo_resignation_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`),
  CONSTRAINT `tbo_resignation_ibfk_4` FOREIGN KEY (`employee_id`) REFERENCES `tbo_employee` (`id`),
  CONSTRAINT `tbo_resignation_ibfk_5` FOREIGN KEY (`company_id`) REFERENCES `tbo_company` (`id`),
  CONSTRAINT `tbo_resignation_ibfk_6` FOREIGN KEY (`approved_by`) REFERENCES `tbo_employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2023-08-03 10:31:48
