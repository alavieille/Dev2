<?php 
/**
* Controlleur d'exemple
* @author Amaury Lavieille
*/

namespace MonAppli\Exemple;
use MvcApp\Components\Controller;

/**
* Controlleur d'exemple
*/
class ExempleController extends Controller
{

	/**
	* initialise le controlleur exemple
	*/
	public function __construct()
	{
		$this->name = 'Exemple';
		parent::__construct();
	}

	/**
	* Action par défaut
	*/
	public function indexAction()
	{
		$this->render("viewExemple");
	}

	public function createAction()
	{
		$exemple = Exemple::initialize();
		$this->render("form",array(
			"model"=>$exemple,
		));
	}
	/**
	* Crée un exemple
	*/
	public function validCreateAction()
	{
		$exemple = Exemple::initialize($_POST);
		$this->render("form",array(
			"model"=>$exemple,
		));
		//ExempleDB::getInstance()->save($exemple);
	}

	public function showallAction(){
		var_dump(ExempleDB::getInstance()->findAll());
	}
}


?>