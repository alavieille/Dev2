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
		$lastFmKey = app::getApp()->getConfig("lastFmKey");
		$lastfm = new LastFm("http://ws.audioscrobbler.com/2.0/?method=geo.getevents",$lastFmKey);
		$data = $lastfm->searchEventByLocation($location);
		$xml = simplexml_load_string($data);

		$this->render("viewAll",array(
			"title"=>"Evènement de Paris",
			"events"=>$xml->events->event,
		));
	}

	public function eventCoordAction($lat,$lng){
		$lastFmKey = app::getApp()->getConfig("lastFmKey");
		$lastfm = new LastFm("http://ws.audioscrobbler.com/2.0/?method=geo.getevents",$lastFmKey);
		$data = $lastfm->searchEventByCoord($lat,$lng);
		$xml = simplexml_load_string($data);

		$this->render("viewAll",array(
			"title"=>"Evènement Proche",
			"events"=>$xml->events->event,
		));
	}

	public function productArtistAction($artist)
	{
		$aws_key = app::getApp()->getConfig("awsKey");
		$aws_secret = app::getApp()->getConfig("awsSecret");
		$aws = new AwsApi($aws_key,$aws_secret);
		$data = $aws->getProductArtist($artist);
		$xml = simplexml_load_string($data);

		$this->render("viewAllProduct",array(
			"artist"=>$artist,
			"items"=>$xml->Items,
		));
	}

		
}