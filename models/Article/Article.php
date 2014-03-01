<?php
/**
* Classe qui représente le modèle Article
* @author Amaury Lavieille
*/
namespace Dev2AL\Article;


use MvcApp\Components\Model;

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
        $data['dateCreation'] = isset($dataObj['dateCreation']) ? $dataObj['dateCreation'] : null;
        $data['datePublication'] = isset($dataObj['datePublication']) ? $dataObj['datePublication'] : null;

        return new self($data);
    }


    /**
    * Retourne un aperçu du texte
    * @return String
    */
    public function previousContenue()
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
     * Retourne l'id de l'article
     * @return String id de l'article
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Modifie l'id de l'article
     * @param String $id Id de l'article
     */
    public function setId($id) {
        $this->id = $id;
    
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
     * Retourne le chapo de l'article
     * @return String chapo de l'article
     */
    public function getChapo() {
        return $this->chapo;
    }
    
    /**
     * Change le contenue
     * @param String $chapo chapo de l'article
     */
    public function setChapo($chapo) {
        $this->content = $chapo;
    
        return $this;
    }

    /**
     * Retourne le contenue de l'article
     * @return String Contenue de l'article
     */
    public function getContenue() {
        return $this->contenue;
    }
    
    /**
     * Change le contenue
     * @param String $content Contenue de l'article
     */
    public function setContenue($content) {
        $this->content = $contenue;
    
        return $this;
    }

    /**
     * Retourne l'auteur de l'article
     * @return String Auteur de l'article
     */
    public function getAuteur() {
        return $this->auteur;
    }
    
    /**
     * Change l'auteur
     * @param String $auteur Auteur de l'article
     */
    public function setAuteur($auteur) {
        $this->auteur = $auteur;
        return $this;
    }

    /**
     * Retourne le status de l'article
     * @return String Status de l'article
     */
    public function getStatus() {
        return $this->status;
    }
    
    /**
     * Change le status
     * @param String $status Status de l'article
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * Retourne la date de creation de l'article
     * @return String date de creation de l'article
     */
    public function getDateCreation() {
        return $this->dateCreation;
    }
    
    /**
     * Change la date de creation
     * @param String $dateCreation Date de creation de l'article
     */
    public function setDateCreation($dateCreation) {
        $this->status = $dateCreation;
    }

    /**
     * Retourne la date de publication de l'article
     * @return String date de publication de l'article
     */
    public function getDatePublication() {
        return $this->datePublication;
    }
    
    /**
     * Change la date de publication
     * @param String $datePublication Date de publication de l'article
     */
    public function setDatePublication($datePublication) {
        $this->status = $datePublication;
    }


    /**
    * Retourne le tableau des erreurs
    * @return Array
    */
    public function getErrors(){
        return $this->errors;
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
