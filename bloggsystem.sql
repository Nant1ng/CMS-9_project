-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 13 mars 2021 kl 15:44
-- Serverversion: 10.4.17-MariaDB
-- PHP-version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `bloggsystem`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `comment` varchar(2500) NOT NULL,
  `date` date NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`commentID`, `comment`, `date`, `postID`, `userID`, `username`) VALUES
(7, 'Hej detta är första kommentaren!', '2021-03-03', 3, 6, 'sr'),
(9, '                    testar       att ändra             \r\n                    ', '2021-03-03', 3, 6, 'sr'),
(10, 'hej', '2021-03-03', 3, 6, 'sr'),
(11, 'hej', '2021-03-03', 3, 6, 'sr'),
(12, 'hej', '2021-03-03', 3, 6, 'sr'),
(14, '                                                                                Testing new comments!                 \r\n                                        \r\n                                        \r\n                                        \r\n                                        \r\n                    ', '2021-03-04', 5, 6, 'sr'),
(15, 'Testar en ny comment!', '2021-03-04', 5, 6, 'sr'),
(16, 'Testar ännu mer', '2021-03-04', 5, 6, 'sr'),
(17, 'Yao yao fräsch klocka!', '2021-03-04', 5, 6, 'sr'),
(19, 'hej hej detta är cm som kommenterar', '2021-03-04', 3, 7, 'cm'),
(20, '                                                                                                    testar att lägga in en kommentar och att ändra den! och testar igen som admin!             \r\n                                        \r\n                                        \r\n                                        \r\n                                        \r\n                    ', '2021-03-06', 3, 8, 'ja'),
(21, 'Here is another comment!', '2021-03-07', 5, 6, 'sr'),
(22, 'Testar att kommentera', '2021-03-08', 14, 6, 'sr'),
(23, 'hej hej', '2021-03-08', 3, 6, 'sr'),
(24, 'Hej Carlos hur mår du!', '2021-03-09', 14, 6, 'sr'),
(25, '                        Hej Rasmus!    Hoppas du mår bra idag! Bra kämpat med grupparbetet :)\r\n                    ', '2021-03-11', 14, 6, 'sr');

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `postID` int(11) NOT NULL,
  `title` varchar(35) NOT NULL,
  `description` varchar(2500) NOT NULL,
  `imageUrl` varchar(1000) NOT NULL,
  `category` varchar(25) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`postID`, `title`, `description`, `imageUrl`, `category`, `date`) VALUES
(3, 'The \'Timeless glasses\'', '                                                                                                                        The other day we had a blast with our virgin orangejuice margaritas with the staff. We used our \'Timeless glasses\'. These have a stable foot and is a perfect decoration for the kitchen. We recommend to decorate with a fruit when serving!                  \r\n                                        \r\n                                        \r\n                                        \r\n                        \r\n                        \r\n                        \r\n                    ', 'https://images.pexels.com/photos/338713/pexels-photo-338713.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'Decor', '2021-02-27'),
(4, 'The \'Retro glasses\'', 'Our client Felicia had this awesome photoshoot and shared one of the marvelous photos. What do tell about our \'Retro glasses\' is that it\'s for everyday use as special occasion, why not a summerwedding, with the right floral dress? Let\'s us know what you think!                \r\n                    ', 'https://images.pexels.com/photos/2811088/pexels-photo-2811088.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260', 'Glasses', '2021-02-27'),
(5, 'Beautiful watch', 'It was a regular sunday, and my client Sara used our Classic watch from Millhouse, and a quote \" it felt like a beautiful watch for everyday use.\" It comes with a light brown leatherband and can be used for everyday adventure', 'https://images.pexels.com/photos/4684396/pexels-photo-4684396.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'Watch', '2021-02-27'),
(14, 'Canvas \'Little guy\'', 'Lorem ipsum dolor sit amet, \r\n\r\nconsectetur adipiscing elit. Proin cursus, enim vitae posuere commodo, purus sem sodales nisi, ut dictum elit purus a neque. \r\n\r\nMauris at ipsum felis. In non metus elementum, feugiat lorem ut, ullamcorper lectus. Proin bibendum aliquet turpis, ac mattis neque pellentesque a. Ut pharetra metus sem, quis varius nisi dictum et. Donec tempus purus sit amet sapien viverra, in varius arcu hendrerit. Curabitur aliquam ultricies orci, sollicitudin varius felis.    \r\n                        \r\n                    ', '../image/uploads/Skärmavbild 2021-03-01 kl. 21.17.28.png', 'Decor', '2021-03-08');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`userID`, `fname`, `lname`, `username`, `password`, `email`, `role`) VALUES
(6, 'Sandra', 'Rivas', 'sr', '8572c4654ca91c2070b96baee572e48c', 'sandee.rivas@gmail.com', 'admin'),
(7, 'Carlos', 'Martinez', 'cm', 'eeaf525d115a55a01f1c7ae23eaa906c', 'carlos@carlos.se', 'user'),
(8, 'Jose', 'Acosta', 'ja', 'c98820cf19ccf6602d72dcf2c43c0353', 'jose@jose.com', 'user');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `userID` (`userID`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
