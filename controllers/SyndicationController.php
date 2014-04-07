<?php 
/**
* Controlleur des flux RSS
* @author Amaury Lavieille
*/
namespace Dev2AL\Syndication;

use MvcApp\Components\Controller;
use MvcApp\Components\App;
use MvcApp\Components\AppException;



/**
* Controlleur des flux Rss
*/
class SyndicationController extends Controller
{

 	/**
    * initialise le controlleur de syndication
    */
    public function __construct()
    {
        $this->name = 'Syndication';
        parent::__construct();
    }

	protected function roles()
	{
	  return array(
	    array(
	        "role" => "*",
	        "actions" => array("rss2"),  
	    	)
	    );

	}

	public function rss2Action()
	{
		$url ="http://rss.lemonde.fr/c/205/f/3058/index.rss";
		$proxy = "http://proxy.unicaen.fr:3128";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_PROXY, $proxy);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);
		$rss2 = new Rss2($data);

		$this->render("viewAll",array(
			"items"=>$rss2->getItem(),
			"rss"=>$rss2->getRss(),
		));
		//var_dump($rss->toHtml());
	}
}