<?php 
/**
* Controlleur des évenements
* @author Amaury Lavieille
*/
namespace Dev2AL\Evenement;

use Dev2AL\Components\LastFm;

use MvcApp\Core\Controller;
use MvcApp\Core\App;
use MvcApp\Core\AppException;



/**
* Controlleur des évènements
*/
class EvenementController extends Controller
{

 	/**
    * initialise le controlleur des évènements
    */
    public function __construct()
    {
        $this->name = 'Evenement';
        parent::__construct();
    }

	protected function roles()
	{
	  return array(
	    array(
	        "role" => "*",
	        "actions" => array("eventLocation"),  
	    	)
	    );

	}


	public function eventLocationAction($location){

		$lastfm = new LastFm("http://ws.audioscrobbler.com/2.0/?method=geo.getevents","f7556041b3454bdd1b36164dd4c68a03");
		$data = $lastfm->searchEvent($location);
		$xml = simplexml_load_string($data);

		$this->render("viewAll",array(
			"events"=>$xml->events->event,
		));

		




	}
}