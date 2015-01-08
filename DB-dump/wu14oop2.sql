-- phpMyAdmin SQL Dump
-- version 4.2.0
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 08 jan 2015 kl 12:50
-- Serverversion: 5.6.17
-- PHP-version: 5.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `wu14oop2`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `Conditions`
--

CREATE TABLE IF NOT EXISTS `Conditions` (
`ID` int(11) NOT NULL,
  `conditionType` varchar(255) DEFAULT NULL,
  `statsType` varchar(255) DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumpning av Data i tabell `Conditions`
--

INSERT INTO `Conditions` (`ID`, `conditionType`, `statsType`, `value`) VALUES
(3, 'equalOrMoreThanValue', 'happiness', 50),
(4, 'lessThanValue', 'happiness', 30),
(5, 'equalOrMoreThanValue', 'food', 50),
(6, 'lessThanValue', 'food', 30),
(7, 'equalOrMoreThanValue', 'money', 50),
(8, 'lessThanValue', 'money', 50),
(9, 'equalOrMoreThanValue', 'military', 40),
(10, 'lessThanValue', 'military', 40),
(11, 'equalOrMoreThanValue', 'military', 100),
(12, 'lessThanValue', 'military', 100),
(13, 'equalOrMoreThanValue', 'education', 30),
(14, 'lessThanValue', 'education', 30),
(15, 'highestOfPlayers', 'education', 0),
(16, 'lowestOfPlayers', 'education', 0),
(17, 'equalOrMoreThanValue', 'military', 50),
(18, 'lessThanValue', 'military', 30),
(19, 'equalOrMoreThanValue', 'education', 70),
(20, 'lessThanValue', 'education', 50),
(21, 'equalOrMoreThanValue', 'money', 70),
(22, 'lessThanValue', 'money', 70),
(23, 'equalOrMoreThanValue', 'happiness', 70),
(24, 'lessThanValue', 'happiness', 30);

-- --------------------------------------------------------

--
-- Tabellstruktur `Effects`
--

CREATE TABLE IF NOT EXISTS `Effects` (
`ID` int(11) NOT NULL,
  `food` int(11) DEFAULT NULL,
  `happiness` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `education` int(11) DEFAULT NULL,
  `military` int(11) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `cardsToRemove` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumpning av Data i tabell `Effects`
--

INSERT INTO `Effects` (`ID`, `food`, `happiness`, `money`, `education`, `military`, `population`, `cardsToRemove`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0),
(2, 0, 0, 20, 0, 0, 10, 0),
(3, 0, 0, -20, 0, 0, -5, 0),
(4, 0, 20, 0, 0, 0, 10, 0),
(5, 0, -20, 0, 0, 0, -10, 0),
(6, -30, 0, 0, 0, 0, 0, 0),
(7, 0, 10, -50, 0, 0, 10, 0),
(8, 0, -20, 0, 0, 0, -10, 0),
(9, 0, 0, 20, 0, 0, 10, 0),
(10, 0, 0, 0, 0, 0, -5, 0),
(11, 0, 20, 60, 0, -40, 10, 0),
(12, -30, -50, -30, -50, -50, -30, 0),
(13, 0, 0, 0, -30, 0, 10, 0),
(14, 0, -20, 0, -50, 0, -5, 0),
(15, 0, 10, 40, 0, 0, 10, 0),
(16, 0, -10, 0, 0, 0, -5, 0),
(17, 20, 0, 0, 0, -30, 10, 0),
(18, -20, 0, 0, 0, 0, -10, 0),
(19, -20, 0, 0, 0, 0, 0, 0),
(20, 0, 20, 0, 0, 0, 10, 0),
(21, 0, -20, 0, 0, 0, -10, 0),
(22, 0, 0, 0, 0, 0, -10, 0),
(23, 0, 20, -70, 0, 0, 10, 0),
(24, 0, -40, 0, 0, 0, -10, 0),
(25, 0, 0, 0, 0, 0, -15, 0),
(26, 0, 0, 50, 0, 0, 10, 0),
(27, 0, 0, 0, 0, 0, -10, 0),
(28, 0, 0, 0, -30, 0, 0, 0),
(29, -20, 0, 0, 0, 0, 0, 0),
(30, 0, 0, 20, 0, 0, 0, 0),
(31, 0, 0, -30, 0, 0, 0, 0),
(32, 0, 20, 0, 0, 0, 0, 0),
(33, 0, 0, -10, 0, 0, 0, 0),
(34, 0, 0, 30, 0, 0, 0, 0),
(35, 0, 0, -30, 0, 0, 0, 0),
(36, 0, 0, -40, 0, 0, 0, 0),
(37, 0, 0, 0, 0, 0, 0, 1),
(38, 0, 0, -30, 0, 0, 0, 0),
(39, 0, 40, 0, 0, 0, 0, 0),
(40, 0, -40, 0, 0, 0, 0, 0),
(41, 0, 0, 0, 0, 30, 0, 0),
(42, 0, -20, 0, 0, 0, 0, 0),
(43, 0, 0, 0, 30, 0, 0, 0),
(44, 0, 0, -40, 0, 0, 0, 0),
(45, 0, 0, 0, 30, 0, 0, 0),
(46, 0, 0, 0, -30, 0, 0, 0),
(47, 0, 0, 0, 0, 30, 0, 0),
(48, -30, 0, 0, 0, 0, 0, 0),
(49, 0, 40, 0, 0, 0, 0, 0),
(50, 0, 0, -50, 0, 0, 0, 0),
(51, 0, 0, 0, 0, 50, 0, 0),
(52, 0, 0, 0, 0, -50, 0, 0),
(53, -20, 0, 0, 0, 0, 0, 0),
(54, 0, -30, 0, 0, 0, 0, 0),
(55, 0, 0, -30, 0, 0, 0, 0),
(56, 40, 0, 0, 0, 0, 0, 0),
(57, -40, 0, 0, 0, 0, 0, 0),
(58, -30, 0, 0, 0, 0, 0, 0),
(59, 0, 0, 0, 0, 20, 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `EventCards`
--

CREATE TABLE IF NOT EXISTS `EventCards` (
`ID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `winConditionID` int(11) DEFAULT NULL,
  `loseConditionID` int(11) DEFAULT NULL,
  `winEffectID` int(11) DEFAULT NULL,
  `loseEffectID` int(11) DEFAULT NULL,
  `startupEffectID` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumpning av Data i tabell `EventCards`
--

INSERT INTO `EventCards` (`ID`, `title`, `description`, `winConditionID`, `loseConditionID`, `winEffectID`, `loseEffectID`, `startupEffectID`) VALUES
(1, 'Visitors', 'A royalty is visiting our region. Make sure your population is kept happy so they don''t cause a riot.', 3, 4, 2, 3, 1),
(2, 'Drought', 'There has been a drought throughout the region. You need to fill the food supply so that your people won''t starve.', 5, 6, 4, 5, 6),
(3, 'Late pay day', 'The money that we needed for this monthly pay day didn''t arrive. You need to get enough money to pay your citizens'' salary quickly before they start a riot.', 7, 8, 7, 8, 1),
(4, 'Dragon sighted in the kingdom!', 'A dragon has been sighted in the kingdom! The king has requested everyone to increase their military assets immediately.', 9, 10, 9, 10, 1),
(5, 'Dragon in our region!', 'A dragon has entered your region! Defeat it quickly before it attacks us!', 11, 12, 11, 12, 1),
(6, 'Bookie monster invasion!', 'Our scouts are reporting a large quantity of bookie monsters migrating to our region. We need to lure them off before they eat all of our books!', 13, 14, 13, 14, 1),
(7, 'School competition', 'There is going to be a big competition between the schools in the region. The winner gets a big price!', 15, 16, 15, 16, 1),
(8, 'Wounded hunters', 'Many of our hunters got wounded during a hunt. Send out some of our military to help the remaining hunters.', 17, 18, 17, 18, 19),
(9, 'Sickness in the region', 'There is a disease spreading throughout the region. We need to figure out how to treat and cure it before too many get sick.', 19, 20, 20, 21, 22),
(10, 'Earthquake', 'There has been an earthquake, several buildings were damaged or destroyed. We need to pay for the repairs.', 21, 22, 23, 24, 25),
(11, 'Happiness survey', 'The king has started a happiness survey in our region. If the citizens are happy with our work he might give us a nice bonus.', 23, 24, 26, 27, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `PlayerNames`
--

CREATE TABLE IF NOT EXISTS `PlayerNames` (
`ID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumpning av Data i tabell `PlayerNames`
--

INSERT INTO `PlayerNames` (`ID`, `name`) VALUES
(1, 'Ymir'),
(2, 'Joul'),
(3, 'Germondo'),
(4, 'Hauser'),
(5, 'Lillou'),
(6, 'Zamanya'),
(7, 'Xander'),
(8, 'Wolf'),
(9, 'Rougar'),
(10, 'Dendria'),
(11, 'Query'),
(12, 'Illiara');

-- --------------------------------------------------------

--
-- Tabellstruktur `ToolCards`
--

CREATE TABLE IF NOT EXISTS `ToolCards` (
`ID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `targetSelf` tinyint(1) DEFAULT NULL,
  `costEffectID` int(11) DEFAULT NULL,
  `selfEffectID` int(11) DEFAULT NULL,
  `opponentEffectID` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumpning av Data i tabell `ToolCards`
--

INSERT INTO `ToolCards` (`ID`, `title`, `description`, `targetSelf`, `costEffectID`, `selfEffectID`, `opponentEffectID`) VALUES
(1, 'Unleash bookie monster', 'Our hunters have captured a bookie monster. We can unleash it on one of our neighbours and have it eat their books.', 0, 1, 1, 28),
(2, 'Sell food for money', 'A merchant visiting our town want to buy some food from us and give us money in return.', 1, 29, 30, 1),
(3, 'Buy food for money', 'A merchant visiting our town want to sell some food to us for money.', 1, 31, 32, 1),
(4, 'Burglar for hire', 'There is a burglar that say he can steal money from one of our neighbours and bring some of it to you.', 0, 33, 34, 35),
(5, 'Saboteur', 'A man says that he can break things in a neighbouring town for you, if the pay is right.', 0, 36, 1, 37),
(6, 'Festival', 'We have the possibility to have a festival in our town. That should make the citizens happier.', 1, 38, 39, 1),
(7, 'Force citizens to join the military', 'We can have some of our soldiers recruit people on the streets to increase our military strength.', 1, 40, 41, 1),
(8, 'Force people to go to school', 'We feel that our citizens are not educated enough for our standards. Make them like going to school!', 1, 42, 43, 1),
(9, 'Buy books from merchant', 'There is a merchant that is selling books. Expensive but good educational books.', 1, 44, 45, 1),
(10, 'Less teachers more soldiers', 'We feel that we need more soldiers than teachers.', 1, 46, 47, 1),
(11, 'Public feast', 'We have been stockpiling food enough for a big feast for our people.', 1, 48, 49, 1),
(12, 'Bribe neighbouring town guard', 'The neighbouring town guards are complaining about their low salary, we can give them a better offer. Temporarily.', 0, 50, 51, 52),
(13, 'Town drunk causing a ruckus', 'We can pay the town drunk and his friends in food and drinks to cause a ruckus in a neighbouring town.', 0, 53, 1, 54),
(14, 'Raid neighbour''s food storage', 'We have gathered a few people that are willing to raid one of our neighbour''s food storage and bring it back here.', 0, 55, 56, 57),
(15, 'Recruit hungry people', 'There are a few hungry people out there on the streets. We can give them food and offer them a job as town guards.', 1, 58, 59, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `TownNames`
--

CREATE TABLE IF NOT EXISTS `TownNames` (
`ID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumpning av Data i tabell `TownNames`
--

INSERT INTO `TownNames` (`ID`, `name`) VALUES
(1, 'Duln'),
(2, 'Samton'),
(3, 'Almon'),
(4, 'Rauler'),
(5, 'Fenden'),
(6, 'Olmam'),
(7, 'Berscht'),
(8, 'Youo'),
(9, 'Tamarr'),
(10, 'Elm Dale'),
(11, 'Poloro'),
(12, 'Teslor');

-- --------------------------------------------------------

--
-- Tabellstruktur `Towns`
--

CREATE TABLE IF NOT EXISTS `Towns` (
`ID` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `food` int(11) DEFAULT NULL,
  `happiness` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `education` int(11) DEFAULT NULL,
  `military` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `Towns`
--

INSERT INTO `Towns` (`ID`, `type`, `food`, `happiness`, `money`, `education`, `military`) VALUES
(1, 'Farming village', 50, 40, 30, 10, 20),
(2, 'Small village', 40, 50, 20, 30, 10),
(3, 'Industrial town', 10, 20, 50, 40, 30),
(4, 'University town', 20, 30, 10, 50, 40),
(5, 'Fortress', 30, 10, 40, 20, 50);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `Conditions`
--
ALTER TABLE `Conditions`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `Effects`
--
ALTER TABLE `Effects`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `EventCards`
--
ALTER TABLE `EventCards`
 ADD PRIMARY KEY (`ID`), ADD KEY `winConditionID` (`winConditionID`), ADD KEY `loseConditionID` (`loseConditionID`), ADD KEY `winEffectID` (`winEffectID`), ADD KEY `loseEffectID` (`loseEffectID`), ADD KEY `startupEffectID` (`startupEffectID`);

--
-- Index för tabell `PlayerNames`
--
ALTER TABLE `PlayerNames`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `ToolCards`
--
ALTER TABLE `ToolCards`
 ADD PRIMARY KEY (`ID`), ADD KEY `costEffectID` (`costEffectID`), ADD KEY `selfEffectID` (`selfEffectID`), ADD KEY `opponentEffectID` (`opponentEffectID`);

--
-- Index för tabell `TownNames`
--
ALTER TABLE `TownNames`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `Towns`
--
ALTER TABLE `Towns`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `Conditions`
--
ALTER TABLE `Conditions`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT för tabell `Effects`
--
ALTER TABLE `Effects`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT för tabell `EventCards`
--
ALTER TABLE `EventCards`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT för tabell `PlayerNames`
--
ALTER TABLE `PlayerNames`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT för tabell `ToolCards`
--
ALTER TABLE `ToolCards`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT för tabell `TownNames`
--
ALTER TABLE `TownNames`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT för tabell `Towns`
--
ALTER TABLE `Towns`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `EventCards`
--
ALTER TABLE `EventCards`
ADD CONSTRAINT `eventcards_ibfk_1` FOREIGN KEY (`winConditionID`) REFERENCES `Conditions` (`ID`),
ADD CONSTRAINT `eventcards_ibfk_2` FOREIGN KEY (`loseConditionID`) REFERENCES `Conditions` (`ID`),
ADD CONSTRAINT `eventcards_ibfk_3` FOREIGN KEY (`winEffectID`) REFERENCES `Effects` (`ID`),
ADD CONSTRAINT `eventcards_ibfk_4` FOREIGN KEY (`loseEffectID`) REFERENCES `Effects` (`ID`),
ADD CONSTRAINT `eventcards_ibfk_5` FOREIGN KEY (`startupEffectID`) REFERENCES `Effects` (`ID`);

--
-- Restriktioner för tabell `ToolCards`
--
ALTER TABLE `ToolCards`
ADD CONSTRAINT `toolcards_ibfk_1` FOREIGN KEY (`costEffectID`) REFERENCES `Effects` (`ID`),
ADD CONSTRAINT `toolcards_ibfk_2` FOREIGN KEY (`selfEffectID`) REFERENCES `Effects` (`ID`),
ADD CONSTRAINT `toolcards_ibfk_3` FOREIGN KEY (`opponentEffectID`) REFERENCES `Effects` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
