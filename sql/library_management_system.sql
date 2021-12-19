-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 04:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `b_id` int(11) NOT NULL,
  `b_name` char(25) NOT NULL,
  `b_price` int(11) NOT NULL,
  `publish_year` int(11) NOT NULL,
  `total_copies` int(11) NOT NULL DEFAULT 0,
  `b_author` char(15) NOT NULL,
  `c_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`b_id`, `b_name`, `b_price`, `publish_year`, `total_copies`, `b_author`, `c_id`, `p_id`) VALUES
(1000, 'DBMS', 600, 2016, 8, 'Korth', 1002, 1000),
(1001, 'Harry Potter', 500, 2016, 10, 'JK Rowling', 1001, 1000),
(1002, 'Kolman Busby', 500, 2018, 4, 'Kolman', 1004, 1001),
(1003, 'William Stallings', 400, 2018, 4, 'William', 1003, 1000),
(1004, 'Cormen', 1500, 2018, 3, 'Cormen', 1005, 1002);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`c_id`, `c_name`) VALUES
(1000, 'Computer Science'),
(1001, 'Fiction'),
(1002, 'DBMS'),
(1003, 'CAO'),
(1004, 'DIGST'),
(1005, 'Data Structures');

-- --------------------------------------------------------

--
-- Table structure for table `book_fees`
--

CREATE TABLE `book_fees` (
  `b_id` int(11) NOT NULL,
  `Lost_Book_Fees` int(11) DEFAULT 0,
  `Late_Return_Fees` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_fees`
--

INSERT INTO `book_fees` (`b_id`, `Lost_Book_Fees`, `Late_Return_Fees`) VALUES
(1000, 100, 50),
(1001, 150, 90);

-- --------------------------------------------------------

--
-- Table structure for table `book_issue`
--

