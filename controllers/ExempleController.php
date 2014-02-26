<?php 
/**
* Controlleur d'exemple
* @author Amaury Lavieille
*/

namespace MonAppli\Exemple;
use MvcApp\Components\Controller;
use MvcApp\Components\App;

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
		$this->render("index");


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
		if(isset($_POST)) {
			$exemple = Exemple::initialize($_POST);
			if($exemple->valid()) {
				$id = ExempleDB::getInstance()->save($exemple);
				App::getApp()->redirect("exemple","view",$id);
			}
		}

		$this->render("form",array(
			"model"=>$exemple,
		));
	}

	/**
	* Affiche tous les exemples
	*/
	public function viewAllAction(){
		$arrayExemple = ExempleDB::getInstance()->findAll();
		$this->render("viewAll",array(
			"arrayModel" => $arrayExemple,
		));
	}	

	/**
	* Affiche un exemple
	*/
	public function viewAction($id){

		$model = ExempleDB::getInstance()->find($id);
		
		$this->render("view",array(
			"model"=>$model,
		));
		/*$arrayExemple = ExempleDB::getInstance()->findAll();
		$this->render("viewAll",array(
			"arrayModel" => $arrayExemple,
		));*/
	}
}


?>