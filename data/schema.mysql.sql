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