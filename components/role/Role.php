<?php 
/**
* Classe qui définit un role
* @author Amaury Lavieille
*/
namespace MvcApp\Components;


class Role
{	
	/**
	* @var Array $actions Nom des actions autorisées
	*/
	protected $actions;

	/**
	* @var String $name Nom du role
	**/
	protected $name;

	/**
	* @var Boolean Expression filtre le role selon une expression
	*/
	protected $expression;

	public function __construct($name,$actions,$expression=true)
	{
		$this->name = $name;
		$this->expression = $expression;
		foreach ($actions as $key => $action) {
			$actions[$key] = $action."Action";
		}
		$this->actions = $actions;
	}


	/**
	* Verifie si un utilisateurs est autorisé
	* @param String $action action demandé
	* @param Object $userAuth Instance of Auth
	**/
	public function validAccess($action,$userAuth)
	{
		return ($userAuth->getRole() == $this->name && in_array($action, $this->actions) && $this->expression);
	}

}