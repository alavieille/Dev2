<?php 
/**
* classe qui représente l'application
* @author Amaury Lavieille
*/

/**
* Classe qui représente l'application
* Elle implemente le pattern singleton
*/
class App{
	
	/**
	* @param Object $instance contient l'instance de la classe
	*/
	private static $instance;

	/**
	* @param String $appName Nom de l'application
	*/
	private $appName;

	/**
	* @param String $basePath Chemin de la racine de l'application
	*/
	private $basePath;


	/**
	* @param Array $config Contient la configuration de l'application
	*/
	private $config;
	/**
	* Constructeur
	* @var Array $config , tableau qui contient la configuration de l'applcation
	*/
	private function __construct($config){
		$this->config = $config;
		$this->extractConfig();
	}

	/**
	* Initialise l'application
	* @var Array $config configuration de l'application
	*/

	public static function newApp($config){
		self::$instance=new App($config);
	}

	/**
	* Retourne l'instance unique de la classe si elle existe sinon elle en crée une
	*/
	public static function getApp()
	{
		if (self::$instance==null)
      		self::$instance=new App(array());
   		return self::$instance;
	}

	/**
	* Extrait le tableau de configuration dans les paramètres de classe
	*/
	private function extractConfig()
	{
		$this->appName = isset($this->config["appName"]) ? $this->config["appName"] : "";
		$this->basePath = isset($this->config["basePath"]) ? $this->config["basePath"] : "";
	}

	/**
	* Retourne le tableau de configuration de l'application
	* @param String $index clé dans le tableau de configuration
	* @return String retourne le contenue correspondant dans le tableau ou une chaine vide 
	*/
	public function getConfig($index)
	{
		return isset($this->config[$index]) ? $this->config[$index] : "";
	}

	/**
	* Retourne le nom de l'application
	* @return String
	*/
	public function getName()
	{
		return $this->appName;
	}

	/**
	* Retourne la racine de l'application
	* @return String
	*/
	public function getBasePath()
	{
		return $this->basePath;
	}



}

