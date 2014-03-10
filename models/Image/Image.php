<?php
/**
* Classe qui représente le modèle Image
* @author Amaury Lavieille
*/
namespace Dev2AL\Image;


use MvcApp\Components\Model;

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
     * Retourne l'id de l'article
     * @return String id de l'article
     */
    public function getIdArticle() {
        return $this->idArticle;
    }
    
    /**
     * Modifie l'id de l'article
     * @param String $id Id de l'article
     */
    public function setIdArticle($id) {
        $this->idArticle = $idArticle;
        return $this;
    }


    /**
     * retourne le titre de l'article
     * @return String titre de l'article
     */
    public function getTitre() {
        return $this->titre;
    }
    
    /**
     * Change le titre de l'article
     * @param String $titre Titre de l'article
     */
    public function setTitre($titre) {
        $this->title = $titre;
    
        return $this;
    }
    

    /**
     * Retourne le fichie de l'image
     * @return String nom du fichier de l'image 
     */
    public function getFile() {
        return $this->file;
    }
    
    /**
     * Change le fichier de l'image
     * @param String nom du fichier de l'image 
     */
    public function setFile($string) {
        $this->file = $string;
    
        return $this;
    }

   
    /**
    * Retourne le tableau des erreurs
    * @return Array
    */
    public function getErrors(){
        return $this->errors;
    }   

    /**
    * ajoute une erreur
    * @param String $key nom de l'input 
    * @param String $value Message de l'erreur
    * @return Array
    */
    public function setErrors($key,$value){
        return $this->errors[$key]=$value;
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
