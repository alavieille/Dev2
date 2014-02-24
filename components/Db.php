<?php 
/**
* Classe fournissant une connexion à la base de donnée
* @author Amaury Lavieille
*/

namespace MvcApp\Components;
use PDO;

class Db
{

	/**
	* @param Object $instance contient l'instance de la classe
	*/
	private static $instance;

    /**
    * propriété contennat le lien pdo de connexion à la BD
    */
    protected $connexion;

    /**
    * constructeur privé qui initialise la connexion
    * @todo rendre le constructeur indépendant du nom des constantes
    */
    private function __construct() {

        /**
        * tableau d'options pour le réglage de la connexion
        */
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

       	$dbConfig = App::getApp()->getConfig("db");
        $this->connexion = new PDO($dbConfig["dsn"], $dbConfig["user"], $dbConfig["pwd"], $options);
    }

    /**
    * desactive le clonage
    */
    private function __clone() {}


    /**
    * Méthode pour accéder à l'UNIQUE instance de la classe
    * @return l'instance du singleton
    */
    public static function getInstance() {
        if (! (self::$instance instanceof self)) {
          self::$instance = new self();
        }
        return self::$instance;
    }

    /**
    * Accesseur de la connexion
    *
    * @return L'identifiant de connexion BD à utiliser pour exécuter les requêtes
    */
    public function getConnexion() {
        return $this->connexion;
    }
}