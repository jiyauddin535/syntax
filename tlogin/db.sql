CREATE DATABASE IF NOT EXISTS login_system;
USE login_system;
CREATE TABLE IF NOT EXISTS `users_twitter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `twitter_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;