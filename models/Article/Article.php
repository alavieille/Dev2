<?php
/**
* Classe qui représente le modèle Article
* @author Amaury Lavieille
*/
namespace Dev2AL\Article;


use MvcApp\Components\Model;
use MvcApp\Components\App;

class Article extends Model
{
	protected $id;
    protected $titre;
    protected $chapo;
    protected $contenue;
    protected $auteur;
    protected $status;
    protected $dateCreation;
    protected $datePublication;

    protected $errors;

    /**
    * Crée un Article
	* @param array $data liste des données
    */
	protected function __construct($data=array()) 
    {

        parent::__construct();
        $data = $this->cleanVar($data);
        $this->id = $data['id'];
        $this->titre = $data['titre'];
        $this->chapo = $data['chapo'];
        $this->contenue = $data['contenue'];
        $this->auteur = $data['auteur'];
        $this->status = $data['status'];
        $this->dateCreation = $data['dateCreation'];
        $this->datePublication = $data['datePublication'];

    }

    /**
    * factory pour initialiser un objet Article
    * @param array $data la liste des données
    * @return une instance d' Article
    */
    public static function initialize($dataObj=array())
    {
        
        $data = array();
        $data['id'] = (isset($dataObj['id']) && trim($dataObj['id']) != '') ? (int) $dataObj['id'] : null ; 
        $data['titre'] = isset($dataObj['titre']) ? $dataObj['titre'] : '';
        $data['chapo'] = isset($dataObj['chapo']) ? $dataObj['chapo'] : '';
        $data['contenue'] = isset($dataObj['contenue']) ? $dataObj['contenue'] : '';
        $data['auteur'] = isset($dataObj['auteur']) ? $dataObj['auteur'] : '';
        $data['status'] = isset($dataObj['status']) ? $dataObj['status'] : null;
        $data['dateCreation'] = isset($dataObj['date_creation']) ? $dataObj['date_creation'] : null;
        $data['datePublication'] = isset($dataObj['date_publication']) ? $dataObj['date_publication'] : null;

        return new self($data);
    }


    /**
    * Retourne un aperçu du texte
    * @return String
    */
    public function excerptContenue()
    {
        $text = $this->contenue;
        if (strlen($text) > 300) { 
          $text = substr($text, 0, 300); 
          $text = substr($text,0,strrpos($text," ")); 
          $etc = " ...";  
          $text = $text.$etc; 
          }
        return $text; 
    }

  
    /**
    * Verifie si l'objet est valide
    **/
    public function valid(){
        if( $this->titre == "") {
            $this->errors["titre"] = "Le titre ne peut être vide";
        }

        if( $this->auteur == "") {
            $this->errors["auteur"] = "L'auteur ne peut être vide";
        }          

        if( strlen($this->chapo) > 300) {
            $this->errors["chapo"] = "Le chapô ne peut pas dépasser 300 caractères";
        }        

        if( $this->contenue == "") {
            $this->errors["contenue"] = "Le contenue ne peut être vide";
        }

        return(count($this->errors) == 0);

    }

	
}
