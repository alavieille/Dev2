<?php 

namespace Dev2AL\Components;
use MvcApp\Core\App;

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

	public function searchEventByLocation($location)
	{
		$url = $this->apiUrl."&location=".$location;
		return $this->getData($url);
	}

	public function searchEventByCoord($lat,$lng)
	{
		$url = $this->apiUrl."&lat=".$lat."&long=".$lng;
		return $this->getData($url);
	}

	private function getData($url)
	{
		$proxy = app::getApp()->getConfig("curl_proxy");
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_PROXY, $proxy);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);
		return $data;
	}

}