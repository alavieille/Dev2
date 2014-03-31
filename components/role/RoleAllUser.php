<?php 
/**
* Classe qui définit un role pour tous les utilisateurs
* @author Amaury Lavieille
*/
namespace MvcApp\Components;


class RoleAllUser extends Role
{	

	/**
	* Verifie si un utilisateurs est autorisé
	* @param String $action action demandé
	* @param Object $userAuth Instance of Auth
	**/
	public function validAccess($action,$userAuth)
	{
		$validAction = (in_array($action, $this->actions));
		if($validAction) {
			$expression = true;
			if(! is_null($this->expression)) {
				$expression = $this->validExpression($instanceController,$paramAction);
			}
			return $expression;
		}
		return false;

	}

}