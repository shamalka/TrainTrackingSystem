-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2018 at 06:16 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `train`
--

-- --------------------------------------------------------

--
-- Table structure for table `logininfo`
--

CREATE TABLE `logininfo` (
  `userid` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logininfo`
--

INSERT INTO `logininfo` (`userid`, `usertype`, `password`) VALUES
('1', 'ADMIN', '1');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `Title` varchar(250) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Description` longtext NOT NULL,
  `added by` varchar(50) NOT NULL,
  `verify` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`Title`, `Date`, `Time`, `Description`, `added by`, `verify`) VALUES
('nnrfnreign eirfoj', '0000-00-00', '01:01:01', 'jfeniwnfin enfiwin', 'ADMIN', 'VERIFIED'),
('vrmgkn ejnknfi', '0000-00-00', '05:07:11', 'wefknefk wekv wke fkjwnfknf wenfnwi', 'ADMIN', 'VERIFIED'),
('Mechan Jacks Lift Expectations for Crossrail Trains', '2018-09-05', '16:27:20', 'Trains running on London’s eagerly anticipated Elizabeth Line will spend more time in service and less in the depot, thanks to rail maintenance equipment specialist, Mechan.\r\n\r\nThe Sheffield-based manufacturer has developed a bespoke set of jacks capable of lifting the complete nine-car electric trains being introduced in the capital, as part of the Crossrail project.\r\n\r\nA 36-jack set has been installed at the new Old Oak Common depot in north London, along with five bogie turntables, in a deal that has given Mechan’s order book a £1 million boost.\r\n\r\nThanks to the firm’s unique Megalink control system, its flagship jacks can be configured in any number to lift trains without splitting carriages, saving valuable servicing time. The Old Oak Common set is among the largest produced to date, although a record 44 are in use at the Longsight depot in Manchester to maintain 11-car Pendolinos.\r\n\r\nMartin Berry, Mechan’s engineering manager, said:\r\n\r\n“We have worked with Bombardier many times and thanks to our ongoing relationship and the performance of our equipment elsewhere, it was specified by Crossrail from the outset. Keeping passenger services running at full capacity is a huge challenge for the industry, so having the ability to lift a full train is a significant way to save time and make the maintenance process more efficient.”\r\n\r\nMechan’s jacks and turntables are now installed and commissioned at Old Oak Common, ahead of the Elizabeth Line’s launch in December this year. A total of 70 nine-car Bombardier Class 345 electric crossrail trains will run on the new commuter service, the majority of which will be maintained and stabled at the depot.', 'ADMIN', 'VERIFIED'),
('The Biggest Rail Show in the World', '2018-09-11', '07:38:49', 'It’s 2018 and it’s back! The world’s biggest trade fair for the railway sector will take place this month.\r\n\r\nTaking place every two years, 2018 will be the twelfth time InnoTrans will fill Berlin’s Messe halls with visitors, exhibitors and experts from the rail sector.\r\n\r\nSome Quick Facts:\r\nDates: \r\n\r\n17 September – press day\r\n18–21 September – InnoTrans open for trade visitors, 9am–6pm 22–23 September – visitor days, only for the Outdoor Display area, 10am–6pm\r\nLocation: \r\n\r\nMesse Berlin GmbH, ExpoCenter City, Messedamm 22, 14055 Berlin\r\n2016 stats:\r\n\r\n2,955 exhibitors from 60 countries – almost 200 more than in 2014\r\n137,391 visitors from 119 countries – almost 3,800 more than in 2014\r\nFirst time InnoTrans features the Bus Display\r\nInnoTrans fills all 41 halls and the Outdoor Display area of Berlin Messe – that’s an area of 200,000 square metres\r\n3,500m of track to showcase rolling stock on the Outdoor Display area\r\nAreas: \r\nRailway Technology\r\nRailway Infrastructure\r\nPublic Transport\r\nInteriors\r\nTunnel Construction\r\nIn addition to halls being filled with exhibitors from these five different areas, the Outdoor Display and the Bus Display, InnoTrans 2018 will again feature a Career & Education Hall (7.1c), which will house the Career Pavilion, the Career Forum and the Jobwall all in one place. Exhibitors are able to feature their company with a stand in this hall or they can request space in the Career Pavilion, where HR experts can focus on recruiting the right employees for them.\r\n\r\nThe Career Forum is a space featuring seating for approx. 60 attendees. Companies are able to present themselves here as a potential employer. Some of the organisations presenting themselves at the Career Forum include:\r\n\r\nTÜV SÜD Rail GmbH\r\nAllianz pro Schiene e.V.\r\nIFV Bahntechnik e.V.\r\nAkiem Holding SAS', 'STAFF', 'NOT VERIFIED'),
('The Ideal Solution for a Fast and Easy Track Survey', '2018-09-13', '11:22:29', 'On the occasion of the InnoTrans fair in Berlin, Amberg Technologies will present its new IMS system with GNSS. Cutting-edge IMU technology combined with GNSS is the perfect solution for performing a track survey without control points and track design information.\r\n\r\nOftentimes railway surveyors are expected to provide data for challenging construction and maintenance projects on tracks whose control points and design information are missing. Up to now, the reconstruction of the missing data required a lot of time and resources.\r\n\r\nSmart Data – Smart Software\r\nThe collected survey data enable to generate automatically a 3D model of the track alignment and 3D coordinates of the newly created control points, which are compatible with BIM platforms and CAD systems. With the help of the Amberg Rail software, designed for both field and office applications, survey engineers can make the most of their data: analyse the track geometry, calculate the Track Quality Index (TQI), produce reports and much more.', 'ADMIN', 'VERIFIED'),
('RAILWAY STRIKES AGAIN', '2018-09-13', '16:36:30', 'Several railway trade unions launched a strike from 3pm yesterday without prior notice against the latest Cabinet decision to suspend the Cabinet paper proposing the rectification of railway workers’ salary anomalies.\r\n\r\nTrade unions representing engine drivers, guards, controllers and station masters are engaged in the strike.\r\n\r\nRailway Trade Union Alliance Co-Convener Lal Ariyaratne said trains that had begun their journeys ply but no train would leave thereafter.\r\n\r\nRailway services were affected with commuters due to depart home after work. Thousands of commuters were left stranded which resulted in a tense situation since the train services were cancelled without prior notice at the Colombo Fort and Maradana Railway stations.', 'ADMIN', 'VERIFIED');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `trainid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `apprating` int(2) NOT NULL,
  `trainrating` int(2) NOT NULL,
  `appfeedback` longtext NOT NULL,
  `trainfeedback` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`trainid`, `userid`, `apprating`, `trainrating`, `appfeedback`, `trainfeedback`) VALUES
(10001, 50003, 8, 6, 'Excellent', 'Good Ride'),
(10002, 50006, 6, 7, 'Good', 'Pleasant Journey'),
(10004, 50004, 6, 8, 'ehukwef feibwifb beifbi', 'iebfib jeniwni einbiw'),
(10004, 50005, 7, 8, 'uhfiweriuh webfibif weifbiu', 'uewhfiuhfiu jwebfibi weifbwib'),
(10005, 50007, 5, 2, 'ebfi iuwehfih jibbbibi jbuibbub', 'ebhbv bibib jibibi bibi');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `trainid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `payment` varchar(25) NOT NULL,
  `check_in` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`trainid`, `userid`, `payment`, `check_in`) VALUES
