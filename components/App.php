<?php 
/**
* classe qui représente l'application
* @author Amaury Lavieille
*/

namespace MvcApp\Components;
use \Exception;

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
		"Controller" => "Controller.php",
		"Db" => "Db.php",
		"AppException" => "AppException.php",
		"FlashMessage" => "FlashMessage.php",
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
	* Fonction qui lance l'application
	**/
	public function run()
	{
		try {
            try {
            	session_start();
                $this->init();
            } 
            catch (AppException $e) {
              
                $e->display();
            }
        } catch (Exception $e) {
            (New AppException($e->getMessage(),$e->getCode()))->display();
        }
	}

	/**
	* Fonction qui retourne l'action du controlleur transmis dans l'url
	* Si le controlleur ou la méthode est inconnue alors une exception est levée
	* @throws Exception 404
	**/
	private function init()
	{
		
		list($controller,$action,$id) = $this->getRoute();
		if(class_exists($controller) && method_exists($controller, $action)){
			$instanceController = new $controller();	
			return $instanceController->$action($id);
		}
		else{
			throw new AppException("Requete invalide", 404);
			
		}

	}


	/**
	* Retourne le controlleur et l'action demande dans l'url
	* @return Array 
	**/
	private function getRoute(){


		$route = (($_GET["p"])!="") ? $_GET["p"] : $this->config["defaultController"];
		$routeArray = explode("/",$route);

		$controller = $routeArray[0];
		$action = (isset($routeArray[1]) && $routeArray[1] != "") ? $routeArray[1] : "index";
		$id = isset($routeArray[2]) ? $routeArray[2] : null;

		$controllerName = ucfirst($controller);
		$classController = $controllerName."Controller";
		$action = $action."Action";

		$classController = $this->config["namespaceApp"]."\\".$controllerName."\\".$classController;

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
	* @var String $index clé dans le tableau de configuration
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
	* Créer une url a partir du nom du controlleur et de l'action
	* @var String $controlleur nom du controleur
	* @var String $action nom de l'action
	* @var String $param 
	* @return String url
	*/
	public function createUrl($method,$action="",$param="")
	{
		$url = self::$basePath.$method."/".$action."/".$param;
		return $url;
	}


	/**
	* Redirige l'utilisateur vers une action d'un controlleur
	* @var String $controlleur nom du controleur
	* @var String $action nom de l'action
	* @var String $param 
	*/
	public function redirect($method,$action="",$param="")
	{
		$url = self::$basePath.$method."/".$action."/".$param;
		header('Location: '.$url);
	}	

	/** 
	* Ajoute un message flash
	* @var String $message contenue du message
	* @var String $type type du message
	*/
	public static function setFlash($message,$type="")
	{
		FlashMessage::setFlash($message,$type);
	}

	/**
	* Affiche les message flash
	*/
	public static function getFlash()
	{
		return FlashMessage::getFlash();
	}


	/**
	* Autoload des classes de l'applcation
	* @var String $className
	*/
	public static function autoload($className)
	{	


		$className = explode("\\", $className);
		$package = $className[1];
		$className = $className[count($className)-1];
		

		if(array_key_exists($className, self::$pathComponents)) {

			$path = "components/".self::$pathComponents[$className];
		}
		elseif(strrpos($className,"Controller")) {
			$path = "controllers/".$className.".php";
		}
		else {	
			$path = "models/".$package."/".$className.".php";
		}

		if(file_exists($path)){
			require_once($path);
		}
		
	}

}
spl_autoload_register(array('\MvcApp\Components\App', 'autoload'));
