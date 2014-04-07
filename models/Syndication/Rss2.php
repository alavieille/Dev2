<?php 
/**
* Classe qui représente un flux xml de type RSS2
* @author Amaury Lavieille
*/

namespace Dev2AL\Syndication;

class Rss2
{

	protected $rss;

	public function __construct($data)
	{
		$this->rss = simplexml_load_string($data);

	}
	/*public function toHtml(){
		//var_dump($this);
		foreach ($this->children() as $child) {
			var_dump($child);
		}
	}*/
	

	public function getItem()
	{
		return $this->rss->channel->item;
	}

	public function getRss()
	{
		return $this->rss;
	}
}