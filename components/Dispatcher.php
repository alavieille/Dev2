<?php 
/**
* classe qui execute le controlleur et la classe demandé
* @author Amaury Lavieille
*/

namespace MvcApp\Components;


class Dispatcher
{
	
	/**
    * Fonction qui retourne l'action du controlleur transmis dans l'url
    * Si le controlleur ou la méthode est inconnue alors une exception est levée
    * @throws Exception 404
    **/
	public function dispatch($route)
	{
	
		$controller = $route->getController();
		$action = $route->getAction();
		$param = $route->getParam();
		if(class_exists($controller) && method_exists($controller, $action)) {
			$controller = new $controller;
			call_user_func_array(array($controller, $action), $param);
		}
		else {
			throw new AppException("Requete invalide", 404);
		}
	}

}

