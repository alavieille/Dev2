<?php 

namespace Dev2AL\Components\Syndication;
use MvcApp\Core\App;

class FactorySyndication 
{
	protected $rss;

	public static function initialize($url)
	{
		
		$proxy = app::getApp()->getConfig("curl_proxy");
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_PROXY, $proxy);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);

		$xml = simplexml_load_string($data);
		if($xml->channel->item) {
			return new Rss2($xml);
		}
		elseif($xml->entry) {
			return new Atom($xml);
		}
		else {
			throw new AppException("Type de flux inconnu");
			
		}
	}

}

