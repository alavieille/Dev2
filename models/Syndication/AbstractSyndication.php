<?php 
/**
* Classe abstraite qui représente un flux rss
* @author Amaury Lavieille
*/

Abstract Class AbstractSyndication
{


	protected $rss;

	public function __construct($rss)
	{
		$this->rss = $rss;
	}


	public function getRss()
	{
		return $this->rss;
	}
}
