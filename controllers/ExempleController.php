<?php 
class ExempleController extends Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->name = 'Exemple';
	}


	public function indexAction()
	{
		$this->render("viewExemple");
	}
}


?>