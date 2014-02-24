<?php

/**
* Classe parente qui représente un controlleur
* @author Amaury Lavieille
*/

namespace MvcApp\Components;
use MvcApp\Components\App;
/**
* Classe parente qui représente un controlleur
*/
class Controller
{
	/**
	* squelette utilisé par le controlleur
	* @var string $layout
	*/
	public $layout = "main";

	/**
	* Nom du controlleur
	* @var string $name
	**/
	public $name;


	/**
	* initialise un constructeur en générale
	**/
	public function __construct()
	{

	}

	/**
	* Inclut la vue definsi par $filename dans le layout
	* @param string $filename
	*/
	public function render($filename="")
	{

		$content = "";
		if($filename != ""){
			ob_start();
			require_once("views/".$this->name."/".$filename.".php");
			$content = ob_get_contents();
			ob_end_clean();
		}

		require_once("views/layout/".$this->layout.".php");

	}

}
