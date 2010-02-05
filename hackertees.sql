--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `email` varchar(127) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `txn_id` varchar(255) NOT NULL,
  `address_name` varchar(255) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_state` varchar(255) NOT NULL,
  `address_zip` varchar(255) NOT NULL,
  `payer_email` varchar(127) NOT NULL,
  `items` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tee_id` int(10) unsigned NOT NULL,
  `size` char(3) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `tee_id`, `size`, `quantity`) VALUES
(1, 1, 'S', 5),
(2, 1, 'M', 36),
(3, 1, 'L', 28),
(4, 1, 'XL', 2),
(5, 2, 'S', 5),
(6, 2, 'M', 40),
(7, 2, 'L', 30),
(8, 2, 'XL', 5),
(9, 3, 'S', 10),
(50, 3, 'M', 50),
(11, 3, 'L', 40),
(12, 3, 'XL', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tees`
--

CREATE TABLE IF NOT EXISTS `tees` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_limited` tinyint(1) unsigned NOT NULL,
  `hosted_button_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tees`
--

INSERT INTO `tees` (`id`, `slug`, `title`, `description`, `image`, `price`, `is_limited`, `hosted_button_id`, `created_at`) VALUES
(1, 'hacker-news', 'Hacker News', 'It''s your morning news, your bedtime story. Delicious. It''s what we do when we should be working. The good, the bad, the ugly. <a href="http://news.ycombinator.com/" title="Hacker News">Hacker News</a>. Love it. Hate it. Sport it.', 'hacker-news.png', 18.00, 1, 'M3FRUJW5XMLC4', '2010-01-13 17:02:16'),
(2, 'theres-no-place-like-127-0-0-1', 'There''s No Place Like 127.0.0.1', 'The only server facility where you can show up in your underwear. Bugs crawling around? No worries. It''s the place for dusty libraries, stale snippets, and at least a couple of half baked ideas.', '127.0.0.1.png', 18.00, 1, '99UHTSYMCWPZG', '2010-01-24 22:27:18'),
(3, 'techstars', 'TechStars', '<a href="http://www.techstars.org" title="TechStars">TechStars</a> provides mentorship and seed funding to startups across the country. They are <a href="http://www.techstars.org/apply/">accepting applications</a> for the summer 2010 Boulder program.', 'techstars.png', 18.00, 1, 'C2Q9NZYJF695E', '2010-01-26 18:39:10');