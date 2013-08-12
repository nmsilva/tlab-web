drop DATABASE if exists tlab_translate;
create database tlab_translate;
use tlab_translate;


/* Tables for Translate module */

CREATE TABLE SourceMessage
(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(32),
    message TEXT
);
CREATE TABLE Message
(
    id INTEGER,
    language VARCHAR(16),
    translation TEXT,
    PRIMARY KEY (id, language),
    CONSTRAINT FK_Message_SourceMessage FOREIGN KEY (id)
         REFERENCES SourceMessage (id) ON DELETE CASCADE ON UPDATE RESTRICT
);


-- extension User Counter Tables

CREATE TABLE IF NOT EXISTS `pcounter_save` (
  `save_name` varchar(10) NOT NULL,
  `save_value` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pcounter_save`
--

INSERT INTO `pcounter_save` (`save_name`, `save_value`) VALUES
('day_time', 2456024),
('max_count', 2),
('counter', 4),
('yesterday', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pcounter_users`
--
-- Creation: Apr 06, 2012 at 05:42 PM
-- Last update: Apr 06, 2012 at 05:42 PM
--

CREATE TABLE IF NOT EXISTS `pcounter_users` (
  `user_ip` varchar(39) NOT NULL,
  `user_time` int(10) unsigned NOT NULL,
  UNIQUE KEY `user_ip` (`user_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pcounter_users`
--

INSERT INTO `pcounter_users` (`user_ip`, `user_time`) VALUES
('''85.138.178.220''', 1333731345);

-- --------------------------------------------------------

