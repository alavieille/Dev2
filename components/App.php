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
	* @param Array Contient les chemins des composants de l'application
	*/
	private static $pathComponents = array(
		"App" => "App.php",
		"Controller" => "Controller.php"
		);

	/**
	* @param Object $instance contient l'instance de la classe
	*/
	private static $instance;

	/**
	* @param String $appName Nom de l'application
	*/
	private static $appName;

	/**
	* @param String $basePath Chemin de la racine de l'application
	*/
	private static $basePath;


	/**
	* @param Array $config Contient la configuration de l'application
	*/
	private $config;
	/**
	* Constructeur
	* @var Array $config , tableau qui contient la configuration de l'applcation
	*/
	private function __construct($config)
	{
		$this->config = $config;
		$this->extractConfig();
	}

	/**
	* Initialise l'application
	* @var Array $config configuration de l'application
	*/

	public static function newApp($config)
	{
		if (self::$instance==null) {
			self::$instance=new App($config);
		}
		return self::$instance;
	}

	/**
	* Retourne l'instance unique de la classe si elle existe sinon elle en crée une
	*/
	public static function getApp()
	{
		if (self::$instance==null) {
      		self::$instance=new App(array());
      	}
   		return self::$instance;
	}


	/**
	* Fonction qui retourne l'action du controlleur transmis dans l'url
	* Si le controlleur ou la méthode est inconnue alors une exception est levée
	* @throws Exception 404
	**/
	public function run(){

		list($controller,$action,$id) = $this->getRoute();
		if(class_exists($controller) && method_exists($controller, $action)){
			$instanceController = new $controller();	
			return $instanceController->$action($id);
		}
		else{
			throw new Exception("Requete invalide", 404);
			
		}
	}

	/**
	* Retourne le controlleur et l'action demande dans l'url
	* @return Array 
	**/
	private function getRoute(){

		$controller =  isset($_GET["controller"]) ? $_GET["controller"] : $this->config["defaultController"];
		$action = isset($_GET["action"]) ? $_GET["action"] : "index";
		$id = isset($_GET["id"]) ? $_GET["id"] : null;

		$controllerName = ucfirst($controller);
		$classController = $controllerName."Controller";
		$action = $action."Action";

		$classController = "MvcApp\\".$controllerName."\\".$classController;

		return array($classController,$action,$id);

	}


	/**
	* Extrait le tableau de configuration dans les paramètres de classe
	*/
	private function extractConfig()
	{
		self::$appName = isset($this->config["appName"]) ? $this->config["appName"] : "";
		self::$basePath = isset($this->config["basePath"]) ? $this->config["basePath"] : "";
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
		return self::$appName;
	}

	/**
	* Retourne la racine de l'application
	* @return String
	*/
	public function getBasePath()
	{
		return self::$basePath;
	}

	/**
	* Autoload des classes de l'applcation
	* @param String $className
	*/
	public static function autoload($className)
	{	

		//	var_dump("aut");
		$className = explode("\\", $className);
		$className = $className[count($className)-1];
		

		if(array_key_exists($className, self::$pathComponents)) {

			$path = "components/".self::$pathComponents[$className];
		}
		elseif(strrpos($className,"Controller")) {
			$path = "controllers/".$className.".php";
		}
		else {	
			$path = "models/".$className.".php";
		}
		//var_dump($path);
		if(file_exists($path)){
			require_once(self::$basePath.$path);
		}
		else{
			throw new Exception("Impossible de charger la classe ".$className);		
		}
	}

}
spl_autoload_register(array('App', 'autoload'));
