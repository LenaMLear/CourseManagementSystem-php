-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 12:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lebaneseuniversity`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `instructor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `instructor_id`) VALUES
(1, 'Introduction to Big Data', 1),
(1, 'Introduction to Big Data', 5),
(2, 'Mathematics Fundamentals', 2),
(2, 'Mathematics Fundamentals', 4),
(3, 'Advanced Arabic Literature', 3),
(4, 'Statistics for Data Analysis', 2),
(4, 'Statistics for Data Analysis', 4),
(5, 'Machine Learning Techniques', 2),
(5, 'Machine Learning Techniques', 5),
(6, 'Data Science Fundamentals', 1),
(6, 'Data Science Fundamentals', 5);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `major` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`user_id`, `name`, `major`, `email`) VALUES
(1, 'Bassem Ahmad', 'Big Data', 'bassem@gmail.com'),
(2, 'Abbas Rammel', 'Math', 'abbas@example.com'),
(3, 'Ali Kawwas', 'Arabic', 'Ali_kawas@gmail.com'),
(4, 'Fatima Mansour', 'Statistics', 'Mansour_fatima@hotmail.com'),
(5, 'Wassim Fawaz', 'Data Science', 'W_fawaz@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `mark_id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `mark` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `registration_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`registration_id`, `student_id`, `course_id`, `instructor_id`, `registration_date`) VALUES
(7, 13, 2, 2, '2024-06-23 13:26:42'),
(8, 13, 6, 1, '2024-06-23 13:26:49'),
(9, 12, 1, 1, '2024-06-23 13:26:55'),
(10, 10, 3, 3, '2024-06-23 13:27:14'),
(11, 10, 5, 2, '2024-06-23 13:27:21'),
(12, 11, 4, 4, '2024-06-23 13:27:29'),
(13, 11, 5, 5, '2024-06-23 13:27:33'),
(14, 11, 2, 4, '2024-06-23 19:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `major` varchar(100) NOT NULL,
  `year_in_school` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`user_id`, `first_name`, `last_name`, `major`, `year_in_school`, `email`) VALUES
(10, 'Sara', 'Wehbi', 'Data Science', 2, 'sara@hotmail.com'),
(11, 'Lina', 'Alameh', 'Data Science', 2, 'lina_alameh@hotmail.com'),
(12, 'samira', 'maalem', 'CS', 1, 'samira@gmail.com'),
(13, 'Ali ', 'Jmayel', 'CS', 3, 'ali_J@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user` int(11) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `plainPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user`, `pass`, `position`, `plainPassword`) VALUES
(1, '$2y$10$l2/mAnL9ic3fvv1jRlA9k.DoxEFGwVzpwNMk40K/fKiS9wxGKp6ky', 'instructor', 'password'),
(2, '$2y$10$NPKihgul83IWx2iUS44j0uJFKZmFm/k56nmlv3PMbhSBqWRBIDnlK', 'instructor', 'password'),
(3, '$2y$10$NPKihgul83IWx2iUS44j0uJFKZmFm/k56nmlv3PMbhSBqWRBIDnlK', 'instructor', 'password'),
(4, '$2y$10$NPKihgul83IWx2iUS44j0uJFKZmFm/k56nmlv3PMbhSBqWRBIDnlK', 'instructor', 'password'),
(5, '$2y$10$NPKihgul83IWx2iUS44j0uJFKZmFm/k56nmlv3PMbhSBqWRBIDnlK', 'instructor', 'password'),
(10, '$2y$10$OZ5cy.uQ88cddF1CyAL4Ke9s7u70M6Kwq.PqiTi7nkUWUV7BoL8B6', 'student', 'password'),
(11, '$2y$10$NPKihgul83IWx2iUS44j0uJFKZmFm/k56nmlv3PMbhSBqWRBIDnlK', 'student', 'password'),
(12, '$2y$10$NPKihgul83IWx2iUS44j0uJFKZmFm/k56nmlv3PMbhSBqWRBIDnlK', 'student', 'password'),
(13, '$2y$10$NPKihgul83IWx2iUS44j0uJFKZmFm/k56nmlv3PMbhSBqWRBIDnlK', 'student', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`,`instructor_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`mark_id`),
  ADD KEY `registration_id` (`registration_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `mark_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`user_id`);

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `fk_marks_registration` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`registration_id`);

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `registration_ibfk_3` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
