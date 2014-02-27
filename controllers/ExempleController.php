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
	public function saveAction()
	{
		
		var_dump($_POST);
		if(isset($_POST)) {
			$exemple = Exemple::initialize($_POST);
			if($exemple->valid()) {
				if($exemple->getId() == "") { //sauvegarde
					$id = ExempleDB::getInstance()->save($exemple);
				}
				else { // update

					$id = ExempleDB::getInstance()->update($exemple);
				}

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
	* @var Integer id de l'exemple
	*/
	public function viewAction($id)
	{
		$model = ExempleDB::getInstance()->find($id);
		if(! is_null($model)) {
			$this->render("view",array(
				"model"=>$model,
			));
		}
		else {
			echo "erreur";
		}
	}

	/**
	* Mise a un jour d'un exemple
	* @var Integer id de l'exemple
	*/
	public function updateAction($id)
	{
		
		$model = ExempleDB::getInstance()->find($id);
		if(! is_null($model)) {
			$this->render("form",array(
				"model"=>$model,
			));
		}
		else {
			echo "erreur";
		}

	}

	/** 
	* Suppression d'un exemple
	* @var Integer id de l'exemple
	*/
	public function deleteAction($id)
	{
		$model = ExempleDB::getInstance()->find($id);
		if(! is_null($model)) {
			$this->render("delete",array(
				"model"=>$model,
			));
		}
		else {
			echo "erreur";
		}
	}

	/**
	* Confirme suppression d'un exemple
	* @var Integer id de l'exemple
	*/
	public function confirmDeleteAction($id)
	{
		$model = ExempleDB::getInstance()->find($id);
		if(! is_null($model)) {
			ExempleDB::getInstance()->delete($model);
			App::getApp()->redirect("exemple","viewAll");
		}
		else {
			echo "erreur";
		}
	}

}


?>