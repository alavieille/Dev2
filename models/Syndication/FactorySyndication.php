<?php 

namespace Dev2AL\Syndication;

class FactorySyndication 
{
	protected $rss;

	public static function initialize($url)
	{
		
		$proxy = "http://proxy.unicaen.fr:3128";
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

