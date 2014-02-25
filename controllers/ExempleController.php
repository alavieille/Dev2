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

	/**
	* Crée un exemple
	*/
	public function createAction()
	{
		$data = array("id"=>"2","title"=>"titre","content"=>"je suis contenue");
		$exemple = Exemple::initialize($data);
		ExempleDB::getInstance()->save($exemple);

	}

	public function showallAction(){
		var_dump(ExempleDB::getInstance()->findAll());
	}
}


?>