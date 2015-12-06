CREATE TABLE `booking` (
  `bookingId` int(11) NOT NULL,
  `tableId` int(11) NOT NULL,
  `bookingPerson` int(11) NOT NULL,
  `bookingDataName` varchar(200) NOT NULL,
  `bookingFrom` datetime NOT NULL,
  `bookingTo` datetime NOT NULL,
  `bookingEmail` varchar(200) NOT NULL,
  `bookingAddress` varchar(500) NOT NULL,
  `bookingComment` text,
  `bookingCreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `tables` (
  `tableId` int(11) NOT NULL,
  `tableName` varchar(50) NOT NULL,
  `tablePerson` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


INSERT INTO `tables` (`tableId`, `tableName`, `tablePerson`) VALUES
(1, 'table.name.1', 2),
(2, 'table.name.2', 2),
(3, 'table.name.3', 2),
(4, 'table.name.4', 4),
(5, 'table.name.5', 4),
(6, 'table.name.6', 4),
(7, 'table.name.7', 6),
(8, 'table.name.8', 6);


ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingId`);

ALTER TABLE `tables`
  ADD PRIMARY KEY (`tableId`);
