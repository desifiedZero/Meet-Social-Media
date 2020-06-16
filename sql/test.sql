CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_friends`
-- (See below for the actual view)
--
CREATE TABLE `all_friends` (
`avatar` varchar(250)
,`firstname` varchar(20)
,`id` int
,`lastname` varchar(20)
,`own_id` int
,`username` varchar(16)
);

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `id` int NOT NULL,
  `user1` int NOT NULL,
  `user2` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id`, `user1`, `user2`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 1, 4),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `friend_info`
-- (See below for the actual view)
--
CREATE TABLE `friend_info` (
`friend_avatar` varchar(250)
,`friend_firstname` varchar(20)
,`friend_id` int
,`friend_lastname` varchar(20)
,`friend_username` varchar(16)
,`user_id` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `friend_posts`
-- (See below for the actual view)
--
CREATE TABLE `friend_posts` (
`content` varchar(2000)
,`date` timestamp
,`friend_avatar` varchar(250)
,`friend_firstname` varchar(20)
,`friend_id` int
,`friend_lastname` varchar(20)
,`friend_username` varchar(16)
,`header` varchar(100)
,`id` int
,`media_url` varchar(150)
,`own_id` int
,`user` int
);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `header` varchar(100) DEFAULT NULL,
  `content` varchar(2000) NOT NULL,
  `media_url` varchar(150) DEFAULT NULL COMMENT 'url',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` varchar(33) NOT NULL,
  `user` int NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remote_ip` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `avatar` varchar(250) DEFAULT NULL,
  `cover_image` varchar(150) DEFAULT NULL,
  `dob` date NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_info`
-- (See below for the actual view)
--
CREATE TABLE `user_info` (
`avatar` varchar(250)
,`cover_image` varchar(150)
,`description` varchar(2000)
,`dob` date
,`firstname` varchar(20)
,`id` int
,`lastname` varchar(20)
,`location` varchar(100)
,`username` varchar(16)
);

-- --------------------------------------------------------

--
-- Structure for view `all_friends`
--
DROP TABLE IF EXISTS `all_friends`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_friends`  AS  select `user`.`id` AS `id`,`user`.`username` AS `username`,`user`.`firstname` AS `firstname`,`user`.`lastname` AS `lastname`,`user`.`avatar` AS `avatar`,`friend`.`user1` AS `own_id` from (`friend` join `user` on((`friend`.`user2` = `user`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `friend_info`
--
DROP TABLE IF EXISTS `friend_info`;

CREATE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `friend_info`  AS  select `friend`.`user1` AS `user_id`,`user`.`id` AS `friend_id`,`user`.`username` AS `friend_username`,`user`.`firstname` AS `friend_firstname`,`user`.`lastname` AS `friend_lastname`,`user`.`avatar` AS `friend_avatar` from (`friend` join `user` on((`friend`.`user2` = `user`.`id`))) order by `friend`.`user1` ;

-- --------------------------------------------------------

--
-- Structure for view `friend_posts`
--
DROP TABLE IF EXISTS `friend_posts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `friend_posts`  AS  select `post`.`id` AS `id`,`post`.`user` AS `user`,`post`.`header` AS `header`,`post`.`content` AS `content`,`post`.`media_url` AS `media_url`,`post`.`date` AS `date`,`friend`.`user1` AS `own_id`,`user`.`id` AS `friend_id`,`user`.`username` AS `friend_username`,`user`.`firstname` AS `friend_firstname`,`user`.`lastname` AS `friend_lastname`,`user`.`avatar` AS `friend_avatar` from ((`friend` join `user` on((`friend`.`user2` = `user`.`id`))) join `post` on((`post`.`user` = `user`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_info`
--
DROP TABLE IF EXISTS `user_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_info`  AS  select `user`.`id` AS `id`,`user`.`username` AS `username`,`user`.`firstname` AS `firstname`,`user`.`lastname` AS `lastname`,`user`.`avatar` AS `avatar`,`user`.`cover_image` AS `cover_image`,`user`.`dob` AS `dob`,`user`.`description` AS `description`,`user`.`location` AS `location` from `user` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_person` (`user1`),
  ADD KEY `fk_friend` (`user2`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_post` (`user`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_session` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`email`),
  ADD UNIQUE KEY `user_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `fk_friend` FOREIGN KEY (`user2`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_person` FOREIGN KEY (`user1`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_user_post` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_user_session` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
