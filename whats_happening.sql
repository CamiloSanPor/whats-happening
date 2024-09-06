-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 23, 2024 at 10:35 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whats_happening`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `EventTypeID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `EventDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `SubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `EventTitle` varchar(100) NOT NULL,
  `EventImage` varchar(50) NOT NULL,
  `EventDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `EventTypeID`, `GroupID`, `EventDate`, `SubmitDate`, `EventTitle`, `EventImage`, `EventDesc`) VALUES
(1, 5, 1, '2024-02-25 22:00:00', '2024-01-04 01:11:38', 'Support Spay and Neuter Day', 'files/images/events/animal1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in tortor vitae nulla tincidunt laoreet vel id sapien. Maecenas bibendum enim sed semper volutpat. Etiam euismod dignissim lectus sit amet dictum. Sed vel orci non turpis interdum imperdiet. In molestie viverra libero a hendrerit. Sed elementum purus ac leo tincidunt, et maximus velit pharetra. Ut ultricies est lorem, sit amet viverra orci bibendum sed. Integer tincidunt venenatis felis. Integer malesuada aliquet nunc a pharetra. Morbi nec enim scelerisque, lobortis leo quis, lobortis magna. Vestibulum vel lorem mattis, pulvinar urna ac, congue risus. In et diam ut neque varius sagittis.'),
(2, 3, 6, '2024-02-26 15:00:00', '2024-01-11 01:11:38', 'Come Skate on the Oval', 'files/images/events/skate3.jpg', 'Nunc sit amet nibh non metus tincidunt sodales id ac felis. Cras malesuada enim vel elit tristique scelerisque. Nam enim massa, finibus eget dolor et, convallis sollicitudin enim. Fusce vestibulum nisl ex, auctor consequat tortor finibus vitae. Proin non tortor ligula. Suspendisse volutpat justo ac varius vestibulum. Praesent rutrum, metus a efficitur pretium, elit leo aliquam sapien, ut dictum mi orci sed leo. Pellentesque finibus dignissim neque, sed suscipit turpis pharetra vel. Phasellus malesuada, lectus vitae egestas lacinia, sem mauris condimentum nisl, ac elementum arcu lacus a nisi. Aenean scelerisque purus vitae mi viverra feugiat. Suspendisse aliquam, erat in viverra maximus, sem ligula egestas lectus, eu pretium quam libero ac nulla. Aenean sapien dolor, aliquet nec enim et, convallis maximus diam. Integer luctus arcu vitae nulla vestibulum vulputate.'),
(3, 3, 8, '2024-02-28 00:00:00', '2024-01-15 09:07:28', 'Learn to Ski', 'files/images/events/ski6.jpg', 'Nam aliquam mauris mattis, suscipit diam sit amet, fermentum ex. Nullam volutpat lacus ut nibh ultricies eleifend. Donec eu facilisis nibh. Vivamus tempus enim odio, vel luctus lacus bibendum non. Donec placerat ante eu nibh suscipit, vel lobortis turpis accumsan. Duis ullamcorper orci in nisl varius, semper ultricies purus efficitur. Ut id turpis diam. Suspendisse quis dapibus eros.'),
(4, 4, 2, '2024-02-28 21:00:00', '2024-02-01 18:08:44', 'Food/Wine Pairing', 'files/images/events/food1.jpg', 'Nulla gravida fermentum erat a bibendum. Suspendisse nulla nulla, blandit a pretium quis, egestas non odio. Sed cursus pulvinar porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis purus magna. Integer erat turpis, convallis non nibh eget, viverra gravida massa. Vivamus lacinia elit non purus tempor interdum. Donec accumsan massa sit amet arcu faucibus, at mollis quam tincidunt. Phasellus ex ante, fermentum in orci nec, blandit tempor lectus. Proin eget felis in ligula facilisis tristique nec et dui.'),
(5, 2, 3, '2024-03-01 22:00:00', '2024-02-18 13:18:10', 'Exhibition of Local Dance', 'files/images/events/dance1.jpg', 'Mauris mollis nisi non enim semper porttitor. Quisque lobortis viverra neque. Suspendisse finibus porta libero laoreet fermentum. Donec a sem mi. Morbi lectus ante, venenatis fringilla ornare eu, varius nec lectus. Integer tincidunt eu magna non luctus. Aenean tincidunt ante placerat sodales commodo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam vestibulum turpis massa, et lacinia ex malesuada non.'),
(6, 5, 4, '2024-03-08 20:00:00', '2024-02-21 01:27:33', 'Local Bands compete to raise funds for national competition', 'files/images/events/music1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In efficitur non purus vel aliquet. Maecenas fringilla eget dolor euismod rutrum. Vivamus mattis accumsan metus et aliquet. Donec eu imperdiet odio. Donec fringilla risus elit, et semper erat consequat ut. Fusce sed metus nec dui sodales pharetra. Vivamus sodales et magna vel consequat.'),
(7, 5, 1, '2024-06-02 16:00:00', '2024-02-18 10:16:11', 'Meet, Greet and Adapt Day', 'files/images/events/animal3.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni quasi quae quaerat assumenda laborum facilis voluptate distinctio beatae nesciunt ut, commodi veritatis, nostrum in. Totam nesciunt inventore suscipit error nulla!\r\n'),
(8, 5, 5, '2024-06-25 20:00:00', '2024-02-14 13:08:11', 'Auction of local art to support local artists', 'files/images/events/art1.jpg', 'Phasellus ante quam, semper non malesuada tempor, porta at arcu. Nam et urna dapibus, commodo justo a, venenatis erat. Donec sit amet velit porta, mollis mi nec, viverra nisl. Integer ac velit eu augue convallis euismod. Aliquam ultricies ante sed turpis vehicula lacinia. Vivamus eu sapien eu nunc vestibulum ullamcorper ut et tellus. In eget vehicula eros. Ut condimentum felis non urna blandit, in viverra ex hendrerit. Sed vulputate odio elit, sed gravida justo pharetra at.'),
(9, 1, 4, '2024-07-29 21:00:00', '2024-02-18 01:31:26', 'Spring concert', 'files/images/events/music2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dui justo, maximus sed sagittis at, molestie quis dui. Quisque vitae volutpat justo. Integer nec mauris congue, hendrerit erat at, gravida dui. Praesent blandit nibh vel erat elementum bibendum. Nulla faucibus odio velit, euismod posuere eros molestie eget. Pellentesque a vulputate est, id sollicitudin ipsum. Duis vel elit dolor. Duis porta volutpat quam, mattis varius ipsum sodales et. Integer pharetra tortor in hendrerit scelerisque. Quisque nibh mauris, dapibus at suscipit vel, gravida at nisi. Donec vitae eros id mauris luctus sodales id id diam. Cras in urna nisi. Donec eros lectus, dignissim in tempor eu, semper a felis.'),
(10, 4, 2, '2024-06-30 18:00:00', '2024-02-20 01:31:26', 'Spring Hamper - Get Yours', 'files/images/events/food7.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquet, sem vel sollicitudin ultricies, ex nisl hendrerit tortor, nec rhoncus ex ante at enim. Sed hendrerit tincidunt eros, vitae suscipit odio laoreet nec. Cras malesuada at sem efficitur bibendum. Nunc ullamcorper accumsan leo, et fermentum mi convallis non. Sed sit amet nisl vel leo facilisis auctor in non libero. Integer at dui at eros tempus cursus. Curabitur faucibus vulputate orci, nec ultricies est faucibus quis. Mauris sit amet volutpat mi.'),
(14, 2, 3, '2024-04-04 21:00:00', '2024-03-10 17:12:12', 'Learn to Dance', 'files/images/events/dance5.jpg', 'Duis finibus vitae dolor a tempor. Phasellus molestie purus non tortor vestibulum dapibus. Morbi dictum tellus massa, nec molestie metus pretium non. Maecenas elementum quis lacus sit amet consequat. Vestibulum sit amet auctor elit. Aliquam pretium diam mi, sit amet tincidunt metus ullamcorper vel. Suspendisse potenti.'),
(60, 5, 11, '2024-07-04 18:00:00', '2024-03-23 21:22:09', 'Afternoon of Music', 'files/images/events/music6.jpg', 'Praesent ut enim tellus. Vestibulum interdum orci vel ex tempus, in ullamcorper quam sagittis. Curabitur eget viverra eros. Sed consectetur suscipit eros, sed vestibulum felis maximus a. Maecenas pulvinar, sapien nec aliquam convallis, nulla erat rhoncus diam, sed sollicitudin nisl diam id ex. Sed finibus lacinia neque, eu placerat ipsum hendrerit sit amet. Morbi sit amet pellentesque libero.');

-- --------------------------------------------------------

--
-- Table structure for table `eventtype`
--

CREATE TABLE `eventtype` (
  `EventTypeID` int(11) NOT NULL,
  `EventType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventtype`
--

INSERT INTO `eventtype` (`EventTypeID`, `EventType`) VALUES
(1, 'Music'),
(2, 'Art+Culture'),
(3, 'Sports'),
(4, 'Food'),
(5, 'Fund Raiser');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `GroupID` int(11) NOT NULL,
  `GroupName` varchar(100) NOT NULL,
  `GroupImage` varchar(50) NOT NULL,
  `GroupType` varchar(100) NOT NULL,
  `GroupDesc` text NOT NULL,
  `ContactName` varchar(255) NOT NULL,
  `ContactEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupID`, `GroupName`, `GroupImage`, `GroupType`, `GroupDesc`, `ContactName`, `ContactEmail`) VALUES
(1, 'Human Society', 'files/images/Groups/HumanSociety.jpg', 'Animal Shelter', 'Nullam id pellentesque ante. Vestibulum in convallis mauris.Duis dolor augue, varius eget gravida eu, ullamcorper vitae sem. Curabitur eleifend maximus finibus. Phasellus sagittis porttitor augue ut commodo.Duis dolor augue, varius eget gravida eu, ullamcorper vitae sem. ', 'Petra Barn', 'pb@hs.com'),
(2, 'Eat Local', 'files/images/Groups/EatLocal.jpg', 'Promotes Local Farms', 'Aenean odio ante, efficitur vel porttitor id, imperdiet ut urna. Ut tincidunt nibh sapien, nec interdum eros fringilla in. Cras accumsan rutrum arcu ac congue. Integer finibus velit eu elementum rutrum.', 'Joe Farm', 'joe@farms.com'),
(3, 'Dance NS', 'files/images/Groups/DanceNS.jpg', 'Dance for Youth', 'Sed sit amet urna sed nisl lobortis pharetra sit amet at nulla. Nulla euismod elit in mauris dignissim auctor. Aenean a diam non turpis mollis auctor ac quis est.', 'Ami Glen', 'ami@NSD.com'),
(4, 'Youth Band', 'files/images/Groups/YouthBand.jpg', 'Promotes Local School Bands', 'Ut ligula metus, pretium non dapibus dictum, rutrum at magna. Pellentesque et lorem in diam pharetra cursus eget et ex. Integer finibus velit eu elementum rutrum.', 'Drum Trumpet', 'DT@band.com'),
(5, 'Nocturne Association', 'files/images/Groups/Nocturne.jpg', 'Showcasing and supporting local art', 'Quisque vel rutrum est. Donec in turpis nec enim tincidunt eleifend vel eu nunc.Varius eget gravida eu, ullamcorper vitae sem.', 'P Blue', 'pb@nocturne.com'),
(6, 'Outdoor Skating Group', 'files/images/Groups/Outdoor_Skate.jpg', 'Organizes outdoor skating', 'Nunc vel commodo sapien. Phasellus ac enim sit amet ligula congue scelerisque sit amet quis tellus.Ut tincidunt nibh sapien, nec interdum eros fringilla in. ', 'Blade Fast', 'bf@rink.com'),
(7, 'NS Soccer Association', 'files/images/Groups/NS_Soccer.jpg', 'Organzies youth soccer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam consequat, est et posuere maximus, magna arcu dapibus justo, ac congue dui dui sed tellus. Aliquam bibendum efficitur lacinia. Quisque ac pellentesque turpis', 'Soca Foot', 'soca@soccer.com'),
(8, 'NS Ski School', 'files/images/Groups/NS_Ski.jpg', 'Downhill skiing', 'Aliquam consequat, est et posuere maximus, magna arcu dapibus justo.', 'SK Drowning', 'sk@hill.com'),
(11, 'Halifax Jazz Festival', 'files/images/Groups/music5.jpg', 'Annual Jazz Festival', 'Sed blandit sapien ut mauris pharetra, quis fermentum odio convallis. Curabitur dignissim turpis risus, eget fermentum neque accumsan eu. Proin non nisi lacinia, varius dolor vitae, aliquam elit. Pellentesque imperdiet rhoncus lacinia. Nam vitae ornare magna.', 'B. Major', 'major@jazz.ca');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `AccountID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`AccountID`, `GroupID`, `Username`, `Password`) VALUES
(1, 1, 'humanS', 'acb123'),
(2, 2, 'locals', 'acb124'),
(3, 3, 'dancer', 'acb125'),
(4, 4, 'bands', 'acb126'),
(5, 5, 'nocturne', 'acb127'),
(6, 6, 'skate', 'acb128'),
(7, 7, 'soccer', 'acb129'),
(8, 8, 'skiNS', 'acb130'),
(11, 11, 'jazzyB', 'acb123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `fk_EventTypeID` (`EventTypeID`),
  ADD KEY `fk_GroupID` (`GroupID`);

--
-- Indexes for table `eventtype`
--
ALTER TABLE `eventtype`
  ADD PRIMARY KEY (`EventTypeID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`AccountID`),
  ADD KEY `fk_login_GroupID` (`GroupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `eventtype`
--
ALTER TABLE `eventtype`
  MODIFY `EventTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_EventTypeID` FOREIGN KEY (`EventTypeID`) REFERENCES `eventtype` (`EventTypeID`),
  ADD CONSTRAINT `fk_GroupID` FOREIGN KEY (`GroupID`) REFERENCES `groups` (`GroupID`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_login_GroupID` FOREIGN KEY (`GroupID`) REFERENCES `groups` (`GroupID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
