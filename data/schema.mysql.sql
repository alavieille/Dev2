/** Table Article **/
CREATE TABLE IF NOT EXISTS `Article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `chapo` varchar(300) DEFAULT NULL,
  `contenue` text NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_creation` int(11) NOT NULL,
  `date_publication` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) 