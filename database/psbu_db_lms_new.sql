/*
 Navicat Premium Dump SQL

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 80043 (8.0.43)
 Source Host           : localhost:3306
 Source Schema         : psbu_db_lms

 Target Server Type    : MySQL
 Target Server Version : 80043 (8.0.43)
 File Encoding         : 65001

 Date: 18/10/2025 16:00:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for nan_attendances
-- ----------------------------
DROP TABLE IF EXISTS `nan_attendances`;
CREATE TABLE `nan_attendances` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `student_id` int NOT NULL DEFAULT '0',
  `checkin_at` datetime DEFAULT NULL,
  `checkout_at` datetime DEFAULT NULL,
  `total_time` decimal(10,0) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `code` (`code`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `id_2` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_attendances
-- ----------------------------
BEGIN;
INSERT INTO `nan_attendances` (`id`, `code`, `student_id`, `checkin_at`, `checkout_at`, `total_time`, `note`, `created_by`, `created_at`, `updated_at`) VALUES (6, 'QUOTE-56919613', 24, '2025-03-12 00:02:43', NULL, NULL, NULL, 1, '2025-03-13 04:02:43', NULL);
INSERT INTO `nan_attendances` (`id`, `code`, `student_id`, `checkin_at`, `checkout_at`, `total_time`, `note`, `created_by`, `created_at`, `updated_at`) VALUES (7, 'Att-28580951', 24, '2025-04-17 21:43:54', NULL, NULL, NULL, 1, '2025-04-18 11:43:54', NULL);
INSERT INTO `nan_attendances` (`id`, `code`, `student_id`, `checkin_at`, `checkout_at`, `total_time`, `note`, `created_by`, `created_at`, `updated_at`) VALUES (8, 'Att-2867162', 23, '2025-04-17 21:43:54', NULL, NULL, NULL, 1, '2025-04-18 11:43:54', NULL);
COMMIT;

-- ----------------------------
-- Table structure for nan_book_borrowers
-- ----------------------------
DROP TABLE IF EXISTS `nan_book_borrowers`;
CREATE TABLE `nan_book_borrowers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_id` int NOT NULL DEFAULT '0',
  `borrower_id` int NOT NULL DEFAULT '0',
  `quantity` decimal(16,0) DEFAULT NULL,
  `book_code` varchar(55) DEFAULT NULL,
  `book_name` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `id_2` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_book_borrowers
-- ----------------------------
BEGIN;
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (45, 13, 25, 1, 'B-16286783509', 'ប្រជុំនិទានបិដក');
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (46, 14, 26, 1, 'B-696537532364', 'នានាធម្មសង្គហៈ');
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (47, 23, 26, 1, 'B-28259050979', 'ដំណើរជីវិត');
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (48, 7, 27, 1, '982948', 'Testing');
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (49, 25, 27, 1, 'B-30397470', 'Helloworl');
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (50, 7, 28, 1, '982948', 'Testing');
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (51, 26, 29, 1, 'B-83573166', 'Python programming');
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (52, 7, 29, 1, '982948', 'Testing');
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (53, 17, 30, 10, 'B-932229420541', 'មង្គលជីវិត');
INSERT INTO `nan_book_borrowers` (`id`, `book_id`, `borrower_id`, `quantity`, `book_code`, `book_name`) VALUES (54, 14, 30, 20, 'B-696537532364', 'នានាធម្មសង្គហៈ');
COMMIT;

-- ----------------------------
-- Table structure for nan_books
-- ----------------------------
DROP TABLE IF EXISTS `nan_books`;
CREATE TABLE `nan_books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(1000) DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `views` int NOT NULL DEFAULT '0',
  `author` varchar(60) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `category_lang_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `code` (`code`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `id_2` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_books
-- ----------------------------
BEGIN;
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (7, '982948', 'Testing', '284a1ddf1155059f0cf3bba23f0fd6dec00531a9faf558ee4d8b45f05f2388ab', 'This for testing', '982948', 0, 'ប្រាក់​ ចន្ធី', '2025-01-18', 11, 14, NULL, '2024-10-02 20:45:04', NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (9, '982949', 'Testing 2', '385e8a40125e88e9a61ac120c3b9eb65f3e72b73727e473715085854e0ee3948', '&lt;p&gt;testing 2&lt;/p&gt;', '982949', 0, 'tesla', '2025-01-18', 11, 20, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (13, 'B-16286783509', 'ប្រជុំនិទានបិដក', NULL, '', 'ប្រជុំនិទានបិដក', 0, 'សុគន្ធា', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (14, 'B-696537532364', 'នានាធម្មសង្គហៈ', NULL, '', 'នានាធម្មសង្គហៈ', 0, 'សុគន្ធា', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (15, 'B-354631362051', 'ឃារាវាសធម៌', NULL, '', 'ឃារាវាសធម៌', 0, 'ប្រាក់​ ចន្ធី', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (16, 'B-282195496662', 'ជីវិតបដិវត្តន៍', NULL, '', 'ជីវិតបដិវត្តន៍', 0, 'សុគន្ធា', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (17, 'B-932229420541', 'មង្គលជីវិត', NULL, '', 'មង្គលជីវិត', 0, 'សុគន្ធា', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (18, 'B-958315153564', 'វិន័យសាមណេរ', NULL, '', 'វិន័យសាមណេរ', 0, 'ប្រាក់​ ចន្ធី', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (19, 'B-934803828115', 'សុខភាពនៃជីវិត', NULL, '', 'សុខភាពនៃជីវិត', 0, 'សុគន្ធា', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (20, 'B-376762557315', 'វិធីចេញចាកសង្ឃាទិសេសបត្តិ', NULL, '', 'វិធីចេញចាកសង្ឃាទិសេសបត្តិ', 0, 'ប្រាក់​ ចន្ធី', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (21, 'B-55960723304', 'សិក្សាពុទ្ធប្បវត្តិភាគ២', NULL, '', 'សិក្សាពុទ្ធប្បវត្តិភាគ២', 0, 'សុគន្ធា', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (22, 'B-225673831365', 'សិក្សាព្រះធម៌', NULL, '', 'សិក្សាព្រះធម៌', 0, 'ប្រាក់​ ចន្ធី', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (23, 'B-28259050979', 'ដំណើរជីវិត', NULL, '', 'ដំណើរជីវិត', 0, 'ប្រាក់​ ចន្ធី', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (24, 'B-409157193611', 'វិសុទ្ធមគ្គ', NULL, '', 'វិសុទ្ធមគ្គ', 0, 'សុគន្ធា', '2025-01-27', 12, 21, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (25, 'B-30397470', 'Helloworl', '2017d56f176e4ad25781e478c257e91491c876cbd2d4a791dc27837455c6f680', '&lt;p&gt;This is book for coding&lt;/p&gt;', 'Helloworl', 0, 'Coding', '2024-12-29', 11, 12, NULL, NULL, NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (26, 'B-83573166', 'Python programming', 'a90487fabfa4a456ca6fd1e8535e317601219fc0502799f9af4db7787186ae16', '&lt;p&gt;testing&nbsp;&lt;/p&gt;', 'Python_programming', 0, 'Chou Chamnan', '2025-01-11', 11, 13, 1, '2025-03-04 20:53:50', NULL);
INSERT INTO `nan_books` (`id`, `code`, `title`, `image`, `details`, `slug`, `views`, `author`, `author_date`, `category_lang_id`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES (36, '09992', 'simple-book', NULL, NULL, 'simple-slug', 0, 'chamnna', '2025-04-12', 11, 13, 1, '2025-04-19 03:37:49', '2025-04-19 03:37:49');
COMMIT;

-- ----------------------------
-- Table structure for nan_borrowers
-- ----------------------------
DROP TABLE IF EXISTS `nan_borrowers`;
CREATE TABLE `nan_borrowers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(50) NOT NULL,
  `student_id` int NOT NULL DEFAULT '0',
  `note` varchar(1000) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `term` decimal(16,0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `code` (`reference_no`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `id_2` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_borrowers
-- ----------------------------
BEGIN;
INSERT INTO `nan_borrowers` (`id`, `reference_no`, `student_id`, `note`, `status`, `start_date`, `end_date`, `created_by`, `created_at`, `updated_at`, `term`) VALUES (26, 'PO-4857962460', 23, '&lt;p&gt;Testing coding&lt;/p&gt;', 'repayed', '2025-03-10', '2025-03-10', 1, '2025-03-12 03:14:08', NULL, NULL);
INSERT INTO `nan_borrowers` (`id`, `reference_no`, `student_id`, `note`, `status`, `start_date`, `end_date`, `created_by`, `created_at`, `updated_at`, `term`) VALUES (27, 'PO-4244683843', 23, '&lt;p&gt;Yes borrower&lt;/p&gt;', 'repayed', '2025-03-11', '2025-03-11', 1, '2025-03-12 04:08:41', NULL, NULL);
INSERT INTO `nan_borrowers` (`id`, `reference_no`, `student_id`, `note`, `status`, `start_date`, `end_date`, `created_by`, `created_at`, `updated_at`, `term`) VALUES (28, 'PO-1216323692', 24, '&lt;p&gt;Hello&lt;/p&gt;', 'repayed', '2025-03-11', '2025-03-11', 1, '2025-03-12 14:28:36', NULL, NULL);
INSERT INTO `nan_borrowers` (`id`, `reference_no`, `student_id`, `note`, `status`, `start_date`, `end_date`, `created_by`, `created_at`, `updated_at`, `term`) VALUES (29, 'PO-6802488787', 23, '&lt;p&gt;Testing coding&lt;/p&gt;', 'repayed', '2025-05-05', '2025-05-05', 1, '2025-05-06 02:01:39', NULL, NULL);
INSERT INTO `nan_borrowers` (`id`, `reference_no`, `student_id`, `note`, `status`, `start_date`, `end_date`, `created_by`, `created_at`, `updated_at`, `term`) VALUES (30, 'PO-5071386843', 24, '&lt;p&gt;Testing coding&lt;/p&gt;', 'repayed', '2025-05-05', '2025-06-25', 1, '2025-05-06 02:03:06', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for nan_categories
-- ----------------------------
DROP TABLE IF EXISTS `nan_categories`;
CREATE TABLE `nan_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(65) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `description` text,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_categories
-- ----------------------------
BEGIN;
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (12, 'horror', 'Horror', NULL, NULL, 'horror', '&lt;p&gt;&lt;strong style=&quot;color: rgb(0, 29, 53); font-family: &quot;Google Sans&quot;, Arial, sans-serif;&quot;&gt;Horror&nbsp;&lt;/strong&gt;&lt;span style=&quot;color: rgb(84, 93, 126); font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 14px; letter-spacing: 0.1px;&quot;&gt;A genre that aims to create feelings of fear, dread, and terror in the reader&lt;/span&gt;&lt;/p&gt;', 0, NULL, NULL);
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (13, 'science_fiction', 'Science fiction', NULL, NULL, 'science_fiction', '&lt;p&gt;&lt;strong style=&quot;color: rgb(0, 29, 53); font-family: &quot;Google Sans&quot;, Arial, sans-serif;&quot;&gt;Science fiction&nbsp;&lt;/strong&gt;&lt;span style=&quot;color: rgb(84, 93, 126); font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 14px; letter-spacing: 0.1px;&quot;&gt;A genre that focuses on real or realistic science, often set in the distant future&lt;/span&gt;&lt;/p&gt;', 0, NULL, NULL);
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (14, 'fantasy', 'Fantasy', NULL, NULL, 'fantasy', '&lt;p&gt;&lt;strong style=&quot;color: rgb(0, 29, 53); font-family: &quot;Google Sans&quot;, Arial, sans-serif;&quot;&gt;Fantasy&nbsp;&lt;/strong&gt;&lt;span style=&quot;background-color: rgb(229, 237, 255); color: rgb(84, 93, 126); font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 14px; letter-spacing: 0.1px;&quot;&gt;A genre that features strange or otherworldly settings or characters, and invites the reader to suspend reality&lt;/span&gt;&lt;/p&gt;', 0, NULL, NULL);
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (15, 'mystery', 'Mystery', NULL, NULL, 'mystery', '&lt;p&gt;&lt;strong style=&quot;color: rgb(0, 29, 53); font-family: &quot;Google Sans&quot;, Arial, sans-serif;&quot;&gt;Mystery&nbsp;&lt;/strong&gt;&lt;span style=&quot;color: rgb(84, 93, 126); font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 14px; letter-spacing: 0.1px;&quot;&gt;A genre that focuses on a puzzling crime, situation, or circumstance that needs to be solved&lt;/span&gt;&lt;span class=&quot;UV3uM&quot; style=&quot;text-wrap-mode: nowrap; color: rgb(84, 93, 126); font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 14px; letter-spacing: 0.1px;&quot;&gt;&nbsp;&lt;/span&gt;&lt;/p&gt;', 0, NULL, NULL);
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (16, 'historical_romance', 'Historical romance', NULL, NULL, 'historical_romance', '&lt;p&gt;&lt;strong style=&quot;color: rgb(0, 29, 53); font-family: &quot;Google Sans&quot;, Arial, sans-serif;&quot;&gt;Historical romance&nbsp;&lt;/strong&gt;&lt;span style=&quot;color: rgb(84, 93, 126); font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 14px; letter-spacing: 0.1px;&quot;&gt;A genre that features romance stories set in a specific historic era&lt;/span&gt;&lt;/p&gt;', 0, NULL, NULL);
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (17, 'magical_realism', 'Magical realism', NULL, NULL, 'magical_realism', '&lt;p&gt;&lt;strong style=&quot;color: rgb(0, 29, 53); font-family: &quot;Google Sans&quot;, Arial, sans-serif;&quot;&gt;Magical realism&nbsp;&lt;/strong&gt;&lt;span style=&quot;color: rgb(84, 93, 126); font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 14px; letter-spacing: 0.1px;&quot;&gt;A genre that depicts the world truthfully, but also adds magical elements that are considered normal in the story&#039;s world&lt;/span&gt;&lt;/p&gt;', 0, NULL, NULL);
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (18, 'children\'s_literature', 'Children\'s literature', NULL, NULL, 'children\'s_literature', '&lt;p&gt;&lt;strong style=&quot;color: rgb(0, 29, 53); font-family: &quot;Google Sans&quot;, Arial, sans-serif;&quot;&gt;Children&#039;s literature&nbsp;&lt;/strong&gt;&lt;span style=&quot;color: rgb(84, 93, 126); font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 14px; letter-spacing: 0.1px;&quot;&gt;A genre that aims to impart a lesson to the reader, and often features tropes such as talking animals, the power of friendship, and appreciating differences&lt;/span&gt;&lt;/p&gt;', 0, NULL, NULL);
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (19, 'list_stories', 'List stories', NULL, NULL, 'list_stories', '&lt;p&gt;&lt;strong style=&quot;color: rgb(0, 29, 53); font-family: &quot;Google Sans&quot;, Arial, sans-serif;&quot;&gt;List stories&nbsp;&lt;/strong&gt;&lt;span style=&quot;color: rgb(84, 93, 126); font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 14px; letter-spacing: 0.1px;&quot;&gt;A genre that is written as or structured around lists&lt;/span&gt;&lt;/p&gt;', 0, NULL, NULL);
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (20, 'history', 'History', NULL, NULL, 'history', '&lt;span style=&quot;color: rgb(77, 81, 86); font-family: Arial, sans-serif; font-size: 14px;&quot;&gt;History is the systematic study and documentation of the human past. History is an academic discipline which uses a narrative to describe, examine, question, and analyse past events, and investigate their patterns of cause and effect.&lt;/span&gt;', 0, NULL, NULL);
INSERT INTO `nan_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (21, 'រឿងខ្មែរ', 'រឿងខ្មែរ', NULL, 14, 'រឿងខ្មែរ', '&lt;p&gt;រឿងខ្មែរ&lt;/p&gt;', 0, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for nan_category_langs
-- ----------------------------
DROP TABLE IF EXISTS `nan_category_langs`;
CREATE TABLE `nan_category_langs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(65) DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_category_langs
-- ----------------------------
BEGIN;
INSERT INTO `nan_category_langs` (`id`, `code`, `name`, `image`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (11, 'EN', 'English', NULL, 'english', '&lt;p&gt;This is english language book&lt;/p&gt;', NULL, NULL, NULL);
INSERT INTO `nan_category_langs` (`id`, `code`, `name`, `image`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (12, 'km', 'Khmer', NULL, 'khmer_language', '&lt;p&gt;Khmer language&lt;/p&gt;', NULL, NULL, NULL);
INSERT INTO `nan_category_langs` (`id`, `code`, `name`, `image`, `slug`, `description`, `created_by`, `created_at`, `updated_at`) VALUES (13, 'ch', 'Chines', NULL, 'chines_language', '&lt;p&gt;Chines language&lt;/p&gt;', NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for nan_login_devices
-- ----------------------------
DROP TABLE IF EXISTS `nan_login_devices`;
CREATE TABLE `nan_login_devices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser_version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logged_in_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of nan_login_devices
-- ----------------------------
BEGIN;
INSERT INTO `nan_login_devices` (`id`, `user_id`, `ip_address`, `device`, `platform`, `browser`, `browser_version`, `logged_in_at`, `created_at`, `updated_at`) VALUES (1, 1, '127.0.0.1', 'Unknown', 'Ubuntu', 'Firefox 144', '144', '2025-10-18 15:48:08', '2025-10-18 15:48:08', '2025-10-18 15:48:08');
INSERT INTO `nan_login_devices` (`id`, `user_id`, `ip_address`, `device`, `platform`, `browser`, `browser_version`, `logged_in_at`, `created_at`, `updated_at`) VALUES (2, 1, '127.0.0.1', 'Unknown', 'Ubuntu', 'Firefox 144', '144', '2025-10-18 15:48:08', '2025-10-18 15:48:08', '2025-10-18 15:48:08');
COMMIT;

-- ----------------------------
-- Table structure for nan_migrations
-- ----------------------------
DROP TABLE IF EXISTS `nan_migrations`;
CREATE TABLE `nan_migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of nan_migrations
-- ----------------------------
BEGIN;
INSERT INTO `nan_migrations` (`id`, `migration`, `batch`) VALUES (1, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `nan_migrations` (`id`, `migration`, `batch`) VALUES (2, '2025_10_11_181608_create_permission_tables', 1);
COMMIT;

-- ----------------------------
-- Table structure for nan_model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `nan_model_has_permissions`;
CREATE TABLE `nan_model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `nan_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `nan_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of nan_model_has_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for nan_model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `nan_model_has_roles`;
CREATE TABLE `nan_model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `nan_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `nan_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of nan_model_has_roles
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for nan_notifications
-- ----------------------------
DROP TABLE IF EXISTS `nan_notifications`;
CREATE TABLE `nan_notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from_date` datetime DEFAULT NULL,
  `till_date` datetime DEFAULT NULL,
  `scope` tinyint(1) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_notifications
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for nan_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `nan_password_resets`;
CREATE TABLE `nan_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for nan_permissions
-- ----------------------------
DROP TABLE IF EXISTS `nan_permissions`;
CREATE TABLE `nan_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nan_permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of nan_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for nan_personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `nan_personal_access_tokens`;
CREATE TABLE `nan_personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_general_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nan_personal_access_tokens_token_unique` (`token`),
  KEY `nan_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of nan_personal_access_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for nan_provinces
-- ----------------------------
DROP TABLE IF EXISTS `nan_provinces`;
CREATE TABLE `nan_provinces` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(1000) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `id_2` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_provinces
-- ----------------------------
BEGIN;
INSERT INTO `nan_provinces` (`id`, `name`, `zip_code`, `image`, `details`, `created_by`, `created_at`, `updated_at`) VALUES (8, 'Svay rieng', '097272', '6864889bf86f368607b0731729e9700babbbd79e1f0ee9928674ed206174c4b0', '&lt;p&gt;This is svay rieng province&lt;/p&gt;', NULL, NULL, NULL);
INSERT INTO `nan_provinces` (`id`, `name`, `zip_code`, `image`, `details`, `created_by`, `created_at`, `updated_at`) VALUES (9, 'Kompong Speu', '0973737', 'c4a5c46aa8431e180c2a6981435e0af3ab39b7910692ec3164af579d781c1dfc', '&lt;p&gt;This is kompong speu province&lt;/p&gt;', NULL, NULL, NULL);
INSERT INTO `nan_provinces` (`id`, `name`, `zip_code`, `image`, `details`, `created_by`, `created_at`, `updated_at`) VALUES (10, 'Kandal', '0577333', '81380e6cca2a6f4603162d9a4e7486920786fc9b57099f5dde1cf6a6d93f1e24', '&lt;p&gt;This is seal of kandal&lt;/p&gt;', 1, '2025-01-07 03:47:19', NULL);
INSERT INTO `nan_provinces` (`id`, `name`, `zip_code`, `image`, `details`, `created_by`, `created_at`, `updated_at`) VALUES (14, 'coding', 'testing', NULL, '&lt;p&gt;testing coding&lt;/p&gt;', 1, '2025-01-08 00:12:06', NULL);
COMMIT;

-- ----------------------------
-- Table structure for nan_role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `nan_role_has_permissions`;
CREATE TABLE `nan_role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `nan_role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `nan_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `nan_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nan_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `nan_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of nan_role_has_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for nan_roles
-- ----------------------------
DROP TABLE IF EXISTS `nan_roles`;
CREATE TABLE `nan_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nan_roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of nan_roles
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for nan_settings
-- ----------------------------
DROP TABLE IF EXISTS `nan_settings`;
CREATE TABLE `nan_settings` (
  `setting_id` int NOT NULL,
  `logo` varchar(255) NOT NULL,
  `site_name` varchar(55) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `version` varchar(10) DEFAULT '1.0',
  `student_prefix` varchar(20) DEFAULT NULL,
  `book_prefix` varchar(20) DEFAULT NULL,
  `attendance_prefix` varchar(20) DEFAULT NULL,
  `borrow_prefix` varchar(20) DEFAULT NULL,
  `theme` varchar(20) DEFAULT NULL,
  `timezone` varchar(100) DEFAULT NULL,
  `iwidth` int DEFAULT '0',
  `iheight` int DEFAULT NULL,
  `watermark` tinyint(1) DEFAULT NULL,
  `captcha` tinyint(1) DEFAULT '0',
  `is_demo` tinyint(1) DEFAULT '0',
  `hidden_login_btn` tinyint(1) DEFAULT '0',
  `ip_address_allow` varchar(20) DEFAULT '0',
  `start_ip_address` varchar(20) DEFAULT '0',
  `end_ip_address` varchar(20) DEFAULT '0',
  `using_in_area` tinyint(1) DEFAULT '0',
  `avariable_register_page` tinyint(1) DEFAULT '0',
  `site_prefix` varchar(100) DEFAULT NULL,
  `lat` varchar(60) DEFAULT NULL,
  `lng` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`setting_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_settings
-- ----------------------------
BEGIN;
INSERT INTO `nan_settings` (`setting_id`, `logo`, `site_name`, `language`, `version`, `student_prefix`, `book_prefix`, `attendance_prefix`, `borrow_prefix`, `theme`, `timezone`, `iwidth`, `iheight`, `watermark`, `captcha`, `is_demo`, `hidden_login_btn`, `ip_address_allow`, `start_ip_address`, `end_ip_address`, `using_in_area`, `avariable_register_page`, `site_prefix`, `lat`, `lng`) VALUES (1, 'be0f3f206742e2a7bca5da8f7e63b8eeea1df24f52ba640a750ed06b017c01b5', 'បណ្ណាល័យតេជោសន្តិភាព', 'kh', '3.4.53', 'std', 'B', 'Att', 'PO', 'white', NULL, 800, 800, NULL, NULL, 1, 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for nan_shop_settings
-- ----------------------------
DROP TABLE IF EXISTS `nan_shop_settings`;
CREATE TABLE `nan_shop_settings` (
  `shop_id` int NOT NULL,
  `shop_name` varchar(55) NOT NULL,
  `description` varchar(160) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about_link` varchar(55) NOT NULL,
  `terms_link` varchar(55) NOT NULL,
  `privacy_link` varchar(55) NOT NULL,
  `contact_link` varchar(55) NOT NULL,
  `payment_text` varchar(100) NOT NULL,
  `follow_text` varchar(100) NOT NULL,
  `facebook` varchar(55) NOT NULL,
  `twitter` varchar(55) DEFAULT NULL,
  `google_plus` varchar(55) DEFAULT NULL,
  `instagram` varchar(55) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `cookie_message` varchar(180) DEFAULT NULL,
  `cookie_link` varchar(55) DEFAULT NULL,
  `slider` text,
  `shipping` int DEFAULT NULL,
  `purchase_code` varchar(100) DEFAULT 'purchase_code',
  `envato_username` varchar(50) DEFAULT 'envato_username',
  `version` varchar(10) DEFAULT '3.4.53',
  `logo` varchar(65) DEFAULT NULL,
  `bank_details` varchar(255) DEFAULT NULL,
  `products_page` tinyint(1) DEFAULT NULL,
  `hide0` tinyint(1) DEFAULT '0',
  `products_description` varchar(255) DEFAULT NULL,
  `private` tinyint(1) DEFAULT '0',
  `hide_price` tinyint(1) DEFAULT '0',
  `stripe` tinyint(1) DEFAULT '0',
  `youtube` varchar(55) DEFAULT NULL,
  `workday` varchar(55) DEFAULT NULL,
  `linkedin` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`shop_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_shop_settings
-- ----------------------------
BEGIN;
INSERT INTO `nan_shop_settings` (`shop_id`, `shop_name`, `description`, `keyword`, `address`, `about_link`, `terms_link`, `privacy_link`, `contact_link`, `payment_text`, `follow_text`, `facebook`, `twitter`, `google_plus`, `instagram`, `phone`, `email`, `cookie_message`, `cookie_link`, `slider`, `shipping`, `purchase_code`, `envato_username`, `version`, `logo`, `bank_details`, `products_page`, `hide0`, `products_description`, `private`, `hide_price`, `stripe`, `youtube`, `workday`, `linkedin`) VALUES (1, 'បណ្ណាល័យតេជោសន្តិភាព', 'បណ្ណាល័យល័យតេជោសន្តិភាពគឺជាបណ្ណាល័យមួយដែលមានទីតាំងស្ថិតនៅពុទ្ទិកសាកលវិទ្យាល័យព្រះសីហមុនីរាជា', 'psbu,library,psbulibrarie', 'Sangkat Boeng Keng Kong 1,Khan Chamkar Mon', 'about', 'terms-conditions', 'privacy-policy', 'contact', 'We accept PayPal or you can pay with your credit/debit cards.', 'Please click the link below to follow us on social media.', 'http://facebook.com/', 'http://twitter.com/tecdiary', NULL, NULL, '0713567907', 'lms@psub.coud', 'We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies.', 'http://127.0.0.1:8000/admin/shop_settings', '[{\"image\":\"s1.jpg\",\"link\":\"http:\\/\\/ci.dev\\/sma\\/shop\\/products\",\"caption\":\"\"},{\"image\":\"s2.jpg\",\"link\":\"\",\"caption\":\"\"},{\"image\":\"s3.jpg\",\"link\":\"\",\"caption\":\"\"},{\"link\":\"\",\"caption\":\"\"},{\"link\":\"\",\"caption\":\"\"}]', 0, '', 'envato_username', '3.4.53', '25e21c3b3a9cdcf4c09119562c972fa906f1f541ed7d1ca9838a74335d5a31f7', '', NULL, 0, NULL, 0, 0, 0, NULL, 'Monday - Sunday   9:00 AM - 17:00 PM', NULL);
COMMIT;

-- ----------------------------
-- Table structure for nan_students
-- ----------------------------
DROP TABLE IF EXISTS `nan_students`;
CREATE TABLE `nan_students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(55) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `nick_name` varchar(55) DEFAULT NULL,
  `gender` varchar(55) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pob` varchar(64) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `father_phone` varchar(64) DEFAULT NULL,
  `mother_phone` varchar(64) DEFAULT NULL,
  `image` varchar(65) DEFAULT NULL,
  `province_id` int DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `description` text,
  `shift` varchar(25) DEFAULT NULL,
  `skills` varchar(50) DEFAULT NULL,
  `batch` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_students
-- ----------------------------
BEGIN;
INSERT INTO `nan_students` (`id`, `code`, `first_name`, `last_name`, `nick_name`, `gender`, `dob`, `pob`, `phone`, `email`, `father_phone`, `mother_phone`, `image`, `province_id`, `slug`, `description`, `shift`, `skills`, `batch`) VALUES (23, 'ElcPR7l8Aj', 'Heng', 'Puthea', NULL, 'Male', '2025-01-13', 'Phnom Penh', '0713567907', 'chou.chamnan.kh@gmail.com', '0713567909', '0713567902', 'e48940ae38bbcb0c1e09018025bbfcc0b8743291eb428682be289c63e2bfc7d0', 8, 'JdQfLusOJFCXEsrNv1aFpKzadLX75JuTCsMClByi', '&lt;p&gt;This is data for testing&lt;/p&gt;', 'ព្រឹក', 'Computer sciences', '16');
INSERT INTO `nan_students` (`id`, `code`, `first_name`, `last_name`, `nick_name`, `gender`, `dob`, `pob`, `phone`, `email`, `father_phone`, `mother_phone`, `image`, `province_id`, `slug`, `description`, `shift`, `skills`, `batch`) VALUES (24, 'EmL4MsbkCt', 'Sok', 'Lisa', NULL, NULL, '2025-02-24', 'ចំបក់ថ្លឹង, គោកព្រីង, ស្វាយជ្រំ, ស្វាយរៀង', '0713567905', 'lisa@gmail.com', '0713567907', '0234949494', '5429c4f2d7cb6ee7cc4a45d1b681fe3f0e478c93f3c7c32248e5ea8b2d39c1cb', 8, 'b9YDYkJUPmXR5o8LwdFLtyGwIfjoHq1cBj1jAeUP', '&lt;p&gt;My name is lisa&lt;/p&gt;', 'រសៀល', 'Computer sciences', '16');
COMMIT;

-- ----------------------------
-- Table structure for nan_users
-- ----------------------------
DROP TABLE IF EXISTS `nan_users`;
CREATE TABLE `nan_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL,
  `activate_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_agree` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `facebook_id` int DEFAULT NULL,
  `google_id` int DEFAULT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `last_login_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `brower_login` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_login` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qrcode_token` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_ban` tinyint NOT NULL DEFAULT '0',
  `major` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nan_users
-- ----------------------------
BEGIN;
INSERT INTO `nan_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `avatar`, `activated`, `activate_code`, `address`, `gender`, `experience`, `skills`, `is_agree`, `remember_token`, `created_at`, `updated_at`, `facebook_id`, `google_id`, `user_type`, `last_login_ip`, `last_login_at`, `brower_login`, `os_login`, `qrcode_token`, `student_id`, `description`, `is_ban`, `major`, `education`) VALUES (1, 'Chou Chamnan', 'chou.chamnan.kh@gmail.com', NULL, '$2y$10$wNQNhRWDObOoSUxKXWOR2.I/ARyoTkykByWKBteNzIaL9.lslKcim', '0713567907', 'f84897ce460b0f9fcfd3272f4f111abbf2738a40d5a291218a9218ace7674382', 1, '', 'Svay Chrum, Svay Rieng', 'male', '10 years', 'Web developer,  Web API, Mobile app, Cyber Security', 0, 'H4fPZBLjBznaVtAFDMhPc4yGBFSPk7nNE9XeN6lUJtvifSNVu94uvtjFksar', '2024-11-03 15:58:57', '2025-10-18 15:48:08', NULL, NULL, 'admin', '127.0.0.1', '2025-10-18 15:48:08', 'Browser not found', '', NULL, NULL, 'I\'m Working now', 0, 'Full Stack', 'PSB University');
INSERT INTO `nan_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `avatar`, `activated`, `activate_code`, `address`, `gender`, `experience`, `skills`, `is_agree`, `remember_token`, `created_at`, `updated_at`, `facebook_id`, `google_id`, `user_type`, `last_login_ip`, `last_login_at`, `brower_login`, `os_login`, `qrcode_token`, `student_id`, `description`, `is_ban`, `major`, `education`) VALUES (18, 'Hello admin', 'admin@gmail.com', NULL, '$2y$10$0gd54UD7wsKFIrUFvqD.helyp3eutEE5/T48fjzp9tJGKkJDREMmy', '0123456789', NULL, 1, NULL, NULL, 'male', NULL, NULL, 0, NULL, '2025-08-27 09:12:54', NULL, NULL, NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, '', 0, NULL, NULL);
INSERT INTO `nan_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `avatar`, `activated`, `activate_code`, `address`, `gender`, `experience`, `skills`, `is_agree`, `remember_token`, `created_at`, `updated_at`, `facebook_id`, `google_id`, `user_type`, `last_login_ip`, `last_login_at`, `brower_login`, `os_login`, `qrcode_token`, `student_id`, `description`, `is_ban`, `major`, `education`) VALUES (9, 'Testing System', 'testing@gmail.com', NULL, '$2y$10$InhYOiEVGgjIpsmK4ZwPueSnHm/L8iFJkRQ6AfDrybaUfR7EzXSty', '012345678', NULL, 1, NULL, NULL, 'male', '1', 'IT Developer', 0, 'h1xjvtcNc5u2Dp6E3MPMciAZKOuIzAEr2E4J7EL06H0G6HZobdEXRwn6mi5o', '2025-03-14 14:53:24', '2025-03-15 01:38:12', NULL, NULL, 'admin', '119.13.156.179', '2025-03-15 01:38:12', 'Google Chrome', 'Windows', NULL, NULL, '&lt;p&gt;User for testing&lt;/p&gt;', 0, NULL, NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
