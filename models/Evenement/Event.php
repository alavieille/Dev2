<?php
/**
* Classe qui représente le modèle evenement
* @author Amaury Lavieille
*/
namespace Dev2AL\Evenement;


use MvcApp\Core\Model;
use MvcApp\Core\App;

class Event extends Model
{

    protected $id; 
    protected $title;
    protected $artists;
    protected $ville;
    protected $pays;
    protected $lat;
    protected $long;
    protected $url;
    protected $site;

    
    /**
    * Crée un evenement
	* @param array $data liste des données
    */
	protected function __construct($data=array()) 
    {

        parent::__construct();
        $data = $this->cleanVar($data);

    }

    /**
    * factory pour initialiser un objet evenement
    * @param array $data la liste des données
    * @return une instance d'un evenement
    */
    public static function initialize($dataObj=array())
    {
        
        $data = array();

        return new self($data);
    }


	
}
