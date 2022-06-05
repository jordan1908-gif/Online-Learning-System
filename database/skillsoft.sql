-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 25, 2022 at 12:10 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adm_id` int NOT NULL AUTO_INCREMENT,
  `adm_username` varchar(30) NOT NULL,
  `adm_password` varchar(255) NOT NULL,
  `adm_email` varchar(40) NOT NULL,
  `adm_first_name` varchar(30) NOT NULL,
  `adm_last_name` varchar(30) NOT NULL,
  PRIMARY KEY (`adm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `adm_username`, `adm_password`, `adm_email`, `adm_first_name`, `adm_last_name`) VALUES
(1, 'admin', '$2y$10$S7ZGmzk2pv98Gw4LUdtCoetiWy7uXlDHuvGN/Po52EuO81DyospFy', 'admintan@gmail.com', 'Admin', 'Tan');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `ans_id` int NOT NULL AUTO_INCREMENT,
  `ans_content` text NOT NULL,
  `ans_date` date NOT NULL,
  `ques_id` int NOT NULL,
  `stud_id` int DEFAULT NULL,
  `teac_id` int DEFAULT NULL,
  PRIMARY KEY (`ans_id`),
  KEY `ques_id` (`ques_id`),
  KEY `teac_id` (`teac_id`),
  KEY `stud_id` (`stud_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`ans_id`, `ans_content`, `ans_date`, `ques_id`, `stud_id`, `teac_id`) VALUES
(1, 'Either inline in a block, or in another JS file you are linking within your header. Ideally below the line you posted.', '2022-05-25', 2, 0, 1),
(2, 'You can insert data by using the INSERT query.\r\n\r\nFor example: INSERT INTO table_name (column1, column2) VALUES (value1, value2);', '2022-05-25', 3, 0, 1),
(3, 'The SELECT statement is used to select data from a database. The data returned is stored in a result table, called the result-set.', '2022-05-25', 4, 0, 1),
(4, 'I highly encourage you to at least get through the first chapters of documentation to get familiar with the basic principles.', '2022-05-25', 5, 0, 1),
(5, 'Please make sure that the API key is valid before calling the function!', '2022-05-25', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

DROP TABLE IF EXISTS `chatbot`;
CREATE TABLE IF NOT EXISTS `chatbot` (
  `id` int NOT NULL AUTO_INCREMENT,
  `queries` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `replies` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `queries`, `replies`) VALUES
(1, 'hi | hello | heyyy | who are you | whats your name? | what is your name?', 'Hello there! I am SkillBot, here to assist you in your doubts.'),
(2, 'How many quiz do you have? | What quiz do you have? | How many type of quiz do you have?', 'We currently focus on 3 types of quiz which are Business, Design, and IT quiz.'),
(3, 'Does your quiz have time limit? | What is the time limit of your quiz | Is there time limit on your quizzes? | time limit | How long is the time limit for each quiz?', 'Yes, different time limits are being set for different quiz.'),
(4, 'How many questions are there in a quiz? | questions in quiz', 'The number of questions differs for each quiz. Number of questions for each quiz would typically range from 5 to 10 questions.'),
(5, 'Do you offer any online courses? | Are there any courses available on your website? | Do you sell courses? | What courses do you have on your website?', 'We currently do not provide any courses within our website, only quizzes. However, always stay tune for new updates!'),
(6, 'How many attempts can i try in a quiz? | How many attempts are there for each quiz? | What are the attempts for each quiz? | What are the number of attempts for each quiz?', 'You can attempt as many tries as you like. There are no limits on how many times a user may attempt the quiz.'),
(7, 'How to contact you regarding other enquiry? | Whats your email address? | How to send you an email? | Do you have a phone number? | Whats your contact address?', 'You can always send us an email at skillsofteducation@gmail.com. We will get back to you as soon as possible.'),
(8, 'Do you offer membership? | Do you have membership feature?', 'We do not offer any membership feature as of now due to the website still being in the initial release stage. '),
(9, 'Is it possible to order attempt quiz without signing in? Can i attempt quiz without signing in? | Can i attempt quiz without logging in? | Is it compulsory to log in? | log in | login | signin | sign in', 'Yes, all users are required to sign in and verify their account through the registered email before being able to utilize the major website features.'),
(10, 'Can i post a forum? How to post a forum question? | forum | Can i post unrelated forum question?', 'You can always post a question in the forum by clicking the forum button on the top navigational panel when you are logged into your account.'),
(11, 'What is this website about? | What is the main objective of Skillsoft? | What does Skillsoft hope to achieve?', 'This is a website that focuses on providing exciting quizzes that enhances students learning knowledge.');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `his_id` int NOT NULL AUTO_INCREMENT,
  `quques_id` int NOT NULL,
  `his_answer` char(2) NOT NULL,
  `his_is_right` int NOT NULL,
  `his_date_time` timestamp NOT NULL,
  `stud_id` int NOT NULL,
  PRIMARY KEY (`his_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`his_id`, `quques_id`, `his_answer`, `his_is_right`, `his_date_time`, `stud_id`) VALUES
