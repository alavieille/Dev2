<?php 	

namespace Dev2AL\Components;
use MvcApp\Core\App;

class AwsApi
{

	protected $awsAccesKey;
	protected $awsSecret;
	protected $baseUrl; 

	public function __construct($awsAccesKey,$awsSecret)
	{
		$this->awsAccesKey = $awsAccesKey;
		$this->awsSecret = $awsSecret;
		$this->baseUrl = "http://webservices.amazon.com/onca/xml?";
	}


	public function getProductArtist($artist)
	{
		$url_params = array(
			 'Operation'=>"ItemSearch",
			 'Service'=>"AWSECommerceService",
			 //'Keywords'=>$artist,
			 'Artist'=>$artist,
			 'AWSAccessKeyId'=>$this->awsAccesKey,
			 'AssociateTag'=>"yourtag10",
			 'Version'=>"2011-08-01",
			 'SearchIndex'=>'Music',
			 "Timestamp"=>gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time())
			 );
		$url = $this->createUrl($url_params);
		return $this->getData($url);

	}

	private function createUrl($url_params)
	{
		$url_parts = $this->sortParam($url_params);
		$signature = $this->createSignature($url_parts);
		$url_string = implode("&",$url_parts);
		$url = $this->baseUrl.$url_string."&Signature=".$signature;
		return $url;
	}

	private function sortParam($url_params)
	{
		$url_parts = array();
		foreach(array_keys($url_params) as $key)
		    $url_parts[] = $key."=".$url_params[$key];
		sort($url_parts);
		return $url_parts;
	}


	private function createSignature($url_parts)
	{
		$string_to_sign = "GET\nwebservices.amazon.com\n/onca/xml\n".implode("&",$url_parts);
		$string_to_sign = str_replace('+','%20',$string_to_sign);
		$string_to_sign = str_replace(':','%3A',$string_to_sign);
		$string_to_sign = str_replace(';',urlencode(';'),$string_to_sign);

		$signature = hash_hmac("sha256",$string_to_sign,$this->awsSecret,TRUE);


		$signature = base64_encode($signature);
		$signature = str_replace('+','%2B',$signature);
		$signature = str_replace('=','%3D',$signature);
		return $signature;

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
/*
$AWS_ACCESS_KEY_ID = "AKIAIRRFFYPENQMXAPXQ";
		$AWS_SECRET_ACCESS_KEY = "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";
		
		$base_url = "http://webservices.amazon.com/onca/xml?";
		$url_params = array(
		 'Operation'=>"ItemSearch",
		 'Service'=>"AWSECommerceService",
		 'Artist'=>"stromae",
		 'AWSAccessKeyId'=>$AWS_ACCESS_KEY_ID,
		 'AssociateTag'=>"yourtag10",
		 'Version'=>"2011-08-01",
		 'SearchIndex'=>'Music',
		 );

		// Add the Timestamp
		$url_params['Timestamp'] = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());

		// Sort the URL parameters
		$url_parts = array();
		foreach(array_keys($url_params) as $key)
		    $url_parts[] = $key."=".$url_params[$key];
		sort($url_parts);
		var_dump($url_parts);
		// Construct the string to sign
		$string_to_sign = "GET\nwebservices.amazon.com\n/onca/xml\n".implode("&",$url_parts);
		$string_to_sign = str_replace('+','%20',$string_to_sign);
		$string_to_sign = str_replace(':','%3A',$string_to_sign);
		$string_to_sign = str_replace(';',urlencode(';'),$string_to_sign);
		var_dump($string_to_sign);
		// Sign the request
		$signature = hash_hmac("sha256",$string_to_sign,$AWS_SECRET_ACCESS_KEY,TRUE);

		// Base64 encode the signature and make it URL safe
		$signature = base64_encode($signature);
		$signature = str_replace('+','%2B',$signature);
		$signature = str_replace('=','%3D',$signature);

		$url_string = implode("&",$url_parts);
		$url = $base_url.$url_string."&Signature=".$signature;*/