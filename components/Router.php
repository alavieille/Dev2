<?php 
/**
* classe qui gére les routes de l'application
* @author Amaury Lavieille
*/

namespace MvcApp\Components;

class Router{

	private $routes=array(); 

	//public function __construct();

  	public function addRoute($route)
  	{
   	 	$this->routes[] = $route;
  	}

  	public function getRoutes()
  	{
  		return $this->$routes;
  	}

    /**
    * Retourne le controlleur et l'action demande dans l'url
    * @return Array 
    **/
    private function createDefaultRoute($request)
    {

      $routeArray = explode("/",$request);

      $controller = $routeArray[0];
      $action = (isset($routeArray[1]) && $routeArray[1] != "") ? $routeArray[1] : "index";
      $param = array_slice($routeArray, 2);

      $controllerName = ucfirst($controller);
      $classController = $controllerName."Controller";
      $classController = App::getApp()->getConfig("namespaceApp")."\\".$controllerName."\\".$classController;
     
      $action = $action."Action";

      return new Route($request,$classController,$action,$param);
      

    }

    /** 
    * Retourne la route demandé par l'utilisateur
    * @param String $request
    */
    public function route($request)
    {
      foreach ($this->routes as $route) {

        if($route->match($request)) {
            return $route;
        }
      }
       return $this->createDefaultRoute($request);

    }



}