(1, 6, '2', 1, '2022-05-25 11:16:54', 2),
(2, 7, '3', 0, '2022-05-25 11:16:54', 2),
(3, 8, '4', 1, '2022-05-25 11:16:54', 2),
(4, 9, '2', 0, '2022-05-25 11:16:54', 2),
(5, 10, '2', 1, '2022-05-25 11:16:54', 2);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `ques_id` int NOT NULL AUTO_INCREMENT,
  `ques_title` varchar(100) NOT NULL,
  `ques_content` text NOT NULL,
  `ques_post_date` date DEFAULT NULL,
  `stud_id` int NOT NULL,
  PRIMARY KEY (`ques_id`),
  KEY `stud_id` (`stud_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`ques_id`, `ques_title`, `ques_content`, `ques_post_date`, `stud_id`) VALUES
(1, 'Ajax Delete Request', 'I have a problem talking with an API. I need to make a DELETE request containing a token and an id to delete some data in the database.', '2022-05-25', 2),
(2, 'How to edit jquery?', 'My question is, where should I enter the jQuery code I want to use?', '2022-05-25', 2),
(3, 'How to insert data using SQL?', 'I kept receiving an error when inserting query to phpMyAdmin. Can someone help me out?', '2022-05-25', 2),
(4, 'SQL Select', 'May I know what is SQL Select statement used for?', '2022-05-25', 2),
(5, 'Material Design Topic', 'How to be extremely good at designing materials?', '2022-05-25', 2),
(6, 'Business Development Expertise', 'May I know how to boost my business development strategy?', '2022-05-25', 2),
(7, 'PHP Extract Method', 'What does the extract method used for in PHP?', '2022-05-25', 2),
(8, 'PHP Framework', 'May I know which is the most popular framework for PHP in the current market?\r\n', '2022-05-25', 2),
(9, 'Regression Testing', 'Does anyone here have experience with regression testing? I need some help on my project.', '2022-05-25', 2),
(10, 'WordPress Plugins', 'I want to integrate WooCommerce into my WordPress website, but have no experience in this field. Can someone lend me a hand?', '2022-05-25', 2),
(11, 'AJAX vs jQuery', 'What exactly are the differences between AJAX and jQuery? It feels like both are the same technology.', '2022-05-25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` int NOT NULL AUTO_INCREMENT,
  `quiz_title` varchar(40) NOT NULL,
  `quiz_category` varchar(50) NOT NULL,
  `quiz_cover` longtext NOT NULL,
  `quiz_timer` int NOT NULL,
  `quiz_point` int NOT NULL,
  `quiz_description` varchar(255) NOT NULL,
  `quiz_create_date` date NOT NULL,
  `teac_id` int NOT NULL,
  PRIMARY KEY (`quiz_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_title`, `quiz_category`, `quiz_cover`, `quiz_timer`, `quiz_point`, `quiz_description`, `quiz_create_date`, `teac_id`) VALUES
(1, 'Business Quiz', 'Business', 'Business Analysis Fundamentals.jpg', 35, 15, 'This quiz is to test students on their basic business knowledges.', '2021-03-01', 1),
(2, 'Entrepreneurial Quiz', 'Business', 'Enterprising & Entrepreneurial.jpeg', 1, 5, 'This quiz is to test students on their basic entrepreneurial knowledge.', '2021-03-01', 1),
(3, 'Communication Quiz', 'Business', 'Communication Skills.png', 20, 10, 'This quiz is to test students on their communication skills.', '2021-03-01', 1),
(4, 'Fundamentals Graphic Design Practice', 'Design', 'fundamental_design.jpg', 15, 10, 'This quiz is to test students on their creativity design.', '2021-03-01', 1),
(5, 'HTML and CSS Quiz', 'IT', 'html_css.jpg', 20, 10, 'This quiz is to test students on their web development expertise.', '2021-03-01', 1),
(6, 'Digital Marketing Quiz', 'Business', 'Digital Marketing Guide.jpeg', 30, 5, 'This quiz is to test students on their knowledge towards marketing plans.', '2021-03-01', 1),
(7, 'Adobe Photoshop Test', 'Design', 'photoshop_course.jpg', 20, 10, 'This quiz is to test students on their photoshop skills.', '2021-03-01', 2),
(8, 'JavaScript Quiz', 'IT', 'javascript.jpg', 10, 10, 'This quiz is to test students on their knowledge towards scripting language.', '2021-03-01', 2),
(9, 'PHP Tutorials Quiz', 'IT', 'php.jpg', 30, 20, 'This quiz is to test students on their knowledge towards PHP language.', '2022-05-03', 2),
(10, 'C++ Tutorials Quiz', 'IT', 'c++.png', 20, 20, 'This quiz is to test students on their knowledge towards C++ language.', '2022-05-04', 2),
(11, 'Adobe Design Test', 'Design', 'photoshop_course.jpg', 10, 10, 'This quiz is to test students on their knowledge towards adobe skills.', '2022-05-02', 2),
(12, 'Interior Design Test', 'Design', 'indesign_course.jpg', 5, 10, 'This is a quiz to assess student\'s interior design knowledge.', '2022-05-25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_question`
--

DROP TABLE IF EXISTS `quiz_question`;
CREATE TABLE IF NOT EXISTS `quiz_question` (
  `quques_id` int NOT NULL AUTO_INCREMENT,
  `quques_number` int NOT NULL,
  `quques_question` text NOT NULL,
  `quques_correct_answer` char(2) NOT NULL,
  `quques_choices_A` varchar(40) NOT NULL,
  `quques_choices_B` varchar(40) NOT NULL,
  `quques_choices_C` varchar(40) DEFAULT NULL,
  `quques_choices_D` varchar(40) DEFAULT NULL,
  `quiz_id` int NOT NULL,
  PRIMARY KEY (`quques_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_question`
--

INSERT INTO `quiz_question` (`quques_id`, `quques_number`, `quques_question`, `quques_correct_answer`, `quques_choices_A`, `quques_choices_B`, `quques_choices_C`, `quques_choices_D`, `quiz_id`) VALUES
(1, 1, 'CWC stands for?', '3', 'Central Water Commission', 'Central Warehousing Commission', 'Central Warehousing Corporation', 'Central Water Corporation', 1),
(2, 2, 'Which of the following is not a function of insurance?', '2', 'Risk sharing', 'Assist in capital formation', 'Lending of funds', 'None of the above', 1),
(3, 3, 'The validity period of a demand draft is?', '3', 'One month', 'Two Months', 'Three months', 'Six Months', 1),
(4, 4, 'DTH services are provided by?', '3', ' Transport Company', 'Banks', 'Cellular Company', 'None of these', 1),
(5, 5, 'Which of the following is an allied postal service?', '3', 'Greeting post', 'Media post', 'Speed post', 'Passport Application', 1),
(6, 1, '____ carried out indirectly through existing resources?', '2', 'Market research', 'Secondary research', 'Demographics', 'Primary research', 2),
(7, 2, 'Which distinguishes goods or services through a design, symbol, name, term, or other features?', '4', 'Positioning', 'Marketing', 'Demographics', 'Brand', 2),
(8, 3, '____ conducted directly on a subject or subjects?', '4', 'Secondary research', 'Marketing', 'Market research', 'Primary research', 2),
(9, 4, 'The development and use of strategies for getting a product or service to customers.', '1', 'Marketing', 'Market Segment', 'Brand', 'Positioning', 2),
(10, 5, 'Stages that a product or service in the market - introduction, growth, maturity, and decline?', '2', 'Positioning', 'Product life cycle (PLC)', 'Market research', 'Primary research', 2),
(11, 1, 'Of the following which is not a nonverbal communication?', '3', 'Eye contact', 'Arms Crossed', 'Verbally talking', 'Nail biting', 3),
(32, 2, 'Which option below allows users to saturate pixels?', '3', 'Dodge Tool', 'Burn Tool', 'Sponge Tool', 'Mixer Brush Tool', 7),
(12, 2, 'Communication is always a ____ way process.', '2', 'One', 'Two', 'Three', 'Four', 3),
(13, 3, '____ is the sharing of information in which a receiver understands the meaning of a message.', '3', 'Netiquette', 'Distraction', 'Communication', 'Non verbal', 3),
(14, 4, 'When a receiver relays information, they expect ____.', '3', 'Communication', 'Symbols', 'Feedback', 'Reaction', 3),
(15, 5, 'This type of communication is speaking to teachers and students.', '3', 'Written', 'Non verbal', 'Oral', 'Body language', 3),
(16, 1, 'What is the first and most basic element of design?', '1', 'Line', 'Shape', 'Color', 'Size', 4),
(17, 2, 'What is the most obvious elements of design?', '1', 'Color', 'Shape', 'Line', 'Texture', 4),
(18, 3, 'How a fabric feels or looks.', '2', 'Rough', 'Texture', 'Slick', 'Shiny', 4),
(19, 4, 'Content and Copy are two types of?', '1', 'Printing', 'Shedding', 'Designs', 'Communication', 4),
(20, 5, 'George Eastman created the _____ ?', '1', 'Eastman Kodak Company', 'AT&T', 'T-Mobile', 'Chinese Printing Press', 4),
(31, 1, 'What keyboard shortcut would you use to undo the last edit?', '1', 'Cmd+Z/Ctrl+Z', 'Cmd+U/Ctrl+U', 'Option+Z/Alt+Z', 'Option+U/Ctrl+U', 7),
(21, 1, 'Who is making the Web standards?', '2', 'Google', 'The World Wide Web Consurtium', 'Mozilla', 'Microsoft', 5),
(22, 2, 'Which of the following is a font property?', '4', 'Face', 'Color', 'Size', 'All of these are font properties', 5),
(23, 3, 'Which character is used to indicate an end tag?', '1', '/', '*', '^', '<', 5),
(24, 4, 'What is the purpose of HTML', '2', 'To make a formatted document', 'To make a webpage', 'To edit photos', 'To make a creative slide', 5),
(25, 5, 'Google Chrome is an example of a what?', '3', 'URL', 'IP address', 'Web browser', 'Incorrect metal', 5),
(26, 1, 'Businesses that sell primarily to other businesses are in the _________ market.', '4', 'Manufacturing', 'B2C', 'Target', 'B2B', 6),
(27, 2, 'Process of communicating with potential customers in an effort to influence their buying behavior.', '2', 'Marketing strategy', 'Promotion', 'Personal influence', 'Situational influence', 6),
(28, 3, 'Focuses on building long-term relationships with customers.', '3', 'Extensive buying decision', 'Promotion', 'Relationship selling', 'Personal influence', 6),
(29, 4, 'Marketing to a larger group of people who might buy a product.', '2', 'Promotion', 'Mass marketing', 'Personal influence', 'Social influence', 6),
(30, 5, '\"Being green.\"', '4', 'Production', 'Sales', 'Market', 'Societal', 6),
(33, 3, 'The _____ bar changes depending on which tool is currently selected.', '1', 'Options', 'Tools', 'Menu', 'Document', 7),
(34, 4, 'In the View menu, you can click ______ to set a guide at an exact point.', '4', 'Lock Guide', 'Set Guide', 'Edit Guide', 'New Guide', 7),
(35, 5, 'A color _____ defines the range of colors within a color model.', '1', 'Profile', 'Menu', 'Gallery', 'Setting', 7),
(36, 1, 'Line segments between anchor points are referred to as _____________.', '2', 'Segments', 'Paths', 'Lines', 'Graphics', 8),
(37, 2, 'How do you change the color of a shape?', '2', 'By changing the stroke line.', 'By selecting it and changing the fill.', 'By selecting it.', 'By changing it to none.', 8),
(38, 3, 'The graphics created in Adobe Illustrator are...?', '1', 'Vector graphics', 'Bitmap images', 'Lines', 'Paths', 8),
(39, 4, 'How do you get a reference image or photo into Illustrator?', '3', 'Drag and drop it in.', 'File>Save>Desktop.', 'File>Place', 'Embed it.', 8),
(40, 5, 'How do you get a photo reference image to stay in your Illustrator project?', '2', 'File>Save', 'Embed it', 'Edit>Arrange', 'Object>Live Trace', 8),
(59, 4, 'What is floor plans?', '2', 'A map of your house.', 'Diagram showing main structure elements.', 'A brochure of ideas.', 'A road map.', 12),
(58, 3, 'What is tactile texture?', '4', 'It is how to look at something.', 'It is how we taste something.', 'It is how we hear something.', 'It is how it feels to the touch.', 12),
(60, 5, 'What is aesthetics?\r\n', '4', 'Plants.', 'Foods.', 'Maps.', 'Refers to beauty of a product.', 12),
(57, 2, 'How do you become an interior designer?', '2', 'Earn a degree in software engineering.', 'Build a presentable design portfolio.', 'Achieve straight As in your courses.', 'Be good at architectures.', 12),
(56, 1, 'What is interior design?', '1', 'It is about how we experience spaces.', 'It is the physical architecture.', 'It is how home decoration.', 'It gives life to your home.', 12),
(41, 1, 'Witch intruction from this create an Loop?', '2', 'If', 'While', 'Var', 'Else', 9),
(42, 2, 'This date 29 is data type?', '3', 'Boolean', 'String', 'Integer', 'Float', 9),
(43, 3, 'What is the correct syntax for declaring a function?', '3', 'var myFunction()', 'myFunction function()', 'function myFunction()', 'function my Function()', 9),
(44, 4, 'Which is the correct syntax for displaying data in the console?', '1', 'console.log();', 'log.console();', 'console.log[];', 'console.log;', 9),
(45, 5, 'How can you get the total number of arguments passed to a function?', '2', 'Using args.length property', 'Using arguments.length property', 'Both of the above.', 'None of the above.', 9),
(46, 1, 'Which of the following type of variables are named and indexed collections of other values?', '2', 'Strings', 'Arrays', 'Objects', 'Recources', 10),
(47, 2, 'Which of the following is used to get information sent via get method in PHP?', '1', '$_GET', '$GET', '$GETREQUEST', 'None of the above.', 10),
(48, 3, 'Which of the following function is used to read the content of a file?', '2', 'fopen()', 'fread()', 'filesize()', 'file_exist()', 10),
(49, 4, 'Which of the following method returns a formatted string representing a date?', '3', 'time()', 'getdate()', 'date()', 'None of the above', 10),
(50, 5, 'Which of the following gives a string containing PHP script file name in which it is called?', '1', '$_PHP_SELF', '$_PHP_SELF', '$_COOKIE', '$_SESSION', 10),
(51, 1, 'Which of the following is not the keyword in C++?', '3', 'Volatile', 'Friend', 'Extends', 'This', 11),
(52, 2, 'Choose the invalid identifier from the below', '2', 'Int', 'Bool', 'Double', '_0_', 11),
(53, 3, 'Which of the following is the correct identifier?', '2', '$var_name', 'VAR_123', 'varname@', 'None of the above', 11),
(54, 4, 'Which of the following is the address operator?', '3', '@', '#', '&', '%', 11),
(55, 5, 'The programming language that has the ability to create new data types is called___.', '4', 'Overloaded', 'Encapsulated', 'Reprehensible', 'Extensible', 11);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `stud_id` int NOT NULL AUTO_INCREMENT,
  `stud_first_name` varchar(30) NOT NULL,
  `stud_last_name` varchar(30) NOT NULL,
  `stud_username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `stud_email` varchar(40) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `stud_profile_picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'default_profile_picture.png',
  `verified` int NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`stud_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `stud_first_name`, `stud_last_name`, `stud_username`, `stud_email`, `hashed_password`, `stud_profile_picture`, `verified`, `token`) VALUES
(1, 'jadson', 'winyip', 'jadson', 'dexter_winyip01@hotmail.com', '$2y$10$.wJJQ6DsyZHhPEu1Hhh5Z.Zm7Zc8c5C/vxZJNb9WzcTrQ79XWXb3O', 'Digital Marketing Guide.jpeg', 1, 'b04555f9ab69fd130d61c72fdcc75f06ca36d5d24fd25c31a42e2f5b416322819fce7050f6249807939348883f941e4c83ad'),
(2, 'Jordan', 'Sahabudin', 'jordan_1908', 'jordansahabudin@gmail.com', '$2y$10$oLDOWbv7yFm1rwDvK5T7oOEYRI93VB8EIwVesHm1MGzDgmKfZiVp6', 'default_profile_picture.png', 1, '6ee821298f633de4ccc8bef6c5f1ad139b86c42ac320c495600b159cdeef880375bb42bbc11fad28c204dc7794f71bd588e6');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teac_id` int NOT NULL AUTO_INCREMENT,
  `teac_username` varchar(30) NOT NULL,
  `teac_password` varchar(255) NOT NULL,
  `teac_email` varchar(40) NOT NULL,
  `teac_first_name` varchar(30) NOT NULL,
  `teac_last_name` varchar(30) NOT NULL,
  `teac_join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `teac_profile_picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'teac_default_profile.png',
  `teac_edu_proof` varchar(255) NOT NULL,
  `teac_status` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`teac_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teac_id`, `teac_username`, `teac_password`, `teac_email`, `teac_first_name`, `teac_last_name`, `teac_join_date`, `teac_profile_picture`, `teac_edu_proof`, `teac_status`) VALUES
(1, 'jordan_1908', '$2y$10$24qXX0nBZwAbAiF7.Dvs2uKtdR0u6u3Kh07gMnOY5IbA5XpQFldKe', 'jordansahabudin@gmail.com', 'Jordan', 'Sahabudin', '2022-04-19 17:42:08', 'p1.png', 'SAT ans.pdf', 'Verified'),
(2, 'jadson', '$2y$10$0p4kBk1kgGPpiyyruIgQ5OxceHBLa.RB.JeYcJtguKgC5iFWM9HPa', 'jadson@justsimple.com', 'jadson', 'chong', '2022-05-18 15:38:14', 'teac_default_profile.png', 'ERD.pdf', 'Verified');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
