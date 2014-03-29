<?php 
/**
* Class qui verifie l'authentification d'un utilisateur
*/

namespace Dev2AL\User;
use MvcApp\Components\Model;


class UserIdentity extends Model
{

	protected $email;
	protected $password;

 	/**
    * Crée un objet user identity
	* @param array $data liste des données
    */
	protected function __construct($data=array()) 
    {
        $data = $this->cleanVar($data);
        $this->email = $data['email'];
        $this->password = $data['password'];

     

    }

    /**
    * factory pour initialiser un objet 
    * @param array $data la liste des données
    * @return une instance de User identity
    */
    public static function initialize($dataObj=array())
    {
        
        $data = array();
        $data['email'] = isset($dataObj['email']) ?  $dataObj['email'] : '' ; 
        $data['password'] = isset($dataObj['password']) ? $dataObj['password'] : '';
 
        return new self($data);
    }

	/**
	 * Authentifie un utilisateur
	 * @return boolean retourne si l'utilisateur est authentifie
	 */
	public function valid()
	{

		$user = UserDB::getInstance()->findByAttribute('email',$this->email);
		if ($user===null) { // aucun utilisateur
			$this->errors["email"]="Utilisateur inconnue";
		}
		else if (($user->password !== $this->password )) { // Invalid password!
			$this->errors["password"]="Mot de passe inconnue";
		}

		
		return !$this->errors;
	}


	


}