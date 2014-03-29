<?php 
/**
* Classe qui définit un role pour les utilisateurs connecté
* @author Amaury Lavieille
*/
namespace MvcApp\Components;


class RoleLoggedUser extends Role
{	

	/**
	* Verifie si un utilisateurs est autorisé
	* @param String $action action demandé
	* @param Object $userAuth Instance of Auth
	**/
	public function validAccess($action,$userAuth)
	{

		return ($userAuth->isLogged() && in_array($action, $this->actions)  && $this->expression );
	}

}