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
		return (in_array($action, $this->actions)  && $this->expression );
	}

}