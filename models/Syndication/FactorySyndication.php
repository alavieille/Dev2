<?php 

namespace Dev2AL\Syndication;

class FactorySyndication 
{
	protected $rss;

	public static function factorySyndication($url)
	{
		
		$url ="http://rss.lemonde.fr/c/205/f/3058/index.rss";
		$proxy = "http://proxy.unicaen.fr:3128";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_PROXY, $proxy);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);

		$this->rss = simplexml_load_string($data);
		if($feed->channel->item) {
			return new Rss2($data);
		}
		elseif($feed->entry) {
			return new Atom($data);
		}
   /* if ($feed->channel->item) {
        return true;
    } else {
        return false;
    }
}

function is_atom($feedxml) {
    @$feed = new SimpleXMLElement($feedxml);

    if ($feed->entry) {
        return true;
    } else {
        return false;
    } 
		if()

	}*/


}

