-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2019 at 09:34 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipho`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `consultation_id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `hcp_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` varchar(10) NOT NULL,
  `booking_status` varchar(30) NOT NULL,
  `booking_price` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `consultation_id`, `user_id`, `hcp_id`, `session_id`, `booking_date`, `booking_time`, `booking_status`, `booking_price`) VALUES
(9, 3, '8937574839263', 2, 634, '2019-11-16', '12:00 PM', 'Pending', '300.00'),
(10, 3, '8937574839263', 2, 681, '2019-11-16', '12:00 PM', 'Completed', '300.00'),
(11, 3, '8937574839263', 2, 775, '2019-11-18', '14:00 PM', 'Pending', '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_body` text NOT NULL,
  `user_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `consultation_id` int(11) NOT NULL,
  `consultation_name` varchar(50) NOT NULL,
  `consultation_desc` text NOT NULL,
  `consultation_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`consultation_id`, `consultation_name`, `consultation_desc`, `consultation_price`) VALUES
(1, 'Check Up', 'At Alt Life is Health, we offer health check-ups that are tailored to your age, gender, and specific conditions that require medical follow-ups. This can be your starting point to a healthier well-being.\r\n                        <br><br>\r\n                        Health Life is Possible can provide you with an assessment of your medical history and your lifestyle habits. We will carry out an extensive physical exam that includes any necessary laboratory tests.\r\n                        <br><br>\r\n                        We will contact you to inform you of the results, often within 48 business hours of taking samples from you.\r\n                        <br><br>\r\n                        We will also provide you with appropriate recommendations and you will be able to get a follow-up appointment with one of our private clinic\\\'s family doctors.', 400),
(2, 'Vaccination', 'Alt Health private medical clinic offers all the most commonly-requested vaccinations:\r\n                        <br><br>\r\n                        <ol>\r\n                        <li>Diphtheria</li>\r\n                        <li>Tetanus</li>\r\n                        <li>Hepatitis A</li>\r\n                        <li>Hepatitis B</li>\r\n                        <li>HPV</li>\r\n                        <li>Influenza</li>\r\n                        <li>Shingles</li> </ol>', 300),
(3, 'Personalized Medical Care', 'Each person is different and should have an overall health check-up that is tailored to their age and gender, and to their specific health needs. In some cases, studying the patient’s specific genetic traits may help identify the most appropriate treatment.\r\n                        <br><br>\r\n                        Good health involves a balanced combination of internal and external factors and requires active patient involvement. Following your check-up and the results of the various laboratory tests, we will draw up a personalized healthcare roadmap for you based on the five pillars of good health:\r\n                        <br><br>\r\n                        <ol>\r\n                            <li>Health-restoring slumber (elimination of sleeping disorders)</li>\r\n                            <li>Healthy immune system (elimination of food intolerances, intestinal hyperpermeability, endothelial dysfunction, or imbalance of the purification or elimination mechanisms)</li>\r\n                            <li>Optimization of hormonal balance and nutritional and energy intakes (hormone therapy and supplements if required)</li>\r\n                            <li>Musculoskeletal stimulation (personalized physical fitness program)</li>\r\n                            <li>Development of a positive relationship with yourself and your surroundings (stress management and senses management).</li>\r\n                        </ol>\r\n                        <br>\r\n                        <strong>We provide a roadmap to our clients so they can regain their physical health and enjoy a healthier lifestyle.<strong>', 300),
(4, 'Blood Test', 'Health Life is Possible offers you: <br>\r\n\r\n            <ul>\r\n            <li>A wide range of blood and urinary testing, including some for genetic profiling; </li>\r\n            <li>Processing of laboratory tests prescribed by other clinics or physicians. In the event of significant anomalies, our nursing staff will ensure that your doctor is informed or that you are promptly referred for the appropriate treatment for your condition;</li>\r\n            <li>Receipt and archiving of your results in a digital format to facilitate optimal follow-up for each patient;</li>\r\n            <li>Most results ready for collection in less than 48 hours.</li>\r\n            </ul>\r\n            <br><br>\r\n            <strong>Please note that our rates are extremely competitive and are reimbursable by most collective insurance plans as well as being tax-deductible.</strong>', 400);

-- --------------------------------------------------------

--
-- Table structure for table `hcp`
--

CREATE TABLE `hcp` (
  `hcp_id` int(11) NOT NULL,
  `hcp_name` varchar(50) NOT NULL,
  `hcp_spec` text NOT NULL,
  `hcp_email` varchar(50) NOT NULL,
  `hcp_password` varchar(255) NOT NULL,
  `hcp_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hcp`
--

INSERT INTO `hcp` (`hcp_id`, `hcp_name`, `hcp_spec`, `hcp_email`, `hcp_password`, `hcp_pic`) VALUES
(1, 'Sipho Mhlanga', 'General Practitioner', 'sipho@althealth.co.za', '1234567', 'none'),
(2, 'Van Niekerk', 'Family Health', 'niekerk@althealth.co.za', '1234567', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `invoice_total` int(11) NOT NULL,
  `invoice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `user_id`, `booking_id`, `invoice_total`, `invoice_date`) VALUES
(1, '8937574839263', 3, 300, '2019-11-15'),
(2, '8937574839263', 3, 300, '2019-11-17'),
(3, '8937574839263', 3, 400, '2019-09-11'),
(4, '8937574839263', 3, 500, '2019-10-22'),
(5, '8937574839263', 4, 300, '2019-08-13'),
(6, '8937574839263', 4, 400, '2019-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `reply_body` text NOT NULL,
  `hcp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(15) NOT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_surname` varchar(50) NOT NULL,
  `user_tel_h` varchar(10) NOT NULL,
  `user_tel_w` varchar(10) NOT NULL,
  `user_tel_c` varchar(10) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_reference` varchar(40) NOT NULL,
  `user_dob` date NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_gender` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_first_name`, `user_surname`, `user_tel_h`, `user_tel_w`, `user_tel_c`, `user_email`, `user_password`, `user_reference`, `user_dob`, `user_address`, `user_gender`) VALUES
('8937574839263', 'Test', 'Test', '0847878179', '0847878179', '0847878179', 'test@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Facebook', '1991-11-12', '99 Bourke Street Pretoria', 'M'),
('8958304759574', 'Sipho', 'Sipho', '0847878179', '0847878179', '0847878179', 'sipho@gmail.com', '1234567', 'Facebook', '1991-11-03', '99 Bourke Street Pretoria', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`consultation_id`);

--
-- Indexes for table `hcp`
--
ALTER TABLE `hcp`
  ADD PRIMARY KEY (`hcp_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hcp`
--
ALTER TABLE `hcp`
  MODIFY `hcp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
