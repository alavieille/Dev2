<?php 
/**
* Classe qui représente un flux xml de type RSS2
* @author Amaury Lavieille
*/

namespace Dev2AL\Syndication;

class Rss2 extends AbstractSyndication
{



	public function getItems()
	{
		return $this->xml->channel->item;
		
	}

	public function getTitle()
	{
		return $this->xml->channel->title;
	}

}