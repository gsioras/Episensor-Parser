
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `measurements` (
  `IDD` int(11) NOT NULL AUTO_INCREMENT,
  `device_datetime` datetime NOT NULL,
  `device_mac` varchar(255) NOT NULL,
  `device_value` varchar(255) NOT NULL,
  `Check` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDD`),
  UNIQUE KEY `IDD` (`IDD`),
  KEY `device_datetime` (`device_datetime`),
  KEY `device_mac` (`device_mac`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3453185 ;
