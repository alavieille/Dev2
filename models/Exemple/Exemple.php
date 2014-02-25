<?php
/**
* Classe qui représente le modèle Exemple
* @author Amaury Lavieille
*/

namespace MonAppli\Exemple;


class Exemple
{
	protected $id;
    protected $title;
    protected $content;

    /**
    * Crée un Exemple
	* @param array $data liste des données
    */
	protected function __construct($data=array()) 
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->content = $data['content'];

    }

    /**
    * factory pour initialiser un objet Exemple
    * @param array $data la liste des données
    * @return une instance de Exemple
    */
    public static function initialize($dataObj=array())
    {
        $data = array();

        if (isset($dataObj['id']) && (trim($dataObj['id']) != '')) {
            $data['id'] =  (int) $dataObj['id'];
        } else {
            $data['id'] = null;
        }

        $data['title'] = isset($dataObj['title']) ? $dataObj['title'] : '';
        $data['content'] = isset($dataObj['content']) ? $dataObj['content'] : '';
        return new self($data);
    }


    /**
     * Retourne l'id de l'exemple
     *
     * @return String id de l'exemple
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Modifie l'id de l'exemple
     *
     * @param String $newid Id de l'exemple
     */
    public function setId($id) {
        $this->id = $id;
    
        return $this;
    }


    /**
     * retourne le titre de l'exemple
     *
     * @return String titre de l'exemple
     */
    public function getTitle() {
        return $this->title;
    }
    
    /**
     * Change le titre de l'exemple
     *
     * @param String $newtitle Titre de l'exemple
     */
    public function setTitle($title) {
        $this->title = $title;
    
        return $this;
    }
    

    /**
     * Retourne le contenue de l'exemple
     *
     * @return String Contenue de l'exemple
     */
    public function getContent() {
        return $this->content;
    }
    
    /**
     * [Description]
     *
     * @param String $newcontent Contenue de l'exemple
     */
    public function setContent($content) {
        $this->content = $content;
    
        return $this;
    }
	
}
