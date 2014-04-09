<?php 
/**
* Controlleur des évenements
* @author Amaury Lavieille
*/
namespace Dev2AL\Evenement;

use Dev2AL\Components\LastFm;
use Dev2AL\Components\AwsApi;

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
	        "actions" => array("eventLocation","eventCoord","productArtist"),  
	    	)
	    );

	}


	public function eventLocationAction($location){

		$lastfm = new LastFm("http://ws.audioscrobbler.com/2.0/?method=geo.getevents","f7556041b3454bdd1b36164dd4c68a03");
		$data = $lastfm->searchEventByLocation($location);
		$xml = simplexml_load_string($data);

		$this->render("viewAll",array(
			"title"=>"Evènement de Paris",
			"events"=>$xml->events->event,
		));
	}

	public function eventCoordAction($lat,$lng){
		$lastfm = new LastFm("http://ws.audioscrobbler.com/2.0/?method=geo.getevents","f7556041b3454bdd1b36164dd4c68a03");
		$data = $lastfm->searchEventByCoord($lat,$lng);
		$xml = simplexml_load_string($data);

		$this->render("viewAll",array(
			"title"=>"Evènement Proche",
			"events"=>$xml->events->event,
		));
	}

	public function productArtistAction($artist)
	{
		$aws_key = "AKIAIRRFFYPENQMXAPXQ";
		$aws_secret = "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";
		$aws = new AwsApi($aws_key,$aws_secret);
		$data = $aws->getProductArtist($artist);
		$xml = simplexml_load_string($data);

		$this->render("viewAllProduct",array(
			"artist"=>$artist,
			"items"=>$xml->Items,
		));
	}

		
}