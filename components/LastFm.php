<?php 

namespace Dev2AL\Components;

class LastFm
{

	protected $methodUrl;
	protected $apiKey;
	protected $apiUrl;


	public function __construct($methodUrl,$apiKey)
	{
		$this->apiKey = $apiKey;
		$this->methodUrl = $methodUrl;
		$this->apiUrl = $methodUrl."&api_key=".$this->apiKey;

	}

	public function searchEvent($location)
	{
		$url = $this->apiUrl."&location=".$location;
		return $this->getData($url);
	}

	private function getData($url)
	{
		$proxy = "http://proxy.unicaen.fr:3128";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_PROXY, $proxy);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);
		return $data;
	}

//http://ws.audioscrobbler.com/2.0/?method=geo.getevents&api_key=f7556041b3454bdd1b36164dd4c68a03&location=paris

}