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

  	public function route($request)
  	{
  		foreach ($this->routes as $route) {
  			if($route->match($request)) {
  					return $route;
  			}
  		}
  		var_dump($request);	
  	}


}