CREATE TABLE `book_issue` (
  `m_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `issue_date` date DEFAULT current_timestamp(),
  `due_date` date DEFAULT (curdate() + interval 7 day)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_issue`
--

INSERT INTO `book_issue` (`m_id`, `b_id`, `issue_date`, `due_date`) VALUES
(1001, 1000, '2021-12-06', '2021-12-13'),
(1002, 1002, '2021-12-06', '2021-12-13');

--
-- Triggers `book_issue`
--
DELIMITER $$
CREATE TRIGGER `check_copies` AFTER INSERT ON `book_issue` FOR EACH ROW BEGIN
	UPDATE book SET book.total_copies = book.total_copies - 1 WHERE book.b_id = new.b_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `email_id`
--

CREATE TABLE `email_id` (
  `m_id` int(11) NOT NULL,
  `m_email_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_id`
--

INSERT INTO `email_id` (`m_id`, `m_email_id`) VALUES
(1001, 'rohan@gmail.com'),
(1002, 'gaurav@mail.com'),
(1002, 'kevin08@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `losses_book`
--

CREATE TABLE `losses_book` (
  `m_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `Payment_Date` date DEFAULT current_timestamp(),
  `Cost_Paid` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `losses_book`
--
DELIMITER $$
CREATE TRIGGER `lost_book_data` BEFORE INSERT ON `losses_book` FOR EACH ROW BEGIN 
IF(new.payment_date > (select due_date FROM book_issue WHERE b_id = new.b_id AND m_id = new.m_id))
THEN SET new.cost_paid = (select b_price from book WHERE b_id = new.b_id) + (SELECT Lost_Book_Fees from book_fees WHERE b_id = new.b_id);
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `m_id` int(11) NOT NULL,
  `m_name` char(15) NOT NULL,
  `dob` date NOT NULL,
  `city` char(15) NOT NULL,
  `state` char(15) NOT NULL,
  `street_no` int(11) NOT NULL,
  `street_name` char(15) NOT NULL,
  `apt_no` int(11) NOT NULL,
  `pincode` decimal(6,0) NOT NULL,
  `membership_cost` int(11) DEFAULT 250,
  `join_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`m_id`, `m_name`, `dob`, `city`, `state`, `street_no`, `street_name`, `apt_no`, `pincode`, `membership_cost`, `join_date`) VALUES
(1001, 'Rohan', '2002-06-11', 'Mumbai', 'Maharashtra', 13, 'Park Street', 303, '400001', 250, '2021-12-04'),
(1002, 'Kevin', '2002-03-03', 'Pune', 'Maharashtra', 10, 'Mall Road', 502, '400201', 250, '2021-12-04'),
(1003, 'Gaurav', '2001-04-21', 'Bangalore', 'Karnataka', 9, 'Gandhi Road', 104, '500108', 250, '2021-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `member_phone_no`
--

CREATE TABLE `member_phone_no` (
  `m_id` int(11) NOT NULL,
  `m_phone_no` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_phone_no`
--

INSERT INTO `member_phone_no` (`m_id`, `m_phone_no`) VALUES
(1001, '8291616699'),
(1001, '9810002039'),
(1003, '9865432891');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `p_id` int(11) NOT NULL,
  `p_name` char(30) NOT NULL,
  `purchase_date` date DEFAULT current_timestamp(),
  `cost` int(11) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`p_id`, `p_name`, `purchase_date`, `cost`, `s_id`) VALUES
(1000, 'Arihant Publications', '2021-12-04', 20000, 1001),
(1001, 'Pearson Publications', '2021-12-04', 25000, 1001),
(1002, 'APK Publications', '2021-12-06', 25000, 1001);

-- --------------------------------------------------------

--
-- Table structure for table `return_book`
--

CREATE TABLE `return_book` (
  `m_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `Return_Date` date DEFAULT current_timestamp(),
  `Late_Fees` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_book`
--

INSERT INTO `return_book` (`m_id`, `b_id`, `Return_Date`, `Late_Fees`) VALUES
(1001, 1000, '2021-12-06', 0),
(1002, 1000, '2021-12-15', 50);

--
-- Triggers `return_book`
--
DELIMITER $$
CREATE TRIGGER `set_return_book_data` BEFORE INSERT ON `return_book` FOR EACH ROW BEGIN
UPDATE book SET book.total_copies = book.total_copies + 1 WHERE b_id = new.b_id;
IF ((new.Return_date) > (SELECT due_date FROM book_issue WHERE book_issue.m_id = new.m_id and book_issue.b_id = new.b_id))
THEN SET new.late_fees = (SELECT Late_Return_Fees FROM book_fees  WHERE b_id = new.b_id);
END IF;
DELETE FROM book_issue WHERE book_issue.m_id = new.m_id and book_issue.b_id = new.b_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `s_id` int(11) NOT NULL,
  `s_name` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`s_id`, `s_name`) VALUES
(1001, 'Aakash');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `FK_book_category` (`c_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `book_fees`
--
ALTER TABLE `book_fees`
  ADD KEY `b_id` (`b_id`);

--
-- Indexes for table `book_issue`
--
ALTER TABLE `book_issue`
  ADD PRIMARY KEY (`b_id`,`m_id`),
  ADD KEY `m_id` (`m_id`);

--
-- Indexes for table `email_id`
--
ALTER TABLE `email_id`
  ADD PRIMARY KEY (`m_id`,`m_email_id`);

--
-- Indexes for table `losses_book`
--
ALTER TABLE `losses_book`
  ADD PRIMARY KEY (`m_id`,`b_id`),
  ADD KEY `b_id` (`b_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `member_phone_no`
--
ALTER TABLE `member_phone_no`
  ADD PRIMARY KEY (`m_id`,`m_phone_no`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `return_book`
--
ALTER TABLE `return_book`
  ADD PRIMARY KEY (`m_id`,`b_id`),
  ADD KEY `b_id` (`b_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_book_category` FOREIGN KEY (`c_id`) REFERENCES `book_category` (`c_id`),
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `publisher` (`p_id`);

--
-- Constraints for table `book_fees`
--
ALTER TABLE `book_fees`
  ADD CONSTRAINT `book_fees_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `book` (`b_id`);

--
-- Constraints for table `book_issue`
--
ALTER TABLE `book_issue`
  ADD CONSTRAINT `book_issue_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`),
  ADD CONSTRAINT `book_issue_ibfk_2` FOREIGN KEY (`b_id`) REFERENCES `book` (`b_id`);

--
-- Constraints for table `email_id`
--
ALTER TABLE `email_id`
  ADD CONSTRAINT `email_id_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`) ON DELETE CASCADE;

--
-- Constraints for table `losses_book`
--
ALTER TABLE `losses_book`
  ADD CONSTRAINT `losses_book_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`),
  ADD CONSTRAINT `losses_book_ibfk_2` FOREIGN KEY (`b_id`) REFERENCES `book` (`b_id`);

--
-- Constraints for table `member_phone_no`
--
ALTER TABLE `member_phone_no`
  ADD CONSTRAINT `member_phone_no_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`) ON DELETE CASCADE;

--
-- Constraints for table `publisher`
--
ALTER TABLE `publisher`
  ADD CONSTRAINT `publisher_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `staff` (`s_id`);

--
-- Constraints for table `return_book`
--
ALTER TABLE `return_book`
  ADD CONSTRAINT `return_book_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`),
  ADD CONSTRAINT `return_book_ibfk_2` FOREIGN KEY (`b_id`) REFERENCES `book` (`b_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
