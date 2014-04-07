<?php 
/**
* Classe abstraite qui représente un flux rss
* @author Amaury Lavieille
*/

namespace Dev2AL\Syndication;

Abstract Class AbstractSyndication
{


	protected $xml;

	public function __construct($xml)
	{
		$this->xml = $xml;
	}


	public function getXml()
	{
		return $this->xml;
	}
}
