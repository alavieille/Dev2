<?php 
/**
* Classe qui représente un flux xml de type Atom
* @author Amaury Lavieille
*/

namespace Dev2AL\Components\Syndication;

class Atom extends AbstractSyndication
{



	public function getItems()
	{
		return $this->xml->entry;
		
	}

	public function getTitle()
	{
		return $this->xml->title;
	}	


}