<?php 
/**
* classe qui execute le controlleur et la classe demandé
* @author Amaury Lavieille
*/

namespace MvcApp\Components;


class Dispatcher
{
	
	public function dispatch($route,$request)
	{
		$controller = $route->createController();
		
	}

}

