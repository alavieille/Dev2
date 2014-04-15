<?php 
/**
* Controlleur pour google books
* @author Amaury Lavieille
*/
namespace Dev2AL\Book;

use MvcApp\Core\Controller;
use MvcApp\Core\App;
use MvcApp\Core\AppException;



/**
* Controlleur des évènements
*/
class BookController extends Controller
{

 	/**
    * initialise le controlleur pour l'utilisation de google books
    */
    public function __construct()
    {
        $this->name = 'Book';
        parent::__construct();
    }

	protected function roles()
	{
	  return array(
	    array(
	        "role" => "*",
	        "actions" => array("search"),  
	    	)
	    );

	}

	public function searchAction()
	{
		$this->render("search",array(
			
		));
	}



		
}