<?php
/**
* Classe qui représente un modèle
* @author Amaury Lavieille
*/

namespace MvcApp\Components;

Abstract class Model
{


	protected function __construct()
	{

	}

	/**
	* Nettoie les variables
	* @var Array $arrayVar
	* @return Array Tableau des varibles nettoyées
	*/
	public function cleanVar($arrayVar)
	{
		$arrayRes = array();
		foreach ($arrayVar as $name => $var) {
			$arrayRes[$name] = trim(htmlentities($var));
		}
		return $arrayRes;
	}
}