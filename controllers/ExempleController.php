<?php 
/**
* Controlleur d'exemple
* @author Amaury Lavieille
*/

namespace MvcApp\Exemple;

/**
* Controlleur d'exemple
*/
class ExempleController extends Controller
{

	/**
	* initialise le controlleur exemple
	**/
	public function __construct()
	{
		parent::__construct();
		$this->name = 'Exemple';
	}

	/**
	* Action par défaut
	**/
	public function indexAction()
	{
		$this->render("viewExemple");
	}
}


?>