(10001, 50001, 'NO', 'NO'),
(10002, 50002, 'NO', 'NO'),
(10002, 50006, 'YES', 'NO'),
(10004, 50006, 'YES', 'NO'),
(10005, 50008, 'YES', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `trainid` int(10) NOT NULL,
  `start` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `for_reserve` int(5) NOT NULL,
  `available` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`trainid`, `start`, `destination`, `date`, `start_time`, `end_time`, `for_reserve`, `available`) VALUES
(10001, 'colombo', 'kandy', '0000-00-00', '05:10:15', '10:05:10', 50, 15),
(10002, 'colombo', 'batticoloa', '0000-00-00', '06:30:01', '18:41:01', 100, 100),
(10004, 'galle', 'rathnapura', '2018-10-14', '06:05:01', '19:38:01', 75, 75),
(10005, 'colombo', 'jaffna', '2018-09-19', '05:00:00', '13:00:00', 200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nic` varchar(10) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `nic`, `mail`, `phone`, `address`, `password`, `status`) VALUES
(50001, 'nimal fernando', '851236451V', 'ewjkvbjk@mail.com', 51616165, 'Matara', 'rvbkwjbvkb', 'ACTIVE'),
(50002, 'amal pieris', '789456123V', 'dhbjf@gmail.com', 741852963, 'Galle', 'vbewbvikb', 'ACTIVE'),
(50003, 'akesha somarathna', '564213789V', 'djbewkfb@yamila.com', 369852147, 'Rathnapura', 'rebvjeb', 'BANNED'),
(50004, 'kumara silva', '852741963V', 'vwrvir@google.com', 362589148, 'Hambanthota', 'wrvbjwb', 'ACTIVE'),
(50005, 'nimesha kulathunga', '852041963V', 'sdbvb@mail.com', 741456963, 'Anuradhapura', 'echbej', 'ACTIVE'),
(50006, 'sivakumar amalan', '963208541V', 'jwebvjh@hotamil.com', 427538619, 'Jaffna', 'cniecbibf', 'ACTIVE'),
(50007, 'kaeshavan selvan', '963230567V', 'kaeshavan7@gmail.com', 776642841, 'Colombo', 'ucsc@123', 'ACTIVE'),
(50008, 'saliya de silva', '753420186V', 'ewfvj@mail.com', 761669634, 'Kurunegala', 'ejcbjhw', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logininfo`
--
ALTER TABLE `logininfo`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`Date`,`Time`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`trainid`,`userid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`trainid`,`userid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`trainid`),
  ADD KEY `trainid` (`trainid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `trainid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10006;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50009;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`trainid`) REFERENCES `timetable` (`trainid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`trainid`) REFERENCES `timetable` (`trainid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
