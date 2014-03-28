/** Table Article **/
CREATE TABLE IF NOT EXISTS `Article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `chapo` varchar(300) DEFAULT NULL,
  `contenue` text NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_creation` date NOT NULL,
  `date_publication` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) 

/** Table Image **/
CREATE TABLE IF NOT EXISTS `Image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idArticle` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)

CREATE TABLE IF NOT EXISTS `User` (
  `email` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `hash_auto_login` varchar(100) DEFAULT NULL,
  `tempory_password` varchar(100) DEFAULT NULL,
  `date_tmp_password` datetime DEFAULT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`),
) 
