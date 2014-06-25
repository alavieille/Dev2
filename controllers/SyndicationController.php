<?php 
/**
* Controlleur des flux RSS
* @author Amaury Lavieille
*/
namespace Dev2AL\Syndication;



use MvcApp\Core\Controller;
use MvcApp\Core\App;
use MvcApp\Core\AppException;
use Dev2AL\Components\Syndication\FactorySyndication;


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
	        "actions" => array("leMondeRss","newYorkTimeRss","w3cRss","googleRss"),  
	    	)
	    );

	}


	public function leMondeRssAction(){
		$url = "http://rss.lemonde.fr/c/205/f/3058/index.rss";
		$this->rss($url);
	}

	public function newYorkTimeRssAction()
	{
		$url = "http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml";
		$this->rss($url);
	}

	public function w3cRssAction()
	{
		$url = "http://www.w3.org/blog/news/feed/atom";
		$this->rss($url);
	}

	public function googleRssAction()
	{
		$url = "http://feeds.feedburner.com/blogspot/MKuf?format=xml";
		$this->rss($url);
	}

	public function rss($url)
	{
		$rss = FactorySyndication::initialize($url);
		$this->render("viewAll",array(
			"rss"=>$rss,
		));
	}
}