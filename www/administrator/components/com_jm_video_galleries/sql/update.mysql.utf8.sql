SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE TABLE IF NOT EXISTS `#__jmvg_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;
CREATE TABLE IF NOT EXISTS `#__jmvg_videos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `video_type` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` date NOT NULL DEFAULT '0000-00-00',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `cat_ids` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;
