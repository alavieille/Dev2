<?php 
/**
* classe qui représente une route
* @author Amaury Lavieille
*/

namespace MvcApp\Components;


class Route
{	

	private $path;
	private $controllerClass;

	public function __constrcut($path,$controllerClass,$action="index",$param=array())
	{
		$this->path = $path;
		$this->controllerClass = $controllerClass;
		$this->action = $action;
		$this->$param;
	}

	public function math($request)
	{
		return $this->path === $request;
	}

	public function createController()
	{
		return new $this->controllerClass;
	}
}
