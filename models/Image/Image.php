<?php
/**
* Classe qui représente le modèle Image
* @author Amaury Lavieille
*/
namespace Dev2AL\Image;


use MvcApp\Core\Model;

class Image extends Model
{
	
    protected $id;
    protected $idArticle;
    protected $titre;
    protected $file;

    protected $errors;

    /**
    * Crée un objet Image
	* @param array $data liste des données
    */
	protected function __construct($data=array()) 
    {

        parent::__construct();
        $data = $this->cleanVar($data);
        $this->id = $data['id'];
        $this->idArticle = $data['idArticle'];
        $this->titre = $data['titre'];
        $this->file = $data['file'];

    }

    /**
    * factory pour initialiser un objet Images
    * @param array $data la liste des données
    * @return une instance d' Image
    */
    public static function initialize($dataObj=array())
    {
        
        $data = array();
        $data['id'] = (isset($dataObj['id']) && trim($dataObj['id']) != '') ? (int) $dataObj['id'] : null ; 
        $data['idArticle'] = (isset($dataObj['idArticle']) && trim($dataObj['idArticle']) != '') ? (int) $dataObj['idArticle'] : null ; 
        $data['titre'] = isset($dataObj['titre']) ? $dataObj['titre'] : '';
        $data['file'] = isset($dataObj['file']) ? $dataObj['file'] : '';
        return new self($data);
    }


    
    /**
    * Verifie si l'objet est valide
    **/
    public function valid(){
        if( $this->titre == "") {
            $this->errors["titre"] = "Le titre ne peut être vide";
        }
       
        return(count($this->errors) == 0);

    }

	
}
