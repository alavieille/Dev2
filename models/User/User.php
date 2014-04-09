<?php
/**
* Classe qui représente le modèle Useer
* @author Amaury Lavieille
*/
namespace Dev2AL\User;


use MvcApp\Core\Model;
use MvcApp\Core\App;

class User extends Model
{
	protected $id;
    protected $email;
    protected $password;
    protected $confirm;
    protected $nom;
    protected $prenom;
    protected $statut;



    /**
    * Crée un User
	* @param array $data liste des données
    */
	protected function __construct($data=array()) 
    {

        parent::__construct();
        $data = $this->cleanVar($data);
        $this->id = $data['id'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->nom = $data['nom'];
        $this->prenom = $data['prenom'];
        $this->statut = $data['statut'];
        $this->confirm = $data['confirm'];
    }

    /**
    * factory pour initialiser un objet User
    * @param array $data la liste des données
    * @return une instance d' User
    */
    public static function initialize($dataObj=array())
    {
        
        $data = array();
        $data['id'] = (isset($dataObj['id']) && trim($dataObj['id']) != '') ? (int) $dataObj['id'] : null ; 
        $data['email'] = isset($dataObj['email']) ? $dataObj['email'] : '';
        $data['password'] = isset($dataObj['password']) ? $dataObj['password'] : '';
        $data['nom'] = isset($dataObj['nom']) ? $dataObj['nom'] : '';
        $data['prenom'] = isset($dataObj['prenom']) ? $dataObj['prenom'] : '';        
        $data['confirm'] = isset($dataObj['confirm']) ? $dataObj['confirm'] : '';
        $data['statut'] = isset($dataObj['statut']) ? $dataObj['statut'] : null;

        return new self($data);
    }




    
    /**
    * Verifie si l'objet est valide
    **/
    public function valid(){
        if( $this->email == "" ) {
            $this->errors["email"] = "L'email ne peut être vide ";
        }       
        if( $this->password == "" ) {
            $this->errors["password"] = "Le mot de passe ne peut être vide ";
        }

        if( $this->confirm == "" ) {
            $this->errors["confirm"] = "La confirmation du mot de passe ne peut être vide ";
        }
        if( $this->confirm != $this->password ) {
            $this->errors["confirm"] = "Les mots de passe doivent être identique";
        }

        if( $this->nom == "" ) {
            $this->errors["nom"] = "Le nom ne peut être vide ";
        }
        if( $this->prenom == "" ) {
            $this->errors["prenom"] = "Le prenom ne peut être vide ";
        } 

        return(count($this->errors) == 0);
    }

	
}
