<?php 
/**
* Classe qui représente une requête
* @author Amaury Lavieille
*/

namespace MvcApp\Components;

class Request
{

	protected $post;
	protected $get;

	public function __construct()
	{

		$this->post = (count($_POST) > 0 ? $_POST : null);
		$this->get =  (count($_GET) > 0 ? $_GET : null);
	}


	/**
	* Retourne la clé index du tableau get
	* @param String $name index
	* @return Object ou Null si l'index n'existe pas
	*/
	public function getGetIndex($name)
	{
		if(array_key_exists($name, $this->get)) {
			return $this->get[$name];
		}
		else {
			return null;
		}
	}


	/**
	* Retourne la clé index du tableau post
	* @param String $name index
	* @return Object ou Null si l'index n'existe pas
	*/
    public function getPostIndex($name)
    {
        if (array_key_exists($name, $this->post)) {
            return $this->post[$name];
        } else {
            return null;
        }
    }


    public function getGet()
    {
    	return $this->get;
    }

    public function getPost()
    {
    	return $this->post;
    }

}	