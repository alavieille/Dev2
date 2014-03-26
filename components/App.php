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
    * @var Array Contient les chemins des composants de l'application
    */
    private static $pathComponents = array(
        "App" => "App.php",
        "Controller" => "Controller.php",
        "Db" => "Db.php",
        "ModelDB" => "ModelDB.php",
        "AppException" => "AppException.php",
        "FlashMessage" => "FlashMessage.php",
        "Form" => "Form.php",
        "Model" => "Model.php",
        "Upload" => "Upload.php",
        "Router" => "Router.php",
        "Route" => "Route.php",
        "Dispatcher" => "Dispatcher.php",
        );

    /**
    * @var Array contient les chemins des extensions
    */
    private static $pathExtentions = array(
    );


    /**
    * @var Array contient les chemins des extensions
    */
    private static $pathPear = array(
        "Mail_mime" => "Mail/mime.php",
        "Mail" => "Mail.php",
    );

    /**
    * @var Object $instance contient l'instance de la classe
    */
    private static $instance;

    /**
    * @var String $appName Nom de l'application
    */
    private static $appName;

    /**
    * @var String $basePath Chemin de la racine de l'application
    */
    private static $basePath;


    /**
    * @param Array $config Contient la configuration de l'application
    */
    private $config;

    /**
    * @param Routeur de l'application
    */
    private $router;

    /**
    * Constructeur
    * @param Array $config , tableau qui contient la configuration de l'applcation
    */
    private function __construct($config,$router)
    {
        $this->config = $config;
        $this->router = $router;
        $this->extractConfig();
    }

    /**
    * Initialise l'application
    * @param Array $config configuration de l'application
    */
    public static function newApp($config,$router)
    {
        if (self::$instance==null) {
            self::$instance=new App($config,$router);
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
                $request = (isset($_GET["p"]) and ($_GET["p"])!="") ? $_GET["p"] : $this->config["defaultController"];
                $route = $this->router->route($request);
                (new Dispatcher())->dispatch($route);
            } 
            catch (AppException $e) {
              
                $e->display();
            }
        } 
        catch (Exception $e) {
            (New AppException($e->getMessage()))->display();
        }
    }

   
    /**
    * Extrait le tableau de configuration dans les paramètres de classe
    */
    private function extractConfig()
    {
        self::$appName = isset($this->config["appName"]) ? $this->config["appName"] : "";
        self::$basePath = isset($this->config["basePath"]) ? $this->config["basePath"] : "";
        if(isset($this->config["extensions"]))
            $this->extractExtension(); 
    }

    /**
    * Extrait la configuration des extensions
    */
    private function extractExtension()
    {
        foreach ($this->config["extensions"] as $className => $path) {
            self::$pathExtentions[$className] = $path;
        }
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
    * Créer une url a partir du nom du controlleur et de l'action
    * @param String $controlleur nom du controleur
    * @param String $action nom de l'action
    * @param String $param 
    * @return String url
    */
    public function createUrl($method,$action="",$param="")
    {
        $url = self::$basePath.$method."/".$action."/".$param;
        return $url;
    }


    /**
    * Redirige l'utilisateur vers une action d'un controlleur
    * @param String $controlleur nom du controleur
    * @param String $action nom de l'action
    * @param String $param 
    */
    public function redirect($method,$action="",$param="")
    {
        $url = self::$basePath.$method."/".$action."/".$param;
        header('Location: '.$url);
    }   

    /** 
    * Ajoute un message flash
    * @param String $message contenue du message
    * @param String $type type du message
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
    * @param String $className
    */
    public static function autoload($className)
    {   
        //var_dump($className);
        $className = explode("\\", $className);
        
        if(isset($className[1])) {
            $package = $className[1];
        }

        $className = $className[count($className)-1];

        if(array_key_exists($className, self::$pathComponents)) {

            $path = "components/".self::$pathComponents[$className];
        }

        elseif(array_key_exists($className, self::$pathPear)) {

            $path = self::$pathPear[$className];
            require_once($path);
            return;
        }

        elseif(array_key_exists($className, self::$pathExtentions)) {

            $path = "extensions/".self::$pathExtentions[$className];
        }

        elseif(strrpos($className,"Controller")) {
            $path = "controllers/".$className.".php";
            //var_dump($path);
        }
        else {  
            $path = "models/".$package."/".$className.".php";   
        }
        //var_dump($path);
        if(file_exists($path)){
            require_once($path);
        }      
    }
}

spl_autoload_register(array('\MvcApp\Components\App', 'autoload'));
