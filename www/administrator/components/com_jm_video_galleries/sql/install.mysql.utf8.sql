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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
INSERT INTO `#__jmvg_categories` (`id`, `title`, `image`, `description`, `ordering`, `state`, `checked_out`, `checked_out_time`, `created_by`) VALUES
(1, 'City Bikes', '', '', 1, 1, 0, '0000-00-00 00:00:00', 42),
(2, 'City Cars', '', '', 2, 1, 0, '0000-00-00 00:00:00', 42),
(3, 'City Limits', '', '', 3, 1, 0, '0000-00-00 00:00:00', 42);
UPDATE `#__jmvg_categories` SET `created_by` = (SELECT `user_id` FROM `#__user_usergroup_map` WHERE `group_id` = 8 LIMIT 1);
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
INSERT INTO `#__jmvg_videos` (`title`, `alias`, `video_type`, `url`, `image`, `description`, `ordering`, `state`, `date_created`, `checked_out`, `checked_out_time`, `created_by`, `cat_ids`) VALUES
('City Limits', 'city-limits', 'Vimeo', 'http://vimeo.com/23237102', 'images/com_jm_video_galleries/thumbnails/thumb_20130725_025405331.jpg', '<p>This is a timelapse video of the city limits. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>', 9, 1, '2013-07-25', 0, '0000-00-00 00:00:00', 42, '3'),
('Beyond the City', 'beyond-the-city', 'Vimeo', 'http://vimeo.com/45878034', 'images/com_jm_video_galleries/thumbnails/thumb_20130725_02534034.jpg', '<p>Living with hopes and dreams of a beautiful world, beyond the city lights. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>', 10, 1, '2013-07-25', 0, '0000-00-00 00:00:00', 42, '3'),
('Los Angeles', 'los-angeles', 'Vimeo', 'http://vimeo.com/27235856', 'images/com_jm_video_galleries/thumbnails/thumb_20130725_025455548.jpg', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>', 11, 1, '2013-07-25', 0, '0000-00-00 00:00:00', 42, '3'),
('Lambourghini Gallardo LP 560', 'lambourghini-gallardo-lp-560', 'Vimeo', 'http://vimeo.com/24421042', 'images/com_jm_video_galleries/thumbnails/thumb_20130725_025446835.jpg', '<p>One of the Official Lambourghini Commercials for the Luxurious Super Fast Gallardo Edition. Enjoy!!!</p>', 12, 1, '2013-07-25', 0, '0000-00-00 00:00:00', 42, '2'),
('Calvin Harris ft. Example - We''ll Be Coming Back (Official Video)', 'calvin-harris-ft-example-we-ll-be-coming-back-official-video', 'Vimeo', 'http://vimeo.com/46353153', 'images/com_jm_video_galleries/thumbnails/thumb_20130725_02535446.jpg', '<p>Cops, Robbers, and 70''s zooms. Directed By: Saman Keshavarz Written by: Saman Keshavarz &amp; Nate Eggert Visual FX Supervisor: Matt Chiang Cinematography: Saman Keshavarz &amp; Alejandro Lalinde Wardrobe: Laura Francis Editing: Nate Tam &amp; Saman Keshavarz Set Design: Elana Farley Assistant Director: Howard Butler Produced by: Jason Baum &amp;Ross Levine Segment Producer: Tom Lee Executive Producer: Laura Tunstall Production Company: Pulse Films © SONY UK 2012</p>', 13, 1, '2013-07-25', 0, '0000-00-00 00:00:00', 42, '1'),
('Kavinsky ''Protovision''', 'kavinsky-protovision', 'Vimeo', 'http://vimeo.com/33828399', 'images/com_jm_video_galleries/thumbnails/thumb_20130725_025436855.jpg', '<p>director - Marcus Herring artist - Kavinsky production company - The Directors Bureau label - Record Makers director of photography - Tari Segal producer - Benjamin Gilovitz executive producer - Duffy Culligan stunt coordinator - Steve Griffin stunt driver - Theo Kypri stylist - Azalea Lee, (Vincent might like to include his girlfriend''s name here also?) art director - Spencer Vrooman coordinator - Ben Rinehardt hair - Sandy Bee makeup - Katie Testo gaffer - Russell Bell assistant director - Andrew Turner art department - Jay Fetzer, Nedell Torrisi first camera assistant - Jake Burke second camera assistant - Keon Javanshier key grip - Steve Dorman grip assistant - Abisai Garcia best boy - Stephan Pagano, Oliver Mauldin shotmaker driver - Mike Evens editor - Michael Mees sound design - Unbridled Sound colorist - Bossi Baker film transfer - Deluxe production assistants - Drew Kordik, Tim Pfeffer, Lindsay Stephen, Galen Howard, Cain Czopek, Robert McHugh, Emanuele Musarra, Grace Alie</p>', 14, 1, '2013-07-25', 0, '0000-00-00 00:00:00', 42, '2'),
('A Day in the Life', 'a-day-in-the-life', 'Vimeo', 'http://vimeo.com/56385466', 'images/com_jm_video_galleries/thumbnails/thumb_20130725_025322257.jpg', '<p>Take a look at a day in the life of Miami’s vintage motorcycle scene. If you’re into classic bikes and find yourself in Miami look us up.</p>', 15, 1, '2013-07-25', 0, '0000-00-00 00:00:00', 42, '1'),
('Jonathan Rea, 2012 Honda Fireblade', 'jonathan-rea-2012-honda-fireblade', 'Vimeo', 'http://vimeo.com/59057273', 'images/com_jm_video_galleries/thumbnails/thumb_20130725_025426804.jpg', '<p>Honda 2012 WSBK Season. All rights to Honda Racing.</p>', 16, 1, '2013-07-25', 0, '0000-00-00 00:00:00', 42, '1'),
('DK Ferrari 599 GTO', 'dk-ferrari-599-gto', 'Vimeo', 'http://vimeo.com/36269011', 'images/com_jm_video_galleries/thumbnails/thumb_20130725_025416275.jpg', '<p>DK Engineering''s 599 GTO | Music - Lost &amp; Found - Amon Tobin</p>', 17, 1, '2013-07-25', 0, '0000-00-00 00:00:00', 42, '2');
UPDATE `#__jmvg_videos` SET `created_by` = (SELECT `user_id` FROM `#__user_usergroup_map` WHERE `group_id` = 8 LIMIT 1);