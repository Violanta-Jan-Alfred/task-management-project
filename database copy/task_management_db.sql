-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 01:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks_information`
--

CREATE TABLE `tasks_information` (
  `task_id` int(11) NOT NULL,
  `task_title` varchar(60) DEFAULT NULL,
  `task_description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks_information`
--

INSERT INTO `tasks_information` (`task_id`, `task_title`, `task_description`, `due_date`, `status`) VALUES
(23, 'Organize Team Meeting', 'Coordinate with the team to finalize the upcoming project meeting agenda.', '2024-10-10', 1),
(24, 'Finalize Budget Report', 'Complete and submit the quarterly budget report to finance.', '2024-10-12', 1),
(25, 'Client Follow-up', 'Send a follow-up email to the client regarding their latest feedback.', '2024-10-15', 0),
(26, 'Prepare Presentation', 'Create slides for the product pitch meeting next week.', '2024-10-20', 0),
(27, 'Team Building Event', 'Plan and schedule the team-building event for this quarter.', '2024-10-18', 0),
(28, 'Update Project Timeline', 'Review the project progress and adjust the timeline as needed.', '2024-10-11', 1),
(29, 'Research Competitor Analysis', 'Conduct an in-depth competitor analysis for the product launch.', '2024-10-25', 0),
(30, 'Employee Feedback', 'Compile and analyze employee feedback from the last survey.', '2024-10-19', 1),
(31, 'Website Content Update', 'Review and update the content on the company website.', '2024-10-14', 0),
(32, 'Product Testing', 'Oversee product testing to ensure quality before the release date.', '2024-10-22', 0),
(33, 'Prepare Marketing Materials', 'Develop marketing materials for the upcoming product campaign.', '2024-10-17', 0),
(34, 'Customer Service Training', 'Arrange training sessions for the customer service team.', '2024-10-13', 0),
(35, 'Update Sales Deck', 'Update the sales deck with the latest product features.', '2024-10-21', 0),
(36, 'Quarterly Review', 'Prepare for the quarterly review meeting with stakeholders.', '2024-10-30', 0),
(37, 'Software Update', 'Deploy the latest software update to the production environment.', '2024-10-09', 0),
(38, 'Conduct User Interviews', 'Interview users for feedback on the new app features.', '2024-10-16', 0),
(39, 'Fix Security Vulnerabilities', 'Patch security vulnerabilities found in the latest audit.', '2024-10-23', 0),
(40, 'Social Media Campaign', 'Plan the next month\'s social media marketing strategy.', '2024-10-29', 0),
(41, 'Host Webinar', 'Organize and host the upcoming webinar for potential clients.', '2024-10-26', 0),
(42, 'Write Blog Post', 'Write a blog post covering recent industry trends.', '2024-11-19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks_information`
--
ALTER TABLE `tasks_information`
  ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks_information`
--
ALTER TABLE `tasks_information`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
