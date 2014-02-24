<?php 

require_once("components/App.php");
require_once("config/init.php");



// initalisation de l'application
App::newApp($config);



$controller =  isset($_GET["controller"]) ? $_GET["controller"] : App::getApp()->getConfig("defaultController");
$action = isset($_GET["action"]) ? $_GET["action"] : "index";
$id = isset($_GET["id"]) ? $_GET["id"] : "null";

$controllerName = ucfirst($controller);
$classController = $controllerName."Controller";
$action = $action."Action";

if(class_exists($classController) && method_exists($classController, $action)){
	

	$class = "\MvcApp\\".$controllerName."\\".$classController;
	$instanceController = new $class();
	
	return $instanceController->$action($id);
}
else{
	echo "erreur 404";
}
?>