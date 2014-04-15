<?php 
/**
* Controlleur principale du site
* @author Amaury Lavieille
*/
namespace Dev2AL\Site;

use MvcApp\Core\Controller;
use MvcApp\Core\App;
use MvcApp\Core\AppException;



/**
* Controlleur du site
*/
class SiteController extends Controller
{

 	/**
    * initialise le controlleur du site
    */
    public function __construct()
    {
        $this->name = 'Site';
        parent::__construct();
    }

	protected function roles()
	{
	  return array(
	    array(
	        "role" => "*",
	        "actions" => array("searchPosition","test"),  
	    	)
	    );

	}

	public function searchPositionAction($lat,$lng)
	{
		$url = "http://api.geonames.org/findNearbyPlaceNameJSON?lat=".$lat."&lng=".$lng."&username=aron";
		$proxy = app::getApp()->getConfig("curl_proxy");
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_PROXY, $proxy);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);
		$data = json_decode($data,true);
  	if(App::getApp()->getRequest()->isAjax()) {
            echo json_encode($data);
        }
	}



		
}